// usuarios.js - CRUD y paginación para usuarios

window.initUsuarios = function() {
  cargarEmpleadosYRoles();
  cargarUsuarios();
// Cargar empleados y roles en el formulario y asignar rol automáticamente
function cargarEmpleadosYRoles() {
  // Cargar empleados
  fetch('../controlador/empleadosController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        const select = document.getElementById('idEmpleado');
        select.innerHTML = '<option value="">Seleccione...</option>';
        data.empleados.forEach(emp => {
          // Suponiendo que el campo rol existe en el objeto emp
          select.innerHTML += `<option value="${emp.idEmpleado}" data-rol="${emp.rol ?? ''}">${emp.nombre} ${emp.apellido} (${emp.cedula})</option>`;
        });
      }
    });
  // Cargar roles
  fetch('../controlador/rolesController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        window._rolesUsuarios = data.roles;
      }
    });
  // Evento para actualizar el rol automáticamente
  document.getElementById('idEmpleado').addEventListener('change', function() {
    const idEmpleado = this.value;
    if (!idEmpleado) {
      document.getElementById('rolEmpleado').value = '';
      return;
    }
    // Buscar el rol asignado en la tabla usuarios
    fetch('../controlador/usuariosController.php?action=listar')
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          const usuario = data.usuarios.find(u => u.cedula && this.options[this.selectedIndex].text.includes(u.cedula));
          if (usuario && usuario.rol) {
            document.getElementById('rolEmpleado').value = usuario.rol;
          } else {
            document.getElementById('rolEmpleado').value = '';
          }
        }
      });
  });
}

  // Mensaje
  let msg = document.getElementById('msg-usuarios');
  if (!msg) {
    msg = document.createElement('div');
    msg.id = 'msg-usuarios';
    msg.style.margin = '10px 0';
    msg.style.textAlign = 'center';
    document.querySelector('h2').insertAdjacentElement('afterend', msg);
  }

  document.getElementById('formAgregarUsuario').addEventListener('submit', function(e) {
    e.preventDefault();
    const idEmpleado = document.getElementById('idEmpleado').value;
    const idRol = document.getElementById('idRol').value;
    const estado = document.getElementById('estado').value;
    fetch('../controlador/usuariosController.php?action=agregar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `idEmpleado=${encodeURIComponent(idEmpleado)}&idRol=${encodeURIComponent(idRol)}&estado=${encodeURIComponent(estado)}`
    })
    .then(r => r.json())
    .then(data => {
      msg.textContent = data.message;
      msg.style.color = data.success ? 'green' : 'red';
      if (data.success) {
        document.getElementById('formAgregarUsuario').reset();
        cargarUsuarios();
      }
    })
    .catch(() => {
      msg.textContent = 'Error de conexión con el servidor.';
      msg.style.color = 'red';
    });
  });
}

function cargarUsuarios() {
  fetch('../controlador/usuariosController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        // --- Paginación igual a roles/empleados ---
        let usuarios = data.usuarios;
        let pageSize = 3;
        let currentPage = 1;
        // Contenedor de paginación y selector
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
                let html = `<table id="tablaUsuarios" style="width:100%; table-layout:fixed; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <colgroup>
              <col style="min-width:90px; max-width:110px; width:100px;">
              <col style="min-width:120px; max-width:180px; width:150px;">
              <col style="min-width:120px; max-width:180px; width:150px;">
              <col style="min-width:120px; max-width:180px; width:150px;">
              <col style="min-width:180px; max-width:220px; width:200px;">
            </colgroup>
            <thead>
              <tr style="background:#f4f4f4;">
                <th style="padding:10px; border:1px solid #ddd;">ID Usuario</th>
                <th style="padding:10px; border:1px solid #ddd;">Empleado (Cédula)</th>
                <th style="padding:10px; border:1px solid #ddd;">Rol</th>
                <th style="padding:10px; border:1px solid #ddd;">Estado</th>
                <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
              </tr>
            </thead>
            <tbody>`;
          const start = (currentPage-1)*pageSize;
          const end = start + pageSize;
          usuarios.slice(start, end).forEach(usuario => {
            html += `<tr>
              <td style=\"padding:10px; border:1px solid #ddd;\">${usuario.idUsuario}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${usuario.cedula}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${usuario.rol}</td>
              <td style="padding:10px; border:1px solid #ddd; text-align:center;">${usuario.estado === 'activo' ? '<span style=\'background:#27ae60; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;\'>Activo</span>' : '<span style=\'background:#c0392b; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;\'>Inactivo</span>'}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">
                <button style=\"background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;\">Editar</button>
                <button style=\"background:${usuario.estado === 'activo' ? '#e74c3c' : '#27ae60'}; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;\">${usuario.estado === 'activo' ? 'Deshabilitar' : 'Habilitar'}</button>
              </td>
            </tr>`;
          });
          html += '</tbody></table>';
          document.getElementById('tabla-usuarios').innerHTML = '';
          document.getElementById('tabla-usuarios').appendChild(paginacionContainer);
          const tablaDiv = document.createElement('div');
          tablaDiv.innerHTML = html;
          document.getElementById('tabla-usuarios').appendChild(tablaDiv);
          // Actualizar info de página
          const totalPages = Math.ceil(usuarios.length / pageSize) || 1;
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
          const totalPages = Math.ceil(usuarios.length / pageSize) || 1;
          if (currentPage < totalPages) {
            currentPage++;
            renderTabla();
          }
        });
        renderTabla();
      }
    });
}
