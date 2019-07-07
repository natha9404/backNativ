<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/dbclass.php';
include_once 'curso.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
 
$curso = new Curso($connection);
 
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$curso->cur_codigo = $data->id;
 
// set product property values
$curso->cur_nombre = $data->nombre;
$curso->cur_horario = $data->horario;
$curso->cur_fecha_inicio = $data->fechaIni;
$curso->cur_fecha_fin = $data->fechaFin;
$curso->cur_nun_est_asociados = $data->numEst;

if($curso->update()){
 
    http_response_code(200);
    
    echo json_encode(array("message" => "El registro fue actualizado exitosamente."));
}else{
     
    http_response_code(503);
    
    echo json_encode(array("message" => "No se encontró el curso."));
}
?>