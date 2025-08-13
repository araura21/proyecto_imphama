console.log("cotizaciones.js activo - ruta: ../validaciones/cotizaciones.js");
 window.initCotizaciones = function() {
    document.getElementById('formAgregarCotizacion').addEventListener('submit',registerCotizacionFormHandler);
 };

   

// Forzar el registro del evento submit aunque el formulario se inserte después
function registerCotizacionFormHandler(retries = 10) {
  const form = document.getElementById('formAgregarCotizacion');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(form);
      formData.append('accion', 'agregar');
      // Asegurarse de enviar todos los campos requeridos
      const idProducto = document.getElementById('idProducto');
      if (idProducto) {
        formData.set('idProducto', idProducto.value);
        const fechaEmision = document.getElementById('fecha_emision');
        if (fechaEmision) {
          formData.set('fecha_emision', fechaEmision.value);
        }
      }
      fetch('../controlador/cotizaciones/agregarCotizacion.php?action=agregar', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(async response => {
        try {
          const data = await response.json();
          if (data.success) {
            location.reload();
          } else {
            let msg = 'Error: ' + (data.message || 'No se pudo agregar la cotización.');
            if (data.mysql_error) msg += '\nMySQL: ' + data.mysql_error;
            if (data.sqlstate) msg += '\nSQLSTATE: ' + data.sqlstate;
            if (data.input) msg += '\nDatos enviados: ' + JSON.stringify(data.input);
            alert(msg);
          }
        } catch (e) {
          const text = await response.text();
          alert('Respuesta inesperada:\n' + text);
        }
      })
      .catch(() => alert('Error de conexión al agregar cotización.'));
    });
    console.log('Handler de submit de cotizaciones registrado');
  } else if (retries > 0) {
    setTimeout(function() { registerCotizacionFormHandler(retries - 1); }, 200);
  } else {
    console.warn('No se encontró el formulario de cotizaciones para registrar el handler');
  }
}
registerCotizacionFormHandler();

function eliminarCotizacion(id) {
  const formData = new FormData();
  formData.append('accion', 'eliminar');
  formData.append('idCotizacion', id);
  fetch('../controlador/cotizaciones/eliminarCotizacion.php?action=eliminar', {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  }).then(() => location.reload());
}
function editarCotizacion(id, estado) {
  const formData = new FormData();
  formData.append('accion', 'editar');
  formData.append('idCotizacion', id);
  formData.append('estado', estado);
  fetch('../controlador/cotizaciones/editarCotizacion.php?action=editar', {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  }).then(() => location.reload());
}

