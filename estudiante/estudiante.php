<?php
/**
* Clase encargada del manejo de la información de los estudiantes
**/
class Estudiante{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "estudiante";

    // table columns
    public $est_codigo;
    public $est_nombre;
    public $est_apellido;
    public $est_edad;
    public $est_correo;
    public $est_cursos_asociados;
   
    public function __construct($connection){
        $this->connection = $connection;
    }

    /**
    ** Funcion encargada de crear un nuevo estudiante
    **/
    public function create(){

        // SQL insert
        $query = "INSERT INTO " . $this->table_name . 
                 " (est_nombre,est_apellido,est_edad,est_correo,est_cursos_asociados)
                 VALUES ('$this->est_nombre','$this->est_apellido','$this->est_edad','$this->est_correo','$this->est_cursos_asociados')";

        // preparando el sql
        $stmt =$this->connection->prepare($query);

        // ejecutando el sql
        if($stmt->execute()){
        return true;
        }

        return false;

    }
    
    
    /**
     * Fucion encargada de leer todos los estudiantes
     **/
    public function read(){
       
        $query = "SELECT    est_codigo as id,
                            est_nombre as nombres,
                            est_apellido as apellidos,
                            est_edad as edad,
                            est_correo as correo,
                            est_cursos_asociados as cursos_asociados
                        FROM " . $this->table_name . " ORDER BY est_apellido DESC;";

        $stmt = $this->connection->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }
    
    /**
     * Funcion para actualizar la información de un estudiante
     * */
    public function update(){

        // update sql
         $query = "UPDATE
                    " . $this->table_name . "
                SET
                    est_nombre = '$this->est_nombre',
                    est_apellido = '$this->est_apellido',
                    est_edad = '$this->est_edad',
                    est_correo = '$this->est_correo',
                    est_cursos_asociados = '$this->est_cursos_asociados'
                WHERE
                    est_codigo = '$this->est_codigo' ";

                // se prepara el sql
                $stmt = $this->connection->prepare($query);

                // execute the query
                if($stmt->execute()){
                return true;
                }

                return false;
    }
    
    
    /**
     * Funcion para eliminar un estudiante 
     **/
    public function delete(){
        // update sql
        $query =    "DELETE FROM "
                    . $this->table_name . "
                    WHERE
                        est_codigo = '$this->est_codigo'; ";

            // se prepara el sql
            $stmt = $this->connection->prepare($query);
//print_r($stmt);exit;
            // execute the query
            if($stmt->execute()){
                return true;
            }else{

                return false;
            }

            
    }
}