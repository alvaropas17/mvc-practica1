<?php

class AnimalesModel
{
    private mysqli $db;
    public function __construct()
    {
        require_once('model/conectar.php');
        $this->db = Conectar::conexion();
    }

    public function insertarAnimal(string $imagen, string $fecha_subida, string $nombre_animal, string $descripcion, int $id_usuario, string $especie, int $edad): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO animales(imagen, fecha_subida, nombre_animal, descripcion, id_usuario, especie, edad) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssisi", $imagen, $fecha_subida, $nombre_animal, $descripcion, $id_usuario, $especie, $edad);
            // Ejecutamos la consulta
            $ok = $stmt->execute();

            // Una vez ejecutada la cerramos
            $stmt->close();
            return $ok;
        } catch (mysqli_sql_exception $e) {
            throw new RuntimeException("Error en la inserción: " . $e->getMessage(), 0, $e);
        }
    }

    public function modificarAnimal(string $imagen, string $fecha_subida, string $nombre_animal, string $descripcion, int $id_animal, string $especie, int $edad): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE animales SET imagen = ?, fecha_subida = ?, nombre_animal = ?, descripcion = ?, especie = ?, edad = ? WHERE id_animal = ?");
            $stmt->bind_param("sssssii", $imagen, $fecha_subida, $nombre_animal, $descripcion, $especie, $edad, $id_animal);

            // Una vez preparada debemos de ejecutarla
            $ok = $stmt->execute();
            $stmt->close();

            return $ok;
        } catch (mysqli_sql_exception $e) {
            throw new RuntimeException("Error en la modificación: " . $e->getMessage(), 0, $e);
        }
    }

    public function eliminarAnimal(int $id_animal): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM animales WHERE id_animal=?");
            $stmt->bind_param("i", $id_animal);

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
