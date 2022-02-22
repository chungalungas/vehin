<?php
class Bike extends Vehicle{
    private static $type = "Bike";

    public function __construct(){
        $this->wheels = 2;  // Set number of wheels
        parent::__construct();
    }

    public function add(string $data){
        return $this->addVehicle(self::$type, $data);
    }
}
?>