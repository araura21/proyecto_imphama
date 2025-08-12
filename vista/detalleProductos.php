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
<!-- Modal para editar detalle producto -->
<div id="modalEditarDetalle" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:1000; align-items:center; justify-content:center;">
    <div style="background:#fff; padding:32px; border-radius:8px; max-width:500px; width:90%; position:relative;">
        <h3 style="margin-bottom:18px;">Editar Detalle de Producto</h3>
        <form id="formEditarDetalleProducto">
            <input type="hidden" name="idDetalle" id="edit_idDetalle">
            <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
                <div>
                    <label style="font-weight:600;">Producto:</label>
                    <select name="idProducto" id="edit_idProducto" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                        <option value="">Seleccione un producto</option>
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?= $producto['idProducto']; ?>"><?= htmlspecialchars($producto['nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="font-weight:600;">Proveedor:</label>
                    <select name="idProveedor" id="edit_idProveedor" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                        <option value="">Seleccione un proveedor</option>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?= $proveedor['idProveedor']; ?>"><?= htmlspecialchars($proveedor['nombre_empresa']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="font-weight:600;">Marca:</label>
                    <input type="text" name="marca" id="edit_marca" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                </div>
                <div>
                    <label style="font-weight:600;">Modelo:</label>
                    <input type="text" name="modelo" id="edit_modelo" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                </div>
                <div>
                    <label style="font-weight:600;">Precio Unitario:</label>
                    <input type="number" step="0.0001" name="precio_unitario" id="edit_precio_unitario" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                </div>
                <div>
                    <label style="font-weight:600;">Moneda:</label>
                    <input type="text" name="moneda" id="edit_moneda" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                </div>
                <div>
                    <label style="font-weight:600;">Cantidad:</label>
                    <input type="number" name="cantidad" id="edit_cantidad" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                </div>
                <div>
                    <label style="font-weight:600;">País Origen:</label>
                    <input type="text" name="pais_origen" id="edit_pais_origen" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                </div>
                <div>
                    <label style="font-weight:600;">Material:</label>
                    <input type="text" name="material" id="edit_material" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
                </div>
                <div style="grid-column:1/3;">
                    <label style="font-weight:600;">Observaciones:</label>
                    <textarea name="observaciones" id="edit_observaciones" rows="2" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;"></textarea>
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" id="btnCerrarModalEditar" style="background:#888; color:#fff; border:none; padding:8px 18px; border-radius:6px; font-weight:600; cursor:pointer;">Cancelar</button>
                <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:8px 18px; border-radius:6px; font-weight:600; cursor:pointer;">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
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
                    <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los detalles se cargarán dinámicamente aquí por JS -->
                <!-- Ejemplo de fila con columna Acciones, reemplazar por render dinámico en JS -->
                <!--
                <tr>
                    <td>1</td>
                    <td>Producto ejemplo</td>
                    <td>Proveedor ejemplo</td>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>100.00</td>
                    <td>USD</td>
                    <td>10</td>
                    <td>País</td>
                    <td>Material</td>
                    <td>Observaciones</td>
                    <td>
                        <button class="btn-editar-detalle" data-id="1" style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; margin-right:4px;">Editar</button>
                        <button class="btn-eliminar-detalle" data-id="1" style="background:#c0392b; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
                    </td>
                </tr>
                -->
            </tbody>
        </table>
</div>
<script src="../validaciones/detalleProductos.js"></script>
</div>