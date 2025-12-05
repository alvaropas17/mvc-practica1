document.querySelectorAll('.btn-seleccionar').forEach(boton => {
    boton.addEventListener('click', (evento) => {
        evento.preventDefault();

        const fila = boton.closest('tr');
        const id = fila.getAttribute('data-id');
        const nombre = fila.getAttribute('data-nombre');
        const imagen = fila.getAttribute('data-imagen');
        const descrip = fila.getAttribute('data-descrip');
        const autor = fila.getAttribute('data-autor');

        console.log(nombre);

        // Enviar datos por AJAX (fetch)
        fetch('controller/tratamiento_controller.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'id=' + encodeURIComponent(id) +
                '&nombre=' + encodeURIComponent(nombre) +
                '&imagen=' + encodeURIComponent(imagen) +
                '&descrip=' + encodeURIComponent(descrip) +
                '&autor=' + encodeURIComponent(autor)
        })
            .then(response => {
                if (!response.ok) throw new Error("Error en el servidor");
                return response.text(); // Recibimos HTML
            })
            .then(html => {
                document.getElementById('modificar').innerHTML = html;

                // Mostrar y ocultar secciones si usas jQuery
                $("#nuevo").hide();
                $("#modificar").show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('No se pudieron obtener los datos');
            });
    });
});
