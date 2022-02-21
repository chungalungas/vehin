<?php
class UserDB extends Database{
    // Users table name
    private $table_name = "users";

    // object properties
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    public function __construct(){
        parent::__construct();
    }

    // create new user aacount
    function create(string $data){
        $data = json_decode( $data );

        // set property values
        $this->firstname = $data->firstname;
        $this->lastname = $data->lastname;
        $this->email = $data->email;
        $this->password = $data->password;

        if(
            !empty($this->firstname) &&
            !empty($this->email) &&
            !empty($this->password)
        ){
            $query = "INSERT INTO " . $this->table_name . "
                      SET firstname = :firstname,
                        lastname = :lastname,
                        email = :email,
                        password = :password";

            // sanitize
            $this->firstname = htmlspecialchars(strip_tags($this->firstname));
            $this->lastname = htmlspecialchars(strip_tags($this->lastname));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = password_hash(htmlspecialchars(strip_tags($this->password)), PASSWORD_BCRYPT);

            // create params array
            $params = array(
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'password' => $this->password
            );

            // execute the query, also check if query was successful
            $id = $this->Insert( $query, $params );
            if($id){
                return true;
            }

            return false;
        }
        else{
            return false;
        }
    }

    // check if given email exist in the database
    function emailExists($email){
        // query to check if email exists
        $query = "SELECT id, firstname, lastname, password
                FROM " . $this->table_name . "
                WHERE email = :email
                LIMIT 0,1";

        // sanitize
        $email = htmlspecialchars(strip_tags($email));

        // create params array
        $params = array( 'email' => $email );

        // execute the query
        return $this->Select( $query, $params );
    }
}
