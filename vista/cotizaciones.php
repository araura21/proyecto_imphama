<?php
// cotizacion.php
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Cotizaciones</h2>
  <form id="formAgregarCotizacion" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="idProveedor" style="font-weight:600;">ID Proveedor:</label>
        <input id="idProveedor" type="text" name="idProveedor" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="idCliente" style="font-weight:600;">ID Cliente:</label>
        <input id="idCliente" type="text" name="idCliente" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="idProducto" style="font-weight:600;">ID Producto:</label>
        <input id="idProducto" type="text" name="idProducto" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="estado" style="font-weight:600;">Estado:</label>
        <select id="estado" name="estado" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="pendiente">Pendiente</option>
          <option value="entregada">Entregada</option>
        </select>
      </div>
    </div>
    <button type="submit" style="background:#27ae60; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(39,174,96,0.08);">Agregar Cotización</button>
  </form>
  <table id="tablaCotizaciones" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
        <th style="padding:10px; border:1px solid #ddd;">ID Cotización</th>
        <th style="padding:10px; border:1px solid #ddd;">ID Proveedor</th>
        <th style="padding:10px; border:1px solid #ddd;">ID Cliente</th>
        <th style="padding:10px; border:1px solid #ddd;">ID Producto</th>
        <th style="padding:10px; border:1px solid #ddd;">Estado</th>
        <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Ejemplo de cotizaciones, reemplazar por datos dinámicos -->
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;"><span style="background:#f1c40f; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;">Pendiente</span></td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Entregar</button>
        </td>
      </tr>
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;"><span style="background:#27ae60; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;">Entregada</span></td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<script>
// Aquí iría la lógica JS para el CRUD, por ahora solo es maqueta visual
</script>
