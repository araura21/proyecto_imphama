<?php
// auditoria.php
?>


<div style="padding:32px;">
  <h2 style="margin-bottom:28px; font-size:2rem; font-weight:700; color:#222d32;">Auditoría del Sistema</h2>
  <div style="background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:24px;">
    <h3 style="margin-bottom:18px; color:#c0392b; font-size:1.2rem;">Registro de Actividades</h3>
    <table style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04); border:2px solid #222d32;">
      <thead>
        <tr style="background:#f4f4f4;">
          <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Fecha y Hora</th>
          <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Usuario</th>
          <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Acción</th>
          <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">Detalle</th>
          <th style="padding:12px; border:2px solid #222d32; font-size:1rem; font-weight:600; text-align:left;">IP</th>
        </tr>
      </thead>
      <tbody>
        <!-- Ejemplo de auditoría, reemplazar por datos dinámicos -->
        <tr>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2025-08-11 09:15:23</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">admin</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Login</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Acceso al sistema</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">192.168.1.10</td>
        </tr>
        <tr>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2025-08-11 09:17:10</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">jgarcia</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Creación</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Nuevo producto: Guantes Anticorte</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">192.168.1.15</td>
        </tr>
        <tr>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2025-08-11 09:20:45</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">admin</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Eliminación</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Proveedor eliminado: Protección Integral Cía. Ltda.</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">192.168.1.10</td>
        </tr>
        <tr>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">2025-08-11 09:25:02</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">carlosr</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Modificación</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">Actualización de datos de cliente</td>
          <td style="padding:12px; border:2px solid #222d32; font-size:0.98rem;">192.168.1.20</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script>
// Aquí iría la lógica JS para mostrar datos dinámicos y filtros de auditoría
</script>
