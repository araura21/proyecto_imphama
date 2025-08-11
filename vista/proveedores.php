<?php
// proveedores.php
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Proveedores</h2>
  <form id="formAgregarProveedor" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="ruc" style="font-weight:600;">RUC:</label>
        <input id="ruc" type="text" name="ruc" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="nombreEmpresa" style="font-weight:600;">Nombre Empresa:</label>
        <input id="nombreEmpresa" type="text" name="nombreEmpresa" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="telefono" style="font-weight:600;">Teléfono:</label>
        <input id="telefono" type="text" name="telefono" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
    </div>
    <button type="submit" style="background:#c0392b; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(192,57,43,0.08);">Agregar Proveedor</button>
  </form>
  <table id="tablaProveedores" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
        <th style="padding:10px; border:1px solid #ddd;">ID Proveedor</th>
        <th style="padding:10px; border:1px solid #ddd;">RUC</th>
        <th style="padding:10px; border:1px solid #ddd;">Nombre Empresa</th>
        <th style="padding:10px; border:1px solid #ddd;">Teléfono</th>
        <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Ejemplo de proveedores, reemplazar por datos dinámicos -->
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">1790012345001</td>
        <td style="padding:10px; border:1px solid #ddd;">Seguridad Total S.A.</td>
        <td style="padding:10px; border:1px solid #ddd;">022345678</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
        </td>
      </tr>
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;">1790098765002</td>
        <td style="padding:10px; border:1px solid #ddd;">Protección Integral Cía. Ltda.</td>
        <td style="padding:10px; border:1px solid #ddd;">023456789</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

