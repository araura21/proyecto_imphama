<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

$db = new connectionDB();
$conn = $db->connection();
$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$estado = isset($_POST['estado']) ? $conn->real_escape_string($_POST['estado']) : 'activo';
// Imagen no implementada aquí, solo nombre y descripción
$sql = "INSERT INTO producto (nombre, descripcion, estado) VALUES ('$nombre', '$descripcion', '$estado')";
if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Producto agregado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al agregar producto: ' . $conn->error]);
}
exit;
