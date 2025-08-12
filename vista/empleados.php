<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Empleados</h2>
  <form id="formAgregarEmpleado" method="post" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="nombre" style="font-weight:600;">Nombre:</label>
  <input id="nombre" type="text" name="nombre" required maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]{1,50}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.value=this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g,'');this.setCustomValidity(this.value.length>50?'Máximo 50 caracteres':'')" oninvalid="this.setCustomValidity('El nombre solo debe contener letras y máximo 50 caracteres')">
      </div>
      <div>
        <label for="apellido" style="font-weight:600;">Apellido:</label>
  <input id="apellido" type="text" name="apellido" required maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]{1,50}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.value=this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g,'');this.setCustomValidity(this.value.length>50?'Máximo 50 caracteres':'')" oninvalid="this.setCustomValidity('El apellido solo debe contener letras y máximo 50 caracteres')">
      </div>
      <div>
        <label for="cedula" style="font-weight:600;">Cédula:</label>
  <input id="cedula" type="text" name="cedula" required maxlength="10" minlength="10" pattern="\d{10}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.value=this.value.replace(/[^0-9]/g,'');this.setCustomValidity('')" onblur="if(this.value.length!==10||!/^\d{10}$/.test(this.value)){this.setCustomValidity('La cédula debe tener exactamente 10 dígitos');this.reportValidity();}else{validarCedulaUnica(this);}"
    oninvalid="this.setCustomValidity('La cédula debe tener exactamente 10 dígitos')" onkeypress="if(event.key<'0'||event.key>'9')event.preventDefault();">
      </div>
      <div>
        <label for="telefono" style="font-weight:600;">Teléfono:</label>
  <input id="telefono" type="text" name="telefono" required maxlength="10" minlength="10" pattern="\d{10}" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="this.value=this.value.replace(/[^0-9]/g,'');this.setCustomValidity('')" onblur="if(this.value.length!==10||!/^\d{10}$/.test(this.value)){this.setCustomValidity('El teléfono debe tener exactamente 10 dígitos');this.reportValidity();}else{this.setCustomValidity('');}" oninvalid="this.setCustomValidity('El teléfono debe tener exactamente 10 dígitos')" onkeypress="if(event.key<'0'||event.key>'9')event.preventDefault();">
      </div>
      <div>
        <label for="correo" style="font-weight:600;">Correo:</label>
  <input id="correo" type="email" name="correo" required maxlength="50" pattern=".+@.+\.com" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" oninput="if(this.value.length>50){this.value=this.value.slice(0,50);}this.setCustomValidity('')" onblur="if(!/.+@.+\.com$/.test(this.value)){this.setCustomValidity('El correo debe contener @ y terminar en .com');this.reportValidity();}else{this.setCustomValidity('');}" oninvalid="this.setCustomValidity('El correo debe contener @ y terminar en .com y máximo 50 caracteres')">
      </div>
    </div>
    <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(41,128,185,0.08);">Agregar Empleado</button>
  </form>
  <script>
    function validarCedulaUnica(input) {
      if(input.value.length!==10||!/^\d{10}$/.test(input.value)){
        input.setCustomValidity('La cédula debe tener exactamente 10 dígitos');
        input.reportValidity();
        return;
      }
      // Validar unicidad por AJAX
      fetch('../controlador/empleados/validarCedula.php?cedula='+encodeURIComponent(input.value))
        .then(r=>r.json())
        .then(data=>{
          if(data.exists){
            input.setCustomValidity('La cédula ya está registrada en otro empleado');
            input.reportValidity();
          }else{
            input.setCustomValidity('');
          }
        })
        .catch(()=>{
          input.setCustomValidity('Error validando cédula');
          input.reportValidity();
        });
    }
  </script>
  <h3 style="margin-bottom:12px;">Empleados registrados</h3>
  <div id="tabla-empleados"></div>
      <div>

