<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

$db = new connectionDB();
$conn = $db->connection();
$idProducto = intval($_POST['idProducto']);
$sql = "DELETE FROM producto WHERE idProducto = $idProducto";
if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar producto: ' . $conn->error]);
}
exit;
