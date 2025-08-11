<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : '';
    if (empty($idUsuario)) {
        echo json_encode(['success' => false, 'message' => 'ID de usuario requerido.']);
        exit;
    }
    $db = new connectionDB();
    $conn = $db->connection();
    $stmt = $conn->prepare('DELETE FROM usuario WHERE idUsuario = ?');
    $stmt->bind_param('i', $idUsuario);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar usuario.']);
    }
    $stmt->close();
    $conn->close();
    exit;
}
echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
