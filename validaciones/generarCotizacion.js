// Funcionalidad para los botones de acción (Imprimir, PDF, Correo)
function initBotonesAccionCotizacion() {
  var btnImprimir = document.getElementById('btnImprimirCotizacion');
  if (btnImprimir) {
    btnImprimir.onclick = function() {
      window.print();
    };
  }
  var btnPDF = document.getElementById('btnGuardarPDF');
  if (btnPDF) {
    btnPDF.onclick = function() {
      window.print();
    };
  }
  var btnCorreo = document.getElementById('btnEnviarCorreo');
  if (btnCorreo) {
    btnCorreo.onclick = function() {
      var cotizacionDiv = document.getElementById('datosCotizacion');
      var comparativoDiv = document.getElementById('comparativoProveedores');
      var contenido = '';
      if (cotizacionDiv) contenido += cotizacionDiv.innerText + '\n\n';
      if (comparativoDiv) contenido += comparativoDiv.innerText;
      var asunto = encodeURIComponent('Cotización IMPHAMA');
      var cuerpo = encodeURIComponent(contenido);
      window.location.href = 'mailto:?subject=' + asunto + '&body=' + cuerpo;
    };
  }
}
// Ejecutar al cargar el script (por si el DOM ya está listo)
initBotonesAccionCotizacion();
// También asegurar que se ejecuta tras DOMContentLoaded
document.addEventListener('DOMContentLoaded', initBotonesAccionCotizacion);
  // Comparar proveedores
  var btnComparar = document.getElementById('btnComparar');
  if (btnComparar) {
    btnComparar.onclick = function() {
      var selectProv = document.getElementById('proveedoresComparar');
      var idCot = document.getElementById('idCotizacion').value;
      if (!idCot) {
        alert('Seleccione una cotización primero.');
        return;
      }
      var selected = Array.from(selectProv.selectedOptions).map(opt => opt.value).filter(Boolean);
      if (selected.length === 0) {
        alert('Seleccione al menos un proveedor.');
        return;
      }
      // Obtener idProducto de la cotización seleccionada
      fetch('../controlador/generarCotizacionController.php?idCotizacion=' + idCot)
        .then(response => response.json())
        .then(data => {
          if (!data.idProducto) {
            alert('No se pudo obtener el producto de la cotización.');
            return;
          }
          // Consultar detalles de producto para los proveedores
          fetch('../controlador/compararProveedoresController.php?idProducto=' + data.idProducto + '&proveedores=' + selected.join(','))
            .then(response => response.json())
            .then(res => {
              if (!res.success) {
                document.getElementById('tablaComparativo').innerHTML = '<div style="color:red;">' + (res.message || 'Error al comparar proveedores') + '</div>';
                return;
              }
              // Construir tabla comparativa
              var detalles = res.detalles;
              var ths = selected.map(pid => `<th style='padding:12px; border:2px solid #222d32;'>${detalles && detalles[pid]?.proveedor_nombre ? detalles[pid].proveedor_nombre : 'Proveedor'}</th>`).join('');
              var rows = '';
              function tdRow(label, key, format) {
                var tds = selected.map(pid => {
                  var val = detalles && detalles[pid] ? detalles[pid][key] : null;
                  return `<td style='padding:12px; border:2px solid #222d32;'>${format ? format(val) : (val ?? '-')}</td>`;
                }).join('');
                rows += `<tr><td style='padding:12px; border:2px solid #222d32;'>${label}</td>${tds}</tr>`;
              }
              if (!detalles || Object.keys(detalles).length === 0) {
                document.getElementById('tablaComparativo').innerHTML = `<div style='color:#b00; padding:18px; text-align:center;'>No hay datos de producto para los proveedores seleccionados.</div>`;
                return;
              }
              tdRow('Precio Unitario', 'precio_unitario', v => v ? ('$' + parseFloat(v).toFixed(2)) : '-');
              tdRow('Cantidad', 'cantidad');
              tdRow('Moneda', 'moneda');
              tdRow('Descuento Volumen (%)', 'descuento_volumen');
              tdRow('Descuento Promocional (%)', 'descuento_promocional');
              tdRow('Impuestos Incluidos', 'impuestos_incluidos', v => v == 1 ? 'Sí' : 'No');
              tdRow('Costo Envío', 'costo_envio', v => v ? ('$' + parseFloat(v).toFixed(2)) : '-');
              tdRow('Costo Instalación', 'costo_instalacion', v => v ? ('$' + parseFloat(v).toFixed(2)) : '-');
              tdRow('Tiempo Entrega (días)', 'tiempo_entrega_dias');
              tdRow('Lugar Entrega', 'lugar_entrega');
              tdRow('Disponibilidad Inmediata', 'disponibilidad_inmediata', v => v == 1 ? 'Sí' : 'No');
              tdRow('Capacidad Suministro', 'capacidad_suministro_mensual');
              tdRow('Método Transporte', 'metodo_transporte');
              tdRow('Entregas Parciales', 'entregas_parciales', v => v == 1 ? 'Sí' : 'No');
              tdRow('Marca', 'marca');
              tdRow('Modelo', 'modelo');
              tdRow('Colores', 'colores_disponibles');
              tdRow('Tamaño/Dimensiones', 'tamano_dimensiones');
              tdRow('Peso', 'peso');
              tdRow('Material', 'material');
              tdRow('País Origen', 'pais_origen');
              tdRow('Certificaciones', 'certificaciones');
              tdRow('Garantía (meses)', 'garantia_mes');
              tdRow('Durabilidad Estimada', 'durabilidad_estimada');
              tdRow('Normas Técnicas', 'cumplimiento_normas');
              tdRow('Condiciones Pago', 'condiciones_pago');
              tdRow('Penalizaciones Retraso', 'penalizaciones_retraso');
              tdRow('Devolución', 'devolucion', v => v == 1 ? 'Sí' : 'No');
              tdRow('Soporte Postventa', 'soporte_postventa', v => v == 1 ? 'Sí' : 'No');
              tdRow('Servicio Técnico', 'servicio_tecnico_incluido', v => v == 1 ? 'Sí' : 'No');
              tdRow('Capacitación', 'capacitacion_incluida', v => v == 1 ? 'Sí' : 'No');
              tdRow('Observaciones', 'observaciones');
              document.getElementById('tablaComparativo').innerHTML = `<table style='width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04); border:2px solid #222d32;'><thead><tr style='background:#f4f4f4;'><th style='padding:12px; border:2px solid #222d32;'>Característica</th>${ths}</tr></thead><tbody>${rows}</tbody></table>`;
            });
        });
    };
  }
