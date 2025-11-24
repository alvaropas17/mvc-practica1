<?php require_once('view/menu.php'); ?>

<header>
    <h1>Usuarios</h1>
</header>

<?php
if (!isset($_SESSION['usuario'])) {
?>

    <h1>Crear nuevo usuario</h1>
    <section class="card">
        <form action="index.php?controlador=usuarios&action=home" method="post" class="form-user">
            <label for="">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduce el nombre...">
            <label for="">Contraseña</label>
            <input type="password" name="passwd" id="passwd" placeholder="Introduce tu contraseña...">
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
                <th>Nombre de usuario</th>
                <th>Correo</th>
                <th><select name="nombre_del_select" id="id_del_select">
                        <option value="Administrador">Administrador</option>
                        <option value="editor">Editor</option>
                        <option value="visor">Visor</option>
                    </select></th>
            </tr>
            <tr>
                <td><button type="button">Crear usuario</button></td>
            </tr>
        </thead>
    </table>
</section>

<section class="card">
    <h3>Usuarios registrados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) {
                foreach ($users as $u) { ?>
                    <tr data-id="<?php echo $u['id']; ?>" data-nombre="<?php echo $u['nombre']; ?>" data-passwd="<?php echo $u['passwd']; ?>">
                        <td><?php echo $u['correo'] ?></td>
                        <td><?php echo $u['rol'] ?></td>
                        <?php if (isset($_SESSION['usuario'])) { ?>
                            <td><?php echo $u['modificar'] ?></td>
                            <td><?php echo $u['borrar'] ?></td>
                        <?php } ?>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</section>