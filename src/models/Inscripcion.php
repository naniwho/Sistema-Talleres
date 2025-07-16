<?php

namespace App\Models;

use PDO;
use PDOException;

class Inscripcion
{
    private $conexion;

    public function __construct($db)
    {
        $this->conexion = $db;
    }

    public function crearInscripcion($id_estudiante, $id_talleres, $fecha)
    {
        try {
            $query = "INSERT INTO inscripcion (id_estudiante, id_talleres, fecha) 
                      VALUES (:id_estudiante, :id_talleres, :fecha)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_estudiante', $id_estudiante);
            $stmt->bindParam(':id_talleres', $id_talleres);
            $stmt->bindParam(':fecha', $fecha);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear inscripción: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerInscripciones()
    {
        try {
            $query = "SELECT * FROM inscripcion";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener inscripciones: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarInscripcion($id, $id_estudiante, $id_talleres, $fecha)
    {
        try {
            $query = "UPDATE inscripcion SET id_estudiante = :id_estudiante, id_talleres = :id_talleres, fecha = :fecha 
                      WHERE id_inscripcion = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_estudiante', $id_estudiante);
            $stmt->bindParam(':id_talleres', $id_talleres);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar inscripción: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarInscripcion($id)
    {
        try {
            $query = "DELETE FROM inscripcion WHERE id_inscripcion = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar inscripción: " . $e->getMessage());
            return false;
        }
    }
}
