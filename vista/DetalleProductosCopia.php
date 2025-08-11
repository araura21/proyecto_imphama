<?php
// DetalleProductos.php
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Detalle de Productos</h2>
  <form id="formAgregarDetalleProducto" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="idProducto" style="font-weight:600;">ID Producto:</label>
        <input id="idProducto" type="text" name="idProducto" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="idProveedor" style="font-weight:600;">ID Proveedor:</label>
        <input id="idProveedor" type="text" name="idProveedor" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="precioUnitario" style="font-weight:600;">Precio Unitario:</label>
        <input id="precioUnitario" type="number" name="precioUnitario" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="cantidad" style="font-weight:600;">Cantidad:</label>
        <input id="cantidad" type="number" name="cantidad" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="precioTotal" style="font-weight:600;">Precio Total:</label>
        <input id="precioTotal" type="number" name="precioTotal" readonly style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc; background:#f4f4f4;">
      </div>
      <div>
        <label for="moneda" style="font-weight:600;">Moneda:</label>
        <select id="moneda" name="moneda" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="USD">USD</option>
          <option value="EUR">EUR</option>
        </select>
      </div>
      <div>
        <label for="descuentoVolumen" style="font-weight:600;">Descuento por Volumen (%):</label>
        <input id="descuentoVolumen" type="number" name="descuentoVolumen" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="descuentoPromocional" style="font-weight:600;">Descuento Promocional (%):</label>
        <input id="descuentoPromocional" type="number" name="descuentoPromocional" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="impuestosIncluidos" style="font-weight:600;">Impuestos Incluidos:</label>
        <select id="impuestosIncluidos" name="impuestosIncluidos" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="si">Sí</option>
          <option value="no">No</option>
        </select>
      </div>
      <div>
        <label for="costosEnvio" style="font-weight:600;">Costos de Envío:</label>
        <input id="costosEnvio" type="number" name="costosEnvio" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="costosInstalacion" style="font-weight:600;">Costos de Instalación/Montaje:</label>
        <input id="costosInstalacion" type="number" name="costosInstalacion" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="tiempoEntrega" style="font-weight:600;">Tiempo de Entrega Estimado (días):</label>
        <input id="tiempoEntrega" type="number" name="tiempoEntrega" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="lugarEntrega" style="font-weight:600;">Lugar de Entrega:</label>
        <select id="lugarEntrega" name="lugarEntrega" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="domicilio">Domicilio</option>
          <option value="planta">Planta</option>
          <option value="bodega">Bodega</option>
        </select>
      </div>
      <div>
        <label for="disponibilidadInmediata" style="font-weight:600;">Disponibilidad Inmediata:</label>
        <select id="disponibilidadInmediata" name="disponibilidadInmediata" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="si">Sí</option>
          <option value="no">No</option>
        </select>
      </div>
      <div>
        <label for="capacidadSuministro" style="font-weight:600;">Capacidad de Suministro Mensual:</label>
        <input id="capacidadSuministro" type="number" name="capacidadSuministro" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="metodoTransporte" style="font-weight:600;">Método de Transporte Utilizado:</label>
        <input id="metodoTransporte" type="text" name="metodoTransporte" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="entregasParciales" style="font-weight:600;">Posibilidad de Entregas Parciales:</label>
        <select id="entregasParciales" name="entregasParciales" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="si">Sí</option>
          <option value="no">No</option>
        </select>
      </div>
      <div>
        <label for="marca" style="font-weight:600;">Marca:</label>
        <input id="marca" type="text" name="marca" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="modelo" style="font-weight:600;">Modelo:</label>
        <input id="modelo" type="text" name="modelo" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="colores" style="font-weight:600;">Colores Disponibles:</label>
        <input id="colores" type="text" name="colores" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="tamano" style="font-weight:600;">Tamaño/Dimensiones:</label>
        <input id="tamano" type="text" name="tamano" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="peso" style="font-weight:600;">Peso:</label>
        <input id="peso" type="text" name="peso" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="material" style="font-weight:600;">Material de Fabricación:</label>
        <input id="material" type="text" name="material" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="paisOrigen" style="font-weight:600;">País de Origen:</label>
        <input id="paisOrigen" type="text" name="paisOrigen" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="certificaciones" style="font-weight:600;">Certificaciones:</label>
        <input id="certificaciones" type="text" name="certificaciones" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" placeholder="ISO, calidad, seguridad, etc.">
      </div>
      <div>
        <label for="garantia" style="font-weight:600;">Garantía (meses/años):</label>
        <input id="garantia" type="text" name="garantia" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="durabilidad" style="font-weight:600;">Durabilidad Estimada:</label>
        <input id="durabilidad" type="text" name="durabilidad" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="cumplimientoNormas" style="font-weight:600;">Cumplimiento de Normas Técnicas:</label>
        <input id="cumplimientoNormas" type="text" name="cumplimientoNormas" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" placeholder="Locales/internacionales">
      </div>
      <div>
        <label for="condicionesPago" style="font-weight:600;">Condiciones de Pago:</label>
        <select id="condicionesPago" name="condicionesPago" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="contado">Contado</option>
          <option value="credito30">Crédito 30 días</option>
          <option value="credito60">Crédito 60 días</option>
        </select>
      </div>
      <div>
        <label for="penalizacionesRetraso" style="font-weight:600;">Penalizaciones por Retraso:</label>
        <input id="penalizacionesRetraso" type="text" name="penalizacionesRetraso" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="posibilidadDevolucion" style="font-weight:600;">Posibilidad de Devolución:</label>
        <select id="posibilidadDevolucion" name="posibilidadDevolucion" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="si">Sí</option>
          <option value="no">No</option>
        </select>
      </div>
      <div>
        <label for="soportePostventa" style="font-weight:600;">Soporte Postventa:</label>
        <select id="soportePostventa" name="soportePostventa" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="si">Sí</option>
          <option value="no">No</option>
        </select>
      </div>
      <div>
        <label for="servicioTecnico" style="font-weight:600;">Servicio Técnico Incluido:</label>
        <select id="servicioTecnico" name="servicioTecnico" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="si">Sí</option>
          <option value="no">No</option>
        </select>
      </div>
      <div>
        <label for="capacitacionIncluida" style="font-weight:600;">Capacitación Incluida:</label>
        <select id="capacitacionIncluida" name="capacitacionIncluida" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="si">Sí</option>
          <option value="no">No</option>
        </select>
      </div>
    </div>
    <button type="submit" style="background:#27ae60; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(39,174,96,0.08);">Agregar Detalle</button>
  </form>
  <table id="tablaDetalleProductos" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
        <th style="padding:10px; border:1px solid #ddd;">ID Producto</th>
        <th style="padding:10px; border:1px solid #ddd;">ID Proveedor</th>
        <th style="padding:10px; border:1px solid #ddd;">Precio Unitario</th>
        <th style="padding:10px; border:1px solid #ddd;">Precio Total</th>
        <th style="padding:10px; border:1px solid #ddd;">Moneda</th>
        <th style="padding:10px; border:1px solid #ddd;">Descuento Volumen (%)</th>
        <th style="padding:10px; border:1px solid #ddd;">Descuento Promocional (%)</th>
        <th style="padding:10px; border:1px solid #ddd;">Impuestos Incluidos</th>
        <th style="padding:10px; border:1px solid #ddd;">Costos de Envío</th>
        <th style="padding:10px; border:1px solid #ddd;">Costos Instalación</th>
        <th style="padding:10px; border:1px solid #ddd;">Tiempo Entrega (días)</th>
        <th style="padding:10px; border:1px solid #ddd;">Lugar Entrega</th>
        <th style="padding:10px; border:1px solid #ddd;">Disponibilidad Inmediata</th>
        <th style="padding:10px; border:1px solid #ddd;">Capacidad Suministro</th>
        <th style="padding:10px; border:1px solid #ddd;">Método Transporte</th>
        <th style="padding:10px; border:1px solid #ddd;">Entregas Parciales</th>
        <th style="padding:10px; border:1px solid #ddd;">Marca</th>
        <th style="padding:10px; border:1px solid #ddd;">Modelo</th>
        <th style="padding:10px; border:1px solid #ddd;">Colores</th>
        <th style="padding:10px; border:1px solid #ddd;">Tamaño</th>
        <th style="padding:10px; border:1px solid #ddd;">Peso</th>
        <th style="padding:10px; border:1px solid #ddd;">Material</th>
        <th style="padding:10px; border:1px solid #ddd;">País Origen</th>
        <th style="padding:10px; border:1px solid #ddd;">Certificaciones</th>
        <th style="padding:10px; border:1px solid #ddd;">Garantía</th>
        <th style="padding:10px; border:1px solid #ddd;">Durabilidad</th>
        <th style="padding:10px; border:1px solid #ddd;">Normas Técnicas</th>
        <th style="padding:10px; border:1px solid #ddd;">Condiciones Pago</th>
        <th style="padding:10px; border:1px solid #ddd;">Penalizaciones Retraso</th>
        <th style="padding:10px; border:1px solid #ddd;">Devolución</th>
        <th style="padding:10px; border:1px solid #ddd;">Soporte Postventa</th>
        <th style="padding:10px; border:1px solid #ddd;">Servicio Técnico</th>
        <th style="padding:10px; border:1px solid #ddd;">Capacitación</th>
        <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Ejemplo de detalle producto, reemplazar por datos dinámicos -->
      <tr>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">1</td>
        <td style="padding:10px; border:1px solid #ddd;">25.00</td>
        <td style="padding:10px; border:1px solid #ddd;">250.00</td>
        <td style="padding:10px; border:1px solid #ddd;">USD</td>
        <td style="padding:10px; border:1px solid #ddd;">5</td>
        <td style="padding:10px; border:1px solid #ddd;">2</td>
        <td style="padding:10px; border:1px solid #ddd;">Sí</td>
        <td style="padding:10px; border:1px solid #ddd;">10.00</td>
        <td style="padding:10px; border:1px solid #ddd;">5.00</td>
        <td style="padding:10px; border:1px solid #ddd;">7</td>
        <td style="padding:10px; border:1px solid #ddd;">Domicilio</td>
        <td style="padding:10px; border:1px solid #ddd;">Sí</td>
        <td style="padding:10px; border:1px solid #ddd;">100</td>
        <td style="padding:10px; border:1px solid #ddd;">Camión</td>
        <td style="padding:10px; border:1px solid #ddd;">No</td>
        <td style="padding:10px; border:1px solid #ddd;">MarcaX</td>
        <td style="padding:10px; border:1px solid #ddd;">ModeloY</td>
        <td style="padding:10px; border:1px solid #ddd;">Rojo, Azul</td>
        <td style="padding:10px; border:1px solid #ddd;">Largo: 30cm</td>
        <td style="padding:10px; border:1px solid #ddd;">2kg</td>
        <td style="padding:10px; border:1px solid #ddd;">Plástico</td>
        <td style="padding:10px; border:1px solid #ddd;">Ecuador</td>
        <td style="padding:10px; border:1px solid #ddd;">ISO 9001</td>
        <td style="padding:10px; border:1px solid #ddd;">12 meses</td>
        <td style="padding:10px; border:1px solid #ddd;">2 años</td>
        <td style="padding:10px; border:1px solid #ddd;">Norma INEN</td>
        <td style="padding:10px; border:1px solid #ddd;">Contado</td>
        <td style="padding:10px; border:1px solid #ddd;">Ninguna</td>
        <td style="padding:10px; border:1px solid #ddd;">Sí</td>
        <td style="padding:10px; border:1px solid #ddd;">Sí</td>
        <td style="padding:10px; border:1px solid #ddd;">Sí</td>
        <td style="padding:10px; border:1px solid #ddd;">Sí</td>
        <td style="padding:10px; border:1px solid #ddd;">
          <button style="background:#2980b9; color:#fff; border:none; padding:6px 12px; border-radius:4px; margin-right:6px; cursor:pointer;">Editar</button>
          <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<script>
// Aquí iría la lógica JS para el CRUD, por ahora solo es maqueta visual
// Ejemplo de cálculo automático de precio total
const precioUnitario = document.getElementById('precioUnitario');
const cantidad = document.getElementById('cantidad');
const precioTotal = document.getElementById('precioTotal');
if(precioUnitario && cantidad && precioTotal) {
  function calcularTotal() {
    const pu = parseFloat(precioUnitario.value) || 0;
    const cant = parseFloat(cantidad.value) || 0;
    precioTotal.value = (pu * cant).toFixed(2);
  }
  precioUnitario.addEventListener('input', calcularTotal);
  cantidad.addEventListener('input', calcularTotal);
}
</script>
