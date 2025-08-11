
<?php
// controlador/rolesController.php
require_once '../modelo/conexionBD.php';

header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'listar') {
    $db = new connectionDB();
    $conn = $db->connection();
    $result = $conn->query('SELECT idRol, nombre, permisos, creado_at FROM rol ORDER BY idRol ASC');
    $roles = [];
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row;
    }
    echo json_encode(['success' => true, 'roles' => $roles]);
    exit;
}
