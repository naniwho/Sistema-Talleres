<?php

namespace App\Controllers;

use App\Models\Asistencia;
use App\Config\DB;

class AsistenciaControlador
{
    public function crear()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_inscripcion'], $data['fecha'], $data['presente'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios']);
            return;
        }

        $db = DB::connect();
        $asistenciaModel = new Asistencia($db);
        $resultado = $asistenciaModel->crearAsistencias(
            $data['id_inscripcion'],
            $data['fecha'],
            $data['presente']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Asistencia registrada exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al registrar asistencia']);
        }
    }

    public function listar()
    {
        $db = DB::connect();
        $asistenciaModel = new Asistencia($db);
        $asistencias = $asistenciaModel->obtenerAsistencias();

        if ($asistencias !== false) {
            echo json_encode($asistencias);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener asistencias']);
        }
    }

    public function actualizar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_asistencia'], $data['id_inscripcion'], $data['fecha'], $data['presente'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios para actualizar']);
            return;
        }

        $db = DB::connect();
        $asistenciaModel = new Asistencia($db);
        $resultado = $asistenciaModel->actualizarAsistencias(
            $data['id_asistencia'],
            $data['id_inscripcion'],
            $data['fecha'],
            $data['presente']
        );

        if ($resultado) {
            echo json_encode(['mensaje' => 'Asistencia actualizada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar asistencia']);
        }
    }

    public function eliminar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_asistencia'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el ID de la asistencia a eliminar']);
            return;
        }

        $db = DB::connect();
        $asistenciaModel = new Asistencia($db);
        $resultado = $asistenciaModel->eliminarAsistencias($data['id_asistencia']);

        if ($resultado) {
            echo json_encode(['mensaje' => 'Asistencia eliminada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar asistencia']);
        }
    }
}