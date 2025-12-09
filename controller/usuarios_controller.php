<?php

function home()
{
    // Cargar los animales desde la base de datos
    require_once('model/animales_model.php');
    $model = new AnimalesModel();
    $animales = $model->mostrarAnimales();
    
    // Cargamos la vista principal de adopción con los animales
    require_once("views/adopcion_view.php");
}


function login()
{
    $message = "";
    if (isset($_POST['entrar'])) {
        $usuario = isset($_POST['user']) ? strip_tags($_POST['user']) : '';
        $passwd = isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : '';

        // Primero se carga el modelo
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

    // Luego se carga a vista
    require_once("views/login_view.php");
}

function crearUsuario()
{
    $message = "";
    if (isset($_POST['crear'])) {
        $nombre = isset($_POST['nombre']) ? strip_tags($_POST['nombre']) : '';
        $passwd = isset($_POST['passwd']) ? strip_tags($_POST['passwd']) : '';
        $sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : '';
        $rol = isset($_POST['rol']) ? htmlspecialchars($_POST['rol']) : '';
        $localidad = isset($_POST['localidad']) ? htmlspecialchars($_POST['localidad']) : '';
    }
    require_once('model/usuarios_model.php');
    $model = new UsuariosModel();
    if ($nombre == "" || $passwd == "") {
        $message = "El campo nombre o contraseña está vacío.";
    } else {
        $userId = $model->crearUsuario($nombre, $passwd, $sexo, $rol, $localidad);
        header('Location: index.php?controlador=usuarios&action=usuarios');
        exit;
    }
}

function cerrarSesion()
{
    session_start();
    session_destroy();
    header('Location: index.php');
    exit;
}

function borrarUsuario()
{
    if (isset($_POST['borrar'])) {
        $id_usuario = isset($_POST['id_usuario']) ? htmlspecialchars($_POST['id_usuario']) : '';
        if ($id_usuario > 0) {
            $message = "El campo id está vacío";
        }
        require_once("model/usuarios_model.php");
        $model = new UsuariosModel();
        $userId = $model->delete($id_usuario);
        header('Location: index.php?controlador=usuarios&action=usuarios');
        exit;
    }
}

function contacto()
{
    require_once("views/contacto_view.php");
}

function usuarios()
{
    // Obtener los usuarios del modelo
    require_once('model/usuarios_model.php');
    $model = new UsuariosModel();
    $users = $model->mostrarUsuarios();
    require_once("views/usuarios_view.php");
}

function modificarUsuario()
{
    // Si es una petición AJAX para obtener el formulario
    console_log("Modificar usuario");
    if (isset($_POST['accion']) && $_POST['accion'] === 'obtenerFormulario') {
        console_log("Llega la petición del formulario");
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
        $rol = isset($_POST['rol']) ? $_POST['rol'] : '';
        $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : '';

        echo '
        <div class="formulario-container">
            <h3>Modificar Usuario</h3>
            <form id="formModificarUsuario" method="post" action="index.php?controlador=usuarios&action=modificarUsuario">
                <label><b>ID:</b></label>
                <input type="text" name="id" value="' . htmlspecialchars($id) . '" readonly>

                <label><b>Nombre:</b></label>
                <input type="text" name="nombre" value="' . htmlspecialchars($nombre) . '" required>

                <label><b>Sexo:</b></label>
                <input type="text" name="sexo" value="' . htmlspecialchars($sexo) . '" required>

                <label><b>Rol:</b></label>
                <select name="rol" required>
                    <option value="Admin" ' . ($rol === 'Admin' ? 'selected' : '') . '>Admin</option>
                    <option value="editor" ' . ($rol === 'editor' ? 'selected' : '') . '>editor</option>
                    <option value="visor" ' . ($rol === 'visor' ? 'selected' : '') . '>visor</option>
                </select>

                <label><b>Localidad:</b></label>
                <input type="text" name="localidad" value="' . htmlspecialchars($localidad) . '" required>

                <input type="submit" name="modificar" value="Modificar">
                <button type="button" id="btnCancelar" onclick="cerrarFormulario()">Cancelar</button>
            </form>
        </div>';
        exit;
    }

    // Si es una petición POST para guardar cambios
    if (isset($_POST['modificar'])) {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $nombre = isset($_POST['nombre']) ? strip_tags($_POST['nombre']) : '';
        $sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : '';
        $rol = isset($_POST['rol']) ? htmlspecialchars($_POST['rol']) : '';
        $localidad = isset($_POST['localidad']) ? htmlspecialchars($_POST['localidad']) : '';

        if ($id > 0 && $nombre != "") {
            require_once('model/usuarios_model.php');
            $model = new UsuariosModel();
            $result = $model->modificarUsuario($id, $nombre, $sexo, $rol, $localidad);

            if ($result) {
                header('Location: index.php?controlador=usuarios&action=usuarios');
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al modificar el usuario.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        }
    }
}

function enviarFormulario()
{
    $message = "";
    if (isset($_POST['enviar'])) {
        $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
        $asunto = isset($_POST['asunto']) ? htmlspecialchars($_POST['asunto']) : '';
        $correo = isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : '';
        $mensaje = isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : '';
        
        if ($nombre != "" && $correo != "" && $asunto != "" && $mensaje != "") {
            // Configurar el destinatario (cambia esto por tu email)
            $destinatario = "admin@adopciones.com";
            
            // Configurar las cabeceras del email
            $headers = "From: " . $correo . "\r\n";
            $headers .= "Reply-To: " . $correo . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            // Construir el cuerpo del mensaje
            $cuerpoMensaje = "<html><body>";
            $cuerpoMensaje .= "<h2>Nuevo mensaje de contacto</h2>";
            $cuerpoMensaje .= "<p><strong>Nombre:</strong> " . $nombre . "</p>";
            $cuerpoMensaje .= "<p><strong>Correo:</strong> " . $correo . "</p>";
            $cuerpoMensaje .= "<p><strong>Asunto:</strong> " . $asunto . "</p>";
            $cuerpoMensaje .= "<p><strong>Mensaje:</strong></p>";
            $cuerpoMensaje .= "<p>" . nl2br($mensaje) . "</p>";
            $cuerpoMensaje .= "</body></html>";
            
            // Enviar el email
            if (mail($destinatario, $asunto, $cuerpoMensaje, $headers)) {
                $message = "Mensaje enviado correctamente. Te responderemos pronto.";
            } else {
                $message = "Error al enviar el mensaje. Por favor, inténtalo de nuevo.";
            }
        } else {
            $message = "Por favor, completa todos los campos.";
        }
    }
    
    // Mostrar la vista con el mensaje
    require_once("views/contacto_view.php");
}
