<?php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../src/config/db.php';

use App\Config\DB;
$pdo = DB::connect();

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (!empty($correo) && !empty($contrasena)) {
        $query = "SELECT * FROM usuario WHERE correo = :correo LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch();

        if ($usuario && $usuario['contraseña'] === $contrasena) {
            $_SESSION['user'] = [
                'id_usuario' => $usuario['id_usuario'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['rol']
            ];
            header('Location: dashboard.php');
            exit;
        } else {
            $mensaje = "Correo o contraseña incorrectos.";
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EduTalleres - Login</title>
    <link rel="stylesheet" href="../estilos/login.css">
    <link rel="icon" type="image/png" href="../public/imagenes/logo.png">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="../public/imagenes/logo_principal.png" alt="Logo EduTalleres" style="width: 200px; margin-bottom: 10px;">
                <p>Bienvenido al sistema de gestión de talleres</p>
            </div>
            <?php if (!empty($mensaje)): ?>
                <p style="color: red;"><?= $mensaje ?></p>
            <?php endif; ?>
            <form class="login-form" method="POST" action="">
                <div class="input-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" name="correo" required>
                </div>
                <div class="input-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" required>
                </div>
                <button type="submit">Iniciar sesión</button>
            </form>
            <div class="login-footer">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
</body>
</html>
