<?php
if (!empty($_POST["btnregistrar"])) {
    
    // 1. Recibir los datos de texto del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // 2. Definir una variable para la ruta (por defecto vacía)
    $ruta_destino = ""; 
    $procesar_registro = true; // Usamos esta bandera para saber si hubo un error con la imagen

    // 3. Verificar SI el usuario seleccionó una imagen
    if (!empty($_FILES["imagen"]["name"])) {
        
        $imagen = $_FILES["imagen"]["tmp_name"];
        $nombreimagen = $_FILES["imagen"]["name"];
        $tipoimagen = strtolower(pathinfo($nombreimagen, PATHINFO_EXTENSION));
        $directorio = "../images/";

        // Validar el formato
        if ($tipoimagen == "jpg" || $tipoimagen == "jpeg" || $tipoimagen == "png") {
            $ruta_temporal = $directorio . time() . "_" . basename($nombreimagen);

            // Intentar mover la imagen
            if (move_uploaded_file($imagen, $ruta_temporal)) {
                $ruta_destino = $ruta_temporal; // Si se movió bien, actualizamos la ruta
            } else {
                echo "<div class='alert alert-danger mt-2 text-center'>Error al guardar la imagen en el servidor.</div>";
                $procesar_registro = false; // Detenemos el registro porque falló la imagen
            }
        } else {
            echo "<div class='alert alert-warning mt-2 text-center'>No se acepta ese formato. Solo JPG, JPEG o PNG.</div>";
            $procesar_registro = false; // Detenemos el registro por formato inválido
        }
    }

    // 4. Guardar en la base de datos (Solo si no hubo errores previos)
    if ($procesar_registro) {
        $sql = "INSERT INTO registro_enfermedades (nombre, descripcion, ruta_imagen) VALUES (?, ?, ?)";
        
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $nombre, $descripcion, $ruta_destino);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success mt-2 text-center'>Registro guardado exitosamente.</div>";
            } else {
                echo "<div class='alert alert-danger mt-2 text-center'>Error al guardar en la base de datos.</div>";
            }
            mysqli_stmt_close($stmt);
        }
    }
    ?>
    
    <script>
        history.replaceState(null, null, location.pathname);
    </script>

    <?php
}
?>