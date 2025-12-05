function modificarUsuario(idUsuario, nombre, localidad, sexo) {
    const formHtml = `
    <form id="formEditarUsuario" class="form-user">
        <input type="hidden" name="id_usuario" value="${idUsuario}">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="${nombre}" required>
        <label>Localidad:</label>
        <input type="text" name="localidad" value="${localidad}" required>
        <label>Sexo:</label>
        <input type="text" name="sexo" value="${sexo}" required>
        <label>Nueva Contraseña (opcional):</label>
        <input type="password" name="passwd" placeholder="Dejar vacío para no cambiar">
        <button type="submit">Guardar</button>
        <button type="button" onclick="cerrarFormulario()">Cancelar</button>
    </form>
`;

    document.getElementById('formModificar').innerHTML = formHtml;
    document.getElementById('formModificar').style.display = 'block';
}

document.getElementById('formEditarUsuario').addEventListener('submit', function (e) {
    e.preventDefault();
    enviarModificacion(this);
});

function enviarModificacion(form) {
    const formData = new FormData(form);
    fetch('index.php?controlador=usuarios&action=modificarUsuario', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Usuario modificado correctamente');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert();
        })
}