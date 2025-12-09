// ===== TODO EN UN SOLO DOMContentLoaded =====
document.addEventListener('DOMContentLoaded', function () {
    
    // ===== Eliminar animal con AJAX =====
    document.querySelectorAll('.btn-borrar-animal').forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            const id_animal = this.getAttribute('data-id_animal');
            const nombre = this.getAttribute('data-nombre');
            
            if (confirm(`¿Estás seguro de que quieres eliminar a ${nombre}?`)) {
                fetch('index.php?controlador=animales&action=eliminarAnimal', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'borrar=true&id_animal=' + encodeURIComponent(id_animal)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Eliminar la fila de la tabla sin recargar
                        const fila = this.closest('tr');
                        fila.style.transition = 'opacity 0.3s';
                        fila.style.opacity = '0';
                        setTimeout(() => fila.remove(), 300);
                        alert(data.message || 'Animal eliminado correctamente');
                    } else {
                        alert(data.message || 'Error al eliminar el animal');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('No se pudo eliminar el animal');
                });
            }
        });
    });

    // ===== Modificar usuario con AJAX =====
    document.querySelectorAll('.btn-modificar').forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            let id = this.getAttribute('data-id');
            let nombre = this.getAttribute('data-nombre');
            let sexo = this.getAttribute('data-sexo');
            let rol = this.getAttribute('data-rol');
            let localidad = this.getAttribute('data-localidad');
            let formModificar = document.getElementById("formModificar");

            console.log(id, nombre, sexo, rol, localidad);
            // Enviar petición AJAX
            fetch('index.php?controlador=usuarios&action=modificarUsuario',
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body:
                        'accion=obtenerFormulario' +
                        '&id=' + encodeURIComponent(id) +
                        '&nombre=' + encodeURIComponent(nombre) +
                        '&sexo=' + encodeURIComponent(sexo) +
                        '&rol=' + encodeURIComponent(rol) +
                        '&localidad=' + encodeURIComponent(localidad)
                })
                .then(response => response.text())
                .then(html => {
                    console.log("Ha pasado el then");
                    if (formModificar) {
                        // console.log("Ha pasado el formModificar" + formModificar);
                        formModificar.innerHTML = html;
                        formModificar.style.display = 'block';

                        // Scroll suave al formulario
                        formModificar.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        // Manejar el envío del formulario
                        const form = document.getElementById('formModificarUsuario');
                        if (form) {
                            form.addEventListener('submit', function (e) {
                                e.preventDefault();

                                const formData = new FormData(form);

                                // Asegurarse de que el campo 'modificar' está presente
                                if (!formData.has('modificar')) {
                                    formData.append('modificar', 'Modificar');
                                }

                                fetch('index.php?controlador=usuarios&action=modificarUsuario', {
                                    method: 'POST',
                                    body: formData
                                })
                                    .then(response => {
                                        if (response.ok) {
                                            window.location.reload();
                                        } else {
                                            alert('Error al modificar el usuario');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Error al modificar el usuario');
                                    });
                            });
                        }
                    } else if (!formModificar) {
                        console.log(`El ${formModificar} no está definido`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('No se pudo cargar el formulario');
                });
        });
    });

    // ===== Modificar animal con AJAX =====
    document.querySelectorAll('.btn-modificar-Animales').forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            let id = this.getAttribute('data-id_animal');
            let fecha_subida = this.getAttribute('data-fecha_subida');
            let imagen = this.getAttribute('data-imagen');
            let nombre = this.getAttribute('data-nombre_animal');
            let especie = this.getAttribute('data-especie');
            let edad = this.getAttribute('data-edad');
            let descripcion = this.getAttribute('data-descripcion');
            let formModificar = document.getElementById("formModificar");

            console.log("ID: " + id, "Fecha de subida: " + fecha_subida, "Ruta imagen: " + imagen, "Nombre: " + nombre, "Especie: " + especie, "Edad: " + edad, "Descripción: " + descripcion);
            // Enviar petición AJAX
            fetch('index.php?controlador=animales&action=modificarAnimal',
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body:
                        'accion=obtenerFormularioAnimal' +
                        '&id=' + encodeURIComponent(id) +
                        '&imagen=' + encodeURIComponent(imagen) +
                        '&nombre=' + encodeURIComponent(nombre) +
                        '&edad=' + encodeURIComponent(edad) +
                        '&especie=' + encodeURIComponent(especie) +
                        '&descripcion=' + encodeURIComponent(descripcion)
                })
                .then(response => response.text())
                .then(html => {
                    console.log("Ha pasado el then");
                    if (formModificar) {
                        console.log("Ha pasado el formModificarAnimal" + formModificar);
                        formModificar.innerHTML = html;
                        formModificar.style.display = 'block';

                        // Scroll suave al formulario
                        formModificar.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        // Manejar el envío del formulario
                        const form = document.getElementById('formModificarAnimal');
                        if (form) {
                            form.addEventListener('submit', function (e) {
                                e.preventDefault();

                                const formData = new FormData(form);

                                // Asegurarse de que el campo 'modificar' está presente
                                if (!formData.has('modificar')) {
                                    formData.append('modificar', 'Modificar');
                                }

                                fetch('index.php?controlador=animales&action=modificarAnimal', {
                                    method: 'POST',
                                    body: formData
                                })
                                    .then(response => {
                                        if (response.ok) {
                                            window.location.reload();
                                        } else {
                                            alert('Error al modificar el usuario');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Error al modificar el usuario');
                                    });
                            });
                        }
                    } else if (!formModificarAnimal) {
                        console.log(`El ${formModificarAnimal} no está definido`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('No se pudo cargar el formulario');
                });
        });
    });

});