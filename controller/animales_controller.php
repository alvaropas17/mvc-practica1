<?php

// Esta función es la que muestra el contenido por defecto
function home()
{
    require_once("views/animales_view.php");
}


function insertarAnimales()
{
    console_log("Entra en insertarAnimales");
    $message = "";
    if (isset($_POST['crear'])) {
        console_log("Ha pulsado el botón de crear animal");
        $fecha_subida = date('Y-m-d H:i:s');
        $nombre_animal = isset($_POST['nombre_animal']) ? strip_tags($_POST['nombre_animal']) : '';
        $descripcion = isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '';
        $especie = isset($_POST['especie']) ? strip_tags($_POST['especie']) : '';
        $edad = isset($_POST['edad']) ? htmlspecialchars($_POST['edad']) : '';
        $id_usuario = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
        $imagen = "./img/caballo.webp"; // Valor por defecto para la imagen

        // Procesar imagen subida
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
            $carpeta = "img/";
            $nombreArchivo = basename($_FILES['foto']['name']);
            $rutaDestino = $carpeta . uniqid() . "_" . $nombreArchivo;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
                $imagen = $rutaDestino;
            } else {
                $message = "Error al subir la imagen. Se usará la imagen por defecto.";
            }
        }
    }
    console_log("ID de usuario usado: " . $id_usuario);
    require_once('model/animales_model.php');
    $model = new AnimalesModel();

    if ($nombre_animal == "" || $especie == "") {
        console_log("Faltan campos obligatorios");
        $message = "El campo nombre o especie está vacío.";
    } else {
        $userId = $model->insertarAnimal($imagen, $fecha_subida, $nombre_animal, $descripcion, $id_usuario, $especie, $edad);
        console_log("Nuevo animal insertado");
        header('Location: index.php?controlador=animales&action=mostrarAnimales');
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
