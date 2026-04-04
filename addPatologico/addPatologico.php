<?php
include("../connection/conexion.php"); 

$queryEnfermedades = "SELECT id, nombre, ruta_imagen FROM registro_enfermedades";
$resultadoEnfermedades = mysqli_query($conexion, $queryEnfermedades);

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

    <style>
        body { background: #333333 url("../img/sinto.jpg") center center no-repeat fixed; background-size: cover; }
        .app-container { background-color: rgba(255, 255, 255, 0.95); border: 2px solid #f8fff8; border-radius: 8px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5); max-width: 900px; margin-top: 30px; }
        .titulo-morfologico { color: #4b60e977; font-weight: 900; text-shadow: 1px 1px 0px #fff; border-bottom: 2px solid #2d4a22; display: inline-block; padding-bottom: 5px; letter-spacing: 1px; }
        .image-placeholder { min-height: 220px; background-color: white; border: 2px solid #666; display: flex; align-items: center; justify-content: center; color: #888; font-style: italic; overflow: hidden; }
        .btn-retro { background-color: #d1cff0; border: 1px solid #666; box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2); font-weight: bold; font-size: 0.85rem; }
        .btn-retro:active { box-shadow: inset 2px 2px 2px rgba(0, 0, 0, 0.3); }
        .action-btn { cursor: pointer; padding: 2px 6px; font-size: 0.9rem; }
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
                        if($resultadoEnfermedades) {
                            while($row = mysqli_fetch_assoc($resultadoEnfermedades)) { 
                                echo '<option value="'.$row['id'].'" data-img="'.$row['ruta_imagen'].'">'.$row['nombre'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="image-placeholder mt-2" id="img-enfermedad-container"><span>[Imagen de Enfermedad]</span></div>
            </div>

            <div class="col-md-6">
                <div class="mb-1 d-flex align-items-center">
                    <label for="selectSintoma" class="form-label fw-bold mb-0 me-2">Síntomas:</label>
                    <select id="selectSintoma" class="form-select form-select-sm border-dark rounded-0">
                        <option value="">Selecciona un síntoma...</option>
                        <?php 
                        if($resultadoSintomas) {
                            while($row = mysqli_fetch_assoc($resultadoSintomas)) { 
                                echo '<option value="'.$row['id'].'" data-img="'.$row['ruta_imagen'].'">'.$row['nombre'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="image-placeholder mt-2" id="img-sintoma-container"><span>[Imagen de Síntoma]</span></div>
            </div>
        </div>

        <div class="row mb-3 mt-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <label for="inputPeso" class="fw-bold me-2 fs-5">Peso:</label>
                <input type="number" id="inputPeso" class="form-control form-control-sm border-dark rounded-0 text-end" style="width: 70px;" value="0" min="0" max="100">
                <span class="fw-bold ms-1 fs-5">%</span>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-10">
                <label class="form-label fw-bold mb-1" id="label-caracteristicas">Características seleccionadas:</label>
                <div class="table-responsive border border-dark bg-white" style="height: 150px; overflow-y: auto;">
                    <table class="table table-sm table-borderless mb-0">
                        <thead class="border-bottom border-dark">
                            <tr>
                                <th>Característica</th>
                                <th class="text-center" style="width: 120px;">Peso</th>
                                <th class="text-center" style="width: 90px;">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-caracteristicas">
                            </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-2 d-flex flex-column justify-content-center gap-3 mt-4">
                <button id="btnAnadir" class="btn btn-retro d-flex flex-column align-items-center py-2">
                    <i class="bi bi-box-seam fs-4" style="color: #a88b32;"></i> <span>Añadir</span>
                </button>
                <button id="btnEliminar" class="btn btn-retro d-flex flex-column align-items-center py-2" title="Borrar último añadido">
                    <i class="bi bi-eraser fs-4 text-secondary"></i> <span>Borrar Nvo</span>
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4 px-3 pb-2">
           <button id="btnGuardar" class="btn btn-retro px-4 d-flex flex-column align-items-center gap-1">
                <i class="bi bi-floppy-fill text-secondary fs-5"></i> <span>GUARDAR NUEVOS</span>
            </button>
            <a href="../interfasExpretoInicio.html" class="btn btn-retro px-4 d-flex flex-column align-items-center gap-1 text-decoration-none text-dark">
                <i class="bi bi-box-arrow-right text-success fs-5"></i> <span>SALIR</span>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // --- 1. Control de Imágenes ---
        function actualizarImagen(selectId, containerId, textoVacio) {
            const select = document.getElementById(selectId);
            const container = document.getElementById(containerId);
            select.addEventListener('change', function () {
                const rutaImg = this.options[this.selectedIndex].getAttribute('data-img');
                if (rutaImg && rutaImg.trim() !== "") {
                    container.innerHTML = `<img src="${rutaImg}" style="max-width: 100%; max-height: 215px; object-fit: contain;" alt="Imagen">`;
                } else {
                    container.innerHTML = `<span>[${textoVacio}]</span>`;
                }
            });
        }
        actualizarImagen('selectEnfermedad', 'img-enfermedad-container', 'Sin Imagen de Enfermedad');
        actualizarImagen('selectSintoma', 'img-sintoma-container', 'Sin Imagen de Síntoma');

        // --- 2. Cargar Datos por Enfermedad (LEER) ---
        const selectEnfermedad = document.getElementById('selectEnfermedad');
        const tabla = document.getElementById('tabla-caracteristicas');
        const labelCaracteristicas = document.getElementById('label-caracteristicas');

        selectEnfermedad.addEventListener('change', function() {
            const idEnfermedad = this.value;
            tabla.innerHTML = ''; // Limpiar tabla
            
            if(!idEnfermedad) {
                labelCaracteristicas.innerText = "Características seleccionadas:";
                return;
            }

            labelCaracteristicas.innerText = `Características de: ${this.options[this.selectedIndex].text}`;

            // Fetch a la base de datos
            fetch(`obtener_patologia.php?id_enfermedad=${idEnfermedad}`)
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        data.data.forEach(item => {
                            const tr = document.createElement('tr');
                            tr.className = 'fila-guardada bg-light';
                            tr.dataset.idEnfermedad = idEnfermedad;
                            tr.dataset.idSintoma = item.id_sintoma;
                            tr.dataset.peso = item.peso;

                            tr.innerHTML = `
                                <td class="align-middle text-secondary">${item.nombre_sintoma}</td>
                                <td class="text-center align-middle">
                                    <div class="input-group input-group-sm w-100">
                                        <input type="number" class="form-control text-end peso-input" value="${item.peso}">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-sm btn-outline-primary action-btn btn-actualizar" title="Actualizar Peso"><i class="bi bi-check2"></i></button>
                                    <button class="btn btn-sm btn-outline-danger action-btn btn-borrar-db" title="Eliminar de BD"><i class="bi bi-trash"></i></button>
                                </td>
                            `;
                            tabla.appendChild(tr);
                        });
                        asignarEventosCRUD();
                    }
                });
        });

        // --- 3. Asignar Eventos de Actualizar y Eliminar a filas existentes ---
        function asignarEventosCRUD() {
            // Actualizar
            document.querySelectorAll('.btn-actualizar').forEach(btn => {
                btn.addEventListener('click', function() {
                    const fila = this.closest('tr');
                    const nuevoPeso = fila.querySelector('.peso-input').value;
                    const idEnf = fila.dataset.idEnfermedad;
                    const idSin = fila.dataset.idSintoma;

                    fetch('actualizar_patologia.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_enfermedad: idEnf, id_sintoma: idSin, peso: nuevoPeso })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) alert("Peso actualizado correctamente.");
                        else alert("Error al actualizar.");
                    });
                });
            });

            // Eliminar
            document.querySelectorAll('.btn-borrar-db').forEach(btn => {
                btn.addEventListener('click', function() {
                    if(!confirm("¿Seguro que deseas eliminar este síntoma de la base de datos?")) return;
                    
                    const fila = this.closest('tr');
                    const idEnf = fila.dataset.idEnfermedad;
                    const idSin = fila.dataset.idSintoma;

                    fetch('eliminar_patologia.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_enfermedad: idEnf, id_sintoma: idSin })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) fila.remove();
                        else alert("Error al eliminar.");
                    });
                });
            });
        }

        // --- 4. Añadir Nuevos (Temporal en UI) ---
        document.getElementById('btnAnadir').addEventListener('click', function () {
            const selectSintoma = document.getElementById('selectSintoma');
            const inputPeso = document.getElementById('inputPeso');
            
            const idEnfermedad = selectEnfermedad.value;
            const idSintoma = selectSintoma.value;
            const peso = parseFloat(inputPeso.value);

            if (!idEnfermedad || !idSintoma) { alert("Selecciona Enfermedad Y Síntoma."); return; }
            if (isNaN(peso) || peso <= 0) { alert("El peso debe ser mayor a 0."); return; }

            const txtSintoma = selectSintoma.options[selectSintoma.selectedIndex].text;
            const tr = document.createElement('tr');
            tr.className = 'fila-nueva';
            tr.dataset.idEnfermedad = idEnfermedad;
            tr.dataset.idSintoma = idSintoma;
            tr.dataset.peso = peso;

            tr.innerHTML = `
                <td class="align-middle fw-bold text-success">${txtSintoma} <span class="badge bg-warning text-dark border border-dark ms-1" style="font-size:0.6rem;">NUEVO</span></td>
                <td class="text-center align-middle"><span class="badge bg-success rounded-0 px-2 py-1">${peso}%</span></td>
                <td class="text-center align-middle">-</td>
            `;
            tabla.appendChild(tr);

            selectSintoma.value = "";
            inputPeso.value = "0";
            selectSintoma.dispatchEvent(new Event('change'));
        });

        // --- 5. Borrar último nuevo (Borrador) ---
        document.getElementById('btnEliminar').addEventListener('click', function () {
            const ultimaFila = tabla.lastElementChild;
            if (ultimaFila && ultimaFila.classList.contains('fila-nueva')) {
                tabla.removeChild(ultimaFila);
            } else {
                alert("No hay elementos nuevos sin guardar para borrar. Usa el icono del bote de basura para borrar los que ya están en la base de datos.");
            }
        });

        // --- 6. Guardar Nuevos ---
        document.getElementById('btnGuardar').addEventListener('click', function () {
            const filasNuevas = document.querySelectorAll('#tabla-caracteristicas tr.fila-nueva');
            if (filasNuevas.length === 0) { alert("No hay síntomas nuevos para guardar."); return; }

            let datosAGuardar = [];
            filasNuevas.forEach(fila => {
                datosAGuardar.push({
                    id_enfermedad: fila.dataset.idEnfermedad,
                    id_sintoma: fila.dataset.idSintoma,
                    peso: fila.dataset.peso
                });
            });

            fetch('guardar_patologia.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(datosAGuardar)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("Guardado con éxito!");
                    // Disparamos el 'change' para recargar la tabla desde la BD
                    selectEnfermedad.dispatchEvent(new Event('change')); 
                } else {
                    alert("Error: " + data.error);
                }
            });
        });
    </script>
</body>
</html>