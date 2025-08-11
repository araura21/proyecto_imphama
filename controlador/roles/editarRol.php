<?php
require_once '../../modelo/conexionBD.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idRol = isset($_POST['idRol']) ? intval($_POST['idRol']) : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $permisos = isset($_POST['permisos']) ? $_POST['permisos'] : [];
    if ($idRol <= 0 || $nombre === '') {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        exit;
    }
    if (is_string($permisos)) {
        $permisos_decoded = json_decode($permisos, true);
        if ($permisos_decoded !== null) {
            $permisos = $permisos_decoded;
        }
    }
    $permisosJson = json_encode($permisos);
    $db = new connectionDB();
    $conn = $db->connection();
    // Verificar si ya existe otro rol con ese nombre
    $stmtCheck = $conn->prepare('SELECT COUNT(*) FROM rol WHERE LOWER(nombre) = LOWER(?) AND idRol != ?');
    $stmtCheck->bind_param('si', $nombre, $idRol);
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();
    $stmtCheck->close();
    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => 'Ya existe un rol con ese nombre.']);
        $conn->close();
        exit;
    }
    $stmt = $conn->prepare('UPDATE rol SET nombre=?, permisos=? WHERE idRol=?');
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error en prepare: ' . $conn->error]);
        $conn->close();
        exit;
    }
    $stmt->bind_param('ssi', $nombre, $permisosJson, $idRol);
    $ok = $stmt->execute();
    if ($ok) {
        echo json_encode(['success' => true, 'message' => 'Rol actualizado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar rol: ' . $stmt->error]);
    }
    $stmt->close();
    $conn->close();
    exit;
}
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
