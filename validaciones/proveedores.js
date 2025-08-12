// validaciones/proveedores.js
// JS para gestionar proveedores (similar a roles.js)


window.initProveedores = function() {
  let proveedoresCache = [];
  // Modal de edición: solo se crea una vez y se reutiliza
  let modal = document.getElementById('modal-editar-proveedor');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'modal-editar-proveedor';
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
        <h3 style="margin-bottom:18px;">Editar Proveedor</h3>
        <form id="formEditarProveedor">
          <input type="hidden" id="editIdProveedor">
          <div style="margin-bottom:12px;">
            <label for="editRuc" style="font-weight:600;">RUC:</label>
            <input id="editRuc" name="editRuc" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editNombreEmpresa" style="font-weight:600;">Nombre Empresa:</label>
            <input id="editNombreEmpresa" name="editNombreEmpresa" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editTelefono" style="font-weight:600;">Teléfono:</label>
            <input id="editTelefono" name="editTelefono" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editCorreo" style="font-weight:600;">Correo:</label>
            <input id="editCorreo" name="editCorreo" type="email" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editDireccion" style="font-weight:600;">Dirección:</label>
            <input id="editDireccion" name="editDireccion" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editEstado" style="font-weight:600;">Estado:</label>
            <select id="editEstado" name="editEstado" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button type="button" id="btnCancelarEditarProveedor" style="background:#eee; color:#333; border:none; padding:7px 16px; border-radius:4px;">Cancelar</button>
            <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:7px 16px; border-radius:4px;">Guardar</button>
          </div>
        </form>
      </div>
    `;
    document.body.appendChild(modal);
    // Cerrar modal
    document.getElementById('btnCancelarEditarProveedor').onclick = function() {
      modal.style.display = 'none';
    };
    // Enviar edición
    document.getElementById('formEditarProveedor').onsubmit = function(e) {
      e.preventDefault();
      const idProveedor = document.getElementById('editIdProveedor').value;
      const ruc = document.getElementById('editRuc').value.trim();
      const nombre_empresa = document.getElementById('editNombreEmpresa').value.trim();
      const telefono = document.getElementById('editTelefono').value.trim();
      const correo = document.getElementById('editCorreo').value.trim();
      const direccion = document.getElementById('editDireccion').value.trim();
      const estado = document.getElementById('editEstado').value;
      fetch('../controlador/proveedores/editarProveedor.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `idProveedor=${encodeURIComponent(idProveedor)}&ruc=${encodeURIComponent(ruc)}&nombre_empresa=${encodeURIComponent(nombre_empresa)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}&direccion=${encodeURIComponent(direccion)}&estado=${encodeURIComponent(estado)}`
      })
      .then(r => r.json())
      .then(data => {
        alert(data.message);
        modal.style.display = 'none';
        cargarProveedoresYCache(cargarProveedores);
      });
    };
  }
  function cargarProveedoresYCache(cb) {
    fetch('../controlador/proveedoresController.php?action=listar')
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          proveedoresCache = data.proveedores;
        }
        if (cb) cb(data);
      });
  }
  cargarProveedoresYCache(cargarProveedores);

  document.getElementById('formAgregarProveedor').addEventListener('submit', function(e) {
    e.preventDefault();
    const ruc = document.getElementById('ruc').value.trim();
    const nombre_empresa = document.getElementById('nombre_empresa').value.trim();
    const telefono = document.getElementById('telefono').value.trim();
    const correo = document.getElementById('correo').value.trim();
    const direccion = document.getElementById('direccion').value.trim();
    const estado = document.getElementById('estado').value;
    if (!ruc || !nombre_empresa || !telefono || !correo || !direccion || !estado) {
      alert('Todos los campos son obligatorios.');
      return;
    }
  fetch('../controlador/proveedores/agregarProveedor.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `ruc=${encodeURIComponent(ruc)}&nombre_empresa=${encodeURIComponent(nombre_empresa)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}&direccion=${encodeURIComponent(direccion)}&estado=${encodeURIComponent(estado)}`
    })
    .then(r => r.json())
    .then(data => {
      alert(data.message);
      if (data.success) {
        document.getElementById('formAgregarProveedor').reset();
        cargarProveedoresYCache(cargarProveedores);
      }
    });
  });

  function cargarProveedores() {
    // Paginación similar a roles.js
    let proveedores = proveedoresCache;
    let pageSize = 5;
    let currentPage = 1;
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
    btnPrev.style.background = '#eee';
    btnPrev.style.color = '#333';
    btnPrev.style.border = 'none';
    btnPrev.style.padding = '7px 16px';
    btnPrev.style.borderRadius = '4px';
    const btnNext = document.createElement('button');
    btnNext.textContent = 'Siguiente';
    btnNext.style.background = '#eee';
    btnNext.style.color = '#333';
    btnNext.style.border = 'none';
    btnNext.style.padding = '7px 16px';
    btnNext.style.borderRadius = '4px';
    const pageInfo = document.createElement('span');
    pageInfo.style.margin = '0 10px';
    controls.appendChild(btnPrev);
    controls.appendChild(pageInfo);
    controls.appendChild(btnNext);
    paginacionContainer.appendChild(select);
    paginacionContainer.appendChild(controls);

    function renderTabla() {
      let html = `<table id="tablaProveedores" style="width:100%; table-layout:fixed; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04); font-size:1rem;">
        <colgroup>
          <col style="min-width:60px; max-width:70px; width:65px;">
          <col style="min-width:120px; max-width:180px; width:150px;">
          <col style="min-width:180px; max-width:220px; width:180px;">
          <col style="min-width:120px; max-width:160px; width:130px;">
          <col style="min-width:120px; max-width:160px; width:130px;">
          <col style="min-width:120px; max-width:160px; width:130px;">
          <col style="min-width:100px; max-width:120px; width:110px;">
          <col style="min-width:100px; max-width:120px; width:110px;">
        </colgroup>
        <thead>
          <tr style="background:#f4f4f4;">
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">ID</th>
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">RUC</th>
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">Nombre Empresa</th>
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">Teléfono</th>
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">Correo</th>
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">Dirección</th>
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">Estado</th>
            <th style="padding:10px; border:1px solid #ddd; font-size:0.97rem;">Acciones</th>
          </tr>
        </thead>
        <tbody>`;
      const start = (currentPage-1)*pageSize;
      const end = start + pageSize;
      proveedores.slice(start, end).forEach(prov => {
        html += `<tr>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; text-align:center;">${prov.idProveedor}</td>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; word-break:break-all;">${prov.ruc}</td>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; word-break:break-word;">${prov.nombre_empresa}</td>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; word-break:break-all;">${prov.telefono}</td>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; word-break:break-all;">${prov.correo}</td>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; word-break:break-word;">${prov.direccion}</td>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; color:${prov.estado==='activo'?'#27ae60':'#e74c3c'}; font-weight:600; text-align:center;">${prov.estado==='activo'?'Activo':'Inactivo'}</td>
          <td style="padding:10px; border:1px solid #ddd; font-size:0.97rem; text-align:center;">
            <button class="btn-editar-proveedor" data-id="${prov.idProveedor}" style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
            <button class="btn-eliminar-proveedor" data-id="${prov.idProveedor}" style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
          </td>
        </tr>`;
      });
      html += '</tbody></table>';
      const cont = document.getElementById('tabla-proveedores');
      cont.innerHTML = '';
      cont.appendChild(paginacionContainer);
      const tablaDiv = document.createElement('div');
      tablaDiv.innerHTML = html;
      cont.appendChild(tablaDiv);

      // Eventos para eliminar
      tablaDiv.querySelectorAll('.btn-eliminar-proveedor').forEach(btn => {
        btn.onclick = function() {
          if (!confirm('¿Eliminar proveedor?')) return;
          fetch(`../controlador/proveedores/eliminarProveedor.php`, {

            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `idProveedor=${encodeURIComponent(this.dataset.id)}`
          })
          .then(r => r.json())
          .then(data => {
            alert(data.message);
            cargarProveedoresYCache(cargarProveedores);
          });
        };
      });
      // Evento para editar proveedor (modal)
      tablaDiv.querySelectorAll('.btn-editar-proveedor').forEach(btn => {
        btn.onclick = function() {
          const id = this.dataset.id;
          const prov = proveedores.find(p => p.idProveedor == id);
          if (!prov) return;
          document.getElementById('editIdProveedor').value = prov.idProveedor;
          document.getElementById('editRuc').value = prov.ruc;
          document.getElementById('editNombreEmpresa').value = prov.nombre_empresa;
          document.getElementById('editTelefono').value = prov.telefono;
          document.getElementById('editCorreo').value = prov.correo;
          document.getElementById('editDireccion').value = prov.direccion;
          document.getElementById('editEstado').value = prov.estado;
          modal.style.display = 'block';
        };
      });
      // Actualizar info de página
      const totalPages = Math.ceil(proveedores.length / pageSize) || 1;
      pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
      btnPrev.disabled = currentPage === 1;
      btnNext.disabled = currentPage === totalPages;
    }
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
      const totalPages = Math.ceil(proveedores.length / pageSize) || 1;
      if (currentPage < totalPages) {
        currentPage++;
        renderTabla();
      }
    });
    renderTabla();
  }
};
