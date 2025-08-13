<?php // controlador/compararProveedoresController.php
require_once '../modelo/conexionBD.php';
header('Content-Type: application/json');

$idProducto = isset($_GET['idProducto']) ? intval($_GET['idProducto']) : 0;
$proveedores = isset($_GET['proveedores']) ? $_GET['proveedores'] : '';

if (!$idProducto || !$proveedores) {
    echo json_encode(['success' => false, 'message' => 'Faltan parámetros.']);
    exit;
}

$proveedoresArr = explode(',', $proveedores);
if (count($proveedoresArr) === 0) {
    echo json_encode(['success' => false, 'message' => 'No hay proveedores seleccionados.']);
    exit;
}


try {
    $db = new connectionDB();
    $conn = $db->connection();

    // Solo permitir hasta 3 proveedores
    $proveedoresArr = array_slice($proveedoresArr, 0, 3);
    $in = implode(',', array_fill(0, count($proveedoresArr), '?'));
    $params = array_merge([$idProducto], $proveedoresArr);
    $types = str_repeat('i', count($params));

    $sql = "SELECT pd.*, p.nombre_empresa AS proveedor_nombre FROM producto_detalle pd 
            LEFT JOIN proveedor p ON pd.idProveedor = p.idProveedor
            WHERE pd.idProducto = ? AND pd.idProveedor IN ($in)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error en prepare: ' . $conn->error);
    }
    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        throw new Exception('Error en execute: ' . $stmt->error);
    }
    $result = $stmt->get_result();
    $detalles = [];
    while ($row = $result->fetch_assoc()) {
        $detalles[$row['idProveedor']] = $row;
    }
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => true, 'detalles' => $detalles]);
    exit;
} catch (Exception $e) {
    if (isset($conn) && $conn) $conn->close();
    error_log('compararProveedoresController ERROR: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error interno: ' . $e->getMessage()]);
    exit;
}
