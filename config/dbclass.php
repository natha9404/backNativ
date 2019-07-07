<?php

/**
 * Clase que se encarga de relizar la conexión a la base de datos
 **/
 
class DBClass {

    private $host = "http://q68u8b2buodpme2n.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $username = "sgzw0zsuhfj1bvjk";
    private $password = "pfnul6l99a8l55v0";
    private $database = "l24vnq4wgnbleib4";

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
