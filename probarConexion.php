<?php
require __DIR__ . '/vendor/autoload.php';
use App\Config\DB;

$conexion = DB::connect();
echo "✅ Conexión exitosa a la base de datos.";
