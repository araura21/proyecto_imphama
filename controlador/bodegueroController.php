<?php
require_once '../modelo/conexionBD.php';

// Agregar proveedor
function agregarProveedor($data) {
    $db = new connectionDB();
    $conn = $db->connection();

    $ruc = trim($data['ruc']);
    $nombre_empresa = trim($data['nombre_empresa']);
    $telefono = trim($data['telefono']);
    $correo = trim($data['correo']);
    $direccion = trim($data['direccion']);

    $stmt = $conn->prepare("INSERT INTO proveedor (ruc, nombre_empresa, telefono, correo, direccion) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "<script>alert('Error en prepare: " . $conn->error . "');</script>";
        $conn->close();
        return;
    }
    $stmt->bind_param('sssss', $ruc, $nombre_empresa, $telefono, $correo, $direccion);
    if ($stmt->execute()) {
        echo "<script>alert('Proveedor agregado correctamente');</script>";
    } else {
        echo "<script>alert('Error al agregar proveedor: " . $stmt->error . "');</script>";
    }
    $stmt->close();
    $conn->close();
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
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )");

    if (!$stmt) {
        echo "<script>alert('Error en prepare: " . $conn->error . "');</script>";
        $conn->close();
        return;
    }

    $stmt->bind_param(
        'iididsdddsisissssssssssissssss',
        $idProducto, $idProveedor, $precio_unitario, $cantidad, $moneda, $descuento_volumen, $descuento_promocional, $impuestos_incluidos,
        $costo_envio, $costo_instalacion, $tiempo_entrega_dias, $lugar_entrega, $disponibilidad_inmediata, $capacidad_suministro_mensual,
        $metodo_transporte, $entregas_parciales, $marca, $modelo, $colores_disponibles, $tamano_dimensiones, $peso, $material, $pais_origen,
        $certificaciones, $garantia_mes, $durabilidad_estimada, $cumplimiento_normas, $condiciones_pago, $penalizaciones_retraso,
        $devolucion, $soporte_postventa, $servicio_tecnico_incluido, $capacitacion_incluida, $observaciones
    );

    if ($stmt->execute()) {
        echo "<script>alert('Detalle de producto agregado correctamente');</script>";
    } else {
        echo "<script>alert('Error al agregar detalle: " . $stmt->error . "');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>