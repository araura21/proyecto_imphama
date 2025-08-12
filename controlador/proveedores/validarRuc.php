<?php
// controlador/proveedores/validarRuc.php
header('Content-Type: application/json');
if (!isset($_GET['ruc'])) {
    echo json_encode(['exists' => false]);
    exit;
}
$ruc = $_GET['ruc'];
if (!preg_match('/^\d{13}$/', $ruc)) {
    echo json_encode(['exists' => false]);
    exit;
}
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();
$stmt = $conn->prepare('SELECT COUNT(*) as total FROM proveedor WHERE ruc = ?');
$stmt->bind_param('s', $ruc);
$stmt->execute();
$stmt->bind_result($total);
$stmt->fetch();
$stmt->close();
$conn->close();
echo json_encode(['exists' => $total > 0]);
