<?php
require_once '../modelo/conexionBD.php';
$conn = (new connectionDB())->connection();

// AGREGAR COTIZACIÓN
// Detectar si la petición es AJAX
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'agregar') {
  $idProducto = $_POST['idProducto'];
  $idCliente = $_POST['idCliente'];
  $idUsuario = $_POST['idUsuario'];
  $notas = $_POST['notas'];
  $estado = $_POST['estado'];
  $sql = "INSERT INTO cotizacion (idProducto, idCliente, idUsuario, notas, estado) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  if ($stmt === false) {
    if ($isAjax) {
      http_response_code(500);
      echo json_encode(["error" => "Error en prepare: " . $conn->error]);
      exit;
    } else {
      die("Error en prepare: " . $conn->error);
    }
  }
  $stmt->bind_param('iiiss', $idProducto, $idCliente, $idUsuario, $notas, $estado);
  if (!$stmt->execute()) {
    if ($isAjax) {
      http_response_code(500);
      echo json_encode([
        "error" => "Error en execute: " . $stmt->error,
        "mysql_error" => $conn->error
      ]);
      $stmt->close();
      exit;
    } else {
      die("Error en execute: " . $stmt->error . "<br>MySQL: " . $conn->error);
    }
  }
  $stmt->close();
  if ($isAjax) {
    echo json_encode(["success" => true]);
    exit;
  }
}

// ELIMINAR COTIZACIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
  $idCotizacion = $_POST['idCotizacion'];
  $sql = "DELETE FROM cotizacion WHERE idCotizacion = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $idCotizacion);
  $stmt->execute();
  $stmt->close();
  exit;
}

// EDITAR COTIZACIÓN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'editar') {
  $idCotizacion = $_POST['idCotizacion'];
  $estado = $_POST['estado'];
  $sql = "UPDATE cotizacion SET estado = ? WHERE idCotizacion = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $estado, $idCotizacion);
  $stmt->execute();
  $stmt->close();
  exit;
}

// VISUALIZAR COTIZACIONES
$sql = "SELECT idCotizacion, idProducto, idCliente, idUsuario, fecha_emision, notas, estado FROM cotizacion";
$result = $conn->query($sql);
?>
<script src="../validaciones/cotizaciones.js"></script>
<div style="padding:24px;">
  <!-- DEBUG: Filas devueltas: <?php echo ($result ? $result->num_rows : 'ERROR: ' . $conn->error); ?> -->
  <h2 style="margin-bottom:18px;">Gestión de Cotizaciones</h2>
  <form id="formAgregarCotizacion" style="margin-bottom:32px;">
    <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px; margin-bottom:18px;">
        <div>
          <label for="idProducto" style="font-weight:600;">ID Producto:</label>
          <input id="idProducto" type="number" name="idProducto" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
      <div>
        <label for="idCliente" style="font-weight:600;">ID Cliente:</label>
        <input id="idCliente" type="number" name="idCliente" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="idUsuario" style="font-weight:600;">ID Usuario:</label>
        <input id="idUsuario" type="number" name="idUsuario" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="notas" style="font-weight:600;">Notas:</label>
        <input id="notas" type="text" name="notas" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
      </div>
      <div>
        <label for="estado" style="font-weight:600;">Estado:</label>
        <select id="estado" name="estado" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
          <option value="borrador">borrador</option>
          <option value="enviada">enviada</option>
          <option value="aceptada">aceptada</option>
          <option value="rechazada">rechazada</option>
        </select>
      </div>
      <div>
        <label for="fecha_emision" style="font-weight:600;">Fecha de Emisión:</label>
        <input id="fecha_emision" type="date" name="fecha_emision" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" value="<?php echo date('Y-m-d'); ?>">
      </div>
    </div>
    <button type="submit" style="background:#27ae60; color:#fff; border:none; padding:10px 24px; border-radius:6px; font-weight:600; font-size:1rem; cursor:pointer; box-shadow:0 2px 8px rgba(39,174,96,0.08);">Agregar Cotización</button>
  </form>
  <table id="tablaCotizaciones" style="width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
    <thead>
      <tr style="background:#f4f4f4;">
  <th style="padding:10px; border:1px solid #ddd;">ID Cotización</th>
  <th style="padding:10px; border:1px solid #ddd;">ID Producto</th>
  <th style="padding:10px; border:1px solid #ddd;">ID Cliente</th>
  <th style="padding:10px; border:1px solid #ddd;">ID Usuario</th>
  <th style="padding:10px; border:1px solid #ddd;">Fecha Emisión</th>
  <th style="padding:10px; border:1px solid #ddd;">Notas</th>
  <th style="padding:10px; border:1px solid #ddd;">Estado</th>
  <th style="padding:10px; border:1px solid #ddd;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td style="padding:10px; border:1px solid #ddd;"><?= $row['idCotizacion'] ?></td>
          <td style="padding:10px; border:1px solid #ddd;"><?= $row['idProducto'] ?></td>
          <td style="padding:10px; border:1px solid #ddd;"><?= $row['idCliente'] ?></td>
          <td style="padding:10px; border:1px solid #ddd;"><?= $row['idUsuario'] ?></td>
          <td style="padding:10px; border:1px solid #ddd;"><?= $row['fecha_emision'] ?></td>
          <td style="padding:10px; border:1px solid #ddd;"><?= $row['notas'] ?></td>
          <td style="padding:10px; border:1px solid #ddd;">
            <span style="background:#2980b9; color:#fff; padding:4px 12px; border-radius:4px; font-weight:600;">
              <?= ucfirst($row['estado']) ?>
            </span>
          </td>
          <td style="padding:10px; border:1px solid #ddd;">
            <button style="background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;" onclick="eliminarCotizacion(<?= $row['idCotizacion'] ?>)">Eliminar</button>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="8" style="padding:20px; text-align:center; color:#888;">No hay cotizaciones registradas.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<script src="../validaciones/cotizaciones.js"></script>
*** End Patch
<script src="../validaciones/cotizaciones.js"></script>
