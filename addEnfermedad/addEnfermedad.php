<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Enfermedad</title>
    <link rel="icon" type="image/svg+xml" href="../img/iconnnn.jpg" />
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <div class="container py-5">
        
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                
                <h1 class="text-center mb-5 fw-bold text-primary">Datos de la enfermedad</h1>

                <form action="altas.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row g-5">
                        
                        <div class="col-lg-7">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre:</label>
                                <input type="text" class="form-control form-control-lg" name="nombre" placeholder="Ej. Gripe" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Descripción:</label>
                                <textarea class="form-control" name="descripcion" rows="4" placeholder="Ej. Es una enfermedad muy contagiosa" required></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*" onchange="mostrarImagen(event)">
                            </div>
                            
                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <button type="submit" class="btn btn-success fw-bold px-4">ALTAS</button>
                                <button type="button" class="btn btn-danger fw-bold px-4" onclick="ejecutarBaja()">BAJAS</button>
                                <button type="button" class="btn btn-primary fw-bold px-4" onclick="ejecutarConsulta()">CONSULTAR</button>
                                <button type="button" class="btn btn-warning fw-bold text-dark px-4" onclick="ejecutarModificacion()">MODIFICACIONES</button>
                                <a href="consultas_Grupal.php" class="btn btn-info fw-bold text-white px-4">CONSULTAS MÚLTIPLES</a>
                                <button type="button" class="btn btn-secondary fw-bold px-4" onclick="window.location.href='../interfasExpretoInicio.html'">REGRESAR</button>
                            </div>
                            
                        </div>

                        <div class="col-lg-5 d-flex flex-column align-items-center justify-content-center bg-white border rounded-3 p-4 shadow-sm">
                            <span class="text-muted mb-3 fw-semibold">Previsualización de Imagen</span>
                            <img id="vista-previa" src="" alt="Vista previa de la enfermedad" class="img-fluid rounded shadow" style="display: none; max-height: 280px; object-fit: cover;">
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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