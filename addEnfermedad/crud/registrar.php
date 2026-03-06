<?php
if (!empty($_POST["btnregistrar"])) {
    
    // 1. Recibir los datos de texto del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // 2. Recibir los datos de la imagen
    $imagen = $_FILES["imagen"]["tmp_name"];
    $nombreimagen = $_FILES["imagen"]["name"];
    $tipoimagen = strtolower(pathinfo($nombreimagen, PATHINFO_EXTENSION));
    
    // 3. Definir la carpeta donde se guardará (un nivel arriba, en images)
    $directorio = "../images/";

    // 4. Validar el formato de la imagen
    if ($tipoimagen == "jpg" or $tipoimagen == "jpeg" or $tipoimagen == "png") {
        
        // Generar una ruta única para que las imágenes no se sobreescriban
        $ruta_destino = $directorio . time() . "_" . basename($nombreimagen);

        // Almacenando la imagen físicamente en la carpeta
        if (move_uploaded_file($imagen, $ruta_destino)) {
            
            // 5. Guardar todo en la base de datos (Usamos sentencias preparadas por seguridad)
            $sql = "INSERT INTO registro_enfermedades (nombre, descripcion, ruta_imagen) VALUES (?, ?, ?)";
            
            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $nombre, $descripcion, $ruta_destino);
                
                if (mysqli_stmt_execute($stmt)) {
                    // Mensaje de éxito real (corregido de <dib> a <div>)
                    echo "<div class='alert alert-success mt-2 text-center'>Imagen y datos guardados exitosamente.</div>";
                } else {
                    echo "<div class='alert alert-danger mt-2 text-center'>Error al guardar en la base de datos.</div>";
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            echo "<div class='alert alert-danger mt-2 text-center'>Error al mover la imagen a la carpeta destino.</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-2 text-center'>No se acepta ese formato. Solo JPG, JPEG o PNG.</div>";
    }
    ?>
    
    <script>
        history.replaceState(null, null, location.pathname);
    </script>

    <?php
}
?>