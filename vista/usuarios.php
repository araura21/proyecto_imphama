<?php
// usuarios.php
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Usuarios</h2>
  <form id="formAgregarUsuario" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="idEmpleado" style="font-weight:600;">Empleado (Cédula):</label>
        <select id="idEmpleado" name="idEmpleado" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="">Seleccione...</option>
          <!-- Aquí se cargarían dinámicamente los empleados -->
          <option value="12345678">Juan Pérez (12345678)</option>
          <option value="87654321">Ana García (87654321)</option>
        </select>
      </div>
      <div>
        <label for="idRol" style="font-weight:600;">Rol:</label>
        <select id="idRol" name="idRol" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="">Seleccione...</option>
          <!-- Aquí se cargarían dinámicamente los roles -->
          <option value="1">Administrador</option>
          <option value="2">Bodeguero</option>
        </select>
      </div>
      <div>
        <label for="estado" style="font-weight:600;">Estado:</label>
        <select id="estado" name="estado" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="activo">Activo</option>
          <option value="inactivo">Inactivo</option>
        </select>
      </div>
    </div>
    <button type="submit" style="background:#8e44ad; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(142,68,173,0.08);">Agregar Usuario</button>
  </form>
  <div id="tabla-usuarios"></div>
</div>
<script>
// Inicializar la tabla dinámica de usuarios
window.addEventListener('DOMContentLoaded', function() {
  if (window.initUsuarios) window.initUsuarios();
});
// El archivo usuarios.js debe estar cargado desde admin.js o aquí
// <script src="../validaciones/usuarios.js"></script>
</script>
