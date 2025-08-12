<?php
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();

$nombre    = $_POST['nombre'] ?? '';
$apellido  = $_POST['apellido'] ?? '';
$cedula    = $_POST['cedula'] ?? '';
$telefono  = $_POST['telefono'] ?? '';
$correo    = $_POST['correo'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$estado    = $_POST['estado'] ?? 'activo';

$stmt = $conn->prepare("INSERT INTO cliente (nombre, apellido, cedula, telefono, correo, direccion, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nombre, $apellido, $cedula, $telefono, $correo, $direccion, $estado);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cliente agregado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al agregar cliente: ' . $conn->error]);
}
$stmt->close();
$conn->close();
?>