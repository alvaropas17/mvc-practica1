<?php

// Esta función es la que muestra el contenido por defecto
function home()
{
    require_once("views/animales_view.php");
}


function insertarAnimales()
{
    $message = "";
    if (isset($_POST['crear'])) {
        $nombre = isset($_POST['nombre']) ? strip_tags($_POST['nombre']) : '';
        $passwd = isset($_POST['passwd']) ? strip_tags($_POST['passwd']) : '';
        $sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : '';
        $localidad = isset($_POST['localidad']) ? htmlspecialchars($_POST['localidad']) : '';
    }
    require_once('model/animales_model.php');
    $model = new AnimalesModel();

    if ($nombre == "" || $passwd = "") {
        $message = "El campo nombre o contraseña está vacío.";
    } else {
        $userId = $model->insertarAnimal($nombre, $passwd, $sexo, $localidad);
        header('Location: index.php');
        exit;
    }
}



function mostrarAnimales()
{
    // Primero cargamos el modelo
    require_once('model/animales_model.php');
    $model = new AnimalesModel();
    $users = $model->mostrarAnimales();

    // Una vez cargados todos los datos mostramos la vista animales
    require_once('views/animales_view.php');
}

function eliminarAnimal()
{
    $error = "";
    if (isset($_POST['borrar'])) {
        $nombre_animal = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';

        if (empty($nombre_animal)) {
            $error = "Error: No se pudo identificar el animal a eliminar.";
        } else {
            require_once("model/animales_model.php");
            $model = new AnimalesModel();
            $result = $model->eliminarAnimal($nombre_animal);

            if ($result) {
                header('Location: index.php?controlador=animales&action=mostrarAnimales');
                exit;
            } else {
                $error = "Error al eliminar el animal.";
            }
        }
    }

    // Si hay error, mostrar la vista con el mensaje
    require_once('model/animales_model.php');
    $model = new AnimalesModel();
    $users = $model->mostrarAnimales();
    require_once('views/animales_view.php');
}
