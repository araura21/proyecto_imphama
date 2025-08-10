
function setActiveMenu(id) {
  document.querySelectorAll('.nav-item').forEach(btn => btn.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

document.getElementById('btn-empleado').addEventListener('click', function() {
  setActiveMenu('btn-empleado');
  var main = document.getElementById('main-content');
  main.innerHTML = '<div style="padding:2em; text-align:center; color:#888;">Cargando...</div>';
  fetch('empleados.php')
    .then(function(response) { return response.text(); })
    .then(function(html) { main.innerHTML = html; })
    .catch(function(e) { main.innerHTML = '<div style="color:red; padding:2em;">Error al cargar empleados.</div>'; });
});

// Delegación global para paginación AJAX de empleados
document.addEventListener('click', function(e) {
  var main = document.getElementById('main-content');
  if (!main) return;
  var pagLink = e.target.closest('.paginacion-empleados a');
  if (pagLink && main.contains(pagLink)) {
    e.preventDefault();
    fetch(pagLink.href)
      .then(r => r.text())
      .then(html => { main.innerHTML = html; });
  }
});

// Delegación global para el selector de cantidad por página en empleados
document.addEventListener('change', function(e) {
  var main = document.getElementById('main-content');
  if (!main) return;
  if (e.target.id === 'size' && main.contains(e.target)) {
    e.preventDefault();
    var form = e.target.closest('form');
    if (!form) return;
    var params = new URLSearchParams(new FormData(form)).toString();
    fetch('empleados.php?' + params)
      .then(r => r.text())
      .then(html => { main.innerHTML = html; });
  }
});

document.getElementById('btn-usuario').addEventListener('click', function() {
  setActiveMenu('btn-usuario');
  var main = document.getElementById('main-content');
  main.innerHTML = '<div style="padding:2em; text-align:center; color:#888;">Cargando...</div>';
  fetch('usuarios.php')
    .then(function(response) { return response.text(); })
    .then(function(html) { main.innerHTML = html; })
    .catch(function(e) { main.innerHTML = '<div style="color:red; padding:2em;">Error al cargar usuarios.</div>'; });
});

document.getElementById('btn-roles').addEventListener('click', function() {
  setActiveMenu('btn-roles');
  console.log('[admin.js] Botón Roles clickeado');
  var main = document.getElementById('main-content');
  main.innerHTML = '<div style="padding:2em; text-align:center; color:#888;">Cargando...</div>';
  fetch('roles.php')
    .then(function(response) {
      console.log('[admin.js] roles.php fetch status:', response.status);
      return response.text();
    })
    .then(function(html) {
      main.innerHTML = html;
      console.log('[admin.js] roles.php HTML insertado');
      // Cargar y ejecutar el script roles.js dinámicamente
      var script = document.createElement('script');
      script.src = '../validaciones/roles.js';
      script.onload = function() {
        console.log('[admin.js] roles.js cargado y ejecutado');
        if (window.initRoles) {
          window.initRoles();
          console.log('[admin.js] window.initRoles() ejecutado');
        } else {
          console.error('[admin.js] window.initRoles no está definida');
        }
      };
      script.onerror = function() { console.error('[admin.js] Error al cargar roles.js'); };
      document.body.appendChild(script);
    })
    .catch(function(e) {
      main.innerHTML = '<div style="color:red; padding:2em;">Error al cargar roles.</div>';
      console.error('[admin.js] Error en fetch roles.php', e);
    });
});
