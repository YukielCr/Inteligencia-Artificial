<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Enfermedad</title>
    <link rel="icon" type="image/svg+xml" href="../img/iconnnn.jpg" />
    <style>
        /* Tipografía y fondo general */
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            padding: 40px 20px;
            margin: 0;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Tarjeta blanca que contiene todo */
        .tarjeta {
            background-color: #ffffff;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        /* Contenedor flexible para dividir en dos columnas */
        .contenedor-principal {
            display: flex;
            gap: 50px;
            align-items: flex-start;
            flex-wrap: wrap; /* Permite que se adapte en celulares */
        }

        /* Columna del formulario (Izquierda) */
        .columna-form {
            flex: 1;
            min-width: 300px;
        }

        /* Columna de la foto (Derecha) */
        .columna-foto {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 280px;
            background-color: #fcfcfc;
            border-radius: 10px;
            padding: 20px;
            border: 1px dashed #e0e0e0;
        }

        /* Estilos de las cajas de texto */
        label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #444;
        }

        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccd1d9;
            border-radius: 6px;
            box-sizing: border-box;
            font-family: inherit;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Estilos del área de la imagen */
        #vista-previa {
            max-width: 250px;
            max-height: 250px;
            display: none;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            object-fit: cover;
        }

        /* Botones hermosos */
        .grupo-botones {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        button, .btn-link {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            color: white;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s, transform 0.1s;
        }

        button:active, .btn-link:active {
            transform: scale(0.97);
        }

        /* Colores por función */
        .btn-altas { background-color: #2ecc71; }
        .btn-altas:hover { background-color: #27ae60; }

        .btn-bajas { background-color: #e74c3c; }
        .btn-bajas:hover { background-color: #c0392b; }

        .btn-consultar { background-color: #3498db; }
        .btn-consultar:hover { background-color: #2980b9; }

        .btn-modificar { background-color: #f39c12; }
        .btn-modificar:hover { background-color: #d68910; }

        .btn-multiples { background-color: #8e44ad; }
        .btn-multiples:hover { background-color: #732d91; }

        .btn-regresar { background-color: #95a5a6; }
        .btn-regresar:hover { background-color: #7f8c8d; }

    </style>
</head>
<body>
    
    <h1>Datos de la enfermedad</h1>

    <div class="tarjeta">
        <form action="altas.php" method="POST" enctype="multipart/form-data">
            
            <div class="contenedor-principal">
                
                <div class="columna-form">
                    <div>
                        <label>Nombre:</label>
                        <input type="text" name="nombre" placeholder="Ej. Gripe" required>
                    </div>
                    
                    <div>
                        <label>Descripción:</label>
                        <textarea name="descripcion" placeholder="Ej. Es una enfermedad muy contagiosa" required></textarea>
                    </div>
                    
                    <div>
                        <label>Imagen:</label>
                        <input type="file" name="imagen" accept="image/*" onchange="mostrarImagen(event)">
                    </div>
                    
                    <div class="grupo-botones">
                        <button type="submit" class="btn-altas">ALTAS</button>
                        <button type="button" class="btn-bajas" onclick="ejecutarBaja()">BAJAS</button>
                        <button type="button" class="btn-consultar" onclick="ejecutarConsulta()">CONSULTAR</button>
                        <a href="consultas_Grupal.php" class="btn-link btn-multiples">CONSULTAS MÚLTIPLES</a>
                        <button type="button" class="btn-modificar" onclick="ejecutarModificacion()">MODIFICACIONES</button>
                        <button type="button" class="btn-regresar" onclick="window.location.href='../interfasExpretoInicio.html'">REGRESAR</button>
                    </div>
                </div>

                <div class="columna-foto">
                    <span style="color: #999; margin-bottom: 10px; font-size: 14px;">Previsualización de Imagen</span>
                    <img id="vista-previa" src="" alt="Vista previa de la enfermedad">
                </div>

            </div>

        </form>
    </div>

    <script>
        function mostrarImagen(event) {
            const archivo = event.target.files[0];
            if (archivo) {
                const urlTemporal = URL.createObjectURL(archivo);
                const imagenPreview = document.getElementById('vista-previa');
                imagenPreview.src = urlTemporal;
                imagenPreview.style.display = 'block';
            }
        }
    </script>

    <script>
        function ejecutarBaja() {
            let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;
            if (nombreEnfermedad.trim() === "") {
                alert("Por favor, escribe el nombre de la enfermedad que deseas dar de baja.");
            } else {
                let confirmacion = confirm("¿Seguro que deseas eliminar la enfermedad: " + nombreEnfermedad + "?");
                if (confirmacion) {
                    window.location.href = 'bajas.php?nombre=' + encodeURIComponent(nombreEnfermedad);
                }
            }
        }
    </script>

    <script>
        function ejecutarModificacion() {
            let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;
            if (nombreEnfermedad.trim() === "") {
                alert("Por favor, escribe el nombre de la enfermedad que deseas modificar.");
            } else {
                let confirmacion = confirm("¿Seguro que deseas modificar los datos de la enfermedad: " + nombreEnfermedad + "?");
                if (confirmacion) {
                    let formulario = document.querySelector('form');
                    formulario.action = 'modificaciones.php';
                    formulario.submit();
                }
            }
        }
    </script>

    <script>
        async function ejecutarConsulta() {
            let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;
            if (nombreEnfermedad.trim() === "") {
                alert("Por favor, escribe el nombre de la enfermedad que deseas buscar.");
                return;
            }

            try {
                let respuesta = await fetch('consultas_Individual.php?nombre=' + encodeURIComponent(nombreEnfermedad));
                let datos = await respuesta.json();

                if (datos.error) {
                    alert(datos.mensaje);
                    document.querySelector('textarea[name="descripcion"]').value = "";
                    document.getElementById('vista-previa').style.display = 'none';
                } else {
                    document.querySelector('textarea[name="descripcion"]').value = datos.descripcion;
                    const imagenPreview = document.getElementById('vista-previa');
                    if (datos.ruta_imagen && datos.ruta_imagen.trim() !== "") {
                        let rutaLimpia = datos.ruta_imagen.replace("../../images/", "../images/");
                        imagenPreview.src = rutaLimpia;
                        imagenPreview.style.display = 'block';
                    } else {
                        imagenPreview.style.display = 'none';
                    }
                }
            } catch (error) {
                console.error("Error Fetch:", error);
                alert("Error de conexión. Revisa la consola.");
            }
        }
    </script>

</body>
</html>