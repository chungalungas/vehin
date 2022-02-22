<?php
class Database{

    private $conn = null;

    // this function is called everytime this class is instantiated
    public function __construct( $dbhost = "localhost", $dbname = "vehin_db", $dbusr = "root", $dbpwd = ""){
        try{
            $this->connection = new PDO("mysql:host={$dbhost};dbname={$dbname};", $dbusr, $dbpwd);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // Insert data
    public function Insert( $query = "" , $params = [] ){
        try{
            $this->executeStatement( $query , $params );
            return $this->connection->lastInsertId();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // Select data
    public function Select( $query = "" , $params = [] ){
        try{
            $stmt = $this->executeStatement( $query , $params );
            return $stmt->fetchAll();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // Update data
    public function Update( $query = "" , $params = [] ){
        try{
            $this->executeStatement( $query , $params );
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // Remove data
    public function Remove( $query = "" , $params = [] ){
        try{
            $this->executeStatement( $query , $params );
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // execute statement
    private function executeStatement( $query = "" , $params = [] ){
        try{
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}
?>