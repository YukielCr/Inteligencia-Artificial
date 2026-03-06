<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../connection/conexion.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ruta_imagen = ""; 
    
    // Lógica de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $carpeta_destino = "../images/"; 
        $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_final = $carpeta_destino . $nombre_archivo;
        
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_final)) {
            $ruta_imagen = $ruta_final; 
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    }

    $sql = "INSERT INTO registro_enfermedades (nombre, descripcion, ruta_imagen) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "sss", $nombre, $descripcion, $ruta_imagen);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('¡Enfermedad registrada con éxito!');
                    window.location.href = 'addEnfermedad.php'; 
                  </script>";
        } else {
            echo "Error al guardar en la base de datos: " . mysqli_error($conexion);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparando la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>