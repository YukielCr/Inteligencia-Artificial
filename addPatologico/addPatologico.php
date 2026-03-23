<?php
// 1. Incluye tu archivo de conexión (cambia 'conexion.php' por el nombre real de tu archivo)
include("../connection/conexion.php"); 

// 2. Consultas a la base de datos
// Consulta para Enfermedades (asegúrate de que tu variable de conexión se llame $conexion, o cámbiala por la tuya)
$queryEnfermedades = "SELECT id, nombre, ruta_imagen FROM registro_enfermedades";
$resultadoEnfermedades = mysqli_query($conexion, $queryEnfermedades);

// Consulta para Síntomas
$querySintomas = "SELECT id, nombre, ruta_imagen FROM registro_Sintomas";
$resultadoSintomas = mysqli_query($conexion, $querySintomas);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadro Patológico</title>
    <link rel="icon" type="image/svg+xml" href="../img/iconnnn.jpg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!--Uso de Estilos -->
    <style>
        body {
            background: #333333 url("../img/sinto.jpg") center center no-repeat fixed;
            background-size: cover;
        }

        .app-container {
            background-color: rgba(255, 255, 255, 0.95);
            border: 2px solid #f8fff8;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            max-width: 900px;
            margin-top: 30px;
        }

        .titulo-morfologico {
            color: #4b60e977;
            font-weight: 900;
            text-shadow: 1px 1px 0px #fff;
            border-bottom: 2px solid #2d4a22;
            display: inline-block;
            padding-bottom: 5px;
            letter-spacing: 1px;
        }

        .image-placeholder {
            min-height: 220px;
            background-color: white;
            border: 2px solid #666;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-style: italic;
            overflow: hidden;
            /* Para que las imágenes no se salgan del cuadro */
        }

        .btn-retro {
            background-color: #d1cff0;
            border: 1px solid #666;
            box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            font-size: 0.85rem;
        }

        .btn-retro:active {
            box-shadow: inset 2px 2px 2px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <div class="container app-container p-4">

        <div class="text-center mb-4">
            <h3 class="titulo-morfologico ">CUADRO PATOLÓGICO</h3>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="mb-1 d-flex align-items-center">
                    <label for="selectEnfermedad" class="form-label fw-bold mb-0 me-2">Enfermedades:</label>
                    <select id="selectEnfermedad" class="form-select form-select-sm border-dark rounded-0">
                        <option value="">Selecciona una enfermedad...</option>
                        <?php 
                        // 3. Ciclo para llenar las enfermedades
                        if($resultadoEnfermedades) {
                            while($row = mysqli_fetch_assoc($resultadoEnfermedades)) { 
                                // Guardamos la ruta de la imagen en un atributo "data-img"
                                echo '<option value="'.$row['id'].'" data-img="'.$row['ruta_imagen'].'">'.$row['nombre'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="image-placeholder mt-2" id="img-enfermedad-container">
                    <span>[Imagen de Enfermedad]</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-1 d-flex align-items-center">
                    <label for="selectSintoma" class="form-label fw-bold mb-0 me-2">Síntomas:</label>
                    <select id="selectSintoma" class="form-select form-select-sm border-dark rounded-0">
                        <option value="">Selecciona un síntoma...</option>
                        <?php 
                        // 4. Ciclo para llenar los síntomas
                        if($resultadoSintomas) {
                            while($row = mysqli_fetch_assoc($resultadoSintomas)) { 
                                echo '<option value="'.$row['id'].'" data-img="'.$row['ruta_imagen'].'">'.$row['nombre'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="image-placeholder mt-2" id="img-sintoma-container">
                    <span>[Imagen de Síntoma]</span>
                </div>
            </div>
        </div>

        <div class="row mb-3 mt-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <label for="inputPeso" class="fw-bold me-2 fs-5">Peso:</label>
                <input type="number" id="inputPeso" class="form-control form-control-sm border-dark rounded-0 text-end"
                    style="width: 70px;" value="0">
                <span class="fw-bold ms-1 fs-5">%</span>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-10">
                <label class="form-label fw-bold mb-1">Características seleccionadas:</label>
                <div class="table-responsive border border-dark bg-white" style="height: 130px; overflow-y: auto;">
                    <table class="table table-sm table-borderless mb-0">
                        <thead class="border-bottom border-dark">
                            <tr>
                                <th>Característica</th>
                                <th class="text-end" style="width: 80px;">Peso</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-caracteristicas">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-2 d-flex flex-column justify-content-center gap-3 mt-4">
                <button id="btnAnadir" class="btn btn-retro d-flex flex-column align-items-center py-2">
                    <i class="bi bi-box-seam fs-4" style="color: #a88b32;"></i>
                    <span>Añadir</span>
                </button>
                <button id="btnEliminar" class="btn btn-retro d-flex flex-column align-items-center py-2">
                    <i class="bi bi-eraser fs-4 text-secondary"></i>
                    <span>Eliminar</span>
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4 px-3 pb-2">
           <button id="btnGuardar" class="btn btn-retro px-4 d-flex flex-column align-items-center gap-1">
                <i class="bi bi-floppy-fill text-secondary fs-5"></i> <span>GUARDAR</span>
            </button>
            <button class="btn btn-retro px-4 d-flex flex-column align-items-center gap-1">
                <i class="bi bi-x-circle-fill text-danger fs-5"></i> <span>CANCELAR</span>
            </button>
            <a href="../interfasExpretoInicio.html"
                class="btn btn-retro px-4 d-flex flex-column align-items-center gap-1 text-decoration-none text-dark">
                <i class="bi bi-box-arrow-right text-success fs-5"></i>
                <span>SALIR</span>
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!--Selector de lista de Enfermedades y sintomas e imagenes-->
    <script>
        function actualizarImagen(selectId, containerId, textoVacio) {
            const select = document.getElementById(selectId);
            const container = document.getElementById(containerId);

            select.addEventListener('change', function () {
                const opcionSeleccionada = this.options[this.selectedIndex];
                const rutaImg = opcionSeleccionada.getAttribute('data-img');

                if (rutaImg && rutaImg.trim() !== "") {
                    // Si hay una ruta de imagen válida, crea una etiqueta <img>
                    container.innerHTML = `<img src="${rutaImg}" style="max-width: 100%; max-height: 215px; object-fit: contain;" alt="Imagen">`;
                } else {
                    // Si no hay imagen o se seleccionó la opción por defecto
                    container.innerHTML = `<span>[${textoVacio}]</span>`;
                }
            });
        }

        // Aplicamos la función a ambos selectores
        actualizarImagen('selectEnfermedad', 'img-enfermedad-container', 'Sin Imagen de Enfermedad');
        actualizarImagen('selectSintoma', 'img-sintoma-container', 'Sin Imagen de Síntoma');
    </script>

    <!--Boton de añadir-->
    <script>
        document.getElementById('btnAnadir').addEventListener('click', function () {
            // 1. Obtener los elementos del DOM
            const selectEnfermedad = document.getElementById('selectEnfermedad');
            const selectSintoma = document.getElementById('selectSintoma');
            const inputPeso = document.getElementById('inputPeso');
            const tabla = document.getElementById('tabla-caracteristicas'); // Cambiado a tu tabla

            // 2. Obtener los valores seleccionados
            const idEnfermedad = selectEnfermedad.value;
            const idSintoma = selectSintoma.value;
            const peso = parseFloat(inputPeso.value);

            // 3. Validaciones
            if (idEnfermedad === "" && idSintoma === "") {
                alert("Por favor, selecciona una Enfermedad o un Síntoma.");
                return;
            }

            if (isNaN(peso) || peso <= 0) {
                alert("El peso debe ser un número mayor a 0%.");
                return;
            }

            // 4. Determinar qué texto mostrar (Enfermedad o Síntoma)
            let textoMostrar = "";
            let tipo = "";

            // Textos que se muestra en lo guardado }
            let txtEnfermedad = selectEnfermedad.options[selectEnfermedad.selectedIndex].text;
            let txtSintoma = selectSintoma.options[selectSintoma.selectedIndex].text;

            // 5. Crear la nueva fila (tr) para la tabla
            const nuevaFila = document.createElement('tr');

            // NUEVO: Guardamos los IDs como atributos ocultos (data-*)
            nuevaFila.dataset.idEnfermedad = idEnfermedad;
            nuevaFila.dataset.idSintoma = idSintoma;
            nuevaFila.dataset.peso = peso;


            nuevaFila.innerHTML = `
            <td class="align-middle"> ${txtEnfermedad}: ${txtSintoma}</td>
            <td class="text-end align-middle">
                <span class="badge bg-dark rounded-0 px-2 py-1">${peso}%</span>
            </td>
        `;

            // 6. Agregarlo a la tabla
            tabla.appendChild(nuevaFila);

            // 7. Limpiar los campos para la siguiente captura
            selectEnfermedad.value = "";
            selectSintoma.value = "";
            inputPeso.value = "0";

            // Disparar el evento 'change' para que las imágenes vuelvan al estado por defecto
            selectEnfermedad.dispatchEvent(new Event('change'));
            selectSintoma.dispatchEvent(new Event('change'));
        });
    </script>

    <!--Boton de eliminar-->
    <script>
        document.getElementById('btnEliminar').addEventListener('click', function () {
            const tabla = document.getElementById('tabla-caracteristicas');

            // Verificamos si la tabla tiene al menos una fila (hijo)
            if (tabla.lastElementChild) {
                // Eliminamos el último elemento agregado
                tabla.removeChild(tabla.lastElementChild);
            } else {
                // Opcional: un aviso si intentan borrar cuando ya está vacío
                alert("La lista ya está vacía.");
            }
        });
    </script>

    <!--Boton de Guardar-->
    <script>
        document.getElementById('btnGuardar').addEventListener('click', function () {
            // Buscamos todas las filas dentro de nuestra tabla
            const filas = document.querySelectorAll('#tabla-caracteristicas tr');
            
            if (filas.length === 0) {
                alert("No hay características en la lista para guardar.");
                return;
            }

            // Creamos un arreglo para juntar todos los datos
            let datosAGuardar = [];
            
            filas.forEach(fila => {
                datosAGuardar.push({
                    id_enfermedad: fila.dataset.idEnfermedad,
                    id_sintoma: fila.dataset.idSintoma,
                    peso: fila.dataset.peso
                });
            });

            // Enviamos los datos a PHP usando fetch
            fetch('guardar_patologia.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datosAGuardar)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("¡Cuadro patológico guardado con éxito!");
                    // Limpiamos la tabla visualmente después de guardar
                    document.getElementById('tabla-caracteristicas').innerHTML = '';
                } else {
                    alert("Hubo un error al guardar: " + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Ocurrió un error en la conexión.");
            });
        });
    </script>
</body>

</html>