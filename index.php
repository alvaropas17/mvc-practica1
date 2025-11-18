<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="./style.css">
  <script src="script.js" defer></script>
  <title>Adopciones • Adopción • Login • Contacto</title>

</head>

<body>
  <header>
    <div class="container" style="display:flex;align-items:center;gap:1rem;">
      <div class="brand">🐾 Adopciones</div>
      <nav>
        <a href="#" class="tab active" data-view="adopcion">Adopción</a>
        <a href="#" class="tab" data-view="login">Iniciar sesión</a>
        <a href="#" class="tab" data-view="contacto">Contacto</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <!-- Vista Adopción -->
    <section id="view-adopcion" class="card">
      <h2>Conoce a nuestros amigos</h2>

      <div class="carousel">
        <div class="slides">
          <!-- SLIDES DEFINIDOS DIRECTAMENTE EN HTML -->
          <div class="slide">
            <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?q=80&w=1600&auto=format&fit=crop"
              alt="Luna">
            <h3>Luna</h3>
            <p>Cariñosa y tranquila. Ideal para vivir en un piso. Vacunada y esterilizada.</p>
          </div>

          <div class="slide">
            <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?q=80&w=1600&auto=format&fit=crop"
              alt="Rocky">
            <h3>Rocky</h3>
            <p>Muy activo y juguetón. Perfecto para familias que disfrutan del aire libre.</p>
          </div>

          <div class="slide">
            <img src="https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?q=80&w=1600&auto=format&fit=crop"
              alt="Maya">
            <h3>Maya</h3>
            <p>Sociable y cariñosa. Se lleva muy bien con niños y otros animales.</p>
          </div>
        </div>

        <!-- Botones -->
        <button id="prev" aria-label="Anterior">‹</button>
        <button id="next" aria-label="Siguiente">›</button>

        <!-- Dots (también definidos en HTML) -->
        <div class="dots">
          <span class="dot active"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
      </div>

      <p class="muted" style="margin-top:.75rem">
        Usa las flechas o los puntos para cambiar de animal. El carrusel avanza automáticamente.
      </p>
    </section>

    <!-- Vista Login -->
    <section id="view-login" class="card" style="display:none">
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

    <!-- Vista Contacto -->
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
  </main>


</body>

</html>