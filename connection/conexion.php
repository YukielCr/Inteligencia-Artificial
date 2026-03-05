<?php
//Conexion con la Base De Datos 
$host     = "localhost";
$user     = "root";
$password = "Angriter305";
$database = "enfermedades";

$conexion = mysqli_connect($host, $user, $password, $database);
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}
mysqli_set_charset($conexion, "utf8");
?>
