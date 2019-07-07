<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/dbclass.php';
include_once 'curso.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
 
$curso = new Curso($connection);
 
// obtenemos los datos envidos por post
$data = json_decode(file_get_contents("php://input"));

// se valida que los datos no esten vacios
if(
    !empty($data->nombre) &&
    !empty($data->horario) &&
    !empty($data->fechaIni) &&
    !empty($data->fechaFin) &&
    !empty($data->numEst)
){
 
    // se agregan los atributos la objeto
    $curso->cur_nombre = $data->nombre;
    $curso->cur_horario = $data->horario;
    $curso->cur_fecha_inicio = $data->fechaIni;
    $curso->cur_fecha_fin = $data->fechaFin;
    $curso->cur_nun_est_asociados = $data->numEst;
 
    // se llama a la funcion crear el objeto
    if($curso->create()){
 
        // se cambia el código de respuesta
        http_response_code(201);
 
        // Se envía el mensaje de exito al usuario
        echo json_encode(array("message" => "El curso fue creado exitosamente."));
    }
 
    // si no se pudo crear se retorna el error
    else{
 
        // se cambia el código de respuesta - 503 Servicio no disponible
        http_response_code(503);
 
        // se cambia el mensaje de error al usuario
        echo json_encode(array("message" => "El curso no pudo ser creado"));
    }
}
 
// Si la información esta incompleta 
else{
 
    // se cambia el código de respuesta
    http_response_code(400);
 
    // se cambia el mensaje de error al usuario
    echo json_encode(array("message" => "El curso no pudo ser creado. Información incompleta"));
}
?>