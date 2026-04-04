<?php
include("../connection/conexion.php");
header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['id_enfermedad'], $data['id_sintoma'])) {
    $stmt = $conexion->prepare("DELETE FROM cuadro_Patologico WHERE id_enfermedad = ? AND id_sintoma = ?");
    $stmt->bind_param("ii", $data['id_enfermedad'], $data['id_sintoma']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    $stmt->close();
}
mysqli_close($conexion);
?>