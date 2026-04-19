<?php
include("../connection/conexion.php");

// Obtener todos los síntomas para llenar el primer ComboBox (select)
//$querySintomas = "SELECT id, nombre, descripcion FROM registro_Sintomas";
$querySintomas = "SELECT id, nombre FROM registro_Sintomas";
$resultadoSintomas = mysqli_query($conexion, $querySintomas);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda Hacia Atrás - Motor de Inferencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/jpeg" href="img/iconnnn.jpg" />
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-danger text-white text-center py-3">
                        <h2 class="mb-0 text-uppercase fs-4 fw-bold">Búsqueda Hacia Adelante </h2>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="row mb-4">
                            <div class="col-md-9">
                                <label for="cbx_sintomas" class="form-label fw-bold text-secondary">Características a
                                    evaluar:</label>
                                <select id="cbx_sintomas" class="form-select form-select-lg mb-3 shadow-sm">
                                    <?php while ($row = mysqli_fetch_assoc($resultadoSintomas)) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['nombre']; ?>
                                            <!-- <?php echo $row['nombre'] . " - " . $row['descripcion']; ?> -->
                                        </option>
                                    <?php } ?>
                                </select>

                                <select id="lista_seleccionados" class="form-select shadow-sm" multiple
                                    style="height: 250px;"></select>
                            </div>

                            <div class="col-md-3 d-flex flex-column justify-content-center gap-3 mt-4 mt-md-0 pt-md-4">
                                <button class="btn btn-outline-primary btn-lg shadow-sm" onclick="añadirSintoma()">
                                    📁 Añadir
                                </button>
                                <button class="btn btn-outline-danger btn-lg shadow-sm" onclick="eliminarSintoma()">
                                    🖍️ Eliminar
                                </button>
                            </div>
                        </div>

                        <hr class="my-4 text-muted">

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <a href="../interfasUsuarioInicio.html" class="btn btn-secondary mb-3 mb-md-0 shadow-sm">
                                Volver al Menú Principal
                            </a>

                            <form id="formInferencia" action="inferir.php" method="POST" class="m-0">
                                <input type="hidden" name="sintomas_ids" id="sintomas_ids" value="">

                                <button type="button" class="btn btn-success"
                                    onclick="prepararInferencia()">Inferir</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function añadirSintoma() {
            var cbx = document.getElementById("cbx_sintomas");
            var lista = document.getElementById("lista_seleccionados");

            var opcionSeleccionada = cbx.options[cbx.selectedIndex];

            // Verificar que no se haya agregado ya para evitar duplicados
            var yaExiste = false;
            for (var i = 0; i < lista.options.length; i++) {
                if (lista.options[i].value === opcionSeleccionada.value) {
                    yaExiste = true;
                    break;
                }
            }

            if (!yaExiste && opcionSeleccionada.value !== "") {
                var nuevaOpcion = document.createElement("option");
                nuevaOpcion.value = opcionSeleccionada.value;
                nuevaOpcion.text = opcionSeleccionada.text;
                lista.add(nuevaOpcion);
            }
        }

        function eliminarSintoma() {
            var lista = document.getElementById("lista_seleccionados");
            // Eliminar los elementos que estén seleccionados en el cuadro grande
            for (var i = lista.options.length - 1; i >= 0; i--) {
                if (lista.options[i].selected) {
                    lista.remove(i);
                }
            }
        }


        function prepararInferencia() {
            var lista = document.getElementById("lista_seleccionados");
            var form = document.getElementById("formInferencia");
            var inputIds = document.getElementById("sintomas_ids");

            // Validar que haya al menos un síntoma seleccionado
            if (lista.options.length === 0) {
                alert("Por favor, añada al menos un síntoma a la lista antes de inferir.");
                return;
            }

            // Recorrer la lista y guardar los IDs en un arreglo
            var ids = [];
            for (var i = 0; i < lista.options.length; i++) {
                ids.push(lista.options[i].value);
            }

            // Convertir el arreglo en una cadena separada por comas (ej. "1,4,15")
            inputIds.value = ids.join(",");

            // Enviar el formulario
            form.submit();
        }


    </script>
</body>

</html>