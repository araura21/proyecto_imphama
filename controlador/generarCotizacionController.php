<?php
// controlador/generarCotizacionController.php
include '../modelo/conexionBD.php';
header('Content-Type: application/json');

if (isset($_GET['idCotizacion'])) {
    $idCotizacion = intval($_GET['idCotizacion']);
    $db = new connectionDB();
    $conn = $db->connection();
    $sql = "SELECT c.*, p.nombre AS producto_nombre, p.descripcion AS producto_descripcion, cl.nombre AS cliente_nombre, cl.apellido AS cliente_apellido, cl.cedula, cl.telefono, cl.correo FROM cotizacion c LEFT JOIN producto p ON c.idProducto = p.idProducto LEFT JOIN cliente cl ON c.idCliente = cl.idCliente WHERE c.idCotizacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idCotizacion);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Cotización no encontrada']);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Falta idCotizacion']);
}
?>
