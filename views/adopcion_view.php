<?php
require_once("views/menu_view.php");
?>

<main class="container">

    <section id="view-adopcion" class="card">
        <h2>Conoce a nuestros amigos</h2>

        <div class="carousel">
            <div class="slides">
                <!-- SLIDES DE EJEMPLO -->
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

                <!-- SLIDES DINÁMICOS DE LA BASE DE DATOS -->
                <?php if (!empty($animales)) {
                    foreach ($animales as $animal) { ?>
                <div class="slide">
                    <img src="<?php echo htmlspecialchars($animal['imagen']); ?>" 
                         alt="<?php echo htmlspecialchars($animal['nombre_animal']); ?>"
                         style="width:100%; height:400px; object-fit:cover; border-radius:12px;">
                    <h3><?php echo htmlspecialchars($animal['nombre_animal']); ?></h3>
                    <p><?php echo htmlspecialchars($animal['descripcion']); ?></p>
                </div>
                <?php } 
                } ?>
            </div>

            <!-- Botones -->
            <button id="prev" aria-label="Anterior">‹</button>
            <button id="next" aria-label="Siguiente">›</button>

            <!-- Dots dinámicos -->
            <div class="dots">
                <?php 
                $totalSlides = 3; // Los 3 de ejemplo
                if (!empty($animales)) {
                    $totalSlides += count($animales);
                }
                for ($i = 0; $i < $totalSlides; $i++) { ?>
                    <span class="dot <?php echo $i === 0 ? 'active' : ''; ?>"></span>
                <?php } ?>
            </div>
        </div>

        <p class="muted" style="margin-top:.75rem">
            Usa las flechas o los puntos para cambiar de animal. El carrusel avanza automáticamente.
        </p>
    </section>

</main>