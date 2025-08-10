<?php
// roles.php
// Ejemplo de interfaz CRUD para roles
?>
<link rel="stylesheet" href="assets/css/estilosRoles.css">
<script src="../validaciones/roles.js"></script>
<div class="roles-wrapper">
  <h2 class="roles-title">Gestión de Roles</h2>
  <form id="formAgregarRol">
    <div class="form-roles-flex">
      <div class="form-roles-label">
  <label for="nombreRol">Nombre del Rol:</label>
  <input id="nombreRol" type="text" name="nombre" placeholder="Escribe el nombre del rol" required>
      </div>
      <button type="submit" class="btn-agregar-rol">Agregar Rol</button>
    </div>
  <fieldset class="roles-fieldset">
      <legend class="roles-legend">Accesos al menú</legend>
      <table class="roles-table">
        <tr>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="roles">
              <i class="fas fa-user-shield" style="color:#2980b9;"></i>
              <span>Roles</span>
            </label>
          </td>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="empleados">
              <i class="fas fa-users" style="color:#16a085;"></i>
              <span>Empleados</span>
            </label>
          </td>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="usuarios">
              <i class="fas fa-user" style="color:#8e44ad;"></i>
              <span>Usuarios</span>
            </label>
          </td>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="productos">
              <i class="fas fa-box" style="color:#d35400;"></i>
              <span>Productos</span>
            </label>
          </td>
        </tr>
        <tr>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="detalleProductos">
              <i class="fas fa-info-circle" style="color:#27ae60;"></i>
              <span>Detalle Productos</span>
            </label>
          </td>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="cotizaciones">
              <i class="fas fa-file-invoice-dollar" style="color:#c0392b;"></i>
              <span>Cotizaciones</span>
            </label>
          </td>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="clientes">
              <i class="fas fa-address-book" style="color:#34495e;"></i>
              <span>Clientes</span>
            </label>
          </td>
          <td>
            <label class="roles-checkbox-label">
              <input type="checkbox" name="accesos[]" value="generarCotizacion">
              <i class="fas fa-file-signature" style="color:#7f8c8d;"></i>
              <span>Generar Cotización</span>
            </label>
          </td>
        </tr>
      </table>
    </fieldset>
  </form>
  <div id="tabla-roles"></div>
  <!-- La tabla de roles se cargará dinámicamente aquí -->
</div>

