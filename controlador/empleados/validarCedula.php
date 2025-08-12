<?php
// controlador/empleados/validarCedula.php
header('Content-Type: application/json');
if (!isset($_GET['cedula'])) {
    echo json_encode(['exists' => false]);
    exit;
}
$cedula = $_GET['cedula'];
if (!preg_match('/^\d{10}$/', $cedula)) {
    echo json_encode(['exists' => false]);
    exit;
}
require_once '../../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();
$stmt = $conn->prepare('SELECT COUNT(*) as total FROM empleado WHERE cedula = ?');
$stmt->bind_param('s', $cedula);
$stmt->execute();
$stmt->bind_result($total);
$stmt->fetch();
$stmt->close();
$conn->close();
echo json_encode(['exists' => $total > 0]);
