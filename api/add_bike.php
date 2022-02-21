<?php
require_once 'config/core.php';

$bike = new Bike();

// get posted data
$data = file_get_contents("php://input");

// add the vehicle
if( $id = $bike->add($data) ){
    $data = json_decode( $data );

    // set response code
    http_response_code(200);

    // display message
    echo json_encode(array(
        "jwt" => $data->jwt,
        "message" => "Bike vehicle successfully added. ID: " . $id
        )
    );
}
else{ // message if unable to create user
    // set response code
    http_response_code(400);

    // display message: unable to create user
    echo json_encode(array("message" => "Unable to add the vehicle.".$data));
}
?>