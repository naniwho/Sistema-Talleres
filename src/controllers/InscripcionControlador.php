<?php

namespace App\Controllers;

use App\Models\Inscripcion;
use App\Config\DB;

class InscripcionControlador
{
    public function crear()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_estudiante'], $data['id_talleres'], $data['fecha'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos para registrar la inscripción']);
            return;
        }

        $db = DB::connect();
        $inscripcionModel = new Inscripcion($db);
        $resultado = $inscripcionModel->crearInscripcion(
            $data['id_estudiante'],
            $data['id_talleres'],
            $data['fecha']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Inscripción creada exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear inscripción']);
        }
    }

    public function listar()
    {
        $db = DB::connect();
        $inscripcionModel = new Inscripcion($db);
        $inscripciones = $inscripcionModel->obtenerInscripciones();

        if ($inscripciones !== false) {
            echo json_encode($inscripciones);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener inscripciones']);
        }
    }

    public function actualizar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'], $data['id_estudiante'], $data['id_talleres'], $data['fecha'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos para actualizar inscripción']);
            return;
        }

        $db = DB::connect();
        $inscripcionModel = new Inscripcion($db);
        $resultado = $inscripcionModel->actualizarInscripcion(
            $data['id'],
            $data['id_estudiante'],
            $data['id_talleres'],
            $data['fecha']
        );

        if ($resultado) {
            echo json_encode(['mensaje' => 'Inscripción actualizada']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar inscripción']);
        }
    }

    public function eliminar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el ID para eliminar inscripción']);
            return;
        }

        $db = DB::connect();
        $inscripcionModel = new Inscripcion($db);
        $resultado = $inscripcionModel->eliminarInscripcion($data['id']);

        if ($resultado) {
            echo json_encode(['mensaje' => 'Inscripción eliminada']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar inscripción']);
        }
    }
}
