<?php
require_once 'config/core.php';

$user = new User();

// get posted data
$data = file_get_contents("php://input");

// validate user
if( $jwt = $user->signIn($data) ){
    // set response code
    http_response_code(200);
    echo json_encode(
        array(
            "message" => "Successful login.",
            "jwt" => $jwt
        )
    );
}
// login failed
else{
    // set response code
    http_response_code(401);
    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
?>
