<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

$db = new connectionDB();
$conn = $db->connection();
$idProveedor = intval($_POST['idProveedor']);
$ruc = $conn->real_escape_string($_POST['ruc']);
$nombre_empresa = $conn->real_escape_string($_POST['nombre_empresa']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$correo = $conn->real_escape_string($_POST['correo']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$estado = isset($_POST['estado']) ? $conn->real_escape_string($_POST['estado']) : 'activo';
$sql = "UPDATE proveedor SET ruc='$ruc', nombre_empresa='$nombre_empresa', telefono='$telefono', correo='$correo', direccion='$direccion', estado='$estado' WHERE idProveedor=$idProveedor";
if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Proveedor actualizado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar proveedor: ' . $conn->error]);
}
exit;
