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
    $precio_unitario = floatval($data['precio_unitario']);
    $cantidad = intval($data['cantidad']);
    $moneda = trim($data['moneda']);
    $descuento_volumen = isset($data['descuento_volumen']) ? floatval($data['descuento_volumen']) : 0.00;
    $descuento_promocional = isset($data['descuento_promocional']) ? floatval($data['descuento_promocional']) : 0.00;
    $impuestos_incluidos = isset($data['impuestos_incluidos']) ? 1 : 0;
    $costo_envio = isset($data['costo_envio']) ? floatval($data['costo_envio']) : 0.00;
    $costo_instalacion = isset($data['costo_instalacion']) ? floatval($data['costo_instalacion']) : 0.00;
    $tiempo_entrega_dias = isset($data['tiempo_entrega_dias']) ? intval($data['tiempo_entrega_dias']) : null;
    $lugar_entrega = isset($data['lugar_entrega']) ? trim($data['lugar_entrega']) : null;
    $disponibilidad_inmediata = isset($data['disponibilidad_inmediata']) ? 1 : 0;
    $capacidad_suministro_mensual = isset($data['capacidad_suministro_mensual']) ? intval($data['capacidad_suministro_mensual']) : null;
    $metodo_transporte = isset($data['metodo_transporte']) ? trim($data['metodo_transporte']) : null;
    $entregas_parciales = isset($data['entregas_parciales']) ? 1 : 0;
    $marca = isset($data['marca']) ? trim($data['marca']) : null;
    $modelo = isset($data['modelo']) ? trim($data['modelo']) : null;
    $colores_disponibles = isset($data['colores_disponibles']) ? trim($data['colores_disponibles']) : null;
    $tamano_dimensiones = isset($data['tamano_dimensiones']) ? trim($data['tamano_dimensiones']) : null;
    $peso = isset($data['peso']) ? trim($data['peso']) : null;
    $material = isset($data['material']) ? trim($data['material']) : null;
    $pais_origen = isset($data['pais_origen']) ? trim($data['pais_origen']) : null;
    $certificaciones = isset($data['certificaciones']) ? trim($data['certificaciones']) : null;
    $garantia_mes = isset($data['garantia_mes']) ? intval($data['garantia_mes']) : null;
    $durabilidad_estimada = isset($data['durabilidad_estimada']) ? trim($data['durabilidad_estimada']) : null;
    $cumplimiento_normas = isset($data['cumplimiento_normas']) ? trim($data['cumplimiento_normas']) : null;
    $condiciones_pago = isset($data['condiciones_pago']) ? trim($data['condiciones_pago']) : null;
    $penalizaciones_retraso = isset($data['penalizaciones_retraso']) ? trim($data['penalizaciones_retraso']) : null;
    $devolucion = isset($data['devolucion']) ? 1 : 0;
    $soporte_postventa = isset($data['soporte_postventa']) ? 1 : 0;
    $servicio_tecnico_incluido = isset($data['servicio_tecnico_incluido']) ? 1 : 0;
    $capacitacion_incluida = isset($data['capacitacion_incluida']) ? 1 : 0;
    $observaciones = isset($data['observaciones']) ? trim($data['observaciones']) : null;

    $stmt = $conn->prepare("INSERT INTO producto_detalle (
        idProducto, idProveedor, precio_unitario, cantidad, moneda, descuento_volumen, descuento_promocional, impuestos_incluidos,
        costo_envio, costo_instalacion, tiempo_entrega_dias, lugar_entrega, disponibilidad_inmediata, capacidad_suministro_mensual,
        metodo_transporte, entregas_parciales, marca, modelo, colores_disponibles, tamano_dimensiones, peso, material, pais_origen,
        certificaciones, garantia_mes, durabilidad_estimada, cumplimiento_normas, condiciones_pago, penalizaciones_retraso,
        devolucion, soporte_postventa, servicio_tecnico_incluido, capacitacion_incluida, observaciones
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        $error = $conn->error;
        error_log("Prepare failed: " . $error);
        $conn->close();
        return ['success' => false, 'message' => 'Error en prepare: ' . $error];
    }

    $stmt->bind_param(
        'iididsdddisissssssssssisssssiiiiis',
        $idProducto, $idProveedor, $precio_unitario, $cantidad, $moneda, $descuento_volumen, $descuento_promocional, $impuestos_incluidos,
        $costo_envio, $costo_instalacion, $tiempo_entrega_dias, $lugar_entrega, $disponibilidad_inmediata, $capacidad_suministro_mensual,
        $metodo_transporte, $entregas_parciales, $marca, $modelo, $colores_disponibles, $tamano_dimensiones, $peso, $material, $pais_origen,
        $certificaciones, $garantia_mes, $durabilidad_estimada, $cumplimiento_normas, $condiciones_pago, $penalizaciones_retraso,
        $devolucion, $soporte_postventa, $servicio_tecnico_incluido, $capacitacion_incluida, $observaciones
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
?>