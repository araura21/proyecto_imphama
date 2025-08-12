<?php
require_once '../controlador/bodegueroController.php';
$productos = obtenerProductos();
$proveedores = obtenerProveedores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Detalle de Producto</title>
    <link rel="stylesheet" href="../assets/css/productos.css">
</head>

<div style="padding:24px;">
    <h2 style="margin-bottom:18px;">Gestión de Detalle de Productos</h2>
    <form id="formAgregarDetalleProducto" method="POST" style="margin-bottom:32px;">
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
            <div>
                <label style="font-weight:600;">Producto:</label>
                <select name="idProducto" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                    <option value="">Seleccione un producto</option>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['idProducto']; ?>"><?= htmlspecialchars($producto['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="font-weight:600;">Proveedor:</label>
                <select name="idProveedor" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                    <option value="">Seleccione un proveedor</option>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?= $proveedor['idProveedor']; ?>"><?= htmlspecialchars($proveedor['nombre_empresa']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="font-weight:600;">Marca:</label>
                <input type="text" name="marca" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div>
                <label style="font-weight:600;">Modelo:</label>
                <input type="text" name="modelo" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div>
                <label style="font-weight:600;">Precio Unitario:</label>
                <input type="number" step="0.0001" name="precio_unitario" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div>
                <label style="font-weight:600;">Moneda:</label>
                <input type="text" name="moneda" value="USD" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div>
                <label style="font-weight:600;">Cantidad:</label>
                <input type="number" name="cantidad" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div>
                <label style="font-weight:600;">País Origen:</label>
                <input type="text" name="pais_origen" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div>
                <label style="font-weight:600;">Material:</label>
                <input type="text" name="material" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div style="grid-column:1/3;">
                <label style="font-weight:600;">Observaciones:</label>
                <textarea name="observaciones" rows="2" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;"></textarea>
            </div>
        </div>
        <button type="submit" name="agregar_producto_detalle" style="background:#d35400; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(211,84,0,0.08);">Agregar Detalle</button>
    </form>
        <table id="tablaDetalleProductos" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <thead>
                <tr style="background:#f4f4f4;">
                    <th style="padding:10px; border:1px solid #ddd;">ID</th>
                    <th style="padding:10px; border:1px solid #ddd;">Producto</th>
                    <th style="padding:10px; border:1px solid #ddd;">Proveedor</th>
                    <th style="padding:10px; border:1px solid #ddd;">Marca</th>
                    <th style="padding:10px; border:1px solid #ddd;">Modelo</th>
                    <th style="padding:10px; border:1px solid #ddd;">Precio Unitario</th>
                    <th style="padding:10px; border:1px solid #ddd;">Moneda</th>
                    <th style="padding:10px; border:1px solid #ddd;">Cantidad</th>
                    <th style="padding:10px; border:1px solid #ddd;">País Origen</th>
                    <th style="padding:10px; border:1px solid #ddd;">Material</th>
                    <th style="padding:10px; border:1px solid #ddd;">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los detalles se cargarán dinámicamente aquí por JS -->
            </tbody>
        </table>
</div>
<script src="../validaciones/detalleProductos.js"></script>
</div>