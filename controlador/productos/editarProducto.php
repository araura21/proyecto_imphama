<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

$db = new connectionDB();
$conn = $db->connection();
$idProducto = intval($_POST['idProducto']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$estado = isset($_POST['estado']) ? $conn->real_escape_string($_POST['estado']) : 'activo';
// Imagen no implementada aquí
$sql = "UPDATE producto SET nombre='$nombre', descripcion='$descripcion', estado='$estado' WHERE idProducto=$idProducto";
if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar producto: ' . $conn->error]);
}
exit;
