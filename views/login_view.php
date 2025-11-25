<?php
require_once("views/menu_view.php");
?>
<main class="container">
    <section id="view-login" class="card">
        <?php
        if (!isset($_SESSION['usuario'])) { ?>
            <h2>Iniciar sesión</h2>
            <form id="loginForm" autocomplete="off">
                <label for="user">Usuario</label>
                <input id="user" name="user" type="text" required>

                <label for="pass">Contraseña</label>
                <input id="pass" name="pass" type="password" required>

                <button class="primary" type="submit">Entrar</button>
                <p id="loginMsg" class="muted" style="margin-top:.5rem"></p>
            </form>
    </section>
<?php
        }
?>
</main>