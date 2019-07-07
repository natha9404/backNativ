<?php
/**
* Clase encargada del manejo de la información de los Cursos
**/
class Curso{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "curso";

    // table columns
    public $cur_codigo;
    public $cur_nombre;
    public $cur_horario;
    public $cur_fecha_inicio;
    public $cur_fecha_fin;
    public $cur_nun_est_asociados;
   
    public function __construct($connection){
        $this->connection = $connection;
    }

    /**
    ** Funcion encargada de crear un nuevo Curso
    **/
    public function create(){

        // SQL insert
        $query = "INSERT INTO " . $this->table_name . 
                  " (cur_nombre,cur_horario,cur_fecha_inicio,cur_fecha_fin,cur_nun_est_asociados)
                 VALUES ('$this->cur_nombre','$this->cur_horario','$this->cur_fecha_inicio','$this->cur_fecha_fin','$this->cur_nun_est_asociados')";

        // preparando el sql
        $stmt =$this->connection->prepare($query);

        // ejecutando el sql
        if($stmt->execute()){
        return true;
        }

        return false;

    }
    
    
    /**
     * Fucion encargada de leer todos los cursos
     **/
    public function read(){
       
        $query = "SELECT    cur_codigo as id,
                            cur_nombre as nombre,
                            cur_horario as horario,
                            cur_fecha_inicio as fechaIni,
                            cur_fecha_fin as fechaFin,
                            cur_nun_est_asociados as numEst
                        FROM " . $this->table_name . " ORDER BY nombre DESC;";

        $stmt = $this->connection->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }
    
    /**
     * Funcion para actualizar la información de un curso
     * */
    public function update(){

        // update sql
         $query = "UPDATE
                    " . $this->table_name . "
                SET
                    cur_nombre = '$this->cur_nombre',
                    cur_horario = '$this->cur_horario',
                    cur_fecha_inicio = '$this->cur_fecha_inicio',
                    cur_fecha_fin = '$this->cur_fecha_fin',
                    cur_nun_est_asociados = '$this->cur_nun_est_asociados'
                WHERE
                    cur_codigo = '$this->cur_codigo' ";

                // se prepara el sql
                $stmt = $this->connection->prepare($query);

                // execute the query
                if($stmt->execute()){
                return true;
                }

                return false;
    }
    
    
    /**
     * Funcion para eliminar un curso 
     **/
    public function delete(){
        // update sql
        $query =    "DELETE FROM "
                    . $this->table_name . "
                    WHERE
                        cur_codigo = '$this->est_codigo'; ";

            // se prepara el sql
            $stmt = $this->connection->prepare($query);

            // execute the query
            if($stmt->execute()){
                return true;
            }else{

                return false;
            }

            
    }

     /**
     * Fucion encargada de obtener el top 3 de los cursos con más estudiantes 
     * 
     **/
    public function topCursos(){
    
    //fecha actual    
    $fecha_actual = date("Y-m-d");
    //fecha actual menos 6 meses
    $fecha_menor = date("Y-m-d",strtotime($fecha_actual."- 6 month")); 

    $query = "SELECT    cur_codigo as id,
                            cur_nombre as nombre,
                            cur_horario as horario,
                            cur_fecha_inicio as fechaIni,
                            cur_fecha_fin as fechaFin,
                            cur_nun_est_asociados as numEst
                        FROM " . $this->table_name . " WHERE cur_fecha_inicio > '$fecha_menor'
                            AND cur_fecha_fin < '$fecha_actual'
                            ORDER BY nombre DESC LIMIT 3;";

        $stmt = $this->connection->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }
}