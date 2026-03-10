<?php
// Verificamos que sí hayamos recibido un ID por la URL al darle clic al botón rojo
if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    // 1. Primero buscamos en la base de datos la ruta de la imagen usando ese ID
    $buscar_imagen = $conexion->query("SELECT ruta_imagen FROM registro_Sintomas WHERE id=$id");
    
    // Si la encontramos, procedemos a borrar el archivo físico
    if ($fila = $buscar_imagen->fetch_object()) {
        $ruta_actual = $fila->ruta_imagen;

        try {   
            // Verificamos que el archivo exista antes de intentar borrarlo
            if (file_exists($ruta_actual)) {
                unlink($ruta_actual); // Elimina la foto de la carpeta images/
            }
        } catch (Throwable $th) {   
            // Si hay un error físico, que el sistema no se trabe
        }
    }

    // 2. Ahora sí, eliminamos todo el registro de la base de datos
    $eliminar = $conexion->query("DELETE FROM registro_Sintomas WHERE id=$id");
    
    // 3. Mostramos las alertas corregidas con verdaderos <div>
    if ($eliminar) {
        echo "<div class='alert alert-success mt-2 text-center'>Correcto, el registro y la imagen fueron eliminados.</div>";
    } else {
        echo "<div class='alert alert-danger mt-2 text-center'>Error al eliminar de la base de datos.</div>";
    }
?>

    <script>
        history.replaceState(null, null, location.pathname);
    </script>

<?php
}
?>