<?php
// proveedores.php
?>

<link rel="stylesheet" href="assets/css/estilosRoles.css">
<script src="../validaciones/proveedores.js"></script>
<div class="roles-wrapper">
  <h2 class="roles-title">Gestión de Proveedores</h2>
  <form id="formAgregarProveedor" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="ruc" style="font-weight:600;">RUC:</label>
        <input id="ruc" type="text" name="ruc" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="nombre_empresa" style="font-weight:600;">Nombre Empresa:</label>
        <input id="nombre_empresa" type="text" name="nombre_empresa" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="telefono" style="font-weight:600;">Teléfono:</label>
        <input id="telefono" type="text" name="telefono" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="correo" style="font-weight:600;">Correo:</label>
        <input id="correo" type="email" name="correo" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="direccion" style="font-weight:600;">Dirección:</label>
        <input id="direccion" type="text" name="direccion" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="estado" style="font-weight:600;">Estado:</label>
        <select id="estado" name="estado" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="activo">Activo</option>
          <option value="inactivo">Inactivo</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn-agregar-rol" style="background:#2980b9; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(41,128,185,0.08);">Agregar Proveedor</button>
  </form>
  <h3 style="margin-bottom:12px;">Proveedores registrados</h3>
  <div id="tabla-proveedores"></div>
</div>

