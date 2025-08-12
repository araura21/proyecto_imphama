// empleados.js - CRUD y paginación para empleados

window.initEmpleados = function() {
  cargarEmpleados();

  // Modal de edición: solo se crea una vez y se reutiliza
  let modal = document.getElementById('modal-editar-empleado');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'modal-editar-empleado';
    modal.style.display = 'none';
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100vw';
    modal.style.height = '100vh';
    modal.style.background = 'rgba(0,0,0,0.3)';
    modal.style.zIndex = '9999';
    modal.innerHTML = `
      <div style="background:#fff; max-width:400px; margin:60px auto; padding:24px 18px 18px 18px; border-radius:8px; box-shadow:0 4px 24px rgba(0,0,0,0.13); position:relative;">
        <h3 style="margin-bottom:18px;">Editar Empleado</h3>
        <form id="formEditarEmpleado">
          <input type="hidden" id="editIdEmpleado">
          <div style="margin-bottom:12px;">
            <label for="editNombreEmpleado" style="font-weight:600;">Nombre:</label>
            <input id="editNombreEmpleado" name="editNombreEmpleado" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editApellidoEmpleado" style="font-weight:600;">Apellido:</label>
            <input id="editApellidoEmpleado" name="editApellidoEmpleado" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editCedulaEmpleado" style="font-weight:600;">Cédula:</label>
            <input id="editCedulaEmpleado" name="editCedulaEmpleado" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editTelefonoEmpleado" style="font-weight:600;">Teléfono:</label>
            <input id="editTelefonoEmpleado" name="editTelefonoEmpleado" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editCorreoEmpleado" style="font-weight:600;">Correo:</label>
            <input id="editCorreoEmpleado" name="editCorreoEmpleado" type="email" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button type="button" id="btnCancelarEditarEmpleado" style="background:#eee; color:#333; border:none; padding:7px 16px; border-radius:4px;">Cancelar</button>
            <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:7px 16px; border-radius:4px;">Guardar</button>
          </div>
        </form>
      </div>
    `;
    document.body.appendChild(modal);
    // Cerrar modal
    document.getElementById('btnCancelarEditarEmpleado').onclick = function() {
      modal.style.display = 'none';
    };
    // Enviar edición
    document.getElementById('formEditarEmpleado').onsubmit = function(e) {
      e.preventDefault();
      const id = document.getElementById('editIdEmpleado').value;
      const nombre = document.getElementById('editNombreEmpleado').value.trim();
      const apellido = document.getElementById('editApellidoEmpleado').value.trim();
      const cedula = document.getElementById('editCedulaEmpleado').value.trim();
      const telefono = document.getElementById('editTelefonoEmpleado').value.trim();
      const correo = document.getElementById('editCorreoEmpleado').value.trim();
      fetch('../controlador/empleados/editarEmpleado.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `idEmpleado=${encodeURIComponent(id)}&nombre=${encodeURIComponent(nombre)}&apellido=${encodeURIComponent(apellido)}&cedula=${encodeURIComponent(cedula)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}`
      })
      .then(r => r.json())
      .then(data => {
        alert(data.success ? 'Empleado actualizado correctamente.' : 'Error al actualizar: ' + (data.error || ''));
        if (data.success) {
          modal.style.display = 'none';
          cargarEmpleados();
        }
      })
      .catch(() => alert('Error de conexión con el servidor.'));
    };
  }

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
    const ruc = document.getElementById('ruc') ? document.getElementById('ruc').value.trim() : '';
    // Validaciones
    if (nombre.length === 0 || nombre.length > 50) {
      msg.textContent = 'El nombre debe tener máximo 50 caracteres.';
      msg.style.color = 'red';
      return;
    }
    if (apellido.length === 0 || apellido.length > 50) {
      msg.textContent = 'El apellido debe tener máximo 50 caracteres.';
      msg.style.color = 'red';
      return;
    }
    if (cedula.length !== 10 || !/^\d{10}$/.test(cedula)) {
      msg.textContent = 'La cédula debe tener exactamente 10 dígitos.';
      msg.style.color = 'red';
      return;
    }
    if (ruc && (ruc.length !== 13 || !/^\d{13}$/.test(ruc))) {
      msg.textContent = 'El RUC debe tener exactamente 13 dígitos.';
      msg.style.color = 'red';
      return;
    }
    if (!/^.+@.+\.com$/.test(correo)) {
      msg.textContent = 'El correo debe contener @ y terminar en .com';
      msg.style.color = 'red';
      return;
    }
    // Si pasa validaciones, enviar
    fetch('../controlador/empleados/agregarEmpleado.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `nombre=${encodeURIComponent(nombre)}&apellido=${encodeURIComponent(apellido)}&cedula=${encodeURIComponent(cedula)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}&ruc=${encodeURIComponent(ruc)}`
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
                <button class=\"btn-editar-empleado\" data-id=\"${emp.idEmpleado}\" style=\"background:#27ae60; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;\">Editar</button>
                <button class=\"btn-eliminar-empleado\" data-id=\"${emp.idEmpleado}\" style=\"background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;\">Eliminar</button>
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
          // Asignar eventos SIEMPRE después de renderizar la tabla
          setTimeout(() => {
            tablaDiv.querySelectorAll('.btn-editar-empleado').forEach(btn => {
              btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const empleado = empleados.find(e => e.idEmpleado == id);
                if (!empleado) return;
                // Precargar datos en el modal
                document.getElementById('editIdEmpleado').value = empleado.idEmpleado;
                document.getElementById('editNombreEmpleado').value = empleado.nombre;
                document.getElementById('editApellidoEmpleado').value = empleado.apellido;
                document.getElementById('editCedulaEmpleado').value = empleado.cedula;
                document.getElementById('editTelefonoEmpleado').value = empleado.telefono;
                document.getElementById('editCorreoEmpleado').value = empleado.correo;
                document.getElementById('modal-editar-empleado').style.display = 'block';
              });
            });
            tablaDiv.querySelectorAll('.btn-eliminar-empleado').forEach(btn => {
              btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if (!confirm('¿Seguro que deseas eliminar este empleado?')) return;
                fetch('../controlador/empleados/eliminarEmpleado.php', {
                  method: 'POST',
                  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                  body: `idEmpleado=${encodeURIComponent(id)}`
                })
                .then(r => r.json())
                .then(data => {
                  alert(data.success ? 'Empleado eliminado correctamente.' : 'Error al eliminar: ' + (data.error || ''));
                  if (data.success) cargarEmpleados();
                })
                .catch(() => alert('Error de conexión con el servidor.'));
              });
            });
          }, 50);
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
        // Delegar eventos para editar y eliminar
        setTimeout(() => {
          document.querySelectorAll('.btn-editar-empleado').forEach(btn => {
            btn.addEventListener('click', function() {
              const id = this.getAttribute('data-id');
              const empleado = empleados.find(e => e.idEmpleado == id);
              if (!empleado) return;
              // Precargar datos en el modal
              document.getElementById('editIdEmpleado').value = empleado.idEmpleado;
              document.getElementById('editNombreEmpleado').value = empleado.nombre;
              document.getElementById('editApellidoEmpleado').value = empleado.apellido;
              document.getElementById('editCedulaEmpleado').value = empleado.cedula;
              document.getElementById('editTelefonoEmpleado').value = empleado.telefono;
              document.getElementById('editCorreoEmpleado').value = empleado.correo;
              document.getElementById('modal-editar-empleado').style.display = 'block';
            });
          });
          document.querySelectorAll('.btn-eliminar-empleado').forEach(btn => {
            btn.addEventListener('click', function() {
              const id = this.getAttribute('data-id');
              if (!confirm('¿Seguro que deseas eliminar este empleado?')) return;
              fetch('../controlador/empleados/eliminarEmpleado.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `idEmpleado=${encodeURIComponent(id)}`
              })
              .then(r => r.json())
              .then(data => {
                alert(data.success ? 'Empleado eliminado correctamente.' : 'Error al eliminar: ' + (data.error || ''));
                if (data.success) cargarEmpleados();
              })
              .catch(() => alert('Error de conexión con el servidor.'));
            });
          });
        }, 100);
      }
    });
}
