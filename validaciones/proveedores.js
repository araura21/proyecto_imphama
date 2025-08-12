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
    if (!ruc || !nombre_empresa || !telefono || !correo || !direccion) {
      alert('Todos los campos son obligatorios.');
      return;
    }
    fetch('../controlador/proveedoresController.php?action=agregar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `ruc=${encodeURIComponent(ruc)}&nombre_empresa=${encodeURIComponent(nombre_empresa)}&telefono=${encodeURIComponent(telefono)}&correo=${encodeURIComponent(correo)}&direccion=${encodeURIComponent(direccion)}`
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
    fetch('../controlador/proveedoresController.php?action=listar')
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          const tbody = document.querySelector('#tablaProveedores tbody');
          tbody.innerHTML = '';
          data.proveedores.forEach(prov => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td>${prov.idProveedor}</td>
              <td>${prov.ruc}</td>
              <td>${prov.nombre_empresa}</td>
              <td>${prov.telefono}</td>
              <td>${prov.correo}</td>
              <td>${prov.direccion}</td>
              <td>
                <button class="btn-editar-proveedor" data-id="${prov.idProveedor}">Editar</button>
                <button class="btn-eliminar-proveedor" data-id="${prov.idProveedor}">Eliminar</button>
              </td>
            `;
            tbody.appendChild(tr);
          });
          // Eventos editar/eliminar (puedes implementar modales si lo deseas)
          tbody.querySelectorAll('.btn-eliminar-proveedor').forEach(btn => {
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
        }
      });
  }
};
