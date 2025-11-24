<?php require_once('view/menu_view.php');
?>
<header>
    <h1>Usuarios</h1>
</header>

<?php
if (!isset($_SESSION['usuario'])) {
?>

    <h1>Añadir un nuevo animal</h1>
    <section class="card">
        <form action="index.php?controlador=usuarios&action=home" method="post" class="form-user">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduce el nombre...">
            <label for="especie">Especie:</label>
            <input type="text" name="especie" id="especie" placeholder="Introduce la especie...">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" placeholder="Introduce la edad...">
            <label for="desc">Descripción</label>
            <input type="text" name="desc" id="desc" placeholder="Introduce una descripción...">
            <input type="submit" name="crear" />
        </form>
    </section>
<?php
}
?>

<?php if (!empty($error)) { ?>
    <div class="alert"><?php echo $error; ?></div>
<?php } ?>

<section class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del animal</th>
                <th>Descripción</th>
            <tr>
                <td><button type="button">Añadir animal</button></td>
            </tr>
        </thead>
    </table>
</section>

<section class="card">
    <h3>Animales registrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Edad</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) {
                foreach ($users as $u) { ?>
                    <tr data-id="<?php echo $u['id']; ?>" data-nombre="<?php echo $u['nombre']; ?>">
                        <td><?php echo $u['correo'] ?></td>
                        <td><?php echo $u['rol'] ?></td>
                        <?php
                        if (isset($_SESSION['usuario'])) {
                        ?>

                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" id="<?php echo $u['id']; ?>" value="<?php echo $u['id']; ?>">
                                    <input type="submit" id="borrar" name="borrar" value="Borrar">
                                </form>
                            </td>
                            <td><button class="btn-modificar">Modificar</button></td>
                        <?php
                        }
                        ?>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</section>