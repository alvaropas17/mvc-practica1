<header>
    <div class="container" style="display:flex;align-items:center;gap:1rem;">
        <div class="brand">🐾 Adopciones</div>
        <?php if (!isset($_SESSION['usuario'])) { ?>
            <nav>
                <a href="index.php?controlador=usuarios&action=home" class="tab" data-view="adopcion">Adopción</a>
                <a href="index.php?controlador=usuarios&action=login" class="tab" data-view="login">Iniciar sesión</a>
                <a href="index.php?controlador=usuarios&action=contacto" class="tab" data-view="contacto">Contacto</a>
            </nav>
        <?php } else if (isset($_SESSION['usuario'])) { ?>
            <nav>
                <a href="index.php?controlador=usuarios&action=home" class="tab" data-view="adopcion">Adopción</a>
                <div class="dropdown">
                    <button class="dropbtn tab">Modificaciones</button>
                    <div class="dropdown-content">
                        <a class="tab" href="index.php?controlador=animales&action=home">Modificacion de animales</a>
                        <a class="tab" href="index.php?controlador=usuarios&action=usuarios">Modificación de usuarios</a>
                    </div>
                </div>
                <!-- <a href="index.php?controlador=usuarios&action=login" class="tab" data-view="login">Iniciar sesión</a> -->
                <!-- <a href="index.php?controlador=usuarios&action=contacto" class="tab" data-view="contacto">Contacto</a> -->
                <a href="index.php?controlador=usuarios&action=cerrarSesion" class="tab" data-view="contacto">Cerrar sesión</a>
            </nav>
        <?php } ?>
    </div>
</header>