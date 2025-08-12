// validaciones/cotizaciones.js

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('formAgregarCotizacion');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(form);
      formData.append('accion', 'agregar');
  fetch('/nrc23244/github/proyecto_imphama/vista/cotizaciones.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          alert('Error: ' + (data.error || 'No se pudo agregar la cotización.'));
        }
      })
      .catch(() => alert('Error de conexión al agregar cotización.'));
    });
  }
});

function eliminarCotizacion(id) {
  const formData = new FormData();
  formData.append('accion', 'eliminar');
  formData.append('idCotizacion', id);
  fetch('/nrc23244/github/proyecto_imphama/vista/cotizaciones.php', {
    method: 'POST',
    body: formData
  }).then(() => location.reload());
}

function editarCotizacion(id, estado) {
  const formData = new FormData();
  formData.append('accion', 'editar');
  formData.append('idCotizacion', id);
  formData.append('estado', estado);
  fetch('/nrc23244/github/proyecto_imphama/vista/cotizaciones.php', {
    method: 'POST',
    body: formData
  }).then(() => location.reload());
}
