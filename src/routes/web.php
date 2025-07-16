<?php

use App\Controllers\LoginController;

require_once __DIR__ . '/../vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/Sistema-Talleres'; 
$uri = str_replace($basePath, '', $uri);

switch ($uri) {
    case '/login':
    case '/':
        $controller = new LoginController();
        $controller->mostrarLogin();
        break;

    case '/login/verificar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new LoginController();
            $controller->verificarCredenciales($_POST['usuario'], $_POST['contrasena']);
        } else {
            http_response_code(405);
            echo 'Método no permitido';
        }
        break;

    case '/logout':
        session_destroy();
        header('Location: /login');
        break;

    default:
        http_response_code(404);
        echo 'Página no encontrada';
        break;
}
