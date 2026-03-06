<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Incluimos la conexión a la base de datos
require "../connection/conexion.php";

// 2. Verificamos que sí hayamos recibido el nombre por la URL
if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    
    $nombre = trim($_GET['nombre']);

    // 3. Buscamos la enfermedad para obtener la ruta de su imagen antes de borrarla
    $sql_buscar = "SELECT id, ruta_imagen FROM registro_enfermedades WHERE nombre = ?";
    
    if ($stmt_buscar = mysqli_prepare($conexion, $sql_buscar)) {
        mysqli_stmt_bind_param($stmt_buscar, "s", $nombre);
        mysqli_stmt_execute($stmt_buscar);
        $resultado = mysqli_stmt_get_result($stmt_buscar);

        // Si la base de datos nos devuelve resultados (sí existe)
        if (mysqli_num_rows($resultado) > 0) {
            
            // Recorremos los resultados (por si casualmente hay dos con el mismo nombre)
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $ruta_actual = $fila['ruta_imagen'];
                
                // Borramos la imagen física de la carpeta
                if (!empty($ruta_actual) && file_exists($ruta_actual)) {
                    unlink($ruta_actual);
                }
            }

            // 4. Ahora sí, borramos el registro de la base de datos
            $sql_borrar = "DELETE FROM registro_enfermedades WHERE nombre = ?";
            
            if ($stmt_borrar = mysqli_prepare($conexion, $sql_borrar)) {
                mysqli_stmt_bind_param($stmt_borrar, "s", $nombre);
                
                if (mysqli_stmt_execute($stmt_borrar)) {
                    // Éxito
                    echo "<script>
                            alert('La enfermedad \"$nombre\" fue dada de baja exitosamente.');
                            window.location.href = 'addEnfermedad.php';
                          </script>";
                } else {
                    echo "<script>alert('Error al intentar borrar de la base de datos.'); window.location.href = 'addEnfermedad.php';</script>";
                }
                mysqli_stmt_close($stmt_borrar);
            }
            
        } else {
            // Si el usuario escribió un nombre que no existe en la base de datos
            echo "<script>
                    alert('No se encontró ninguna enfermedad registrada con el nombre \"$nombre\".');
                    window.location.href = 'addEnfermedad.php';
                  </script>";
        }
        mysqli_stmt_close($stmt_buscar);
    }
    
} else {
    // Si alguien entra directo a bajas.php sin enviar un nombre, lo regresamos
    header("Location: addEnfermedad.php");
    exit();
}
?>