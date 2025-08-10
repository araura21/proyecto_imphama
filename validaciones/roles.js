
// Permite inicializar roles desde admin.js
window.initRoles = function() {
  cargarRoles();

  // Crear contenedor de mensajes si no existe
  let msg = document.getElementById('msg-roles');
  if (!msg) {
    msg = document.createElement('div');
    msg.id = 'msg-roles';
    msg.style.margin = '10px 0';
    msg.style.textAlign = 'center';
    document.querySelector('.roles-title').insertAdjacentElement('afterend', msg);
  }

  document.getElementById('formAgregarRol').addEventListener('submit', function(e) {
    e.preventDefault();
    const inputNombre = document.getElementById('nombreRol').value.trim();
    const selectNombre = document.getElementById('selectNombreRol').value.trim();
    // Prioridad: input si no está vacío, si no, select
    const nombre = inputNombre !== '' ? inputNombre : selectNombre;
    if (!nombre) {
      msg.textContent = 'Debes seleccionar o escribir un nombre de rol.';
      msg.style.color = 'red';
      return;
    }
    const accesos = Array.from(document.querySelectorAll('input[name="accesos[]"]:checked')).map(cb => cb.value);
    fetch('../controlador/rolesController.php?action=agregar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'nombre=' + encodeURIComponent(nombre) + '&permisos=' + encodeURIComponent(JSON.stringify(accesos))
    })
    .then(r => r.json())
    .then(data => {
      msg.textContent = data.message;
      msg.style.color = data.success ? 'green' : 'red';
      if (data.success) {
        document.getElementById('formAgregarRol').reset();
        cargarRoles();
      }
    })
    .catch(() => {
      msg.textContent = 'Error de conexión con el servidor.';
      msg.style.color = 'red';
    });
  });
}

function cargarRoles() {
  fetch('../controlador/rolesController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        let html = `<table id="tablaRoles" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
          <thead>
            <tr style="background:#f4f4f4;">
              <th style="padding:10px; border:1px solid #ddd;">ID Rol</th>
              <th style="padding:10px; border:1px solid #ddd;">Nombre</th>
              <th style="padding:10px; border:1px solid #ddd;">Accesos</th>
              <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
            </tr>
          </thead>
          <tbody>`;
        data.roles.forEach(rol => {
          let accesos = '';
          try {
            const permisos = JSON.parse(rol.permisos);
            if (Array.isArray(permisos)) {
              accesos = '<ul style="list-style:none; margin:0; padding:0; display:flex; flex-wrap:wrap; gap:10px;">' +
                permisos.map(p => `<li style="display:flex; align-items:center; gap:6px; background:#eafaf1; border-radius:4px; padding:4px 10px; font-size:0.97rem;">${iconoAcceso(p)} ${accesoNombre(p)}</li>`).join('') +
                '</ul>';
            } else if (typeof permisos === 'object' && permisos !== null) {
              accesos = Object.keys(permisos).filter(k => permisos[k]).map(k => `<li style="display:flex; align-items:center; gap:6px; background:#eafaf1; border-radius:4px; padding:4px 10px; font-size:0.97rem;">${iconoAcceso(k)} ${accesoNombre(k)}</li>`).join('');
              accesos = '<ul style="list-style:none; margin:0; padding:0; display:flex; flex-wrap:wrap; gap:10px;">' + accesos + '</ul>';
            }
          } catch(e) {
            accesos = '<span style="color:#888;">Sin datos</span>';
          }
          html += `<tr>
            <td style="padding:10px; border:1px solid #ddd;">${rol.idRol}</td>
            <td style="padding:10px; border:1px solid #ddd;">${rol.nombre}</td>
            <td style="padding:10px; border:1px solid #ddd;">${accesos}</td>
            <td style="padding:10px; border:1px solid #ddd;">
              <button style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
              <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
            </td>
          </tr>`;
        });
        html += '</tbody></table>';
        document.getElementById('tabla-roles').innerHTML = html;
      }
    });
}

function iconoAcceso(nombre) {
  const iconos = {
    roles: '<i class="fas fa-user-shield" style="color:#2980b9;"></i>',
    empleados: '<i class="fas fa-users" style="color:#16a085;"></i>',
    usuarios: '<i class="fas fa-user" style="color:#8e44ad;"></i>',
    productos: '<i class="fas fa-box" style="color:#d35400;"></i>',
    detalleProductos: '<i class="fas fa-info-circle" style="color:#27ae60;"></i>',
    cotizaciones: '<i class="fas fa-file-invoice-dollar" style="color:#c0392b;"></i>',
    clientes: '<i class="fas fa-address-book" style="color:#34495e;"></i>',
    generarCotizacion: '<i class="fas fa-file-signature" style="color:#7f8c8d;"></i>'
  };
  return iconos[nombre] || '';
}
function accesoNombre(nombre) {
  const nombres = {
    roles: 'Roles',
    empleados: 'Empleados',
    usuarios: 'Usuarios',
    productos: 'Productos',
    detalleProductos: 'Detalle Productos',
    cotizaciones: 'Cotizaciones',
    clientes: 'Clientes',
    generarCotizacion: 'Generar Cotización'
  };
  return nombres[nombre] || nombre;
}
