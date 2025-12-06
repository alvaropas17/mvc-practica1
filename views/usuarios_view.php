<?php require_once('menu_view.php'); ?>

<h1>Usuarios</h1>

<?php
// Definir el formulario en una variable para reutilizarlo
$formularioUsuario = '
<section class="form-user">
    <form action="index.php?controlador=usuarios&action=crearUsuario" method="post" class="form-user">
        <label for="">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Introduce el nombre...">
        <label for="">Localidad:</label>
        <input type="text" name="localidad" id="localidad" placeholder="Introduce la localidad...">
        <label for="">Sexo:</label>
        <input type="text" name="sexo" id="sexo" placeholder="Introduce tu sexo...">
        <label for="">Contraseña</label>
        <input type="password" name="passwd" id="passwd" placeholder="Introduce tu contraseña...">
        <input type="submit" name="crear" />
    </form>
</section>
';

if (!isset($_SESSION['usuario'])) {
?>

    <h1>Crear nuevo usuario</h1>
    <?php echo $formularioUsuario; ?>

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
                    <th>Rol: <select name="nombre_del_select" id="id_del_select">
                            <option value="Administrador">Administrador</option>
                            <option value="editor">Editor</option>
                            <option value="visor">Visor</option>
                        </select></th>
                </tr>
            </thead>
            <tbody>
                <td><input type="text" name="nombre" id="nombre"></td>
                <td><input type="text" name="correo" id="correo"></td>
            </tbody>
            <tr>
                <td><button type="button" id="btnCrearForm">Crear usuario</button></td>
            </tr>
        </table>

        <div id="formCrearUsuario" style="display: none;">
            <?php echo $formularioUsuario; ?>
        </div>
    </section>

    <section class="card">
        <h3>Usuarios registrados</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Localidad</th>
                    <th>Sexo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)) {
                    foreach ($users as $u) { ?>
                        <tr>
                            <td><?php echo $u['nombre']; ?></td>
                            <td><?php echo $u['localidad'] ?></td>
                            <td><?php echo $u['sexo'] ?></td>
                            <td><?php echo isset($u['rol']) ? $u['rol'] : 'Sin rol';  ?></td>
                            <?php
                            if (isset($_SESSION['usuario'])) {
                            ?>
                                <!-- <div id="modificar"></div> -->

                                <?php
                                console_log("Antes del array");
                                // if (isset($users)) { 
                                ?>
                                <td>
                                    <button class="btn-modificar"
                                        data-id="<?php echo $u['id_usuario'] ?>"
                                        data-nombre="<?php echo $u['nombre'] ?>"
                                        data-sexo="<?php echo $u['sexo'] ?>"
                                        data-localidad="<?php echo $u['localidad'] ?>">
                                        Modificar
                                    </button>
                                    <form action="index.php?controlador=usuarios&action=borrarUsuario" method="post" style="display:inline;">
                                        <input type="hidden" name="id_usuario" id="<?php echo $u['id_usuario']; ?>" value="<?php echo $u['id_usuario']; ?>">
                                        <input type="submit" name="borrar" value="Borrar" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                    </form>
                                </td>
                        </tr>
                    <?php           } ?>
        </table>
        </div>
        </main>

        </td>
    <?php
                    }
    ?>
    </tr>
<?php }
            } ?>
</tbody>
</table>
<div id="formModificar" style="display: none; margin-bottom: 20px; padding: 15px; background: #f5f5f5; border-radius: 5px;"></div>
    </section>