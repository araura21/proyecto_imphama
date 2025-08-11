<?php
require_once '../../modelo/conexionBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idEmpleado'] ?? null;
    if ($id) {
    $conexion = (new connectionDB())->connection();
        $stmt = $conexion->prepare("DELETE FROM empleado WHERE idEmpleado=?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
        $conexion->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
