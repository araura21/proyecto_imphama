<?php
// proveedores.php
?>
<link rel="stylesheet" href="assets/css/proveedores.css">
<script src="../validaciones/proveedores.js"></script>
<div class="proveedores-container" onload="window.initProveedores && window.initProveedores()">
  <h2>Gestión de Proveedores</h2>
  <form id="formAgregarProveedor" class="proveedores-form">
    <div class="proveedores-form-grid">
      <div>
        <label for="ruc">RUC:</label>
        <input id="ruc" type="text" name="ruc" required>
      </div>
      <div>
        <label for="nombre_empresa">Nombre Empresa:</label>
        <input id="nombre_empresa" type="text" name="nombre_empresa" required>
      </div>
      <div>
        <label for="telefono">Teléfono:</label>
        <input id="telefono" type="text" name="telefono" required>
      </div>
      <div>
        <label for="correo">Correo:</label>
        <input id="correo" type="email" name="correo" required>
      </div>
      <div>
        <label for="direccion">Dirección:</label>
        <input id="direccion" type="text" name="direccion" required>
      </div>
    </div>
    <button type="submit" class="btn-proveedor">Agregar Proveedor</button>
  </form>
  <table id="tablaProveedores" class="proveedores-table">
    <thead>
      <tr>
        <th>ID Proveedor</th>
        <th>RUC</th>
        <th>Nombre Empresa</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Aquí se cargarán los proveedores dinámicamente -->
    </tbody>
  </table>
</div>

