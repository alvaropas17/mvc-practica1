<?php require_once("views/menu_view.php");
?>
<h1>Gestión de Animales</h1>

<?php
if (isset($_SESSION['usuario'])) {
?>

    <h2>Añadir un nuevo animal</h2>
    <section class="card">
        <form action="index.php?controlador=animales&action=insertarAnimales" method="post" class="form-user">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduce el nombre...">
            <label for="especie">Especie:</label>
            <input type="text" name="especie" id="especie" placeholder="Introduce la especie...">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" placeholder="Introduce la edad...">
            <label for="desc">Descripción</label>
            <input type="text" name="desc" id="desc" placeholder="Introduce una descripción...">
            <button class="primary" name="insertarAnimal" type="submit">Añadir animal</button>
        </form>
    </section>
<?php
}
?>

<?php if (!empty($error)) { ?>
    <div class="alert"><?php echo $error; ?></div>
<?php } ?>

<section class="card">
    <h3>Animales registrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Edad</th>
                <th>Descripción</th>
                <?php if (isset($_SESSION['usuario'])) { ?>
                    <th>Acciones</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) {
                foreach ($users as $animal) { ?>
                    <tr data-nombre="<?php echo htmlspecialchars($animal['nombre']); ?>">
                        <td><?php echo htmlspecialchars($animal['nombre']) ?></td>
                        <td><?php echo htmlspecialchars($animal['especie']) ?></td>
                        <td><?php echo htmlspecialchars($animal['edad']) ?></td>
                        <td><?php echo htmlspecialchars($animal['descripcion']) ?></td>
                        <?php if (isset($_SESSION['usuario'])) { ?>
                            <td>
                                <form action="index.php?controlador=animales&action=eliminarAnimal" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($animal['nombre']); ?>">
                                    <input type="submit" name="borrar" value="Borrar" onclick="return confirm('¿Estás seguro de que quieres eliminar este animal?');">
                                </form>
                                <button class="btn-modificar">Modificar</button>
                            </td>
                        <?php } ?>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="<?php echo isset($_SESSION['usuario']) ? '5' : '4'; ?>">No hay animales registrados</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>