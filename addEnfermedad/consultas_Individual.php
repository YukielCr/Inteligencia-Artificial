<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Conexión a tu base de datos
require "../connection/conexion.php";

if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre_buscado = trim($_GET['nombre']);
    
    // 2. Buscamos si la enfermedad realmente existe
    $sql = "SELECT nombre FROM registro_enfermedades WHERE nombre = ?";
    
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $nombre_buscado);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        // 3. ¿Encontró algo?
        if (mysqli_stmt_num_rows($stmt) > 0) {
            // SÍ EXISTE: Lo regresamos a tu diseño original pasándole el nombre para que se autollene
            header("Location: addEnfermedad.php?consulta=" . urlencode($nombre_buscado));
        } else {
            // NO EXISTE: Mostramos alerta y lo regresamos a tu diseño original
            echo "<script>
                    alert('No se encontró ninguna enfermedad registrada con el nombre \"$nombre_buscado\".');
                    window.location.href = 'addEnfermedad.php';
                  </script>";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    // Si entran directo al archivo, los regresa
    header("Location: addEnfermedad.php");
}
?>