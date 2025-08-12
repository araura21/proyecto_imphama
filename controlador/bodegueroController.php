<?php
require_once '../modelo/conexionBD.php';

// Agregar proveedor
function agregarProveedor($data) {
    $db = new connectionDB();
    $conn = $db->connection();

    if (!$conn) {
        return ['success' => false, 'message' => 'Error de conexión a la base de datos'];
    }

    $ruc = trim($data['ruc']);
    $nombre_empresa = trim($data['nombre_empresa']);
    $telefono = trim($data['telefono']);
    $correo = trim($data['correo']);
    $direccion = trim($data['direccion']);

    if (empty($ruc) || empty($nombre_empresa)) {
        $conn->close();
        return ['success' => false, 'message' => 'RUC y nombre de empresa son obligatorios'];
    }

    $stmt = $conn->prepare("INSERT INTO proveedor (ruc, nombre_empresa, telefono, correo, direccion) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        $error = $conn->error;
        $conn->close();
        return ['success' => false, 'message' => 'Error en prepare: ' . $error];
    }

    $stmt->bind_param('sssss', $ruc, $nombre_empresa, $telefono, $correo, $direccion);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return ['success' => true, 'message' => 'Proveedor agregado correctamente'];
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => 'Error al agregar proveedor: ' . $error];
    }

}

// Manejo de acciones AJAX para detalle productos
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    if ($_GET['action'] === 'listar_detalles') {
        $detalles = obtenerDetallesProducto();
        echo json_encode(['success' => true, 'detalles' => $detalles]);
        exit;
    }
    if ($_GET['action'] === 'agregar_detalle' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = agregarProductoDetalle($_POST);
        echo json_encode($result);
        exit;
    }
}
// Obtener proveedores para el select
function obtenerProveedores() {
    $db = new connectionDB();
    $conn = $db->connection();
    $proveedores = [];
    $result = $conn->query("SELECT idProveedor, nombre_empresa FROM proveedor");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $proveedores[] = $row;
        }
    }
    $conn->close();
    return $proveedores;
}

// Obtener productos para el select
function obtenerProductos() {
    $db = new connectionDB();
    $conn = $db->connection();
    $productos = [];
    $result = $conn->query("SELECT idProducto, nombre FROM producto");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    }
    $conn->close();
    return $productos;
}

// Agregar detalle de producto
function agregarProductoDetalle($data) {
    $db = new connectionDB();
    $conn = $db->connection();

    if (!$conn) {
        return ['success' => false, 'message' => 'Error de conexión a la base de datos'];
    }

    // Validar campos obligatorios
    if (empty($data['idProducto']) || empty($data['idProveedor']) || empty($data['precio_unitario']) || empty($data['cantidad']) || empty($data['moneda'])) {
        $conn->close();
        return ['success' => false, 'message' => 'Los campos obligatorios (Producto, Proveedor, Precio Unitario, Cantidad, Moneda) son requeridos'];
    }

    // Validar existencia de idProducto
    $stmtCheck = $conn->prepare("SELECT idProducto FROM producto WHERE idProducto = ?");
    $stmtCheck->bind_param('i', $data['idProducto']);
    $stmtCheck->execute();
    $stmtCheck->store_result();
    if ($stmtCheck->num_rows == 0) {
        $stmtCheck->close();
        $conn->close();
        return ['success' => false, 'message' => 'El producto seleccionado no existe'];
    }
    $stmtCheck->close();

    // Validar existencia de idProveedor
    $stmtCheck = $conn->prepare("SELECT idProveedor FROM proveedor WHERE idProveedor = ?");
    $stmtCheck->bind_param('i', $data['idProveedor']);
    $stmtCheck->execute();
    $stmtCheck->store_result();
    if ($stmtCheck->num_rows == 0) {
        $stmtCheck->close();
        $conn->close();
        return ['success' => false, 'message' => 'El proveedor seleccionado no existe'];
    }
    $stmtCheck->close();

    // Procesar datos
    $idProducto = intval($data['idProducto']);
    $idProveedor = intval($data['idProveedor']);
    $marca = isset($data['marca']) ? trim($data['marca']) : null;
    $modelo = isset($data['modelo']) ? trim($data['modelo']) : null;
    $precio_unitario = floatval($data['precio_unitario']);
    $moneda = trim($data['moneda']);
    $cantidad = intval($data['cantidad']);
    $pais_origen = isset($data['pais_origen']) ? trim($data['pais_origen']) : null;
    $material = isset($data['material']) ? trim($data['material']) : null;
    $observaciones = isset($data['observaciones']) ? trim($data['observaciones']) : null;

    $stmt = $conn->prepare("INSERT INTO producto_detalle (
        idProducto, idProveedor, marca, modelo, precio_unitario, moneda, cantidad, pais_origen, material, observaciones
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        $error = $conn->error;
        error_log("Prepare failed: " . $error);
        $conn->close();
        return ['success' => false, 'message' => 'Error en prepare: ' . $error];
    }

    $stmt->bind_param(
        'iisssdisss',
        $idProducto, $idProveedor, $marca, $modelo, $precio_unitario, $moneda, $cantidad, $pais_origen, $material, $observaciones
    );

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return ['success' => true, 'message' => 'Detalle de producto agregado correctamente'];
    } else {
        $error = $stmt->error;
        error_log("Execute failed: " . $error);
        $stmt->close();
        $conn->close();
        return ['success' => false, 'message' => 'Error al agregar detalle: ' . $error];
    }
}

// Obtener todos los detalles de producto
function obtenerDetallesProducto() {
    $db = new connectionDB();
    $conn = $db->connection();
    $detalles = [];
    $sql = "SELECT pd.idDetalle, p.nombre AS producto, pr.nombre_empresa AS proveedor, pd.marca, pd.modelo, pd.precio_unitario, pd.moneda, pd.cantidad, pd.pais_origen, pd.material, pd.observaciones
            FROM producto_detalle pd
            JOIN producto p ON pd.idProducto = p.idProducto
            JOIN proveedor pr ON pd.idProveedor = pr.idProveedor
            ORDER BY pd.idDetalle DESC";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $detalles[] = $row;
        }
    }
    $conn->close();
    return $detalles;
}

if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    if ($_GET['action'] === 'listar_detalles') {
        $detalles = obtenerDetallesProducto();
        echo json_encode(['success' => true, 'detalles' => $detalles]);
        exit;
    }
    if ($_GET['action'] === 'agregar_detalle' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = agregarProductoDetalle($_POST);
        echo json_encode($result);
        exit;
    }
}
?>