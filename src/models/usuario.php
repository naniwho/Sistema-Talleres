<?php

namespace App\Models;

use PDO;
use PDOException;

class Usuario
{
    private $conexion;

    public function __construct($db)
    {
        $this->conexion = $db;
    }

    public function autenticar($correo, $contrasena)
    {
        try {
            $query = "SELECT * FROM usuario WHERE correo = :correo";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":correo", $correo);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                return $usuario; // Autenticación exitosa
            }

            return false; // Falló la autenticación
        } catch (PDOException $e) {
            error_log("Error en autenticar: " . $e->getMessage());
            return false;
        }
    }

    public function crearUsuario($nombre, $correo, $clave, $rol)
    {
        try {
            $hash = password_hash($clave, PASSWORD_DEFAULT);

             $query = "INSERT INTO usuario (nombre, correo, contrasena, rol) 
                      VALUES (:nombre, :correo, :clave, :rol)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':clave', $hash);
            $stmt->bindParam(':rol', $rol);

            return $stmt->execute();
        } catch (PDOException $e) {
           error_log("Error al crear usuario: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerUsuarios()
    {
        try {
            $query = "SELECT id_usuario, nombre, correo, rol FROM usuario";
         $stmt = $this->conexion->prepare($query);
         $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarUsuario($id, $nombre, $correo, $rol)
    {
        try {
            $query = "UPDATE usuario SET nombre = :nombre, correo = :correo, rol = :rol WHERE id_usuario = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarUsuario($id)
    {
        try {
            $query = "DELETE FROM usuario WHERE id_usuario = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }


}
