<?php
// cliente.php
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Clientes</h2>
  <form id="formAgregarCliente" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="nombre" style="font-weight:600;">Nombre:</label>
        <input id="nombre" type="text" name="nombre" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="apellido" style="font-weight:600;">Apellido:</label>
        <input id="apellido" type="text" name="apellido" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="cedula" style="font-weight:600;">Cédula:</label>
        <input id="cedula" type="text" name="cedula" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
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
        <input id="direccion" type="text" name="direccion" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
    </div>
    <button type="submit" style="background:#34495e; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(52,73,94,0.08);">Agregar Cliente</button>
  </form>
  <table id="tablaClientes" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
        <th style="padding:10px; border:1px solid #ddd;">ID Cliente</th>
        <th style="padding:10px; border:1px solid #ddd;">Nombre</th>
        <th style="padding:10px; border:1px solid #ddd;">Apellido</th>
        <th style="padding:10px; border:1px solid #ddd;">Cédula</th>
  <th style="padding:10px; border:1px solid #ddd;">Teléfono</th>
  <th style="padding:10px; border:1px solid #ddd;">Correo</th>
  <th style="padding:10px; border:1px solid #ddd;">Dirección</th>
  <th style="padding:10px; border:1px solid #ddd;">Estado</th>
  <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Las filas serán generadas dinámicamente por validaciones/clientes.js -->
    </tbody>
  </table>
</div>
<script src="../validaciones/clientes.js"></script>