// validaciones/generarCotizacion.js
window.initGenerarCotizacion = function() {
  // Cargar cotizaciones
  var selectCot = document.getElementById('idCotizacion');
  if (selectCot) {
    fetch('../controlador/generarCotizacionController.php?action=listarCotizaciones')
      .then(response => response.json())
      .then(data => {
        if (Array.isArray(data)) {
          selectCot.innerHTML = '<option value="">Seleccione...</option>';
          data.forEach(function(cot) {
            selectCot.innerHTML += `<option value="${cot.id}">Cotización #${cot.id} - ${cot.nombre_cliente || ''}</option>`;
          });
        }
      })
      .catch(() => {
        selectCot.innerHTML = '<option value="">Error al cargar cotizaciones</option>';
      });

    // Cuando se selecciona una cotización, cargar automáticamente los detalles y la tabla comparativa
    selectCot.addEventListener('change', function() {
      var idCot = selectCot.value;
      if (!idCot) {
        document.getElementById('datosCotizacion').innerHTML = '<div style="color:#888; padding:18px; text-align:center;">Seleccione una cotización para ver los datos.</div>';
        document.getElementById('tablaComparativo').innerHTML = '';
        return;
      }
      // Cargar datos de la cotización
      fetch('../controlador/generarCotizacionController.php?idCotizacion=' + idCot)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            document.getElementById('datosCotizacion').innerHTML = '<div style="color:red;">' + data.error + '</div>';
            document.getElementById('tablaComparativo').innerHTML = '';
            return;
          }
          // Mostrar datos de producto y cliente
          var productoHtml = `<h3 style="margin-bottom:8px;">Producto</h3><div style="background:#f9f9f9; border-radius:8px; padding:12px; box-shadow:0 1px 4px rgba(0,0,0,0.04); display:flex; gap:18px; align-items:center;"><img src='assets/img/productos/corporal/1.jpg' alt='Producto' style='height:60px; border-radius:6px; box-shadow:0 1px 4px rgba(0,0,0,0.08);'><div><strong>Nombre:</strong> ${data.producto_nombre || ''}<br><strong>Descripción:</strong> ${data.producto_descripcion || ''}<br></div></div>`;
          var clienteHtml = `<h3 style="margin-bottom:8px;">Cliente</h3><div style="background:#f9f9f9; border-radius:8px; padding:12px; box-shadow:0 1px 4px rgba(0,0,0,0.04);"><strong>Nombre:</strong> ${data.cliente_nombre || ''}<br><strong>Apellido:</strong> ${data.cliente_apellido || ''}<br><strong>Cédula:</strong> ${data.cedula || ''}<br><strong>Teléfono:</strong> ${data.telefono || ''}<br><strong>Correo:</strong> ${data.correo || ''}<br></div>`;
          document.getElementById('datosCotizacion').innerHTML = `<div style='display:flex; gap:32px;'><div style='flex:1;'>${productoHtml}</div><div style='flex:1;'>${clienteHtml}</div></div>`;

          // Si hay proveedores seleccionados, cargar la tabla comparativa automáticamente
          var selectProv = document.getElementById('proveedoresComparar');
          var selected = Array.from(selectProv.selectedOptions).map(opt => opt.value).filter(Boolean);
          if (data.idProducto && selected.length > 0) {
            fetch('../controlador/compararProveedoresController.php?idProducto=' + data.idProducto + '&proveedores=' + selected.join(','))
              .then(response => response.json())
              .then(res => {
                if (!res.success) {
                  document.getElementById('tablaComparativo').innerHTML = '<div style="color:red;">' + (res.message || 'Error al comparar proveedores') + '</div>';
                  return;
                }
                var detalles = res.detalles;
                var ths = selected.map(pid => `<th style='padding:12px; border:2px solid #222d32;'>${detalles[pid]?.proveedor_nombre || 'Proveedor'}</th>`).join('');
                var rows = '';
                function tdRow(label, key, format) {
                  var tds = selected.map(pid => {
                    var val = detalles[pid]?.[key];
                    return `<td style='padding:12px; border:2px solid #222d32;'>${format ? format(val) : (val ?? '-')}</td>`;
                  }).join('');
                  rows += `<tr><td style='padding:12px; border:2px solid #222d32;'>${label}</td>${tds}</tr>`;
                }
                tdRow('Precio Unitario', 'precio_unitario', v => v ? ('$' + parseFloat(v).toFixed(2)) : '-');
                tdRow('Moneda', 'moneda');
                tdRow('Descuento Volumen (%)', 'descuento_volumen');
                tdRow('Descuento Promocional (%)', 'descuento_promocional');
                tdRow('Impuestos Incluidos', 'impuestos_incluidos', v => v == 1 ? 'Sí' : 'No');
                tdRow('Costo Envío', 'costo_envio', v => v ? ('$' + parseFloat(v).toFixed(2)) : '-');
                tdRow('Costo Instalación', 'costo_instalacion', v => v ? ('$' + parseFloat(v).toFixed(2)) : '-');
                tdRow('Tiempo Entrega (días)', 'tiempo_entrega_dias');
                tdRow('Lugar Entrega', 'lugar_entrega');
                tdRow('Disponibilidad Inmediata', 'disponibilidad_inmediata', v => v == 1 ? 'Sí' : 'No');
                tdRow('Capacidad Suministro', 'capacidad_suministro_mensual');
                tdRow('Método Transporte', 'metodo_transporte');
                document.getElementById('tablaComparativo').innerHTML = `<table style='width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04); border:2px solid #222d32;'><thead><tr style='background:#f4f4f4;'><th style='padding:12px; border:2px solid #222d32;'>Característica</th>${ths}</tr></thead><tbody>${rows}</tbody></table>`;
              });
          } else {
            document.getElementById('tablaComparativo').innerHTML = '';
          }
        });
    });
  }

  // Cargar proveedores
  var selectProv = document.getElementById('proveedoresComparar');
  if (selectProv) {
    fetch('../controlador/proveedoresController.php?action=listar')
      .then(response => response.json())
      .then(data => {
        if (data.success && Array.isArray(data.proveedores)) {
          selectProv.innerHTML = '';
          data.proveedores.forEach(function(prov) {
            selectProv.innerHTML += `<option value="${prov.idProveedor}">${prov.nombre_empresa}</option>`;
          });
        } else {
          selectProv.innerHTML = '<option value="">Sin proveedores</option>';
        }
      })
      .catch(() => {
        selectProv.innerHTML = '<option value="">Error al cargar proveedores</option>';
      });
  }
  // Botón cargar datos
  var btn = document.getElementById('btnCargarDatos');
  if (btn) {
    btn.onclick = function() {
      var idCot = document.getElementById('idCotizacion').value;
      if (!idCot) {
        alert('Seleccione una cotización');
        return;
      }
      fetch('../controlador/generarCotizacionController.php?idCotizacion=' + idCot)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            document.getElementById('datosCotizacion').innerHTML = '<div style="color:red;">' + data.error + '</div>';
            return;
          }
          // Producto
          var productoHtml = `<h3 style="margin-bottom:8px;">Producto</h3><div style="background:#f9f9f9; border-radius:8px; padding:12px; box-shadow:0 1px 4px rgba(0,0,0,0.04); display:flex; gap:18px; align-items:center;"><img src='assets/img/productos/corporal/1.jpg' alt='Producto' style='height:60px; border-radius:6px; box-shadow:0 1px 4px rgba(0,0,0,0.08);'><div><strong>Nombre:</strong> ${data.producto_nombre || ''}<br><strong>Descripción:</strong> ${data.producto_descripcion || ''}<br></div></div>`;
          // Cliente
          var clienteHtml = `<h3 style="margin-bottom:8px;">Cliente</h3><div style="background:#f9f9f9; border-radius:8px; padding:12px; box-shadow:0 1px 4px rgba(0,0,0,0.04);"><strong>Nombre:</strong> ${data.cliente_nombre || ''}<br><strong>Apellido:</strong> ${data.cliente_apellido || ''}<br><strong>Cédula:</strong> ${data.cedula || ''}<br><strong>Teléfono:</strong> ${data.telefono || ''}<br><strong>Correo:</strong> ${data.correo || ''}<br></div>`;
          document.getElementById('datosCotizacion').innerHTML = `<div style='display:flex; gap:32px;'><div style='flex:1;'>${productoHtml}</div><div style='flex:1;'>${clienteHtml}</div></div>`;
        })
        .catch(function() {
          document.getElementById('datosCotizacion').innerHTML = '<div style="color:red;">Error al cargar datos</div>';
        });
    };
  }
};
// Ejecutar automáticamente si la vista se carga directamente (no por AJAX)
if (document.getElementById('idCotizacion')) {
  window.initGenerarCotizacion();
}
