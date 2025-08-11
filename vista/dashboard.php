<?php
// dashboard.php
?>
<div style="padding:32px;">
  <h2 style="margin-bottom:28px; font-size:2rem; font-weight:700; color:#222d32;">Dashboard General</h2>
  <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:32px; margin-bottom:32px;">
    <!-- Totales principales -->
    <div style="background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:24px;">
      <h3 style="margin-bottom:18px; color:#2980b9; font-size:1.2rem;">Totales del Sistema</h3>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">12</div>
          <div style="font-size:1rem;">Roles</div>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">34</div>
          <div style="font-size:1rem;">Empleados</div>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">20</div>
          <div style="font-size:1rem;">Usuarios</div>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">50</div>
          <div style="font-size:1rem;">Productos</div>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">8</div>
          <div style="font-size:1rem;">Proveedores</div>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">60</div>
          <div style="font-size:1rem;">Clientes</div>
        </div>
      </div>
    </div>
    <!-- Cotizaciones -->
    <div style="background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:24px;">
      <h3 style="margin-bottom:18px; color:#27ae60; font-size:1.2rem;">Cotizaciones</h3>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">40</div>
          <div style="font-size:1rem;">Enviadas</div>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px; text-align:center;">
          <div style="font-size:2rem; font-weight:700; color:#222d32;">20</div>
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
          <span style="font-size:1.1rem; font-weight:600; color:#222d32;">Seguridad Total S.A.</span>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px;">
          <strong>Proveedor con menos productos:</strong><br>
          <span style="font-size:1.1rem; font-weight:600; color:#222d32;">Protección Integral Cía. Ltda.</span>
        </div>
        <div style="background:#f4f4f4; border-radius:8px; padding:16px;">
          <strong>Mejor cliente:</strong><br>
          <span style="font-size:1.1rem; font-weight:600; color:#222d32;">Carlos Ramírez</span>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
// Aquí iría la lógica JS para mostrar datos dinámicos en el dashboard
</script>
