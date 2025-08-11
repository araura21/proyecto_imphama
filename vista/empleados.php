<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Empleados</h2>
  <form id="formAgregarEmpleado" method="post" style="margin-bottom:32px;">
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
  <h3 style="margin-bottom:12px;">Empleados registrados</h3>
  <div id="tabla-empleados"></div>
      <div>

