<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\DB;
use App\Models\Usuario;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $clave = $_POST['clave'] ?? '';

    $db = DB::connect();
    $usuarioModel = new Usuario($db);
    $usuario = $usuarioModel->autenticar($correo, $clave);

    if ($usuario) {
        $_SESSION['user'] = [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol']
        ];

        header('Location: ../../views/dashboard.php');
        exit;
    } else {
        echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='../../views/login.php';</script>";
    }
} else {
    http_response_code(405);
    echo "Método no permitido";
}
