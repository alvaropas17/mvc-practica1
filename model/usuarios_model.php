<?php

class UsuariosModel
{
    private mysqli $db;
    public function __construct()
    {
        require_once('model/conectar.php');
        $this->db = Conectar::conexion();
    }

    // Función insertar usuarios


    // Función borrar usuarios


    // Función iniciar sesión
    public function iniciarSesion(string $nombreUsuario, string $pass)
    {
        try {
            // Seleccionamos tanto id como passwd
            $stmt = $this->db->prepare("SELECT id_usuario, contrasenia FROM usuarios WHERE nombre=? LIMIT 1");

            // Con esto le decimos el tipo de dato que vamos a introducir
            $stmt->bind_param("s", $nombreUsuario);

            // Ejecutamos la consulta
            $stmt->execute();

            // Leemos el resultado
            $user = $stmt->get_result()->fetch_assoc();

            $stmt->close();

            if ($user && password_verify($pass, $user['contrasenia'])) {
                return $user['id_usuario'];  // Retorna el ID si es válido
            } else {
                return 0;  // Retorna 0 si no es válido
            }
        } catch (mysqli_sql_exception $e) {
            return 0;
        }
    }

    // Función crear usuario
    public function crearUsuario(string $nombreUsuario, string $pass, string $sexo, string $localidad): bool
    {
        try {
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, contrasenia, sexo, localidad) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombreUsuario, $passHash, $sexo, $localidad);

            // Ejecutamos la consulta
            $ok = $stmt->execute();

            // Una vez ejecutada la cerramos
            $stmt->close();
            return $ok;
        } catch (mysqli_sql_exception $e) {
            throw new RuntimeException("Error en la inserción: " . $e->getMessage(), 0, $e);
        }
    }


    // Función borrar datos
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id=?");
            $stmt->bind_param("i", $id);

            $ok = $stmt->execute();
            $stmt->close();

            return $ok;
        } catch (mysqli_sql_exception $e) {
            return false;
            throw new RuntimeException("Error en la inserción: " . $e->getMessage(), 0, $e);
        }
    }



    public function mostrarUsuarios(): array
    {
        try {
            // Seleccionamos todos los usuarios
            $stmt = $this->db->prepare("SELECT id_usuario, nombre, localidad, sexo FROM usuarios");

            // Ejecutamos la consulta
            $stmt->execute();

            // Leemos TODOS los resultados
            $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            $stmt->close();

            return $users;
        } catch (mysqli_sql_exception $e) {
            return array();
        }
    }
}
