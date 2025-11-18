<?php

class UsuariosModel
{
    private mysqli $db;
    public function __construct()
    {
        require_once('model/conectar.php');
        $this->db = Conectar::conexion();
    }
}
