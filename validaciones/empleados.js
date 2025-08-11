// empleados.js - CRUD y paginación para empleados

window.initEmpleados = function() {
  cargarEmpleados();

  // Mensaje
  let msg = document.getElementById('msg-empleados');
  if (!msg) {
    msg = document.createElement('div');
    msg.id = 'msg-empleados';
    msg.style.margin = '10px 0';
    msg.style.textAlign = 'center';
    document.querySelector('h2').insertAdjacentElement('afterend', msg);
  }

  document.getElementById('formAgregarEmpleado').addEventListener('submit', function(e) {
    e.preventDefault();
    const nombre = document.getElementById('nombre').value.trim();
    const apellido = document.getElementById('apellido').value.trim();
    const cedula = document.getElementById('cedula').value.trim();
    const telefono = document.getElementById('telefono').value.trim();
    const correo = document.getElementById('correo').value.trim();
    fetch('../controlador/empleadosController.php?action=agregar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `nombre=${encodeURIComponent(nombre)}&apellido=${encodeURIComponent(apellido)}&cedula=${encodeURIComponent(cedula)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}`
    })
    .then(r => r.json())
    .then(data => {
      msg.textContent = data.message;
      msg.style.color = data.success ? 'green' : 'red';
      if (data.success) {
        document.getElementById('formAgregarEmpleado').reset();
        cargarEmpleados();
      }
    })
    .catch(() => {
      msg.textContent = 'Error de conexión con el servidor.';
      msg.style.color = 'red';
    });
  });
}

function cargarEmpleados() {
  fetch('../controlador/empleadosController.php?action=listar')
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        // --- Paginación igual a roles ---
        let empleados = data.empleados;
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
          let html = `<table id="tablaEmpleados" style="width:100%; table-layout:fixed; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <colgroup>
              <col style="min-width:50px; max-width:110px; width:110px;"> <!-- ID -->
              <col style="min-width:50px; max-width:110px; width:110px;"> <!-- Nombre -->
              <col style="min-width:50px; max-width:110px; width:110px;"> <!-- Apellido -->
              <col style="min-width:50px; max-width:110px; width:110px;"> <!-- Cedula -->
              <col style="min-width:50px; max-width:110px; width:110px;"> <!-- Telefono -->
              <col style="min-width:320px; max-width:600px; width:250px;"> <!-- Correo -->
              <col style="min-width:100px; max-width:140px; width:120px;"> <!-- Acciones -->
            </colgroup>
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
            <tbody>`;
          const start = (currentPage-1)*pageSize;
          const end = start + pageSize;
          empleados.slice(start, end).forEach(emp => {
            html += `<tr>
              <td style=\"padding:10px; border:1px solid #ddd;\">${emp.idEmpleado}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${emp.nombre}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${emp.apellido}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${emp.cedula}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">${emp.telefono}</td>
              <td style=\"padding:10px; border:1px solid #ddd; max-width:380px;\">${emp.correo}</td>
              <td style=\"padding:10px; border:1px solid #ddd;\">
                <button style=\"background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;\">Editar</button>
                <button style=\"background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;\">Eliminar</button>
              </td>
            </tr>`;
          });
          html += '</tbody></table>';
          document.getElementById('tabla-empleados').innerHTML = '';
          document.getElementById('tabla-empleados').appendChild(paginacionContainer);
          const tablaDiv = document.createElement('div');
          tablaDiv.innerHTML = html;
          document.getElementById('tabla-empleados').appendChild(tablaDiv);
          // Actualizar info de página
          const totalPages = Math.ceil(empleados.length / pageSize) || 1;
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
          const totalPages = Math.ceil(empleados.length / pageSize) || 1;
          if (currentPage < totalPages) {
            currentPage++;
            renderTabla();
          }
        });
        renderTabla();
      }
    });
}
