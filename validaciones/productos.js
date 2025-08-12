// validaciones/productos.js
// JS para gestionar productos dinámicamente


window.initProductos = function() {
  let productosCache = [];
  // Modal de edición: solo se crea una vez y se reutiliza
  let modal = document.getElementById('modal-editar-producto');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'modal-editar-producto';
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
        <h3 style="margin-bottom:18px;">Editar Producto</h3>
        <form id="formEditarProducto">
          <input type="hidden" id="editIdProducto">
          <div style="margin-bottom:12px;">
            <label for="editNombreProducto" style="font-weight:600;">Nombre:</label>
            <input id="editNombreProducto" name="editNombreProducto" type="text" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
          </div>
          <div style="margin-bottom:12px;">
            <label for="editDescripcionProducto" style="font-weight:600;">Descripción:</label>
            <textarea id="editDescripcionProducto" name="editDescripcionProducto" rows="3" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;"></textarea>
          </div>
          <div style="margin-bottom:12px;">
            <label for="editEstadoProducto" style="font-weight:600;">Estado:</label>
            <select id="editEstadoProducto" name="editEstadoProducto" required style="width:100%; padding:7px; border-radius:4px; border:1px solid #ccc;">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button type="button" id="btnCancelarEditarProducto" style="background:#eee; color:#333; border:none; padding:7px 16px; border-radius:4px;">Cancelar</button>
            <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:7px 16px; border-radius:4px;">Guardar</button>
          </div>
        </form>
      </div>
    `;
    document.body.appendChild(modal);
    // Cerrar modal
    document.getElementById('btnCancelarEditarProducto').onclick = function() {
      modal.style.display = 'none';
    };
    // Enviar edición
    document.getElementById('formEditarProducto').onsubmit = function(e) {
      e.preventDefault();
      const idProducto = document.getElementById('editIdProducto').value;
      const nombre = document.getElementById('editNombreProducto').value.trim();
      const descripcion = document.getElementById('editDescripcionProducto').value.trim();
      const estado = document.getElementById('editEstadoProducto').value;
      fetch('../controlador/productos/editarProducto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `idProducto=${encodeURIComponent(idProducto)}&nombre=${encodeURIComponent(nombre)}&descripcion=${encodeURIComponent(descripcion)}&estado=${encodeURIComponent(estado)}`
      })
      .then(r => r.json())
      .then(data => {
        alert(data.message);
        modal.style.display = 'none';
        cargarProductosYCache(cargarProductos);
      });
    };
  }

  function cargarProductosYCache(cb) {
    fetch('../controlador/productosController.php?action=listar')
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          productosCache = data.productos;
        }
        if (cb) cb(data);
      });
  }
  cargarProductosYCache(cargarProductos);

  // Agregar producto
  const formAgregar = document.getElementById('formAgregarProducto');
  if (formAgregar) {
    formAgregar.onsubmit = function(e) {
      e.preventDefault();
      const nombre = document.getElementById('nombre').value.trim();
      const descripcion = document.getElementById('descripcion').value.trim();
      const estado = document.getElementById('estado').value;
      fetch('../controlador/productos/agregarProducto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `nombre=${encodeURIComponent(nombre)}&descripcion=${encodeURIComponent(descripcion)}&estado=${encodeURIComponent(estado)}`
      })
      .then(r => r.json())
      .then(data => {
        alert(data.message);
        if (data.success) {
          formAgregar.reset();
          cargarProductosYCache(cargarProductos);
        }
      });
    };
  }

  function cargarProductos() {
    let productos = productosCache;
    let pageSize = 5;
    let currentPage = 1;
    const tabla = document.getElementById('tablaProductos');
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
      productos.slice(start, end).forEach(prod => {
        const estadoColor = prod.estado === 'activo' ? '#27ae60' : '#c0392b';
        const estadoText = prod.estado.charAt(0).toUpperCase() + prod.estado.slice(1);
        const btnStyleEditar = 'background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;';
        const btnStyleEliminar = 'background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;';
        tbody.innerHTML += `
          <tr>
            <td style="padding:10px; border:1px solid #ddd;">${prod.idProducto}</td>
            <td style="padding:10px; border:1px solid #ddd;">${prod.nombre}</td>
            <td style="padding:10px; border:1px solid #ddd;"><img src="${prod.imagen || ''}" alt="${prod.nombre}" style="height:40px; border-radius:4px;"></td>
            <td style="padding:10px; border:1px solid #ddd;">${prod.descripcion}</td>
            <td style="padding:10px; border:1px solid #ddd;"><span style="background:${estadoColor}; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;">${estadoText}</span></td>
            <td style="padding:10px; border:1px solid #ddd;">
              <button class="btn-editar-producto" data-id="${prod.idProducto}" style="${btnStyleEditar}">Editar</button>
              <button class="btn-eliminar-producto" data-id="${prod.idProducto}" style="${btnStyleEliminar}">Eliminar</button>
            </td>
          </tr>
        `;
      });
      pageInfo.textContent = `Página ${currentPage} de ${Math.ceil(productos.length/pageSize)}`;
      btnPrev.disabled = currentPage === 1;
      btnNext.disabled = currentPage === Math.ceil(productos.length/pageSize);

      // Evento para editar producto (modal)
      tbody.querySelectorAll('.btn-editar-producto').forEach(btn => {
        btn.onclick = function() {
          const id = this.dataset.id;
          const prod = productos.find(p => p.idProducto == id);
          if (!prod) return;
          document.getElementById('editIdProducto').value = prod.idProducto;
          document.getElementById('editNombreProducto').value = prod.nombre;
          document.getElementById('editDescripcionProducto').value = prod.descripcion;
          document.getElementById('editEstadoProducto').value = prod.estado;
          modal.style.display = 'block';
        };
      });

      // Evento para eliminar producto
      tbody.querySelectorAll('.btn-eliminar-producto').forEach(btn => {
        btn.onclick = function() {
          if (!confirm('¿Eliminar producto?')) return;
          fetch('../controlador/productos/eliminarProducto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `idProducto=${encodeURIComponent(this.dataset.id)}`
          })
          .then(r => r.json())
          .then(data => {
            alert(data.message);
            cargarProductosYCache(cargarProductos);
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
      if (currentPage < Math.ceil(productos.length/pageSize)) {
        currentPage++;
        renderTabla();
      }
    };

    // Insertar paginación arriba de la tabla
    if (!tabla.previousElementSibling || !tabla.previousElementSibling.classList || !tabla.previousElementSibling.classList.contains('productos-paginacion')) {
      paginacionContainer.classList.add('productos-paginacion');
      tabla.parentNode.insertBefore(paginacionContainer, tabla);
    }
    renderTabla();
  }
};

// Ejecutar automáticamente si la tabla está presente
if (document.getElementById('tablaProductos')) {
  window.initProductos();
}
