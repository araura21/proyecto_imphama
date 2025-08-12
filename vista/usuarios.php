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
        </select>
      </div>
      <div>
        <label for="idRol" style="font-weight:600;">Rol:</label>
        <select id="idRol" name="idRol" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="">Seleccione...</option>
        </select>
      </div>
      <div>
        <label style="font-weight:600;">Nombre del Rol:</label>
        <input type="text" id="rolEmpleado" name="rolEmpleado" readonly style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc; background:#f4f4f4; color:#333;" placeholder="Seleccione un empleado" />
      </div>
      <div>
        <label for="usuario" style="font-weight:600;">Usuario (correo electrónico):</label>
        <input type="text" id="usuario" name="usuario" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" autocomplete="username" />
      </div>
      <div>
        <label for="password" style="font-weight:600;">Contraseña:</label>
  <input type="password" id="password" name="password" required minlength="10" maxlength="10" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};':\\|,.<>/?])[A-Za-z0-9!@#$%^&*()_+\-=[\]{};':\\|,.<>/?]{10}$" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" placeholder="Ingrese contraseña de 10 caracteres" autocomplete="new-password" oninput="if(this.value.length!==10){this.setCustomValidity('La contraseña debe tener exactamente 10 caracteres.');}else if(!/[0-9]/.test(this.value)){this.setCustomValidity('La contraseña debe contener al menos un número.');}else if(!/[!@#$%^&*()_+\-=[\]{};':\\|,.<>/?]/.test(this.value)){this.setCustomValidity('La contraseña debe contener al menos un caracter especial.');}else{this.setCustomValidity('');}" />
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
<div id="modalEditarUsuario" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.35); z-index:1000; align-items:center; justify-content:center;">
  <div style="background:#fff; padding:18px 18px 14px 18px; border-radius:8px; min-width:320px; max-width:95vw; box-shadow:0 2px 12px rgba(0,0,0,0.13); position:relative; width:350px;">
    <button id="cerrarModalEditarUsuario" style="position:absolute; top:8px; right:8px; background:none; border:none; font-size:1.3rem; color:#888; cursor:pointer;">&times;</button>
    <h3 style="margin-bottom:10px; font-size:1.1rem;">Editar Usuario</h3>
    <div id="infoEditarUsuario" style="font-size:0.97rem; color:#444; margin-bottom:10px; background:#f7f7f7; border-radius:5px; padding:7px 10px; display:none;"></div>
    <form id="formEditarUsuario">
      <input type="hidden" id="edit_idUsuario" name="idUsuario" />
      <div style="display:grid; grid-template-columns:1fr; gap:10px; margin-bottom:10px;">
        <div>
          <label for="edit_idEmpleado" style="font-weight:600; font-size:0.97rem;">Empleado (Cédula):</label>
          <select id="edit_idEmpleado" name="idEmpleado" required style="width:100%; padding:6px; border-radius:4px; border:1px solid #ccc; font-size:0.97rem;"></select>
        </div>
        <div>
          <label for="edit_idRol" style="font-weight:600; font-size:0.97rem;">Rol:</label>
          <select id="edit_idRol" name="idRol" required style="width:100%; padding:6px; border-radius:4px; border:1px solid #ccc; font-size:0.97rem;"></select>
        </div>
        <div>
          <label style="font-weight:600; font-size:0.97rem;">Nombre del Rol:</label>
          <input type="text" id="edit_rolEmpleado" name="rolEmpleado" readonly style="width:100%; padding:6px; border-radius:4px; border:1px solid #ccc; background:#f4f4f4; color:#333; font-size:0.97rem;" />
        </div>
        <div>
          <label for="edit_usuario" style="font-weight:600; font-size:0.97rem;">Usuario (correo electrónico):</label>
          <input type="text" id="edit_usuario" name="usuario" required readonly style="width:100%; padding:6px; border-radius:4px; border:1px solid #ccc; font-size:0.97rem; background:#f4f4f4; color:#333;" />
        </div>
        <div>
          <label for="edit_password" style="font-weight:600; font-size:0.97rem;">Contraseña (dejar vacío para no cambiar):</label>
          <input type="password" id="edit_password" name="password" minlength="10" maxlength="10" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};':\"\\|,.<>/?])[A-Za-z0-9!@#$%^&*()_+\-=[\]{};':\"\\|,.<>/?]{10}$" style="width:100%; padding:6px; border-radius:4px; border:1px solid #ccc; font-size:0.97rem;" placeholder="Nueva contraseña de 10 caracteres (opcional)" autocomplete="new-password" oninput="if(this.value.length>0&&this.value.length!==10){this.setCustomValidity('La contraseña debe tener exactamente 10 caracteres.');}else if(this.value.length>0&&!/[0-9]/.test(this.value)){this.setCustomValidity('La contraseña debe contener al menos un número.');}else if(this.value.length>0&&!/[!@#$%^&*()_+\-=[\]{};':\"\\|,.<>/?]/.test(this.value)){this.setCustomValidity('La contraseña debe contener al menos un caracter especial.');}else{this.setCustomValidity('');}" />
        </div>
        <div>
          <label for="edit_estado" style="font-weight:600; font-size:0.97rem;">Estado:</label>
          <select id="edit_estado" name="estado" required style="width:100%; padding:6px; border-radius:4px; border:1px solid #ccc; font-size:0.97rem;">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
          </select>
        </div>
      </div>
      <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:8px 18px; border-radius:5px; font-weight:600; font-size:0.97rem; cursor:pointer; box-shadow:0 2px 8px rgba(41,128,185,0.08);">Guardar Cambios</button>
    </form>
    <div id="msg-editar-usuario" style="margin-top:8px; text-align:center; font-size:0.97rem;"></div>
  </div>
</div>
