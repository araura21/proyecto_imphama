<?php
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();

$idCotizacion = $_POST['idCotizacion'] ?? '';

$stmt = $conn->prepare("DELETE FROM cotizacion WHERE idCotizacion=?");
$stmt->bind_param("i", $idCotizacion);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cotización eliminada correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar cotización: ' . $conn->error]);
}
$stmt->close();
$conn->close();
?>
