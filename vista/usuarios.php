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
  <table id="tablaUsuarios" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
        <th style="padding:10px; border:1px solid #ddd;">ID Usuario</th>
        <th style="padding:10px; border:1px solid #ddd;">Empleado (Cédula)</th>
        <th style="padding:10px; border:1px solid #ddd;">Rol</th>
        <th style="padding:10px; border:1px solid #ddd;">Estado</th>
        <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Ejemplo de usuarios, reemplazar por datos dinámicos -->
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">12345678</td>
        <td style="padding:10px; border:1px solid #ddd;">Administrador</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <span style="background:#27ae60; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;">Activo</span>
        </td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Deshabilitar</button>
        </td>
      </tr>
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;">87654321</td>
        <td style="padding:10px; border:1px solid #ddd;">Bodeguero</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <span style="background:#c0392b; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;">Inactivo</span>
        </td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Habilitar</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<script>
// Aquí iría la lógica JS para el CRUD, por ahora solo es maqueta visual
</script>
