<?php
require_once 'config/core.php';

$user = new User();

// get posted data
$data = file_get_contents("php://input");

// create the user
if( $user->create($data) ){
    // set response code
    http_response_code(200);

    // display message: user was created
    echo json_encode(array("message" => "User was created."));
}
else{ // message if unable to create user
    // set response code
    http_response_code(400);

    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create user.".$data));
}
?>