<?php

/**
 * Clase que se encarga de relizar la conexión a la base de datos
 **/
 
class DBClass {

    private $host = "127.0.0.1";
    private $username = "prueba";
    private $password = "prueba";
    private $database = "api_prueba";

    public $connection;

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database.";charset=utf8", $this->username, $this->password);
            $this->connection->exec("set names utf8");
            
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}

?>