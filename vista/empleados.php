<?php
// empleados.php
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Empleados</h2>
  <form id="formAgregarEmpleado" style="margin-bottom:32px;">
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
    </div>
    <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(41,128,185,0.08);">Agregar Empleado</button>
  </form>
  <table id="tablaEmpleados" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
        <th style="padding:10px; border:1px solid #ddd;">ID Empleado</th>
        <th style="padding:10px; border:1px solid #ddd;">Nombre</th>
        <th style="padding:10px; border:1px solid #ddd;">Apellido</th>
        <th style="padding:10px; border:1px solid #ddd;">Cédula</th>
        <th style="padding:10px; border:1px solid #ddd;">Teléfono</th>
        <th style="padding:10px; border:1px solid #ddd;">Correo</th>
        <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Ejemplo de empleados, reemplazar por datos dinámicos -->
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">Juan</td>
        <td style="padding:10px; border:1px solid #ddd;">Pérez</td>
        <td style="padding:10px; border:1px solid #ddd;">12345678</td>
        <td style="padding:10px; border:1px solid #ddd;">0991234567</td>
        <td style="padding:10px; border:1px solid #ddd;">juan.perez@email.com</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
        </td>
      </tr>
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;">Ana</td>
        <td style="padding:10px; border:1px solid #ddd;">García</td>
        <td style="padding:10px; border:1px solid #ddd;">87654321</td>
        <td style="padding:10px; border:1px solid #ddd;">0987654321</td>
        <td style="padding:10px; border:1px solid #ddd;">ana.garcia@email.com</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<script>
// Aquí iría la lógica JS para el CRUD, por ahora solo es maqueta visual
</script>
