<?php
require_once '../../modelo/conexionBD.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $permisos = isset($_POST['permisos']) ? $_POST['permisos'] : [];
    $debug = [
        'post_nombre' => $nombre,
        'post_permisos_raw' => $permisos
    ];
    if ($nombre === '') {
        echo json_encode(['success' => false, 'message' => 'El nombre es obligatorio', 'debug' => $debug]);
        exit;
    }
    // Si permisos es un string JSON, decodificarlo a array antes de volver a codificar
    if (is_string($permisos)) {
        $permisos_decoded = json_decode($permisos, true);
        $debug['permisos_decoded'] = $permisos_decoded;
        if ($permisos_decoded === null && json_last_error() !== JSON_ERROR_NONE) {
            $debug['json_error'] = json_last_error_msg();
            echo json_encode(['success' => false, 'message' => 'Permisos inválidos', 'debug' => $debug]);
            exit;
        }
        $permisos = $permisos_decoded;
    }
    $permisosJson = json_encode($permisos);
    $debug['permisos_json'] = $permisosJson;
    $db = new connectionDB();
    $conn = $db->connection();
    // Verificar si ya existe un rol con ese nombre (case-insensitive)
    $stmtCheck = $conn->prepare('SELECT COUNT(*) FROM rol WHERE LOWER(nombre) = LOWER(?)');
    $stmtCheck->bind_param('s', $nombre);
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();
    $stmtCheck->close();
    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => 'Ya existe un rol con ese nombre.']);
        $conn->close();
        exit;
    }
    $stmt = $conn->prepare('INSERT INTO rol (nombre, permisos) VALUES (?, ?)');
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error en prepare: ' . $conn->error, 'debug' => $debug]);
        $conn->close();
        exit;
    }
    $stmt->bind_param('ss', $nombre, $permisosJson);
    $ok = $stmt->execute();
    if ($ok) {
        echo json_encode(['success' => true, 'message' => 'Rol agregado correctamente']);
    } else {
        $debug['sql_error'] = $stmt->error;
        echo json_encode(['success' => false, 'message' => 'Error al agregar rol: ' . $stmt->error, 'debug' => $debug]);
    }
    $stmt->close();
    $conn->close();
    exit;
}

echo json_encode(['success' => false, 'message' => 'Método no permitido']);
