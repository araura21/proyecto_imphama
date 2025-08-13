<?php
// generarCotizacion.php
?>
<div style="padding:24px;">
  <div style="margin-bottom:18px;">
    <h2 style="margin-bottom:8px;">Generar Cotización</h2>
    <div style="background:#222d32; color:#fff; border-radius:8px; padding:14px 24px; margin-bottom:18px; display:flex; align-items:center; gap:32px;">
      <div style="font-size:1.3rem; font-weight:700; letter-spacing:1px;">IMPHAMA</div>
      <div><strong>RUC:</strong> 1720020112001</div>
      <div><strong>Dirección:</strong> Las casa, LaPrimavera</div>
      <div><strong>Teléfono:</strong> 0979357401</div>
    </div>
  </div>
  <form id="formSeleccionCotizacion" style="margin-bottom:32px;">
    <div style="display:flex; gap:18px; align-items:center; margin-bottom:18px;">
      <label for="idCotizacion" style="font-weight:600;">ID Cotización:</label>
      <select id="idCotizacion" name="idCotizacion" required style="padding:8px; border-radius:4px; border:1px solid #ccc; min-width:180px;">
        <option value="">Seleccione...</option>
        <!-- Opciones cargadas dinámicamente por JS -->
      </select>
  <button type="button" id="btnCargarDatos" style="background:#2980b9; color:#fff; border:none; padding:8px 18px; border-radius:6px; font-weight:600; cursor:pointer;">Cargar Datos</button>
    </div>
  </form>
  <div id="datosCotizacion" style="margin-bottom:32px;">
    <div style="color:#888; padding:18px; text-align:center;">Seleccione una cotización para ver los datos.</div>
  </div>
  <div id="comparativoProveedores" style="margin-bottom:32px;">
    <h3 style="margin-bottom:12px;">Comparativo de Proveedores</h3>
    <form id="formSeleccionProveedores" style="margin-bottom:18px;">
      <label for="proveedoresComparar" style="font-weight:600;">Selecciona hasta 3 proveedores:</label>
      <select id="proveedoresComparar" name="proveedoresComparar[]" multiple size="3" style="padding:8px; border-radius:4px; border:1px solid #ccc; min-width:220px;">
        <!-- Aquí se cargarían dinámicamente los proveedores -->
      </select>
      <button type="button" id="btnComparar" style="background:#27ae60; color:#fff; border:none; padding:8px 18px; border-radius:6px; font-weight:600; cursor:pointer; margin-left:18px;">Comparar</button>
    </form>
    <div id="tablaComparativo" style="overflow-x:auto;">
  <table style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04); border:2px solid #222d32;">
        <thead>
          <tr style="background:#f4f4f4;">
            <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Característica</th>
            <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Proveedor 1</th>
            <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Proveedor 2</th>
            <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Proveedor 3</th>
          </tr>
        </thead>
        <tbody>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Precio Unitario</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$25.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$27.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$24.50</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Precio Total</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$250.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$270.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$245.00</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Moneda</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">USD</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">USD</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">USD</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Descuento Volumen (%)</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">5</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">3</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">4</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Descuento Promocional (%)</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">1</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">0</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Impuestos Incluidos</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">No</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Costos de Envío</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$10.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$12.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$8.00</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Costos Instalación</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$5.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$6.00</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">$4.00</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Tiempo Entrega (días)</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">7</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">10</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">5</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Lugar Entrega</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Domicilio</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Planta</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Bodega</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Disponibilidad Inmediata</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">No</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Capacidad Suministro</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">100</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">80</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">120</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Método Transporte</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Camión</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Furgoneta</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Camión</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Entregas Parciales</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">No</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Marca</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">MarcaX</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">MarcaY</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">MarcaZ</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Modelo</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">ModeloY</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">ModeloZ</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">ModeloA</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Colores</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Rojo, Azul</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Verde</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Negro</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Tamaño</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Largo: 30cm</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Largo: 32cm</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Largo: 28cm</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Peso</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2kg</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2.2kg</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">1.8kg</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Material</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Plástico</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Metal</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Plástico</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">País Origen</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Ecuador</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Colombia</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Perú</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Certificaciones</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">ISO 9001</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">ISO 14001</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">ISO 9001</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Garantía</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">12 meses</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">24 meses</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">18 meses</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Durabilidad</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2 años</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">3 años</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2 años</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Normas Técnicas</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Norma INEN</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Norma ISO</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Norma INEN</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Condiciones Pago</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Contado</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Crédito 30 días</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Contado</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Penalizaciones Retraso</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Ninguna</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Multa</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Ninguna</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Devolución</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">No</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Soporte Postventa</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">No</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Servicio Técnico</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">No</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td></tr>
          <tr><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Capacitación</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">No</td><td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Sí</td></tr>
        </tbody>
      </table>
    </div>
  </div>
  <div style="display:flex; gap:18px;">
  <button type="button" id="btnImprimirCotizacion" style="background:#34495e; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer;">Imprimir Cotización</button>
  <button type="button" id="btnGuardarPDF" style="background:#8e44ad; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer;">Guardar PDF</button>
  <button type="button" id="btnEnviarCorreo" style="background:#27ae60; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer;">Enviar por Correo</button>
  </div>
</div>
<script src="../validaciones/generarCotizacion.js"></script>