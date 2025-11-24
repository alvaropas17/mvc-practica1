<?php

// Esta función es la que muestra el contenido por defecto
function home()
{
    // Cargamos el menú de navegación
    require_once("views/menu_view.php");

    require_once("views/animales_view.php");
}
