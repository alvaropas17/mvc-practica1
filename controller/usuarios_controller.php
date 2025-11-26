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
