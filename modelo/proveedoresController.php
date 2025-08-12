<?php
require_once 'conexionBD.php';
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'listar') {
    $db = new connectionDB();
    $conn = $db->connection();
    $sql = 'SELECT idProveedor, nombre, telefono, direccion, email FROM proveedor ORDER BY idProveedor ASC';
    $result = $conn->query($sql);
    $proveedores = [];
    while ($row = $result->fetch_assoc()) {
        $proveedores[] = $row;
    }
    echo json_encode(['success' => true, 'proveedores' => $proveedores]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida']);
