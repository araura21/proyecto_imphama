<?php
require_once '../modelo/conexionBD.php';
$db = new connectionDB();
$conn = $db->connection();

// Paginación
$pageSize = isset($_GET['size']) && in_array((int)$_GET['size'], [3,5,7]) ? (int)$_GET['size'] : 3;
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page-1)*$pageSize;
$totalResult = $conn->query('SELECT COUNT(*) as total FROM empleado');
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows/$pageSize);
$result = $conn->query("SELECT idEmpleado, nombre, apellido, cedula, telefono, correo FROM empleado ORDER BY idEmpleado ASC LIMIT $pageSize OFFSET $offset");
?>
<div style="padding:24px;">
  <h2 style="margin-bottom:18px;">Gestión de Empleados</h2>
  <form id="formAgregarEmpleado" method="post" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:18px; margin-bottom:18px;">
      <div>
        <label for="nombre" style="font-weight:600;">Nombre:</label>
        <input id="nombre" type="text" name="nombre" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="apellido" style="font-weight:600;">Apellido:</label>
        <input id="apellido" type="text" name="apellido" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="cedula" style="font-weight:600;">Cédula:</label>
        <input id="cedula" type="text" name="cedula" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="telefono" style="font-weight:600;">Teléfono:</label>
        <input id="telefono" type="text" name="telefono" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="correo" style="font-weight:600;">Correo:</label>
        <input id="correo" type="email" name="correo" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
    </div>
    <button type="submit" style="background:#2980b9; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(41,128,185,0.08);">Agregar Empleado</button>
  </form>
  <h3 style="margin-bottom:12px;">Empleados registrados</h3>
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
    <div style="font-weight:600;">Página <?= $page ?> de <?= $totalPages ?></div>
  <form method="get" onsubmit="return false;" style="display:flex; align-items:center; gap:10px; margin:0;">
      <label for="size" style="font-weight:600;">Mostrar:</label>
  <select name="size" id="size" style="padding:4px 8px; border-radius:4px;">
        <option value="3"<?= $pageSize==3?' selected':'' ?>>3</option>
        <option value="5"<?= $pageSize==5?' selected':'' ?>>5</option>
        <option value="7"<?= $pageSize==7?' selected':'' ?>>7</option>
      </select>
      <input type="hidden" name="page" value="<?= $page ?>">
    </form>
  </div>
  <table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse; background:#fff; table-layout:fixed; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <colgroup>
      <col style="min-width:50px; max-width:60px; width:55px;">
      <col style="min-width:80px; max-width:110px; width:90px;">
      <col style="min-width:80px; max-width:110px; width:90px;">
      <col style="min-width:80px; max-width:110px; width:90px;">
      <col style="min-width:80px; max-width:110px; width:90px;">
      <col style="min-width:120px; max-width:260px; width:180px;">
    </colgroup>
    <thead style="background:#f4f4f4;">
      <tr>
        <th style="padding:8px; border:1px solid #ddd;">ID</th>
        <th style="padding:8px; border:1px solid #ddd;">Nombre</th>
        <th style="padding:8px; border:1px solid #ddd;">Apellido</th>
        <th style="padding:8px; border:1px solid #ddd;">Cédula</th>
        <th style="padding:8px; border:1px solid #ddd;">Teléfono</th>
        <th style="padding:8px; border:1px solid #ddd;">Correo</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td style="padding:8px; border:1px solid #ddd;\"><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
          <td style="padding:8px; border:1px solid #ddd;\"><?php echo htmlspecialchars($row['nombre']); ?></td>
          <td style="padding:8px; border:1px solid #ddd;\"><?php echo htmlspecialchars($row['apellido']); ?></td>
          <td style="padding:8px; border:1px solid #ddd;\"><?php echo htmlspecialchars($row['cedula']); ?></td>
          <td style="padding:8px; border:1px solid #ddd;\"><?php echo htmlspecialchars($row['telefono']); ?></td>
          <td style="padding:8px; border:1px solid #ddd; white-space:nowrap; overflow-x:auto; max-width:220px; "><?php echo htmlspecialchars($row['correo']); ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="paginacion-empleados" style="margin-top:12px; display:flex; justify-content:flex-end; gap:8px; align-items:center;">
    <?php if($page>1): ?>
  <a href="empleados.php?page=1&size=<?= $pageSize ?>" style="padding:6px 10px; background:#eee; border-radius:4px; text-decoration:none; color:#333;">«</a>
  <a href="empleados.php?page=<?= $page-1 ?>&size=<?= $pageSize ?>" style="padding:6px 14px; background:#eee; border-radius:4px; text-decoration:none; color:#333;">Anterior</a>
    <?php endif; ?>
    <?php
      // Mostrar máximo 5 números de página
      $start = max(1, $page-2);
      $end = min($totalPages, $start+4);
      if ($end-$start<4) $start = max(1, $end-4);
      for($i=$start; $i<=$end; $i++):
    ?>
      <?php if($i==$page): ?>
        <span style="padding:6px 12px; background:#2980b9; color:#fff; border-radius:4px; font-weight:600;"> <?= $i ?> </span>
      <?php else: ?>
  <a href="empleados.php?page=<?= $i ?>&size=<?= $pageSize ?>" style="padding:6px 12px; background:#eee; border-radius:4px; text-decoration:none; color:#333;"> <?= $i ?> </a>
      <?php endif; ?>
    <?php endfor; ?>
    <?php if($page<$totalPages): ?>
  <a href="empleados.php?page=<?= $page+1 ?>&size=<?= $pageSize ?>" style="padding:6px 14px; background:#eee; border-radius:4px; text-decoration:none; color:#333;">Siguiente</a>
  <a href="empleados.php?page=<?= $totalPages ?>&size=<?= $pageSize ?>" style="padding:6px 10px; background:#eee; border-radius:4px; text-decoration:none; color:#333;">»</a>
    <?php endif; ?>
  </div>

