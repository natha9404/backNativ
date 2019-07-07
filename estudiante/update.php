<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/dbclass.php';
include_once 'estudiante.php';
 
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
 
$estudiante = new Estudiante($connection);
 
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$estudiante->est_codigo = $data->id;
 
// set product property values
$estudiante->est_nombre = $data->nombre;
$estudiante->est_apellido = $data->apellido;
$estudiante->est_edad = $data->edad;
$estudiante->est_correo = $data->correo;
$estudiante->est_cursos_asociados = $data->cursos;

if($estudiante->update()){
 
    http_response_code(200);
    
    echo json_encode(array("message" => "El registro fue actualizado exitosamente."));
}else{
     
    http_response_code(503);
    
    echo json_encode(array("message" => "No se encontró el estudiante."));
}
?>