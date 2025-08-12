<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

$db = new connectionDB();
$conn = $db->connection();
$idProveedor = intval($_POST['idProveedor']);
$sql = "DELETE FROM proveedor WHERE idProveedor = $idProveedor";
if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Proveedor eliminado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar proveedor: ' . $conn->error]);
}
exit;
