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
                    <th><select name="nombre_del_select" id="id_del_select">
                            <option value="Administrador">Administrador</option>
                            <option value="editor">Editor</option>
                            <option value="visor">Visor</option>
                        </select></th>
                </tr>
                <tr>
                    <td><button type="button" id="btnCrearForm">Crear usuario</button></td>
                </tr>
            </thead>
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
                            <?php
                            if (isset($_SESSION['usuario'])) {
                            ?>
                                <td>
                                    <button class="btn-modificar" 
                                        data-id="<?php echo $u['id_usuario']; ?>"
                                        data-nombre="<?php echo htmlspecialchars($u['nombre']); ?>"
                                        data-sexo="<?php echo htmlspecialchars($u['sexo']); ?>"
                                        data-localidad="<?php echo htmlspecialchars($u['localidad']); ?>">
                                        Modificar
                                    </button>
                                    <div id="modificar"></div>

                                    <?php
                                    if (isset($array)) {

                                        echo "<table border><tr><th>Id</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Imagen</th>
                                        <th></th>
                                        <th>Autor</th>
                                        <th></th>
                                        </tr>";

                                        foreach ($array as $registro) {

                                            if (is_array($registro)) {

                                                echo '<tr 
                    data-id="' . htmlspecialchars($registro["id"]) . '"
                    data-nombre="' . htmlspecialchars($registro["nombre"]) . '"
                    data-imagen="' . htmlspecialchars($registro["imagen"]) . '"
                    data-descrip="' . htmlspecialchars($registro["descrip"]) . '"
                    data-autor="' . htmlspecialchars($registro["autor"]) . '"
                  >';

                                                // Mostrar cada campo del registro
                                                foreach ($registro as $key => $campo) {
                                                    echo "<td data-id>" . htmlspecialchars($campo) . "</td>";
                                                }

                                                // Botón borrar
                                                echo '<td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="' . htmlspecialchars($registro["id"]) . '">
                        <input type="hidden" name="imagen" value="' . htmlspecialchars($registro["imagen"]) . '">
                        <input type="submit" name="borrar" value="Eliminar">
                    </form>
                  </td>';

                                                // Botón modificar (AJAX / JS)
                                                echo '<td>
                    <button class="btn-seleccionar">Modificar</button>
                  </td>';

                                                echo "</tr>";
                                            }
                                        }

                                        echo "</table>";
                                    }
                                    ?>
                                    </div>
                                    </main>

                                    <form action="index.php?controlador=usuarios&action=borrarUsuario" method="post" style="display:inline;">
                                        <input type="hidden" name="id_usuario" id="<?php echo $u['id_usuario']; ?>" value="<?php echo $u['id_usuario']; ?>">
                                        <input type="submit" name="borrar" value="Borrar" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
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
        <div id="formModificar" style="display: none; margin-bottom: 20px; padding: 15px; background: #f5f5f5; border-radius: 5px;"></div>
    </section>
<?php } ?>