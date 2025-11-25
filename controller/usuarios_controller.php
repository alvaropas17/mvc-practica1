<?php

function home()
{
    // Cargamos el menú de navegación


    // Cargamos la vista principal de adopción
    require_once("views/adopcion_view.php");
}


function login()
{

    require_once("views/login_view.php");
}
function contacto()
{
    // Cargamos el menú de navegación


    echo '<main class="container">';
    require_once("views/login_view.php");
    echo '</main>';
}
