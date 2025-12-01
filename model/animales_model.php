<?php

class AnimalesModel
{
    private mysqli $db;
    public function __construct()
    {
        require_once('model/conectar.php');
        $this->db = Conectar::conexion();
    }

    public function insertarAnimal(string $nombre, string $especie, string $edad, string $descripcion): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO animales(nombre, especie, edad, descripcion) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $especie, $edad, $descripcion);

            // Ejecutamos la consulta
            $ok = $stmt->execute();

            // Una vez ejecutada la cerramos
            $stmt->close();
            return $ok;
        } catch (mysqli_sql_exception $e) {
            throw new RuntimeException("Error en la inserción: " . $e->getMessage(), 0, $e);
        }
    }

    public function eliminarAnimal(string $nombre): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM animales WHERE nombre=?");
            $stmt->bind_param("s", $nombre);

            $ok = $stmt->execute();
            $stmt->close();

            return $ok;
        } catch (mysqli_sql_exception $e) {
            return false;
            throw new RuntimeException("Error en la inserción: " . $e->getMessage(), 0, $e);
        }
    }

    public function mostrarAnimales(): array
    {
        try {
            // Seleccionamos todos los usuarios
            $stmt = $this->db->prepare("SELECT * FROM animales");

            // Ejecutamos la consulta
            $stmt->execute();

            // Leemos TODOS los resultados
            $animales = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            $stmt->close();

            return $animales;
        } catch (mysqli_sql_exception $e) {
            return array();
        }
    }
}
