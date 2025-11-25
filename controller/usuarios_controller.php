<?php

function home()
{
    // Cargamos la vista principal de adopción
    require_once("views/adopcion_view.php");
}


function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = $_POST['user'] ?? '';
        $passwd = $_POST['pass'] ?? '';

        require_once('model/usuarios_model.php');
        $model = new UsuariosModel();
        $userId = $model->iniciarSesion($usuario, $passwd);

        if ($userId > 0) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['user_id'] = $userId;

            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Login exitoso'
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Usuario o contraseña incorrectos'
            ]);
        }
        exit;
    } else {

        require_once("views/login_view.php");
    }
}
function contacto()
{
    require_once("views/contacto_view.php");
}
