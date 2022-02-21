<?php
require_once 'config/core.php';

$user = new User();
$vehicle = new Sedan();

// get posted data
$data = file_get_contents("php://input");

if( $user->validateToken($data) ){
    $data = json_decode($data);
    echo json_encode(array(
        "message" => "Access granted",
        "data" => array(
                "inventory" => $vehicle->inventorySummary()
            )
        )
    );
}
?>