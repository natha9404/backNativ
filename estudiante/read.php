<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/dbclass.php';
include_once 'estudiante.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$estudiante = new Estudiante($connection);

$stmt = $estudiante->read();


$count = $stmt->rowCount();

if($count > 0){


    $estudiantes = array();
    $estudiantes["body"] = array();
    $estudiantes["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $estudiante  = array(
              "id" => $id,
              "nombres" => $nombres,
              "apellidos" => $apellidos,
              "edad" => $edad,
              "correo" => $correo,
              "cursos_asociados" => $cursos_asociados,
        );

        array_push($estudiantes["body"], $estudiante);
    }
    http_response_code(200);
    echo json_encode($estudiantes);
    
} else {
    http_response_code(404);
    echo json_encode(array("body" => array(), "count" => 0));
}

?>