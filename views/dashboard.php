<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$nombre = $_SESSION['user']['nombre'];
$rol = $_SESSION['user']['rol'];

$roles = [1 => 'Padre', 2 => 'Estudiante', 3 => 'Instructor', 4 => 'Administrador'];
$rolNombre = $roles[$rol] ?? 'Desconocido';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../estilos/login.css"> <!-- Reutilizando estilos por simplicidad -->
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">📚</div>
                <h2>Bienvenido</h2>
            </div>
            <div class="sidebar-nav">
                <ul>
                    <li class="active"><a href="#">Inicio</a></li>
                    <li><a href="#">Perfil</a></li>
                    <li><a href="#">Talleres</a></li>
                </ul>
            </div>
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar"><?= strtoupper(substr($nombre, 0, 1)) ?></div>
                    <div>
                        <div class="user-name"><?= htmlspecialchars($nombre) ?></div>
                        <div class="user-role"><?= $rolNombre ?></div>
                    </div>
                </div>
                <a class="logout-button" href="logout.php">Cerrar sesión</a>
            </div>
        </div>

        <div class="main-content">
            <div class="main-header">
                <h1>¡Hola, <?= htmlspecialchars($nombre) ?>!</h1>
                <p>Este es tu panel de inicio.</p>
            </div>
            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header">
                        <h3>Resumen</h3>
                    </div>
                    <div class="card-body">
                        <p>Aquí se puede mostrar información relevante del sistema.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
