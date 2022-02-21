<?php
abstract class Vehicle extends Database{
    // Users table name
    protected $table_name = "vehicles";

    protected $wheels;
    protected $hp;

    public function __construct(){
        $this->setNumberOfWheels($this->wheels); // Set number of wheels
        parent::__construct();
    }

    public function setNumberOfWheels($wheels){
        $this->wheels = $wheels;
    }

    public function setHP($hp){
        $this->hp = $hp;
    }

    public function addVehicle(string $type, string $data){
        $data = json_decode( $data );

        // sanitize
        $this->hp = htmlspecialchars(strip_tags($data->hp));

        $query = "INSERT INTO " . $this->table_name . "
                  SET type = :type,
                    wheels = :wheels,
                    hp = :hp";

        // create params array
        $params = array(
            'type' => $type,
            'wheels' => $this->wheels,
            'hp' => $this->hp
        );

        // execute the query, also check if query was successful
        $id = $this->Insert( $query, $params );
        if($id){
            return $id;
        }

        return false;
    }

    public function inventorySummary(){
        $query = "SELECT type AS 'Type', COUNT(*) AS 'Total'
                    FROM " . $this->table_name ."
                    GROUP BY type";
        $summary_data = $this->Select( $query );

        $query = "SELECT id AS 'ID', type AS 'Type', hp AS 'Motor Power (HP)', create_timestamp AS 'Date Added'
                    FROM " . $this->table_name ."
                    ORDER BY create_timestamp";
        $detail_data = $this->Select( $query );

        return array( "summary" => $summary_data, "detail" => $detail_data );
    }

    abstract public function add(string $data);
}
