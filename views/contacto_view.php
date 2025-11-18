<section id="view-contacto" class="card" style="display:none">
    <h2>Contacto</h2>
    <form id="contactForm">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="asunto">Asunto</label>
        <input type="text" id="asunto" name="asunto" required>

        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" required>

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje" required></textarea>

        <button class="primary" type="submit">Enviar</button>
        <p id="contactMsg" class="muted" style="margin-top:.5rem"></p>
    </form>
</section>