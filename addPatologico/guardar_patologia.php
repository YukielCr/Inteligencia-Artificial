<?php
// Incluye tu conexión
include("../connection/conexion.php");

// Recibimos los datos en formato JSON desde JavaScript
$datosJSON = file_get_contents('php://input');
$datos = json_decode($datosJSON, true);

// Verificamos que sí hayan llegado datos
if (!empty($datos)) {
    $errores = 0;

    // Recorremos cada fila que nos mandó el JavaScript
    foreach ($datos as $fila) {
        // Limpiamos los datos por seguridad
        $id_enf = mysqli_real_escape_string($conexion, $fila['id_enfermedad']);
        $id_sin = mysqli_real_escape_string($conexion, $fila['id_sintoma']);
        $peso = mysqli_real_escape_string($conexion, $fila['peso']);

        // Preparamos la inserción
        $query = "INSERT INTO cuadro_Patologico (id_enfermedad, id_sintoma, peso) 
                  VALUES ('$id_enf', '$id_sin', '$peso')";
        
        // Si una consulta falla, sumamos un error
        if (!mysqli_query($conexion, $query)) {
            $errores++;
        }
    }

    // Devolvemos una respuesta al JavaScript
    if ($errores == 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "No se pudieron guardar algunos registros."]);
    }

} else {
    echo json_encode(["success" => false, "error" => "No se recibieron datos."]);
}
?>