<?php
require_once("views/menu_view.php");
?>
<main class="container">
<section id="view-contacto" class="card">
    <h2>Contacto</h2>
    <?php if (isset($message)) { ?>
        <div class="alert" style="padding:12px; background:#dcfce7; color:#166534; border-radius:8px; margin-bottom:16px;"><?php echo $message; ?></div>
    <?php } ?>
    <form id="contactForm" method="post" action="index.php?controlador=usuarios&action=enviarFormulario">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="asunto">Asunto</label>
        <input type="text" id="asunto" name="asunto" required>

        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" required>

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje" required></textarea>

        <button class="primary" name="enviar" type="submit">Enviar</button>
        <p id="contactMsg" class="muted" style="margin-top:.5rem"></p>
    </form>
</section>
</main>