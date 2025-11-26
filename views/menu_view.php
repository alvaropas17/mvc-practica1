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
                <select name="" id="menu_seleccion">
                    <option value="usuarios" selected><a href="index.php?controlador=usuarios&action=usuarios">Modificación usuarios</a></option>
                    <option value="animales"><a href="index.php?controlador=usuarios&action=usuarios">Modificación de animales</a></option>
                </select>
                <!-- <a href="index.php?controlador=usuarios&action=login" class="tab" data-view="login">Iniciar sesión</a> -->
                <!-- <a href="index.php?controlador=usuarios&action=contacto" class="tab" data-view="contacto">Contacto</a> -->
                <a href="index.php?controlador=usuarios&action=cerrarSesion" class="tab" data-view="contacto">Cerrar sesión</a>
            </nav>
        <?php } ?>
    </div>
</header>