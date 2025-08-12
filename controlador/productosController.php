<?php
require_once '../modelo/conexionBD.php';
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

if ($action === 'listar') {
    $db = new connectionDB();
    $conn = $db->connection();
    $result = $conn->query('SELECT idProducto, nombre, descripcion, estado FROM producto ORDER BY idProducto ASC');
    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
    echo json_encode(['success' => true, 'productos' => $productos]);
    exit;
}


echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
exit;
