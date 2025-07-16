<?php

namespace App\Models;

use PDO;
use PDOException;

class Asistencia
{
    private $conexion;

    public function __construct($db)
    {
        $this->conexion = $db;
    }

    public function crearAsistencias($id_inscripcion, $fecha, $presente)
    {
        try {
            $query = "INSERT INTO asistencia (id_inscripcion, fecha, presente) 
                      VALUES (:id_inscripcion, :fecha, :presente)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_inscripcion', $id_inscripcion);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':presente', $presente, PDO::PARAM_BOOL);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear asistencia: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerAsistencias()
    {
        try {
            $query = "SELECT * FROM asistencia";
            $stmt = $this->conexion->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener asistencias: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarAsistencias($id_asistencia, $fecha, $presente)
    {
        try {
            $query = "UPDATE asistencia 
                      SET fecha = :fecha, presente = :presente 
                      WHERE id_asistencia = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':presente', $presente, PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $id_asistencia);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar asistencia: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarAsistencias($id_asistencia)
    {
        try {
            $query = "DELETE FROM asistencia WHERE id_asistencia = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id_asistencia);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar asistencia: " . $e->getMessage());
            return false;
        }
    }
}