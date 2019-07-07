<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/dbclass.php';
include_once 'estudiante.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
 
$estudiante = new Estudiante($connection);
 
// obtenemos los datos envidos por post
$data = json_decode(file_get_contents("php://input"));

// se valida que los datos no esten vacios
if(
    !empty($data->nombre) &&
    !empty($data->apellido) &&
    !empty($data->edad) &&
    !empty($data->correo) &&
    !empty($data->cursos)
){
 
    // se agregan los atributos la objeto
    $estudiante->est_nombre = $data->nombre;
    $estudiante->est_apellido = $data->apellido;
    $estudiante->est_edad = $data->edad;
    $estudiante->est_correo = $data->correo;
    $estudiante->est_cursos_asociados = $data->cursos;
 
    // se llama a la funcion crear el objeto
    if($estudiante->create()){
 
        // se cambia el código de respuesta
        http_response_code(201);
 
        // Se envía el mensaje de exito al usuario
        echo json_encode(array("message" => "El estudiante fue creado exitosamente."));
    }
 
    // si no se pudo crear se retorna el error
    else{
 
        // se cambia el código de respuesta - 503 Servicio no disponible
        http_response_code(503);
 
        // se cambia el mensaje de error al usuario
        echo json_encode(array("message" => "El estudiante no pudo ser creado"));
    }
}
 
// Si la información esta incompleta 
else{
 
    // se cambia el código de respuesta
    http_response_code(400);
 
    // se cambia el mensaje de error al usuario
    echo json_encode(array("message" => "El estudiante no pudo ser creado. Información incompleta"));
}
?>