<?php
include_once 'config/core.php';

$user = new User();

// get posted data
$data = file_get_contents("php://input");

if($user->validateToken($data)){
    http_response_code(200);
    // show user details
    echo json_encode(array(
        "message" => "Access granted."
    ));
}
?>