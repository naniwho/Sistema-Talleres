<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Config\DB;

class UsuarioControlador
{
    public function crear()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['nombre'], $data['correo'], $data['clave'], $data['rol'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios']);
            return;
        }

        $db = DB::connect();
        $usuarioModel = new Usuario($db);
        $resultado = $usuarioModel->crearUsuario(
            $data['nombre'],
            $data['correo'],
            $data['clave'],
            $data['rol']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Usuario creado exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear usuario']);
        }
    }

    public function listar()
    {
        $db = DB::connect();
        $usuarioModel = new Usuario($db);
        $usuarios = $usuarioModel->obtenerUsuarios();

        if ($usuarios !== false) {
            echo json_encode($usuarios);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener usuarios']);
        }
    }

    public function actualizar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'], $data['nombre'], $data['correo'], $data['rol'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios para actualizar']);
            return;
        }

        $db = DB::connect();
        $usuarioModel = new Usuario($db);
        $resultado = $usuarioModel->actualizarUsuario(
            $data['id'],
            $data['nombre'],
            $data['correo'],
            $data['rol']
        );

        if ($resultado) {
            echo json_encode(['mensaje' => 'Usuario actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar usuario']);
        }
    }

    public function eliminar()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el ID del usuario a eliminar']);
            return;
        }

        $db = DB::connect();
        $usuarioModel = new Usuario($db);
        $resultado = $usuarioModel->eliminarUsuario($data['id']);

        if ($resultado) {
            echo json_encode(['mensaje' => 'Usuario eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar usuario']);
        }
    }
}
