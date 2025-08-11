<?php
require_once '../../modelo/conexionBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idEmpleado'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $cedula = $_POST['cedula'] ?? '';

    if ($id && $nombre && $apellido && $correo && $telefono && $cedula) {
    $conn = new connectionDB();
    $conexion = $conn->connection();
        $stmt = $conexion->prepare("UPDATE empleado SET nombre=?, apellido=?, correo=?, telefono=?, cedula=? WHERE idEmpleado=?");
        $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $telefono, $cedula, $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
        $conexion->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
