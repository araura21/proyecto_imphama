<?php
// productos.php
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Productos</h2>
  <form id="formAgregarProducto" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="nombre" style="font-weight:600;">Nombre:</label>
        <input id="nombre" type="text" name="nombre" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="imagen" style="font-weight:600;">Imagen:</label>
        <input id="imagen" type="file" name="imagen" accept="image/*" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div style="grid-column:1/3;">
        <label for="descripcion" style="font-weight:600;">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="3" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;"></textarea>
      </div>
      <div>
        <label for="estado" style="font-weight:600;">Estado:</label>
        <select id="estado" name="estado" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="activo">Activo</option>
          <option value="inactivo">Inactivo</option>
        </select>
      </div>
    </div>
    <button type="submit" style="background:#d35400; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(211,84,0,0.08);">Agregar Producto</button>
  </form>
  <table id="tablaProductos" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
        <th style="padding:10px; border:1px solid #ddd;">ID Producto</th>
        <th style="padding:10px; border:1px solid #ddd;">Nombre</th>
        <th style="padding:10px; border:1px solid #ddd;">Imagen</th>
        <th style="padding:10px; border:1px solid #ddd;">Descripción</th>
        <th style="padding:10px; border:1px solid #ddd;">Estado</th>
        <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Los productos se cargarán dinámicamente aquí -->
    </tbody>
  </table>
</div>
<script src="../validaciones/productos.js"></script>
<script>
  window.initProductos && window.initProductos();
</script>
