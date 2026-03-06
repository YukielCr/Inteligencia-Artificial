<?php
// Ocultamos los errores de HTML/PHP normales para no romper el formato de respuesta
error_reporting(0);
// Le decimos al navegador que le vamos a contestar estrictamente con datos JSON
header('Content-Type: application/json; charset=utf-8');

// Incluimos tu conexión
require "../connection/conexion.php";

// Aquí prepararemos nuestra respuesta
$respuesta = array(); 

if (isset($_GET['nombre']) && !empty(trim($_GET['nombre']))) {
    $nombre_buscado = trim($_GET['nombre']);
    
    // Buscamos la enfermedad
    $sql = "SELECT * FROM registro_enfermedades WHERE nombre = ?";
    
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $nombre_buscado);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
        // Si la base de datos nos devuelve la fila...
        if ($fila = mysqli_fetch_assoc($resultado)) {
            // ¡Éxito! Empaquetamos los datos
            $respuesta['error'] = false;
            $respuesta['id'] = $fila['id'];
            $respuesta['nombre'] = $fila['nombre'];
            $respuesta['descripcion'] = $fila['descripcion'];
            $respuesta['ruta_imagen'] = $fila['ruta_imagen'];
        } else {
            // Si no existe, preparamos el error
            $respuesta['error'] = true;
            $respuesta['mensaje'] = "No se encontró ninguna enfermedad llamada '$nombre_buscado'.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $respuesta['error'] = true;
        $respuesta['mensaje'] = "Error conectando con la base de datos.";
    }
} else {
    $respuesta['error'] = true;
    $respuesta['mensaje'] = "El campo de nombre está vacío.";
}

// Transformamos nuestro arreglo de PHP al formato JSON que JavaScript (AJAX) entiende
echo json_encode($respuesta);
?>