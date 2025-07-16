<?php

namespace App\Controllers;

use App\Models\Calificacion;
use App\Config\DB;

class CalificacionController
{
    public function listar()
    {
        $db = DB::connect();
        $modelo = new Calificacion($db);
        $resultado = $modelo->obtenerCalificaciones();
        echo json_encode($resultado ?: []);
    }

    public function crear()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_inscripcion'], $data['nota'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos obligatorios']);
            return;
        }

        $db = DB::connect();
        $modelo = new Calificacion($db);
        $resultado = $modelo->crearCalificacion($data['id_inscripcion'], $data['nota']);

        echo json_encode($resultado ? ['mensaje' => 'Calificación registrada correctamente'] : ['error' => 'Error al registrar']);
    }

    public function actualizar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_calificacion'], $data['id_inscripcion'], $data['nota'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos obligatorios']);
            return;
        }

        $db = DB::connect();
        $modelo = new Calificacion($db);
        $resultado = $modelo->actualizarCalificacion(
            $data['id_calificacion'],
            $data['id_inscripcion'],
            $data['nota']
        );

        echo json_encode($resultado ? ['mensaje' => 'Calificación actualizada'] : ['error' => 'Error al actualizar']);
    }

    public function eliminar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_calificacion'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID requerido']);
            return;
        }

        $db = DB::connect();
        $modelo = new Calificacion($db);
        $resultado = $modelo->eliminarCalificacion($data['id_calificacion']);

        echo json_encode($resultado ? ['mensaje' => 'Calificación eliminada'] : ['error' => 'Error al eliminar']);
    }
}
