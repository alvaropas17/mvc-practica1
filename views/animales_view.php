<?php require_once("views/menu_view.php");
?>
<h1>Gestión de Animales</h1>

<?php
if (isset($_SESSION['usuario'])) {
?>

    <h1 style="text-align:center;">Añadir un nuevo animal</h1>

    <section class="form-user" style="max-width:1000px; margin:32px auto 0 auto; background:#fff; border-radius:14px; box-shadow:0 4px 16px rgba(2,6,23,0.04); padding:2rem 2.5rem;">
        <form action="index.php?controlador=animales&action=insertarAnimales" method="post" enctype="multipart/form-data" style="width:100%;">
            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:15px; margin-bottom:20px;">
                <div>
                    <label for="nombre" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Nombre</label>
                    <input type="text" name="nombre_animal" id="nombre" placeholder="Nombre..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
                <div>
                    <label for="foto" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Foto</label>
                    <input type="file" name="foto" id="foto" accept="image/*" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" />
                </div>
                <div>
                    <label for="especie" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Especie</label>
                    <input type="text" name="especie" id="especie" placeholder="Especie..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
                <div>
                    <label for="edad" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Edad</label>
                    <input type="text" name="edad" id="edad" placeholder="Edad..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
                <div>
                    <label for="descripcion" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Descripción..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
            </div>
            <div style="display:flex; justify-content:center; align-items:center;">
                <button type="submit" name="crearAnimal" class="btn-crear" style="background:#2563eb; color:#fff; font-size:1.15rem; border-radius:30px; padding:0.7rem 2.2rem; font-weight:600; border:none; box-shadow:0 2px 8px rgba(37,99,235,0.10); cursor:pointer;">Añadir animal</button>
            </div>
        </form>
        <p id="loginMsg" class="muted" style="margin-top:.5rem"><?= isset($message) ? $message : "" ?></p>
    </section>
<?php
}
?>

<?php if (!empty($error)) { ?>
    <div class="alert"><?php echo $error; ?></div>
<?php } ?>

<section style="max-width:1200px; margin:40px auto; background:#fff; border-radius:14px; box-shadow:0 4px 16px rgba(2,6,23,0.04); padding:2rem;">
    <h3 style="font-size:1.5rem; font-weight:700; margin-bottom:1.5rem; color:#0f172a;">Animales registrados</h3>
    <table style="width:100%; border-collapse:separate; border-spacing:0;">
        <thead>
            <tr style="background:#f8fafc; border-bottom:2px solid #e2e8f0;">
                <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Nombre</th>
                <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Especie</th>
                <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Edad</th>
                <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Descripción</th>
                <?php if (isset($_SESSION['usuario'])) { ?>
                    <th style="padding:12px 16px; text-align:center; font-weight:600; font-size:0.9rem; color:#475569;">Acciones</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) {
                foreach ($users as $animal) {
                    console_log($animal) ?>
                    <tr data-nombre="<?php echo htmlspecialchars($animal['nombre_animal']); ?>" style="border-bottom:1px solid #f1f5f9; transition:background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                        <td style="padding:14px 16px; font-size:0.95rem; color:#0f172a; font-weight:500;"><?php echo htmlspecialchars($animal['nombre_animal']); ?></td>
                        <td style="padding:14px 16px; font-size:0.95rem; color:#64748b;"><?php echo htmlspecialchars($animal['especie']); ?></td>
                        <td style="padding:14px 16px; font-size:0.95rem; color:#64748b;"><?php echo htmlspecialchars($animal['edad']); ?></td>
                        <td style="padding:14px 16px; font-size:0.95rem; color:#64748b;"><?php echo htmlspecialchars($animal['descripcion']); ?></td>
                        <?php if (isset($_SESSION['usuario'])) { ?>
                            <td style="padding:14px 16px; text-align:center;">
                                <button class="btn-modificar btn-modificar-Animales"
                                    data-id_animal="<?php echo $animal['id_animal']; ?>"
                                    data-imagen="<?php echo $animal['imagen']; ?>"
                                    data-fecha_subida="<?php echo $animal['fecha_subida']; ?>"
                                    data-nombre_animal="<?php echo $animal['nombre_animal'] ?>"
                                    data-especie="<?php echo $animal['especie'] ?>"
                                    data-edad="<?php echo $animal['edad'] ?>"
                                    data-descripcion="<?php echo $animal['descripcion'] ?>"
                                    style="margin-right:8px;">
                                    Modificar
                                </button>
                                <button class="btn-borrar btn-borrar-animal"
                                    data-id_animal="<?php echo $animal['id_animal']; ?>"
                                    data-nombre="<?php echo htmlspecialchars($animal['nombre_animal']); ?>">
                                    Borrar
                                </button>
                            </td>
                        <?php } ?>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="<?php echo isset($_SESSION['usuario']) ? '5' : '4'; ?>" style="padding:20px; text-align:center; color:#64748b;">No hay animales registrados</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div id="formModificar" style="display: none; margin-top: 30px; padding: 20px; background: #f5f5f5; border-radius: 10px;"></div>
</section>