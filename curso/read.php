<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/dbclass.php';
include_once 'curso.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
 
$curso = new Curso($connection);

$stmt = $curso->read();


$count = $stmt->rowCount();

if($count > 0){


    $cursos = array();
    $cursos["body"] = array();
    $cursos["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $curso  = array(
              "id" => $id,
              "nombre" => $nombre,
              "horario" => $horario,
              "fecha_inicio" => $fechaIni,
              "fecha_fin" => $fechaFin,
              "numero_estudiantes" => $numEst
        );

        array_push($cursos["body"], $curso);
    }
    http_response_code(200);
    echo json_encode($cursos);
    
} else {
    http_response_code(404);
    echo json_encode(array("body" => array(), "count" => 0));
}

?>