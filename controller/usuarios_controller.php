<?php

function home()
{
    // Cargamos la vista principal de adopción
    require_once("views/adopcion_view.php");
}


function login()
{
    $message = "";
    if (isset($_POST['entrar'])) {
        $usuario = isset($_POST['user']) ? strip_tags($_POST['user']) : '';
        $passwd = isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : '';
        require_once('model/usuarios_model.php');
        $model = new UsuariosModel();

        if ($usuario == "" || $passwd == "") {
            $message = "El usuario o la contraseña están vacíos";
        } else {
            $userId = $model->iniciarSesion($usuario, $passwd);

            if ($userId > 0) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['user_id'] = $userId;
                header('Location: index.php');
                exit;
            } else {
                $message = "Error: Usuario o contraseña incorrectos.";
            }
        }
    }

    require_once("views/login_view.php");
}

function crearUsuario()
{
    $message = "";
    if (isset($_POST['crear'])) {
        $nombre = isset($_POST['nombre']) ? strip_tags($_POST['nombre']) : '';
        $passwd = isset($_POST['pass']) ? strip_tags($_POST['pass']) : '';
        $sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : '';
        $localidad = isset($_POST['localidad']) ? htmlspecialchars($_POST['localidad']) : '';
    }
    require_once('model/usuarios_model.php');
    $model = new UsuariosModel();

    if ($nombre == "" || $passwd = "") {
        $message = "El campo nombre o contraseña está vacío.";
    } else {
        $userId = $model->crearUsuario($nombre, $passwd, $sexo, $localidad);
        header('Location: index.php');
        exit;
    }
}

function usuarios()
{
    // Mostrar la vista de gestión de usuarios
    require_once("views/usuarios_view.php");
}

function cerrarSesion()
{
    session_start();
    session_destroy();
    header('Location: index.php');
    exit;
}

function contacto()
{
    require_once("views/contacto_view.php");
}
