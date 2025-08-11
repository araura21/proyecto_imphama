<?php
require_once '../modelo/conexionBD.php';
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'listar') {
    $db = new connectionDB();
    $conn = $db->connection();
    $sql = 'SELECT u.idUsuario, e.cedula, r.nombre AS rol, u.estado FROM usuario u 
            JOIN empleado e ON u.idEmpleado = e.idEmpleado 
            JOIN rol r ON u.idRol = r.idRol 
            ORDER BY u.idUsuario ASC';
    $result = $conn->query($sql);
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    echo json_encode(['success' => true, 'usuarios' => $usuarios]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida']);
