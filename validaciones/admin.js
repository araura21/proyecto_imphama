addMenuHandler('btn-proveedores', 'proveedores.php', '../validaciones/proveedores.js');

function setActiveMenu(id) {
  document.querySelectorAll('.nav-item').forEach(btn => btn.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

document.getElementById('btn-dashboard').addEventListener('click', function() {
  setActiveMenu('btn-dashboard');
  var main = document.getElementById('main-content');
  main.innerHTML = '<div style="padding:2em; text-align:center; color:#888;">Cargando...</div>';
  fetch('dashboard.php')
    .then(function(response) { return response.text(); })
    .then(function(html) { main.innerHTML = html; })
    .catch(function(e) { main.innerHTML = '<div style=\"color:red; padding:2em;\">Error al cargar dashboard.</div>'; });
});


function addMenuHandler(btnId, phpFile, extraScript) {
  document.getElementById(btnId).addEventListener('click', function() {
    setActiveMenu(btnId);
    var main = document.getElementById('main-content');
    main.innerHTML = '<div style="padding:2em; text-align:center; color:#888;">Cargando...</div>';
    fetch(phpFile)
      .then(function(response) { return response.text(); })
      .then(function(html) {
        main.innerHTML = html;
        if (extraScript) {
          // Eliminar cualquier script previo con el mismo src
          var oldScript = document.querySelector('script[src="' + extraScript + '"]');
          if (oldScript) oldScript.remove();
          // Crear y agregar el script de nuevo para asegurar ejecución
          var script = document.createElement('script');
          script.src = extraScript + '?v=' + Date.now(); // Forzar recarga
          script.onload = function() {
            if (btnId === 'btn-roles' && window.initRoles) window.initRoles();
            if (btnId === 'btn-empleados' && window.initEmpleados) window.initEmpleados();
            if (btnId === 'btn-usuarios' && window.initUsuarios) window.initUsuarios();
            if (btnId === 'btn-proveedores' && window.initProveedores) window.initProveedores();
            if (btnId === 'btn-cotizaciones' && window.initCotizaciones) window.initCotizaciones();
            if (btnId === 'btn-productos' && window.initProductos) window.initProductos();
          };
          document.body.appendChild(script);
        }
      })
      .catch(function(e) { main.innerHTML = '<div style=\"color:red; padding:2em;\">Error al cargar '+phpFile+'.</div>'; });
  });
}

addMenuHandler('btn-dashboard', 'dashboard.php');
addMenuHandler('btn-auditoria', 'auditoria.php');
addMenuHandler('btn-roles', 'roles.php', '../validaciones/roles.js');
addMenuHandler('btn-empleados', 'empleados.php', '../validaciones/empleados.js');
addMenuHandler('btn-usuarios', 'usuarios.php', '../validaciones/usuarios.js');
addMenuHandler('btn-productos', 'productos.php');
addMenuHandler('btn-detalle-productos', 'detalleProductos.php', '../validaciones/detalleProductos.js');
addMenuHandler('btn-cotizaciones', '../controlador/cotizacionesController.php?action=listar', '../validaciones/cotizaciones.js');
addMenuHandler('btn-clientes', 'clientes.php', '../validaciones/clientes.js');
addMenuHandler('btn-generar-cotizacion', 'generarCotizacion.php');

window.addEventListener('DOMContentLoaded', function() {
  var btnDashboard = document.getElementById('btn-dashboard');
  if (btnDashboard) btnDashboard.click();
});
