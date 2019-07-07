<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/dbclass.php';
include_once 'estudiante.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
 
$estudiante = new Estudiante($connection);
  
// set ID property of record to read
$estudiante->est_codigo = isset($_GET['id']) ? $_GET['id'] : die();
 
if($estudiante->est_codigo){
    if($estudiante->delete()){

            // set response code - 200 OK
            http_response_code(200);
        
            // make it json format
            echo json_encode(array("message" => "Registro eliminado exitosamente."));
    }else{

        http_response_code(503);
        echo json_encode(array("message" => "El id no se encontró"));
    }

}else{
    
    http_response_code(404);
    echo json_encode(array("message" => "El campo id es necesario"));

}

?>