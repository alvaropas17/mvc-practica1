<?php

// Esta función es la que muestra el contenido por defecto
function home()
{
    // Primero cargamos el modelo
    require_once('model/animales_model.php');
    $model = new AnimalesModel();
    $users = $model->mostrarAnimales();

    // Una vez cargados todos los datos mostramos la vista animales
    require_once('views/animales_view.php');
}


function insertarAnimales()
{
    console_log("Entra en insertarAnimales");
    $message = "";
    if (isset($_POST['crearAnimal'])) {
        console_log("Ha pulsado el botón de crear animal");
        $fecha_subida = date('Y-m-d H:i:s');
        $nombre_animal = isset($_POST['nombre_animal']) ? strip_tags($_POST['nombre_animal']) : '';
        $descripcion = isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '';
        console_log("Descripción recibida: " . $descripcion);
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
        $id_animal = isset($_POST['id_animal']) ? htmlspecialchars($_POST['id_animal']) : '';
        console_log("Id_animal: " . $id_animal);

        if (empty($id_animal)) {
            $error = "Error: No se pudo identificar el animal a eliminar.";
        } else {
            require_once("model/animales_model.php");
            $model = new AnimalesModel();
            $result = $model->eliminarAnimal($id_animal);
            console_log("Result " . $result);

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

function modificarAnimal()
{
    // Si es una petición AJAX para obtener el formulario
    console_log("Modificar animal");
    if (isset($_POST['accion']) && $_POST['accion'] === 'obtenerFormularioAnimal') {
        console_log("Llega la petición del formulario");
        $id = isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0;
        $nombre = isset($_POST['nombre_animal']) ? $_POST['nombre_animal'] : '';
        console_log("Nombre: " . $nombre);
        $especie = isset($_POST['especie']) ? $_POST['especie'] : '';
        $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

        echo '
        <div class="formulario-container">
            <h3>Modificar animal</h3>
            <form id="formModificarUsuario" method="post" action="index.php?controlador=animales&action=mostrarAnimales">
                <label><b>Nombre:</b></label>
                <input type="text" name="nombre" value="' . htmlspecialchars($nombre) . '" required>

                <label><b>Especie:</b></label>
                <input type="text" name="especie" value="' . htmlspecialchars($especie) . '" required>

                <label><b>Edad:</b></label>
                <input type="text" name="edad" value="' . htmlspecialchars($edad) . '" required>

                <label><b>Descripción:</b></label>
                <input type="text" name="descripcion" value="' . htmlspecialchars($descripcion) . '" required>

                <input type="submit" name="modificarAnimal" value="Modificar">
                <button type="button" id="btnCancelar" onclick="cerrarFormulario()">Cancelar</button>
            </form>
        </div>';
        exit;
    }

    // Si es una petición POST para guardar cambios
    if (isset($_POST['modificarAnimal'])) {
        $id = isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0;
        $fecha_subida = isset($_POST['fecha_subida']) ? $_POST['fecha_subida'] : '';
        $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
        $nombre = isset($_POST['nombre_animal']) ? $_POST['nombre_animal'] : '';
        $especie = isset($_POST['especie']) ? $_POST['especie'] : '';
        $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

        if ($id > 0 && $nombre != "") {
            require_once('model/animales_model.php');
            $model = new AnimalesModel();
            $result = $model->modificarAnimal($id, $fecha_subida, $imagen, $nombre, $especie, $edad, $descripcion);

            if ($result) {
                header('Location: index.php?controlador=animales&action=mostrarAnimales');
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al modificar el usuario.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        }
    }
}
