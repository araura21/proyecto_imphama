
<?php
// controlador/clientesController.php
require_once '../modelo/conexionBD.php';
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : '';
if ($action === 'listar') {
    $db = new connectionDB();
    $conn = $db->connection();
    $result = $conn->query('SELECT * FROM cliente ORDER BY idCliente ASC');
    $clientes = [];
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
    echo json_encode(['success' => true, 'clientes' => $clientes]);
    exit;
}
echo json_encode(['success'=>false, 'message'=>'Acción no válida']);
