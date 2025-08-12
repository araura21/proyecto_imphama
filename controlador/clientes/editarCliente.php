<?php
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();

$idCliente = $_POST['idCliente'] ?? '';
$nombre    = $_POST['nombre'] ?? '';
$apellido  = $_POST['apellido'] ?? '';
$cedula    = $_POST['cedula'] ?? '';
$telefono  = $_POST['telefono'] ?? '';
$correo    = $_POST['correo'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$estado    = $_POST['estado'] ?? 'activo';

$stmt = $conn->prepare("UPDATE cliente SET nombre=?, apellido=?, cedula=?, telefono=?, correo=?, direccion=?, estado=? WHERE idCliente=?");
$stmt->bind_param("sssssssi", $nombre, $apellido, $cedula, $telefono, $correo, $direccion, $estado, $idCliente);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cliente actualizado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar cliente: ' . $conn->error]);
}
$stmt->close();
$conn->close();
?>