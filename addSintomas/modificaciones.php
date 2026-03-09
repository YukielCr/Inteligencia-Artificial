<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Conexión a la base de datos
require "../connection/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibimos todo del formulario de tu pantalla principal
    $nombre = $_POST['nombre']; // Usaremos el nombre para buscar a quién modificar
    $descripcion = $_POST['descripcion'];
    
    // 2. Buscamos si existe el síntoma y cuál es su foto actual
    $sql_buscar = "SELECT id, ruta_imagen FROM registro_Sintomas WHERE nombre = ?";
    
    if ($stmt_buscar = mysqli_prepare($conexion, $sql_buscar)) {
        mysqli_stmt_bind_param($stmt_buscar, "s", $nombre);
        mysqli_stmt_execute($stmt_buscar);
        $resultado = mysqli_stmt_get_result($stmt_buscar);
        
        // Si el nombre SÍ coincide con uno de la base de datos
        if ($fila = mysqli_fetch_assoc($resultado)) {
            $id = $fila['id'];
            $ruta_actual = $fila['ruta_imagen'];
            $ruta_destino = $ruta_actual; // Por defecto se queda la foto que ya tenía
            
            // 3. ¿El usuario eligió una foto nueva en el input de imagen?
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $carpeta_destino = "../images/";
                $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
                $ruta_nueva = $carpeta_destino . $nombre_archivo;
                
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_nueva)) {
                    // Borramos la imagen vieja para no saturar tu disco
                    if (!empty($ruta_actual) && file_exists($ruta_actual)) {
                        unlink($ruta_actual);
                    }
                    $ruta_destino = $ruta_nueva; 
                }
            }

            // 4. Actualizamos la base de datos con los datos nuevos
            $sql_update = "UPDATE registro_Sintomas SET descripcion=?, ruta_imagen=? WHERE id=?";
            if ($stmt_update = mysqli_prepare($conexion, $sql_update)) {
                mysqli_stmt_bind_param($stmt_update, "ssi", $descripcion, $ruta_destino, $id);
                
                if (mysqli_stmt_execute($stmt_update)) {
                    echo "<script>
                            alert('¡Los datos de \"$nombre\" fueron modificados con éxito!'); 
                            window.location.href='addSintomas.php';
                          </script>";
                } else {
                    echo "<script>alert('Error al modificar en la base de datos.'); window.location.href='addSintomas.php';</script>";
                }
                mysqli_stmt_close($stmt_update);
            }
            
        } else {
            // Si escribiste un nombre que no existe, te avisa sin borrar nada
            echo "<script>
                    alert('No se encontró ninguna enfermedad llamada \"$nombre\". Asegúrate de escribir el nombre exacto.'); 
                    window.location.href='addSintomas.php';
                  </script>";
        }
        mysqli_stmt_close($stmt_buscar);
    }
} else {
    // Si entran por URL sin darle al botón, los regresa
    header("Location: addSintomas.php");
}
?>