<?php
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();

$idCliente = $_POST['idCliente'] ?? '';

$stmt = $conn->prepare("DELETE FROM cliente WHERE idCliente=?");
$stmt->bind_param("i", $idCliente);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cliente eliminado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar cliente: ' . $conn->error]);
}
$stmt->close();
$conn->close();
?>