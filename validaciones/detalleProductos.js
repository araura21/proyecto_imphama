// validaciones/detalleProductos.js
// JS para gestionar detalle de productos dinámicamente

window.initDetalleProductos = function() {
  let detallesCache = [];

  function cargarDetallesYCache(cb) {
    fetch('../controlador/bodegueroController.php?action=listar_detalles')
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          detallesCache = data.detalles;
        }
        if (cb) cb(data);
      });
  }
  cargarDetallesYCache(cargarDetalles);

  // Agregar detalle
  const formAgregar = document.getElementById('formAgregarDetalleProducto');
  if (formAgregar) {
    formAgregar.onsubmit = function(e) {
      e.preventDefault();
      const fd = new FormData(formAgregar);
      fetch('../controlador/bodegueroController.php?action=agregar_detalle', {
        method: 'POST',
        body: fd
      })
      .then(r => r.json())
      .then(data => {
        alert(data.message);
        if (data.success) {
          formAgregar.reset();
          cargarDetallesYCache(cargarDetalles);
        }
      });
    };
  }

  function cargarDetalles() {
    const tabla = document.getElementById('tablaDetalleProductos');
    const tbody = tabla.querySelector('tbody');
    tbody.innerHTML = '';
    if (!detallesCache.length) {
      tbody.innerHTML = '<tr><td colspan="11" style="padding:10px; border:1px solid #ddd; text-align:center;">No hay detalles registrados.</td></tr>';
      return;
    }
    detallesCache.forEach(detalle => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td style="padding:10px; border:1px solid #ddd;">${detalle.idDetalle}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.producto}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.proveedor}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.marca}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.modelo}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.precio_unitario}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.moneda}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.cantidad}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.pais_origen}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.material}</td>
        <td style="padding:10px; border:1px solid #ddd;">${detalle.observaciones}</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button class="btn-editar-detalle" data-id="${detalle.idDetalle}" style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; margin-right:4px;">Editar</button>
          <button class="btn-eliminar-detalle" data-id="${detalle.idDetalle}" style="background:#c0392b; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
        </td>
      `;
      tbody.appendChild(tr);
    });
    // Asignar eventos a los botones
    tbody.querySelectorAll('.btn-editar-detalle').forEach(btn => {
      btn.onclick = function() {
        const id = this.getAttribute('data-id');
        const detalle = detallesCache.find(d => d.idDetalle == id);
        if (!detalle) return alert('No se encontró el detalle');
        // Llenar el formulario del modal
        document.getElementById('edit_idDetalle').value = detalle.idDetalle;
        // Buscar el idProducto y idProveedor reales si no están en el objeto
        // Si el backend ya los envía, esto funcionará directamente
        if (detalle.idProducto) {
          document.getElementById('edit_idProducto').value = detalle.idProducto;
        } else if (detalle.producto) {
          // Buscar el idProducto por nombre en el select
          const selectProd = document.getElementById('edit_idProducto');
          for (let opt of selectProd.options) {
            if (opt.text === detalle.producto) {
              selectProd.value = opt.value;
              break;
            }
          }
        }
        if (detalle.idProveedor) {
          document.getElementById('edit_idProveedor').value = detalle.idProveedor;
        } else if (detalle.proveedor) {
          // Buscar el idProveedor por nombre en el select
          const selectProv = document.getElementById('edit_idProveedor');
          for (let opt of selectProv.options) {
            if (opt.text === detalle.proveedor) {
              selectProv.value = opt.value;
              break;
            }
          }
        }
        document.getElementById('edit_marca').value = detalle.marca || '';
        document.getElementById('edit_modelo').value = detalle.modelo || '';
        document.getElementById('edit_precio_unitario').value = detalle.precio_unitario || '';
        document.getElementById('edit_moneda').value = detalle.moneda || '';
        document.getElementById('edit_cantidad').value = detalle.cantidad || '';
        document.getElementById('edit_pais_origen').value = detalle.pais_origen || '';
        document.getElementById('edit_material').value = detalle.material || '';
        document.getElementById('edit_observaciones').value = detalle.observaciones || '';
  const modal = document.getElementById('modalEditarDetalle');
  modal.style.display = 'flex';
  modal.style.alignItems = 'center';
  modal.style.justifyContent = 'center';
      };
    });

    // Cerrar modal
    document.getElementById('btnCerrarModalEditar').onclick = function() {
      document.getElementById('modalEditarDetalle').style.display = 'none';
    };

    // Enviar edición
    const formEditar = document.getElementById('formEditarDetalleProducto');
    if (formEditar) {
      formEditar.onsubmit = function(e) {
        e.preventDefault();
        const idDetalle = document.getElementById('edit_idDetalle').value;
        const idProducto = document.getElementById('edit_idProducto').value;
        const idProveedor = document.getElementById('edit_idProveedor').value;
        const marca = document.getElementById('edit_marca').value.trim();
        const modelo = document.getElementById('edit_modelo').value.trim();
        const precio_unitario = document.getElementById('edit_precio_unitario').value.trim();
        const moneda = document.getElementById('edit_moneda').value.trim();
        const cantidad = document.getElementById('edit_cantidad').value.trim();
        const pais_origen = document.getElementById('edit_pais_origen').value.trim();
        const material = document.getElementById('edit_material').value.trim();
        const observaciones = document.getElementById('edit_observaciones').value.trim();
        const body = `idDetalle=${encodeURIComponent(idDetalle)}&idProducto=${encodeURIComponent(idProducto)}&idProveedor=${encodeURIComponent(idProveedor)}&marca=${encodeURIComponent(marca)}&modelo=${encodeURIComponent(modelo)}&precio_unitario=${encodeURIComponent(precio_unitario)}&moneda=${encodeURIComponent(moneda)}&cantidad=${encodeURIComponent(cantidad)}&pais_origen=${encodeURIComponent(pais_origen)}&material=${encodeURIComponent(material)}&observaciones=${encodeURIComponent(observaciones)}`;
        fetch('../controlador/bodegueroController.php?action=editar_detalle', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: body
        })
        .then(r => r.json())
        .then(data => {
          alert(data.message);
          document.getElementById('modalEditarDetalle').style.display = 'none';
          cargarDetallesYCache(cargarDetalles);
        });
      };
    }
    tbody.querySelectorAll('.btn-eliminar-detalle').forEach(btn => {
      btn.onclick = function() {
        const id = this.getAttribute('data-id');
        if (confirm('¿Seguro que deseas eliminar el detalle con ID: ' + id + '?')) {
          fetch('../controlador/bodegueroController.php?action=eliminar_detalle', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'idDetalle=' + encodeURIComponent(id)
          })
          .then(r => r.json())
          .then(data => {
            alert(data.message);
            if (data.success) cargarDetallesYCache(cargarDetalles);
          });
        }
      };
    });
  }
}

window.initDetalleProductos();
