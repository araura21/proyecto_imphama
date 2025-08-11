<?php
require_once '../controlador/bodegueroController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_producto_detalle'])) {
    agregarProductoDetalle($_POST);
}

$productos = obtenerProductos();
$proveedores = obtenerProveedores();
?>

<link rel="stylesheet" href="assets/css/productos.css">

<h2 class="section-title">Agregar Detalle de Producto</h2>
<form method="POST" class="form-container">
  <!-- Identificación del Producto -->
  <fieldset class="fieldset">
    <legend class="legend">Identificación del Producto</legend>
    <div class="grid-container">
      <div>
        <label class="label">Producto:</label>
        <select name="idProducto" required class="input-field">
          <?php foreach ($productos as $producto): ?>
            <option value="<?= $producto['idProducto']; ?>"><?= htmlspecialchars($producto['nombre']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="label">Proveedor:</label>
        <select name="idProveedor" required class="input-field">
          <?php foreach ($proveedores as $proveedor): ?>
            <option value="<?= $proveedor['idProveedor']; ?>"><?= htmlspecialchars($proveedor['nombre_empresa']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="label">Marca:</label>
        <input type="text" name="marca" class="input-field">
      </div>
      <div>
        <label class="label">Modelo:</label>
        <input type="text" name="modelo" class="input-field">
      </div>
      <div>
        <label class="label">País Origen:</label>
        <input type="text" name="pais_origen" class="input-field">
      </div>
      <div>
        <label class="label">Material:</label>
        <input type="text" name="material" class="input-field">
      </div>
      <div class="full-width">
        <label class="label">Certificaciones:</label>
        <input type="text" name="certificaciones" class="input-field">
      </div>
    </div>
  </fieldset>

  <!-- Datos Comerciales -->
  <fieldset class="fieldset">
    <legend class="legend">Datos Comerciales</legend>
    <div class="grid-container">
      <div>
        <label class="label">Precio Unitario:</label>
        <input type="number" step="0.0001" name="precio_unitario" required class="input-field">
      </div>
      <div>
        <label class="label">Moneda:</label>
        <input type="text" name="moneda" value="USD" required class="input-field">
      </div>
      <div>
        <label class="label">Cantidad:</label>
        <input type="number" name="cantidad" required class="input-field">
      </div>
      <div>
        <label class="label">Descuento Volumen:</label>
        <input type="number" step="0.01" name="descuento_volumen" value="0.00" class="input-field">
      </div>
      <div>
        <label class="label">Descuento Promocional:</label>
        <input type="number" step="0.01" name="descuento_promocional" value="0.00" class="input-field">
      </div>
      <div>
        <label class="label">Impuestos Incluidos:</label>
        <input type="checkbox" name="impuestos_incluidos" value="1" class="checkbox">
      </div>
      <div>
        <label class="label">Condiciones Pago:</label>
        <input type="text" name="condiciones_pago" class="input-field">
      </div>
      <div>
        <label class="label">Penalizaciones Retraso:</label>
        <input type="text" name="penalizaciones_retraso" class="input-field">
      </div>
    </div>
  </fieldset>

  <!-- Logística -->
  <fieldset class="fieldset">
    <legend class="legend">Datos Logísticos</legend>
    <div class="grid-container">
      <div>
        <label class="label">Tiempo Entrega (días):</label>
        <input type="number" name="tiempo_entrega_dias" class="input-field">
      </div>
      <div>
        <label class="label">Lugar Entrega:</label>
        <input type="text" name="lugar_entrega" class="input-field">
      </div>
      <div>
        <label class="label">Método Transporte:</label>
        <input type="text" name="metodo_transporte" class="input-field">
      </div>
      <div>
        <label class="label">Costo Envío:</label>
        <input type="number" step="0.01" name="costo_envio" value="0.00" class="input-field">
      </div>
      <div>
        <label class="label">Costo Instalación:</label>
        <input type="number" step="0.01" name="costo_instalacion" value="0.00" class="input-field">
      </div>
      <div>
        <label class="label">Capacidad Suministro Mensual:</label>
        <input type="number" name="capacidad_suministro_mensual" class="input-field">
      </div>
      <div>
        <label class="label">Disponibilidad Inmediata:</label>
        <input type="checkbox" name="disponibilidad_inmediata" value="1" class="checkbox">
      </div>
      <div>
        <label class="label">Entregas Parciales:</label>
        <input type="checkbox" name="entregas_parciales" value="1" checked class="checkbox">
      </div>
    </div>
  </fieldset>

  <!-- Características Físicas -->
  <fieldset class="fieldset">
    <legend class="legend">Características Físicas</legend>
    <div class="grid-container">
      <div>
        <label class="label">Colores Disponibles:</label>
        <input type="text" name="colores_disponibles" class="input-field">
      </div>
      <div>
        <label class="label">Tamaño/Dimensiones:</label>
        <input type="text" name="tamano_dimensiones" class="input-field">
      </div>
      <div>
        <label class="label">Peso:</label>
        <input type="text" name="peso" class="input-field">
      </div>
      <div>
        <label class="label">Durabilidad Estimada:</label>
        <input type="text" name="durabilidad_estimada" class="input-field">
      </div>
      <div>
        <label class="label">Cumplimiento Normas:</label>
        <input type="text" name="cumplimiento_normas" class="input-field">
      </div>
      <div>
        <label class="label">Garantía (meses):</label>
        <input type="number" name="garantia_mes" class="input-field">
      </div>
    </div>
  </fieldset>

  <!-- Servicios y Soporte -->
  <fieldset class="fieldset">
    <legend class="legend">Servicios y Soporte</legend>
    <div class="checkbox-grid">
      <div><label><input type="checkbox" name="devolucion" value="1"> Devolución</label></div>
      <div><label><input type="checkbox" name="soporte_postventa" value="1"> Soporte Postventa</label></div>
      <div><label><input type="checkbox" name="servicio_tecnico_incluido" value="1"> Servicio Técnico Incluido</label></div>
      <div><label><input type="checkbox" name="capacitacion_incluida" value="1"> Capacitación Incluida</label></div>
    </div>
  </fieldset>

  <!-- Observaciones -->
  <fieldset class="fieldset">
    <legend class="legend">Observaciones</legend>
    <textarea name="observaciones" class="textarea" rows="4"></textarea>
  </fieldset>

  <button type="submit" name="agregar_producto_detalle" class="submit-button">
    Agregar Detalle
  </button>
</form>