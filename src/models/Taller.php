<?php

namespace App\Models;

use PDO;
use PDOException;

class Taller
{
    private $conexion;

    public function __construct($db)
    {
        $this->conexion = $db;
    }

    public function obtenerTalleres()
    {
        try {
            $query = "SELECT * FROM talleres";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener talleres: " . $e->getMessage());
            return false;
        }
    }

    public function crearTaller($id_instructor, $nombre, $descripcion, $fecha_inicio, $fecha_fin)
    {
        try {
            $query = "INSERT INTO talleres (id_instructor, nombre, descripcion, fecha_inicio, fecha_fin)
                      VALUES (:id_instructor, :nombre, :descripcion, :fecha_inicio, :fecha_fin)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_instructor', $id_instructor);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear taller: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarTaller($id, $id_instructor, $nombre, $descripcion, $fecha_inicio, $fecha_fin)
    {
        try {
            $query = "UPDATE talleres SET id_instructor = :id_instructor, nombre = :nombre, descripcion = :descripcion,
                      fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id_talleres = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_instructor', $id_instructor);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar taller: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarTaller($id)
    {
        try {
            $query = "DELETE FROM talleres WHERE id_talleres = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar taller: " . $e->getMessage());
            return false;
        }
    }
}
