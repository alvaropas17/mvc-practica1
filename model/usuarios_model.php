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
    public function iniciarSesion($nombreUsuario, $hashContra)
    {
        try {
            $stmt = $this->db->prepare("SELECT id, contrasenia FROM usuario WHERE nombre = ? LIMIT 1");
        } catch (\Throwable $th) {
        }
    }
}
