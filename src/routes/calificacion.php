<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\CalificacionController;

header("Content-Type: application/json");

$metodo = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$controller = new CalificacionController();

if (strpos($uri, '/calificaciones/listar') !== false && $metodo === 'GET') {
    $controller->listar();
} elseif (strpos($uri, '/calificaciones/crear') !== false && $metodo === 'POST') {
    $controller->crear();
} elseif (strpos($uri, '/calificaciones/actualizar') !== false && $metodo === 'POST') {
    $controller->actualizar();
} elseif (strpos($uri, '/calificaciones/eliminar') !== false && $metodo === 'POST') {
    $controller->eliminar();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Ruta o método no válido']);
}
