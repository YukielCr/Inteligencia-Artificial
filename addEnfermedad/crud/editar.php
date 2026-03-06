<?php
if(!empty($_POST["btneditar"])){
    
    // 1. Recibimos todos los datos (ID, Nombre, Descripción y Ruta de la foto actual)
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $ruta_actual = $_POST["ruta_actual"]; 
    
    // Variable para saber si la consulta SQL funcionó
    $ejecutar = false;

    // 2. VERIFICAMOS: ¿El usuario seleccionó una imagen NUEVA?
    if (!empty($_FILES["imagen"]["name"])) {
        
        $imagen = $_FILES["imagen"]["tmp_name"];
        $nombreimagen = $_FILES["imagen"]["name"];
        $tipoimagen = strtolower(pathinfo($nombreimagen, PATHINFO_EXTENSION));
        $directorio = "../images/";

        if ($tipoimagen == "jpg" or $tipoimagen == "jpeg" or $tipoimagen == "png") {
            
            // Borramos la imagen vieja
            try {   
                if (file_exists($ruta_actual)) {
                    unlink($ruta_actual); 
                }
            } catch(\Throwable $th) {}
            
            // Subimos la nueva imagen
            $ruta_destino = $directorio . time() . "_" . basename($nombreimagen);
            
            if (move_uploaded_file($imagen, $ruta_destino)) {
                // Actualizamos TEXTOS Y FOTO
                $sql = "UPDATE registro_enfermedades SET nombre=?, descripcion=?, ruta_imagen=? WHERE id=?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "sssi", $nombre, $descripcion, $ruta_destino, $id);
                $ejecutar = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                echo "<div class='alert alert-danger mt-2 text-center'>Error al subir la nueva imagen.</div>";
            }
        } else {
           echo "<div class='alert alert-warning mt-2 text-center'>Solo se aceptan formatos de imagen JPG, JPEG o PNG.</div>";
        }
        
    } else {
        // 3. NO SELECCIONÓ IMAGEN: Solo actualizamos el Nombre y la Descripción
        $sql = "UPDATE registro_enfermedades SET nombre=?, descripcion=? WHERE id=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $descripcion, $id);
        $ejecutar = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // 4. Mensaje final de éxito o error
    if ($ejecutar) {
        echo "<div class='alert alert-success mt-2 text-center'>Registro modificado correctamente.</div>";
    } elseif(empty($_FILES["imagen"]["name"]) || (isset($ruta_destino) && move_uploaded_file($imagen, $ruta_destino))) {
        // Solo mostramos error general si no fue culpa de la imagen (que ya tiene su propia alerta)
        echo "<div class='alert alert-danger mt-2 text-center'>Error al actualizar la base de datos.</div>";
    }
    ?>

    <script>
        history.replaceState(null, null, location.pathname);
    </script>

    <?php
}
?>