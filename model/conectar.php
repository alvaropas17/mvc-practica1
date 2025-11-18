<?php

class Conectar
{
    public static function conexion()
    {
        try {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db_name = "adopciones";
            $db = new mysqli($host, $user, $pass, $db_name);
            $db->set_charset('utf8mb4');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
