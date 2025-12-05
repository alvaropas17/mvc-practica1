<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
  <title>Adopciones • Adopción • Login • Contacto</title>

</head>

<body>

  <?php
  require_once("controller/front_controller.php");
  ?>

  <form action="" id="formEditarUsuario" class="form-user">
    <input type="hidden" name="" value="${idUsuario}">
    <label for="">Nombre:</label>
    <input type="text" name="nombre" id="" value="${nombre}" required>
  </form>

</body>

</html>