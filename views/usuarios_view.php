<?php require_once('menu_view.php'); ?>



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
            <button type="submit" name="crear" class="btn-crear" style="background:#2563eb; color:#fff; font-size:1.15rem; border-radius:30px; padding:0.7rem 2.2rem; font-weight:600; border:none; box-shadow:0 2px 8px rgba(37,99,235,0.10);">Crear usuario</button>
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
<h1 style="max-width:1200px; margin:32px auto 0 auto;">Usuarios</h1>
<section class="form-user" style="max-width:1200px; margin:32px auto 0 auto; background:#fff; border-radius:14px; box-shadow:0 4px 16px rgba(2,6,23,0.04); padding:2rem 2.5rem;">
        <h1 style="text-align:left;">Crear nuevo usuario</h1>
        <form action="index.php?controlador=usuarios&action=crearUsuario" method="post" style="width:100%;">
            <div style="display:grid; grid-template-columns: repeat(5, 1fr); gap:15px; margin-bottom:20px;">
                <div>
                    <label for="nombre" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Nombre de usuario</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
                <div>
                    <label for="localidad" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Localidad</label>
                    <input type="text" name="localidad" id="localidad" placeholder="Localidad..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
                <div>
                    <label for="sexo" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Sexo</label>
                    <input type="text" name="sexo" id="sexo" placeholder="Sexo..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
                <div>
                    <label for="rol" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Rol</label>
                    <select name="rol" id="rol" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required>
                        <option value="Admin">Admin</option>
                        <option value="editor">editor</option>
                        <option value="visor">visor</option>
                    </select>
                </div>
                <div>
                    <label for="passwd" style="font-weight:600; margin-bottom:6px; display:block; font-size:0.9rem;">Contraseña</label>
                    <input type="password" name="passwd" id="passwd" placeholder="Contraseña..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.9rem; background:#fff;" required />
                </div>
            </div>
            <div style="display:flex; justify-content:center; align-items:center;">
                <button type="submit" name="crear" class="btn-crear" style="background:#2563eb; color:#fff; font-size:1.15rem; border-radius:30px; padding:0.7rem 2.2rem; font-weight:600; border:none; box-shadow:0 2px 8px rgba(37,99,235,0.10); cursor:pointer;">Crear usuario</button>
            </div>
        </form>
    </section>
    <?php if (!empty($error)) { ?>
        <div class="alert"><?php echo $error; ?></div>
    <?php } ?>



    <section style="max-width:1200px; margin:40px auto; background:#fff; border-radius:14px; box-shadow:0 4px 16px rgba(2,6,23,0.04); padding:2rem;">
        <h3 style="font-size:1.5rem; font-weight:700; margin-bottom:1.5rem; color:#0f172a;">Usuarios registrados</h3>
        <table style="width:100%; border-collapse:separate; border-spacing:0;">
            <thead>
                <tr style="background:#f8fafc; border-bottom:2px solid #e2e8f0;">
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Usuario</th>
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Localidad</th>
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Sexo</th>
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:0.9rem; color:#475569;">Rol</th>
                    <th style="padding:12px 16px; text-align:center; font-weight:600; font-size:0.9rem; color:#475569;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)) {
                    foreach ($users as $u) { ?>
                        <tr style="border-bottom:1px solid #f1f5f9; transition:background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                            <td style="padding:14px 16px; font-size:0.95rem; color:#0f172a; font-weight:500;"><?php echo htmlspecialchars($u['nombre']); ?></td>
                            <td style="padding:14px 16px; font-size:0.95rem; color:#64748b;"><?php echo htmlspecialchars($u['localidad']); ?></td>
                            <td style="padding:14px 16px; font-size:0.95rem; color:#64748b;"><?php echo htmlspecialchars($u['sexo']); ?></td>
                            <td style="padding:14px 16px;">
                                <span style="display:inline-block; padding:4px 12px; background:#dbeafe; color:#1e40af; border-radius:20px; font-size:0.85rem; font-weight:500;">
                                    <?php echo isset($u['rol']) ? htmlspecialchars($u['rol']) : 'Sin rol'; ?>
                                </span>
                            </td>
                            <?php if (isset($_SESSION['usuario'])) { ?>
                                <td style="padding:14px 16px; text-align:center;">
                                    <button class="btn-modificar"
                                        data-id="<?php echo $u['id_usuario'] ?>"
                                        data-nombre="<?php echo $u['nombre'] ?>"
                                        data-sexo="<?php echo $u['sexo'] ?>"
                                        data-rol="<?php echo $u['rol'] ?>"
                                        data-localidad="<?php echo $u['localidad'] ?>"
                                        style="margin-right:8px;">
                                        Modificar
                                    </button>
                                    <form action="index.php?controlador=usuarios&action=borrarUsuario" method="post" style="display:inline;">
                                        <input type="hidden" name="id_usuario" value="<?php echo $u['id_usuario']; ?>">
                                        <input type="submit" name="borrar" value="Borrar" class="btn-borrar" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <div id="formModificar" style="display: none; margin-top: 30px; padding: 20px; background: #f5f5f5; border-radius: 10px;"></div>
    </section>

<?php } ?>