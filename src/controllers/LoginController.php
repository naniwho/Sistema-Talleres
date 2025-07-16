<?php

namespace App\Controllers;

use App\Models\Usuario;

class LoginController
{
    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['usuario']) || !isset($data['contrasena'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos']);
            return;
        }

        $usuario = new Usuario();
        $resultado = $usuario->verificarCredenciales($data['usuario'], $data['contrasena']);

        if ($resultado) {
            
            echo json_encode(['mensaje' => 'Inicio de sesión exitoso', 'usuario' => $resultado]);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Credenciales inválidas']);
        }
    }
}
