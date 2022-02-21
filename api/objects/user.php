<?php
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class User extends UserDB{
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    private $password;

    // variables used for jwt
    private static $secret_key = "vehin_key";
    private static $encrypt = 'HS256';
    private static $issuer = "http://localhost/api/";

    public function __construct(){
        parent::__construct();
    }

    function signIn(string $data){
        $data = json_decode( $data );
        $this->email = $data->email;

        $db_data = $this->emailExists($this->email);

        if( !empty($db_data[0]['password']) && password_verify($data->password, $db_data[0]['password'] ) ){
            $this->id = $db_data[0]['id'];
            $this->firstname = $db_data[0]['firstname'];
            $this->lastname  = $db_data[0]['lastname'];
            $this->password  = $db_data[0]['password'];

            $time = time();

            $token = array(
               "iat" => $time,
               "exp" => $time + (60*5), // 5 minutes valid
               "iss" => self::$issuer,
               "data" => array(
                   "id" => $this->id,
                   "firstname" => $this->firstname,
                   "lastname" => $this->lastname,
                   "email" => $this->email
               )
            );

            // generate jwt
            return JWT::encode($token, self::$secret_key, self::$encrypt);
        }
        else{
            return false;
        }
    }

    function validateToken(string $data){
        $data = json_decode( $data );
        $jwt = isset($data->jwt) ? $data->jwt : "";

        // if jwt is not empty
        if($jwt){
            // if decode succeed, show user details
            try {
                // decode jwt
                $decoded = JWT::decode($jwt, new Key( self::$secret_key, self::$encrypt ));

                return true; // $decoded
            }

            // if decode fails, it means jwt is invalid
            catch (Exception $e){
                // set response code
                http_response_code(401);
                // tell the user access denied
                echo json_encode(array("message" => "Access denied."));
            }
        }
        // show error message if jwt is empty
        else{
            // set response code
            http_response_code(401);
            // tell the user access denied
            echo json_encode(array("message" => "Access denied."));
        }
    }

    function getTokenData(string $data){
        if($decoded = $this->validateToken($data)){
            // set response code
            http_response_code(200);
            // show user details
            echo json_encode(array(
                "message" => "Access granted.",
                "data" => $decoded->data
            ));
        }
        // show error message if jwt is empty
        else{
            // set response code
            http_response_code(401);
            // tell the user access denied
            echo json_encode(array("message" => "Access denied."));
        }
    }
}
