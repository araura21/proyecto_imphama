// validaciones/clientes.js
// CRUD y tabla dinámica para clientes, igual a proveedores

window.initClientes = function() {
  let clientesCache = [];
  // Modal de edición: solo se crea una vez y se reutiliza
  let modal = document.getElementById('modal-editar-cliente');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'modal-editar-cliente';
    modal.style.display = 'none';
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100vw';
    modal.style.height = '100vh';
    modal.style.background = 'rgba(0,0,0,0.3)';
    modal.style.zIndex = '9999';
    modal.innerHTML = `
      <div style="background:#fff; max-width:420px; margin:60px auto; padding:24px 18px 18px 18px; border-radius:8px; box-shadow:0 4px 24px rgba(0,0,0,0.13); position:relative;">
        <h3 style="margin-bottom:18px;">Editar Cliente</h3>
        <form id="formEditarCliente">
          <input type="hidden" id="editIdCliente">
          <div style="margin-bottom:12px;">
            <label for="editNombreCliente" style="font-weight:600;">Nombre:</label>
            <input id="editNombreCliente" name="editNombreCliente" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editApellidoCliente" style="font-weight:600;">Apellido:</label>
            <input id="editApellidoCliente" name="editApellidoCliente" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editCedulaCliente" style="font-weight:600;">Cédula:</label>
            <input id="editCedulaCliente" name="editCedulaCliente" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editTelefonoCliente" style="font-weight:600;">Teléfono:</label>
            <input id="editTelefonoCliente" name="editTelefonoCliente" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editCorreoCliente" style="font-weight:600;">Correo:</label>
            <input id="editCorreoCliente" name="editCorreoCliente" type="email" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editDireccionCliente" style="font-weight:600;">Dirección:</label>
            <input id="editDireccionCliente" name="editDireccionCliente" type="text" style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editEstadoCliente" style="font-weight:600;">Estado:</label>
            <select id="editEstadoCliente" name="editEstadoCliente" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button type="button" id="btnCancelarEditarCliente" style="background:#eee; color:#333; border:none; padding:7px 16px; border-radius:4px;">Cancelar</button>
            <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:7px 16px; border-radius:4px;">Guardar</button>
          </div>
        </form>
      </div>
    `;
    document.body.appendChild(modal);
    document.getElementById('btnCancelarEditarCliente').onclick = function() {
      modal.style.display = 'none';
    };
    document.getElementById('formEditarCliente').onsubmit = function(e) {
  e.preventDefault();
  const idCliente = document.getElementById('editIdCliente').value;
  const nombre = document.getElementById('editNombreCliente').value.trim();
  const apellido = document.getElementById('editApellidoCliente').value.trim();
  const cedula = document.getElementById('editCedulaCliente').value.trim();
  const telefono = document.getElementById('editTelefonoCliente').value.trim();
  const correo = document.getElementById('editCorreoCliente').value.trim();
  const direccion = document.getElementById('editDireccionCliente').value.trim();
  const estado = document.getElementById('editEstadoCliente').value;
  fetch('/controlador/clientes/editarCliente.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `idCliente=${encodeURIComponent(idCliente)}&nombre=${encodeURIComponent(nombre)}&apellido=${encodeURIComponent(apellido)}&cedula=${encodeURIComponent(cedula)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}&direccion=${encodeURIComponent(direccion)}&estado=${encodeURIComponent(estado)}`
      })
      .then(r => r.json())
      .then(data => {
        alert(data.message);
        modal.style.display = 'none';
        cargarClientesYCache(cargarClientes);
      });
    };
  }

  function cargarClientesYCache(cb) {
  fetch('../controlador/clientesController.php?action=listar')
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          clientesCache = data.clientes;
        }
        if (cb) cb(data);
      });
  }
  cargarClientesYCache(cargarClientes);

  // Agregar cliente
  const formAgregar = document.getElementById('formAgregarCliente');
  if (formAgregar) {
    formAgregar.onsubmit = function(e) {
      e.preventDefault();
      const nombre = document.getElementById('nombre').value.trim();
      const apellido = document.getElementById('apellido').value.trim();
      const cedula = document.getElementById('cedula').value.trim();
      const telefono = document.getElementById('telefono').value.trim();
      const correo = document.getElementById('correo').value.trim();
      const direccion = document.getElementById('direccion') ? document.getElementById('direccion').value.trim() : '';
      const estado = 'activo';
      fetch('../controlador/clientes/agregarCliente.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `nombre=${encodeURIComponent(nombre)}&apellido=${encodeURIComponent(apellido)}&cedula=${encodeURIComponent(cedula)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}&direccion=${encodeURIComponent(direccion)}&estado=${encodeURIComponent(estado)}`
      })
      .then(r => r.json())
      .then(data => {
        alert(data.message);
        if (data.success) {
          formAgregar.reset();
          cargarClientesYCache(cargarClientes);
        }
      });
    };
  }

  function cargarClientes() {
    let clientes = clientesCache;
    let pageSize = 5;
    let currentPage = 1;
    const tabla = document.getElementById('tablaClientes');
    const tbody = tabla.querySelector('tbody');
    // Crear paginación y selector
    const paginacionContainer = document.createElement('div');
    paginacionContainer.style.display = 'flex';
    paginacionContainer.style.justifyContent = 'space-between';
    paginacionContainer.style.alignItems = 'center';
    paginacionContainer.style.marginBottom = '12px';
    const select = document.createElement('select');
    [5,10,15].forEach(n => {
      const opt = document.createElement('option');
      opt.value = n;
      opt.textContent = n + ' por página';
      select.appendChild(opt);
    });
    select.value = pageSize;
    select.style.marginRight = '16px';
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

    function renderTabla() {
      tbody.innerHTML = '';
      const start = (currentPage-1)*pageSize;
      const end = start + pageSize;
      clientes.slice(start, end).forEach(cli => {
        const estadoColor = cli.estado === 'activo' ? '#27ae60' : '#c0392b';
        const estadoText = cli.estado.charAt(0).toUpperCase() + cli.estado.slice(1);
        const btnStyleEditar = 'background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;';
        const btnStyleEliminar = 'background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;';
        tbody.innerHTML += `
          <tr>
            <td style="padding:10px; border:1px solid #ddd;">${cli.idCliente}</td>
            <td style="padding:10px; border:1px solid #ddd;">${cli.nombre}</td>
            <td style="padding:10px; border:1px solid #ddd;">${cli.apellido}</td>
            <td style="padding:10px; border:1px solid #ddd;">${cli.cedula}</td>
            <td style="padding:10px; border:1px solid #ddd;">${cli.telefono}</td>
            <td style="padding:10px; border:1px solid #ddd;">${cli.correo}</td>
            <td style="padding:10px; border:1px solid #ddd;">${cli.direccion || ''}</td>
            <td style="padding:10px; border:1px solid #ddd; text-align:center;"><span style="background:${estadoColor}; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;">${estadoText}</span></td>
            <td style="padding:10px; border:1px solid #ddd; text-align:center;">
              <button class="btn-editar-cliente" data-id="${cli.idCliente}" style="${btnStyleEditar}">Editar</button>
              <button class="btn-eliminar-cliente" data-id="${cli.idCliente}" style="${btnStyleEliminar}">Eliminar</button>
            </td>
          </tr>
        `;
      });
      pageInfo.textContent = `Página ${currentPage} de ${Math.ceil(clientes.length/pageSize)}`;
      btnPrev.disabled = currentPage === 1;
      btnNext.disabled = currentPage === Math.ceil(clientes.length/pageSize);

      // Evento para editar cliente (modal)
      tbody.querySelectorAll('.btn-editar-cliente').forEach(btn => {
        btn.onclick = function() {
          const id = this.dataset.id;
          const cli = clientes.find(c => c.idCliente == id);
          if (!cli) return;
          document.getElementById('editIdCliente').value = cli.idCliente;
          document.getElementById('editNombreCliente').value = cli.nombre;
          document.getElementById('editApellidoCliente').value = cli.apellido;
          document.getElementById('editCedulaCliente').value = cli.cedula;
          document.getElementById('editTelefonoCliente').value = cli.telefono;
          document.getElementById('editCorreoCliente').value = cli.correo;
          document.getElementById('editDireccionCliente').value = cli.direccion || '';
          document.getElementById('editEstadoCliente').value = cli.estado;
          modal.style.display = 'block';
        };
      });

      // Evento para eliminar cliente
      tbody.querySelectorAll('.btn-eliminar-cliente').forEach(btn => {
        btn.onclick = function() {
          if (!confirm('¿Eliminar cliente?')) return;
          fetch('../controlador/clientes/eliminarCliente.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `idCliente=${encodeURIComponent(this.dataset.id)}`
          })
          .then(r => r.json())
          .then(data => {
            alert(data.message);
            cargarClientesYCache(cargarClientes);
          });
        };
      });
    }

    // Eventos
    select.onchange = function() {
      pageSize = parseInt(this.value);
      currentPage = 1;
      renderTabla();
    };
    btnPrev.onclick = function() {
      if (currentPage > 1) {
        currentPage--;
        renderTabla();
      }
    };
    btnNext.onclick = function() {
      if (currentPage < Math.ceil(clientes.length/pageSize)) {
        currentPage++;
        renderTabla();
      }
    };

    // Insertar paginación arriba de la tabla
    if (!tabla.previousElementSibling || !tabla.previousElementSibling.classList || !tabla.previousElementSibling.classList.contains('clientes-paginacion')) {
      paginacionContainer.classList.add('clientes-paginacion');
      tabla.parentNode.insertBefore(paginacionContainer, tabla);
    }
    renderTabla();
  }
};

// Ejecutar automáticamente si la tabla está presente
if (document.getElementById('tablaClientes')) {
  window.initClientes();
}
