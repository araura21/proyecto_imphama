<?php
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();


$idProducto = $_POST['idProducto'] ?? '';
$idCliente  = $_POST['idCliente'] ?? '';
$idUsuario  = $_POST['idUsuario'] ?? '';
$fecha_emision = $_POST['fecha_emision'] ?? date('Y-m-d');
$notas      = $_POST['notas'] ?? '';
$estado     = $_POST['estado'] ?? 'borrador';

$stmt = $conn->prepare("INSERT INTO cotizacion (idProducto, idCliente, idUsuario, fecha_emision, notas, estado) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiisss", $idProducto, $idCliente, $idUsuario, $fecha_emision, $notas, $estado);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cotización agregada correctamente']);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al agregar cotización',
        'mysql_error' => $stmt->error,
        'sqlstate' => $stmt->sqlstate,
        'input' => [
            'idProducto' => $idProducto,
            'idCliente' => $idCliente,
            'idUsuario' => $idUsuario,
            'fecha_emision' => $fecha_emision,
            'notas' => $notas,
            'estado' => $estado
        ]
    ]);
}
$stmt->close();
$conn->close();
?>