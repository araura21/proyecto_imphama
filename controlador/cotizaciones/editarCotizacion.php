<?php
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();

$idCotizacion = $_POST['idCotizacion'] ?? '';
$idProducto   = $_POST['idProducto'] ?? '';
$idCliente    = $_POST['idCliente'] ?? '';
$idUsuario    = $_POST['idUsuario'] ?? '';
$notas        = $_POST['notas'] ?? '';
$estado       = $_POST['estado'] ?? 'pendiente';
$fecha_emision = $_POST['fecha_emision'] ?? date('Y-m-d');

$stmt = $conn->prepare("UPDATE cotizacion SET idProducto=?, idCliente=?, idUsuario=?, notas=?, estado=?, fecha_emision=? WHERE idCotizacion=?");
$stmt->bind_param("iiisssi", $idProducto, $idCliente, $idUsuario, $notas, $estado, $fecha_emision, $idCotizacion);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cotización actualizada correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar cotización: ' . $conn->error]);
}
$stmt->close();
$conn->close();
?>
