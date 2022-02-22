<?php
class Sedan extends Vehicle{
    private static $type = "Sedan";

    public function __construct(){
        $this->wheels = 4;  // Set number of wheels
        parent::__construct();
    }

    public function add(string $data){
        return $this->addVehicle(self::$type, $data);
    }
}
?>