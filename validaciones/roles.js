
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
    const nombre = document.getElementById('nombreRol').value.trim();
    if (!nombre) {
      msg.textContent = 'Debes escribir un nombre de rol.';
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
        // --- Paginación ---
        let roles = data.roles;
        let pageSize = 3;
        let currentPage = 1;
        // Crear contenedor de paginación y selector
        const paginacionContainer = document.createElement('div');
        paginacionContainer.style.display = 'flex';
        paginacionContainer.style.justifyContent = 'space-between';
        paginacionContainer.style.alignItems = 'center';
        paginacionContainer.style.marginBottom = '12px';
        // Selector de cantidad
        const select = document.createElement('select');
        [3,5,7].forEach(n => {
          const opt = document.createElement('option');
          opt.value = n;
          opt.textContent = n + ' por página';
          select.appendChild(opt);
        });
        select.value = pageSize;
        select.style.marginRight = '16px';
        // Controles de página
        const controls = document.createElement('div');
        const btnPrev = document.createElement('button');
        btnPrev.textContent = 'Anterior';
        btnPrev.style.marginRight = '8px';
        const btnNext = document.createElement('button');
        btnNext.textContent = 'Siguiente';
        const pageInfo = document.createElement('span');
        pageInfo.style.margin = '0 10px';

        controls.appendChild(btnPrev);
        controls.appendChild(pageInfo);
        controls.appendChild(btnNext);

        paginacionContainer.appendChild(select);
        paginacionContainer.appendChild(controls);

        // Renderizar tabla paginada
        function renderTabla() {
          let html = `<table id="tablaRoles" style="width:100%; table-layout:fixed; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <colgroup>
              <col style="min-width:90px; max-width:110px; width:100px;">
              <col style="min-width:120px; max-width:180px; width:150px;">
              <col style="min-width:180px; max-width:320px; width:220px;">
              <col style="min-width:120px; max-width:160px; width:130px;">
            </colgroup>
            <thead>
              <tr style="background:#f4f4f4;">
                <th style="padding:10px; border:1px solid #ddd;">ID Rol</th>
                <th style="padding:10px; border:1px solid #ddd;">Nombre</th>
                <th style="padding:10px; border:1px solid #ddd;">Accesos</th>
                <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
              </tr>
            </thead>
            <tbody>`;
          const start = (currentPage-1)*pageSize;
          const end = start + pageSize;
          roles.slice(start, end).forEach(rol => {
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
          document.getElementById('tabla-roles').innerHTML = '';
          document.getElementById('tabla-roles').appendChild(paginacionContainer);
          const tablaDiv = document.createElement('div');
          tablaDiv.innerHTML = html;
          document.getElementById('tabla-roles').appendChild(tablaDiv);
          // Actualizar info de página
          const totalPages = Math.ceil(roles.length / pageSize) || 1;
          pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
          btnPrev.disabled = currentPage === 1;
          btnNext.disabled = currentPage === totalPages;
        }

        // Eventos
        select.addEventListener('change', function() {
          pageSize = parseInt(this.value);
          currentPage = 1;
          renderTabla();
        });
        btnPrev.addEventListener('click', function() {
          if (currentPage > 1) {
            currentPage--;
            renderTabla();
          }
        });
        btnNext.addEventListener('click', function() {
          const totalPages = Math.ceil(roles.length / pageSize) || 1;
          if (currentPage < totalPages) {
            currentPage++;
            renderTabla();
          }
        });

        renderTabla();
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
