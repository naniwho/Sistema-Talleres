<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\UsuarioControlador;

header("Content-Type: application/json");

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        (new UsuarioControlador())->listar();
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'])) {
            (new UsuarioControlador())->actualizar();
        } else {
            (new UsuarioControlador())->crear();
        }
        break;

    case 'DELETE':
        (new UsuarioControlador())->eliminar();
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
