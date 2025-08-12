<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

$db = new connectionDB();
$conn = $db->connection();
$ruc = $conn->real_escape_string($_POST['ruc']);
$nombre_empresa = $conn->real_escape_string($_POST['nombre_empresa']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$correo = $conn->real_escape_string($_POST['correo']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$estado = isset($_POST['estado']) ? $conn->real_escape_string($_POST['estado']) : 'activo';
$sql = "INSERT INTO proveedor (ruc, nombre_empresa, telefono, correo, direccion, estado) VALUES ('$ruc', '$nombre_empresa', '$telefono', '$correo', '$direccion', '$estado')";
if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Proveedor agregado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al agregar proveedor: ' . $conn->error]);
}
exit;
