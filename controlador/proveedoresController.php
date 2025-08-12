
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

if ($action === 'agregar') {
	$db = new connectionDB();
	$conn = $db->connection();
	$ruc = $conn->real_escape_string($_POST['ruc']);
	$nombre_empresa = $conn->real_escape_string($_POST['nombre_empresa']);
	$telefono = $conn->real_escape_string($_POST['telefono']);
	$correo = $conn->real_escape_string($_POST['correo']);
	$direccion = $conn->real_escape_string($_POST['direccion']);
	$estado = isset($_POST['estado']) ? $conn->real_escape_string($_POST['estado']) : 'activo';
	$sql = "INSERT INTO proveedor (ruc, nombre_empresa, telefono, correo, direccion, estado) VALUES ('$ruc', '$nombre_empresa', '$telefono', '$correo', '$direccion', '$estado')";
	if ($conn->query($sql)) {
		echo json_encode(['success' => true, 'message' => 'Proveedor agregado correctamente.']);
	} else {
		echo json_encode(['success' => false, 'message' => 'Error al agregar proveedor: ' . $conn->error]);
	}
	exit;
}

if ($action === 'eliminar') {
	$db = new connectionDB();
	$conn = $db->connection();
	$idProveedor = intval($_POST['idProveedor']);
	$sql = "DELETE FROM proveedor WHERE idProveedor = $idProveedor";
	if ($conn->query($sql)) {
		echo json_encode(['success' => true, 'message' => 'Proveedor eliminado correctamente.']);
	} else {
		echo json_encode(['success' => false, 'message' => 'Error al eliminar proveedor: ' . $conn->error]);
	}
	exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
exit;

