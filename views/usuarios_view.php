<?php require_once('menu_view.php'); ?>

<h1>Usuarios</h1>

<?php
if (!isset($_SESSION['usuario'])) {
?>

    <h1>Crear nuevo usuario</h1>
    <section class="card">
        <form action="index.php?controlador=usuarios&action=crearUsuario" method="post" class="form-user">
            <label for="">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduce el nombre...">
            <label for="">Localidad:</label>
            <input type="text" name="localidad" id="nombre" placeholder="Introduce la localidad...">
            <label for="">Sexo:</label>
            <input type="text" name="sexo" id="sexo" placeholder="Introduce tu sexo...">
            <label for="">Contraseña</label>
            <input type="password" name="passwd" id="passwd" placeholder="Introduce tu contraseña...">
            <input type="submit" name="crear" />
        </form>
    </section>
<?php
} else {
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
                        <tr data-id="<?php echo $u['id']; ?>" data-nombre="<?php echo $u['nombre']; ?>">
                            <td><?php echo $u['correo'] ?></td>
                            <td><?php echo $u['rol'] ?></td>
                            <?php
                            if (isset($_SESSION['usuario'])) {
                            ?>

                                <td>
                                <td><button class="btn-modificar">Modificar</button></td>
                                <form action="index.php?controlador=usuarios&action=home" method="post">
                                    <input type="hidden" name="id" id="<?php echo $u['id']; ?>" value="<?php echo $u['id']; ?>">
                                    <input type="submit" id="borrar" name="borrar" value="Borrar">
                                </form>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    <?php } ?>
    </section>