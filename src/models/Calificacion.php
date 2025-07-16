<?php

namespace App\Models;

use PDO;
use PDOException;

class Calificacion
{
    private $conexion;

    public function __construct($db)
    {
        $this->conexion = $db;
    }

    public function obtenerCalificaciones()
    {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM calificacion");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener calificaciones: " . $e->getMessage());
            return false;
        }
    }

    public function crearCalificacion($id_inscripcion, $nota)
    {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO calificacion (id_inscripcion, nota) VALUES (:id_inscripcion, :nota)");
            $stmt->bindParam(':id_inscripcion', $id_inscripcion);
            $stmt->bindParam(':nota', $nota);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear calificación: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarCalificacion($id_calificacion, $id_inscripcion, $nota)
    {
        try {
            $stmt = $this->conexion->prepare("UPDATE calificacion SET id_inscripcion = :id_inscripcion, nota = :nota WHERE id_calificacion = :id_calificacion");
            $stmt->bindParam(':id_calificacion', $id_calificacion);
            $stmt->bindParam(':id_inscripcion', $id_inscripcion);
            $stmt->bindParam(':nota', $nota);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar calificación: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarCalificacion($id_calificacion)
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM calificacion WHERE id_calificacion = :id_calificacion");
            $stmt->bindParam(':id_calificacion', $id_calificacion);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar calificación: " . $e->getMessage());
            return false;
        }
    }
}
