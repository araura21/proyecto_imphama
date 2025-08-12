
<?php
require_once '../modelo/conexionBD.php';
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

if ($action === 'listar') {
	$db = new connectionDB();
	$conn = $db->connection();
	$result = $conn->query('SELECT idProveedor, ruc, nombre_empresa, telefono, correo, direccion, estado FROM proveedor ORDER BY idProveedor ASC');
	$proveedores = [];
	while ($row = $result->fetch_assoc()) {
		$proveedores[] = $row;
	}
	echo json_encode(['success' => true, 'proveedores' => $proveedores]);
	exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
exit;

