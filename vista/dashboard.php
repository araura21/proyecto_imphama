
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../modelo/datosDashboard.php';

$datos = new DatosDashboard();
$totales = $datos->getTotales();
$enviadas = $datos->contarCotizacionesPorEstado('enviada');
$pendientes = $datos->contarCotizacionesPorEstado('borrador');
$proveedorMax = $datos->proveedorConMasProductos();
$proveedorMin = $datos->proveedorConMenosProductos();
$mejorCliente = $datos->mejorCliente();
?>

<div style="padding:32px;">
  <h2 style="margin-bottom:28px; font-size:2rem; font-weight:700; color:#222d32;">Dashboard General</h2>

  <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:32px; margin-bottom:32px;">

    <!-- Totales principales -->
    <div style="background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:24px;">
      <h3 style="margin-bottom:18px; color:#2980b9; font-size:1.2rem;">Totales del Sistema</h3>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
        <?php foreach ($totales as $label => $cantidad): ?>
          <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
            <div style="font-size:2rem; font-weight:700; color:#222d32;"><?= $cantidad ?></div>
            <div style="font-size:1rem;"><?= $label ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Cotizaciones -->
    <div style="background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:24px;">
      <h3 style="margin-bottom:18px; color:#27ae60; font-size:1.2rem;">Cotizaciones</h3>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;"><?= $enviadas ?></div>
          <div style="font-size:1rem;">Enviadas</div>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;"><?= $pendientes ?></div>
          <div style="font-size:1rem;">Por Enviar</div>
        </div>
      </div>
    </div>

    <!-- Proveedores y clientes destacados -->
    <div style="background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:24px;">
      <h3 style="margin-bottom:18px; color:#c0392b; font-size:1.2rem;">Destacados</h3>
      <div style="display:grid; grid-template-columns:1fr; gap:18px;">
        <div style="background:#f4f4f4; border-radius:8px; padding:16px;">
          <strong>Proveedor con más productos:</strong><br>
          <span style="font-size:1.1rem; font-weight:600; color:#222d32;"><?= $proveedorMax ?></span>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px;">
          <strong>Proveedor con menos productos:</strong><br>
          <span style="font-size:1.1rem; font-weight:600; color:#222d32;"><?= $proveedorMin ?></span>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px;">
          <strong>Mejor cliente:</strong><br>
          <span style="font-size:1.1rem; font-weight:600; color:#222d32;"><?= $mejorCliente ?></span>
        </div>
      </div>
    </div>

  </div>
</div>
