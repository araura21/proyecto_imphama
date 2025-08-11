<?php
require_once '../modelo/conexionBD.php';

header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'listar') {
    $db = new connectionDB();
    $conn = $db->connection();
    $result = $conn->query('SELECT idEmpleado, nombre, apellido, cedula, telefono, correo FROM empleado ORDER BY idEmpleado ASC');
    $empleados = [];
    while ($row = $result->fetch_assoc()) {
        $empleados[] = $row;
    }
    echo json_encode(['success' => true, 'empleados' => $empleados]);
    exit;
}
