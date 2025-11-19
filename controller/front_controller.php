<?php

// Iniciamos sesión para que esté disponible en todo el resto del proyecto
session_start();

function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

// Definimos la carpeta de los controladores
define('CONTROLLERS_FOLDER', "controller/");

define('DEFAULT_CONTROLLER', "usuarios");

define('DEFAULT_ACTION', "home");


// Definimos el controlador
$controller = DEFAULT_CONTROLLER;

if (!empty($_GET['controlador'])) {
    $controller = $_GET['controlador'];
}

// Definimos la acción
$action = DEFAULT_ACTION;

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Hacemos que se cree la ruta y se guarde en $controller
$controller = CONTROLLERS_FOLDER . $controller . '_controller.php';

try {
    if (is_file($controller)) {
        require_once($controller);
    } else {
        throw new Exception('El controlador no existe - 404 not found');
    }

    if (is_callable($action)) {
        $action();
    } else {
        throw new Exception('La acción no existe - 404 not found');
    }
} catch (\Throwable $e) {
    console_log($e->getMessage());
}
