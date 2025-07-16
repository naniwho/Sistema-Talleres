<?php

namespace App\Controllers;

use App\Models\Taller;
use App\Config\DB;

class TallerControlador
{
    public function listar()
    {
        $db = DB::connect();
        $modelo = new Taller($db);
        $talleres = $modelo->obtenerTalleres();

        if ($talleres !== false) {
            echo json_encode($talleres);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener talleres']);
        }
    }

    public function crear()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id_instructor'], $data['nombre'], $data['descripcion'], $data['fecha_inicio'], $data['fecha_fin'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios']);
            return;
        }

        $db = DB::connect();
        $modelo = new Taller($db);
        $resultado = $modelo->crearTaller(
            $data['id_instructor'],
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Taller creado exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear taller']);
        }
    }

    public function actualizar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'], $data['id_instructor'], $data['nombre'], $data['descripcion'], $data['fecha_inicio'], $data['fecha_fin'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos para actualizar']);
            return;
        }

        $db = DB::connect();
        $modelo = new Taller($db);
        $resultado = $modelo->actualizarTaller(
            $data['id'],
            $data['id_instructor'],
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin']
        );

        if ($resultado) {
            echo json_encode(['mensaje' => 'Taller actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar taller']);
        }
    }

    public function eliminar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el ID del taller a eliminar']);
            return;
        }

        $db = DB::connect();
        $modelo = new Taller($db);
        $resultado = $modelo->eliminarTaller($data['id']);

        if ($resultado) {
            echo json_encode(['mensaje' => 'Taller eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar taller']);
        }
    }
}
