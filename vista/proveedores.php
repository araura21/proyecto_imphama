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
  <input id="ruc" type="text" name="ruc" required maxlength="13" minlength="13" pattern="\d{13}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.value=this.value.replace(/[^0-9]/g,'');this.setCustomValidity('')" onblur="if(this.value.length!==13||!/^\d{13}$/.test(this.value)){this.setCustomValidity('El RUC debe tener exactamente 13 dígitos');this.reportValidity();}else{validarRucUnico(this);}" oninvalid="this.setCustomValidity('El RUC debe tener exactamente 13 dígitos')" onkeypress="if(event.key<'0'||event.key>'9')event.preventDefault();">
      </div>
      <div>
        <label for="nombre_empresa" style="font-weight:600;">Nombre Empresa:</label>
  <input id="nombre_empresa" type="text" name="nombre_empresa" required maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]{1,50}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.value=this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g,'');this.setCustomValidity('')" onblur="if(this.value.length>50){this.setCustomValidity('El nombre de la empresa debe tener máximo 50 caracteres');this.reportValidity();}else{this.setCustomValidity('');}">
      </div>
      <div>
        <label for="telefono" style="font-weight:600;">Teléfono:</label>
  <input id="telefono" type="text" name="telefono" required maxlength="10" minlength="10" pattern="\d{10}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.value=this.value.replace(/[^0-9]/g,'');this.setCustomValidity('')" onblur="if(this.value.length!==10||!/^\d{10}$/.test(this.value)){this.setCustomValidity('El teléfono debe tener exactamente 10 dígitos');this.reportValidity();}else{this.setCustomValidity('');}" oninvalid="this.setCustomValidity('El teléfono debe tener exactamente 10 dígitos')" onkeypress="if(event.key<'0'||event.key>'9')event.preventDefault();">
      </div>
      <div>
        <label for="correo" style="font-weight:600;">Correo:</label>
  <input id="correo" type="email" name="correo" required pattern=".+@.+\.com" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.setCustomValidity('')" onblur="if(!/.+@.+\.com$/.test(this.value)){this.setCustomValidity('El correo debe contener @ y terminar en .com');this.reportValidity();}else{this.setCustomValidity('');}">
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
  <script>
    function validarRucUnico(input) {
      if(input.value.length!==13||!/^\d{13}$/.test(input.value)){
        input.setCustomValidity('El RUC debe tener exactamente 13 dígitos');
        input.reportValidity();
        return;
      }
      // Validar unicidad por AJAX
      fetch('../controlador/proveedores/validarRuc.php?ruc='+encodeURIComponent(input.value))
        .then(r=>r.json())
        .then(data=>{
          if(data.exists){
            input.setCustomValidity('El RUC ya está registrado en otro proveedor');
            input.reportValidity();
          }else{
            input.setCustomValidity('');
          }
        })
        .catch(()=>{
          input.setCustomValidity('Error validando RUC');
          input.reportValidity();
        });
    }
  </script>
  <h3 style="margin-bottom:12px;">Proveedores registrados</h3>
  <div id="tabla-proveedores"></div>
</div>

