// validaciones/proveedores.js
// JS para gestionar proveedores (similar a roles.js)


window.initProveedores = function() {
  let proveedoresCache = [];
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
    fetch('../controlador/proveedoresController.php?action=agregar', {
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
          fetch(`../controlador/proveedoresController.php?action=eliminar`, {
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
      // (Opcional: aquí puedes agregar eventos para editar con modal, igual a roles/empleados)
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
