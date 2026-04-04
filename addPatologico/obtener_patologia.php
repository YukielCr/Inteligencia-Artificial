<?php
include("../connection/conexion.php");
header('Content-Type: application/json');

if (isset($_GET['id_enfermedad'])) {
    $id_enfermedad = intval($_GET['id_enfermedad']);
    
    $query = "SELECT cp.id_sintoma, cp.peso, s.nombre AS nombre_sintoma 
              FROM cuadro_Patologico cp 
              JOIN registro_Sintomas s ON cp.id_sintoma = s.id 
              WHERE cp.id_enfermedad = ?";
              
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_enfermedad);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $datos]);
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Falta ID']);
}
mysqli_close($conexion);
?>