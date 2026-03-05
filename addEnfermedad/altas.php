<?php
// 1. Incluir tu archivo de conexión
include("../connection/conexion.php"); 

// 2. Verificar si se enviaron los datos por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Recibir los datos de texto del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    // 4. Lógica para procesar y guardar la imagen
    $ruta_imagen = ""; 
    
    // Verificamos si se subió un archivo y no hay errores
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        // CORRECCIÓN 1: Usamos la carpeta 'img' que ya tienes en tu proyecto
        $carpeta_destino = "../images/"; 
        
        // Agregamos la fecha y hora al nombre del archivo para que no se repitan
        $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
        $ruta_final = $carpeta_destino . $nombre_archivo;
        
        // Movemos el archivo temporal que subió PHP a nuestra carpeta
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_final)) {
            $ruta_imagen = $ruta_final; 
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    }

    // 5. Preparar la consulta SQL 
    $sql = "INSERT INTO registro_enfermedades (nombre, descripcion, ruta_imagen) VALUES (?, ?, ?)";
    
    // Preparamos la consulta usando tu variable $conexcion
    if ($stmt = mysqli_prepare($conexcion, $sql)) {
        
        // Vinculamos nuestras variables
        mysqli_stmt_bind_param($stmt, "sss", $nombre, $descripcion, $ruta_imagen);
        
        // 6. Ejecutar la consulta y avisar al usuario
        if (mysqli_stmt_execute($stmt)) {
            // CORRECCIÓN 2: Regresamos al formulario después del éxito
            echo "<script>
                    alert('¡Enfermedad registrada con éxito!');
                    window.location.href = 'addEnfermedad.html'; 
                  </script>";
        } else {
            echo "Error al guardar en la base de datos: " . mysqli_error($conexcion);
        }
        
        // Cerramos la sentencia
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparando la consulta: " . mysqli_error($conexcion);
    }
    
    // Cerramos la conexión
    mysqli_close($conexcion);
}
?>

