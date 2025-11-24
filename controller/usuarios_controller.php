<?php

function home()
{
    // Cargamos el menú de navegación
    require_once("views/menu_view.php");

    // Cargamos la vista principal de adopción
    echo '<main class="container">';
    require_once("views/adopcion_view.php");
    echo '</main>';
}
