<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\TallerControlador;

header("Content-Type: application/json");

$metodo = $_SERVER['REQUEST_METHOD'];

$controlador = new TallerControlador();

switch ($metodo) {
    case 'GET':
        $controlador->listar();
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'])) {
            $controlador->actualizar();
        } else {
            $controlador->crear();
        }
        break;

    case 'DELETE':
        $controlador->eliminar();
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
