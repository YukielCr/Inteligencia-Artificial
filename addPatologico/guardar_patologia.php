<?php
// 1. Incluye tu conexión
include("../connection/conexion.php");

// 2. Recibimos los datos en formato JSON desde JavaScript
$datosJSON = file_get_contents('php://input');
$datos = json_decode($datosJSON, true);

if (!empty($datos)) {
    $errores = 0;
    // Creamos un arreglo para recordar a qué enfermedades les movimos datos
    $enfermedades_afectadas = [];

    // 3. Insertamos cada característica en el Cuadro Patológico
    foreach ($datos as $fila) {
        $id_enf = mysqli_real_escape_string($conexion, $fila['id_enfermedad']);
        $id_sin = mysqli_real_escape_string($conexion, $fila['id_sintoma']);
        $peso = mysqli_real_escape_string($conexion, $fila['peso']);

        $queryInsertar = "INSERT INTO cuadro_Patologico (id_enfermedad, id_sintoma, peso) 
                          VALUES ('$id_enf', '$id_sin', '$peso')";
        
        if (!mysqli_query($conexion, $queryInsertar)) {
            $errores++;
        } else {
            // Guardamos el ID de la enfermedad para actualizar su total después
            $enfermedades_afectadas[$id_enf] = true;
        }
    }

    // 4. Si todo se insertó bien, recalculamos la suma total
    if ($errores == 0) {
        // Recorremos solo las enfermedades que acabamos de modificar
        foreach (array_keys($enfermedades_afectadas) as $id_enf) {
            
            // Esta consulta suma todos los pesos de esa enfermedad y la actualiza
            $querySuma = "UPDATE registro_enfermedades 
                          SET suma_total = (
                              SELECT COALESCE(SUM(peso), 0) 
                              FROM cuadro_Patologico 
                              WHERE id_enfermedad = '$id_enf'
                          ) 
                          WHERE id = '$id_enf'";
                          
            mysqli_query($conexion, $querySuma);
        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "No se pudieron guardar algunos registros."]);
    }

} else {
    echo json_encode(["success" => false, "error" => "No se recibieron datos."]);
}
?>