<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Enfermedad</title>
    <link rel="icon" type="image/svg+xml" href="../img/iconnnn.jpg" />
    <style>
        /* CSS para poner el formulario a la izquierda y la imagen a la derecha */
        .contenedor-principal {
            display: flex; /* Esto pone los elementos en fila */
            gap: 50px; /* Espacio entre el formulario y la imagen */
            align-items: flex-start;
        }

        /* Estilos para el cuadro donde aparecerá la foto */
        #vista-previa {
            max-width: 250px;
            max-height: 250px;
            display: none; /* Estará oculto hasta que selecciones una imagen */
            border: 2px dashed #ccc;
            padding: 5px;
        }
    </style>
</head>
<body>
    
    <h1>Datos de la enfermedad</h1>

    <!--Create un nuevo registro-->
    <form action="altas.php" method="POST" enctype="multipart/form-data">
        
        <div class="contenedor-principal">
            
            <div>
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" placeholder="Ej. Gripe" required>
                </div>
                <br>
                <div>
                    <label>Descripción:</label>
                    <textarea name="descripcion" placeholder="Ej. Es una enfermedad muy contagiosa" required></textarea>
                </div>
                <br>
                <div>
                    <label>Imagen:</label>
                    <input type="file" name="imagen" accept="image/*" onchange="mostrarImagen(event)">
                </div>
                <br>
                <div>
                    <button type="submit">ALTAS</button>
                    <button type="button" onclick="ejecutarBaja()">BAJAS</button>
                    <button type="button" onclick="ejecutarConsulta()">CONSULTAR</button>
                    <a href="consultas_Grupal.php">CONSULTAS</a>
                    <button type="button" onclick="ejecutarModificacion()">MODIFICACIONES</button>
                    <button type="button" onclick="window.location.href='../interfasExpretoInicio.html'">REGRESAR</button>
                </div>
            </div>

            <div>
                <img id="vista-previa" src="" alt="Vista previa de la enfermedad">
            </div>

        </div>

    </form>

    <script>
        function mostrarImagen(event) {
            // Obtenemos el archivo que el usuario seleccionó
            const archivo = event.target.files[0];
            
            if (archivo) {
                // Creamos una URL temporal para esa imagen
                const urlTemporal = URL.createObjectURL(archivo);
                
                // Buscamos la etiqueta <img> y le ponemos esa URL
                const imagenPreview = document.getElementById('vista-previa');
                imagenPreview.src = urlTemporal;
                
                // Hacemos que la imagen se vuelva visible
                imagenPreview.style.display = 'block';
            }
        }
    </script>

    <!-- Eliminar un registro -->
    <script>
    function ejecutarBaja() {
        // Buscamos lo que el usuario escribió en el campo con name="nombre"
        let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;

        // Verificamos que no esté vacío
        if (nombreEnfermedad.trim() === "") {
            alert("Por favor, escribe el nombre de la enfermedad que deseas dar de baja.");
        } else {
            // Pedimos confirmación para evitar borrados accidentales
            let confirmacion = confirm("¿Seguro que deseas eliminar la enfermedad: " + nombreEnfermedad + "?");
            
            if (confirmacion) {
                // Redirigimos a bajas.php enviando el nombre por la URL
                window.location.href = 'bajas.php?nombre=' + encodeURIComponent(nombreEnfermedad);
            }
        }
    }
</script>

<!-- Modificación de un registro -->
<script>
    function ejecutarModificacion() {
        let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;

        if (nombreEnfermedad.trim() === "") {
            alert("Por favor, escribe el nombre de la enfermedad que deseas modificar.");
        } else {
            let confirmacion = confirm("¿Seguro que deseas modificar los datos de la enfermedad: " + nombreEnfermedad + "?");
            
            if (confirmacion) {
                // Truco maestro: Seleccionamos tu formulario
                let formulario = document.querySelector('form');
                
                // Le cambiamos el destino de "altas.php" a "modificaciones.php"
                formulario.action = 'modificaciones.php';
                
                // Lo enviamos con todos los campos (nombre, descripción, imagen)
                formulario.submit();
            }
        }
    }
</script>

<script>
    // Ejecutar la CONSULTA
    function ejecutarConsulta() {
        let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;
        
        if (nombreEnfermedad.trim() === "") {
            alert("Por favor, escribe el nombre de la enfermedad que deseas buscar.");
        } else {
            // Mandamos el nombre directamente por la URL a tu archivo backend
            window.location.href = 'consultas_Individual.php?nombre=' + encodeURIComponent(nombreEnfermedad);
        }
    }
</script>


</body>
</html>