<?php
require_once("views/menu_view.php");
?>
<main class="container">
    <section id="view-login" class="card">
        <?php
        if (!isset($_SESSION['usuario'])) { ?>
            <h2>Iniciar sesión</h2>
            <form id="loginForm" method="post" action="index.php?controlador=usuarios&action=login" autocomplete="off">
                <label for="user">Usuario</label>
                <input id="user" name="user" type="text">

                <label for="pass">Contraseña</label>
                <input id="pass" name="pass" type="password">

                <button class="primary" name="entrar" type="submit">Entrar</button>
                <p id="loginMsg" class="muted" style="margin-top:.5rem"><?= isset($message) ? $message : "" ?></p>
            </form>
    </section>
<?php
        }
?>
</main>