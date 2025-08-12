// validaciones/productos.js
// JS para gestionar productos dinámicamente

window.initProductos = function() {
  let productosCache = [];

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
            <td style="padding:10px; border:1px solid #ddd;"><img src="${prod.imagen}" alt="${prod.nombre}" style="height:40px; border-radius:4px;"></td>
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
