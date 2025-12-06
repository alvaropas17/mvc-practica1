<?php require_once('menu_view.php'); ?>

<h1>Usuarios</h1>

<?php
// Definir el formulario en una variable para reutilizarlo
$formularioUsuario = '
<section class="form-user" style="margin-left:400px; margin-right:400px; margin-top:32px;">
    <form action="index.php?controlador=usuarios&action=crearUsuario" method="post" class="form-user" style="width:100%;">
        <div style="display:flex; gap:18px; align-items:flex-start; width:100%; margin-bottom:18px;">
            <div style="flex:1; min-width:180px;">
                <label for="nombre" style="font-weight:600; margin-bottom:6px; display:block;">Nombre de usuario</label>
                <input type="text" name="nombre" id="nombre" placeholder="Introduce el nombre..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; background:#fff;" />
            </div>
            <div style="flex:1; min-width:180px;">
                <label for="localidad" style="font-weight:600; margin-bottom:6px; display:block;">Localidad</label>
                <input type="text" name="localidad" id="localidad" placeholder="Introduce la localidad..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; background:#fff;" />
            </div>
            <div style="flex:1; min-width:180px;">
                <label for="sexo" style="font-weight:600; margin-bottom:6px; display:block;">Sexo</label>
                <input type="text" name="sexo" id="sexo" placeholder="Introduce tu sexo..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; background:#fff;" />
            </div>
            <div style="flex:1; min-width:180px;">
                <label for="rol" style="font-weight:600; margin-bottom:6px; display:block;">Rol</label>
                <select name="rol" id="rol" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; background:#fff;">
                    <option value="Admin">Admin</option>
                    <option value="editor">editor</option>
                    <option value="visor">visor</option>
                </select>
            </div>
            <div style="flex:1; min-width:180px;">
                <label for="passwd" style="font-weight:600; margin-bottom:6px; display:block;">Contraseña</label>
                <input type="password" name="passwd" id="passwd" placeholder="Introduce tu contraseña..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; background:#fff;" />
            </div>
        </div>
        <div style="display:flex; justify-content:flex-start; align-items:center;">
            <button type="submit" name="crear" class="btn-modificar" style="background:#2563eb; color:#fff; font-size:1.15rem; border-radius:30px; padding:0.7rem 2.2rem; font-weight:600; border:none; box-shadow:0 2px 8px rgba(37,99,235,0.10);">Crear usuario</button>
        </div>
    </form>
</section>
';

if (!isset($_SESSION['usuario'])) {
?>

    <h1 style="text-align:center; margin-left:400px; margin-right:400px; font-size:2.2rem; font-weight:800; margin-bottom:0.2rem;">Modificación de usuarios</h1>
    <div style="text-align:center; margin-left:400px; margin-right:400px; color:#64748b; font-size:1.15rem; margin-bottom:1.2rem;">Crea nuevos usuarios y gestiona los existentes.</div>
    <?php echo $formularioUsuario; ?>

<?php
} else if (isset($_SESSION['usuario'])) {
?>

    <h1 style="text-align:center; margin-left:400px; margin-right:400px;">Crear nuevo usuario</h1>
    <?php echo $formularioUsuario; ?>
    <?php if (!empty($error)) { ?>
        <div class="alert"><?php echo $error; ?></div>
    <?php } ?>

    <!-- <section class="card">
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
                <td><button type="button" id="btnCrearForm">Crear usuario</button></td> -->
    <!-- </tr>
        </table>

        <div id="formCrearUsuario">
        </div>
    </section> -->

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