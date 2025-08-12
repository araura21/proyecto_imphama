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
      `;
      tbody.appendChild(tr);
    });
  }
}

window.initDetalleProductos();
