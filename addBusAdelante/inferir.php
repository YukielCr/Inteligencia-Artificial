<?php
include("../connection/conexion.php"); // Asegúrate de que esta ruta sea la correcta para tu proyecto

$resultados = [];

// --- AQUÍ DEFINES CUÁNTOS RESULTADOS QUIERES MOSTRAR ---
$limite_resultados = 5; // Cambia este número por la cantidad de enfermedades que quieras mostrar
// -------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['sintomas_ids'])) {
    // 1. Obtener los IDs de los síntomas enviados (ej. "1,5,12")
    $sintomas_ids = $_POST['sintomas_ids'];
    
    // Sanitización básica para evitar inyección SQL (solo permitir números y comas)
    $sintomas_ids = preg_replace('/[^0-9,]/', '', $sintomas_ids);

    if(!empty($sintomas_ids)){
        /*
         * LÓGICA DE INFERENCIA DIRECTA (Basado en el PDF)
         * 1) Suma seleccionada = Suma de pesos de los síntomas que el usuario eligió y que pertenecen a la enfermedad.
         * 2) Suma total = Suma de todos los pesos registrados para esa enfermedad en la BD.
         * 3) Porcentaje = (Suma Seleccionada / Suma Total) * 100
         */
        $query = "
            SELECT 
                e.nombre AS enfermedad,
                SUM(CASE WHEN cp.id_sintoma IN ($sintomas_ids) THEN cp.peso ELSE 0 END) AS suma_seleccionada,
                (SELECT SUM(peso) FROM cuadro_Patologico WHERE id_enfermedad = e.id) AS suma_total
            FROM registro_enfermedades e
            JOIN cuadro_Patologico cp ON e.id = cp.id_enfermedad
            GROUP BY e.id, e.nombre
            HAVING suma_seleccionada > 0
            ORDER BY (suma_seleccionada / suma_total) DESC
        ";

        $resultado_bd = mysqli_query($conexion, $query);

        if ($resultado_bd) {
            while ($row = mysqli_fetch_assoc($resultado_bd)) {
                // Calcular el porcentaje (Regla de 3 del PDF)
                $porcentaje = round(($row['suma_seleccionada'] / $row['suma_total']) * 100);
                
                $resultados[] = [
                    'enfermedad' => $row['enfermedad'],
                    'porcentaje' => $porcentaje
                ];
            }

            // ¡AQUÍ ESTÁ LA MAGIA! Ordenamos el arreglo de mayor a menor porcentaje
            usort($resultados, function($a, $b) {
                return $b['porcentaje'] <=> $a['porcentaje'];
            });

            // ¡NUEVO: AQUÍ CORTAMOS LOS RESULTADOS!
            // Esto asegura que el arreglo solo tenga la cantidad de elementos definidos en $limite_resultados
            $resultados = array_slice($resultados, 0, $limite_resultados);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Inferencia Directa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-success text-white text-center py-3">
                        <h2 class="mb-0 text-uppercase fs-4 fw-bold">Resultado de Inferencia Directa</h2>
                    </div>
                    
                    <div class="card-body p-4 p-md-5 text-center">
                        <?php if (count($resultados) > 0): ?>
                            
                            <h3 class="text-primary mb-4">
                                La Enfermedad más probable es <strong><?php echo $resultados[0]['enfermedad']; ?></strong> con un <strong><?php echo $resultados[0]['porcentaje']; ?>%</strong> de exactitud.
                            </h3>

                            <?php if (count($resultados) > 1): ?>
                                <p class="text-muted fs-5 mt-4">Pero también pueden ser:</p>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover mx-auto" style="max-width: 500px;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Enfermedad</th>
                                                <th>Certeza</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // Empezamos desde el índice 1 porque el 0 ya se mostró como principal
                                            for ($i = 1; $i < count($resultados); $i++): 
                                            ?>
                                                <tr>
                                                    <td class="fw-bold text-secondary"><?php echo $resultados[$i]['enfermedad']; ?></td>
                                                    <td><span class="badge bg-warning text-dark fs-6"><?php echo $resultados[$i]['porcentaje']; ?>%</span> de exactitud</td>
                                                </tr>
                                            <?php endfor; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>

                        <?php else: ?>
                            <div class="alert alert-warning" role="alert">
                                No se encontraron enfermedades relacionadas con los síntomas seleccionados.
                            </div>
                        <?php endif; ?>

                        <hr class="my-4">
                        <a href="javascript:history.back()" class="btn btn-secondary btn-lg">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>