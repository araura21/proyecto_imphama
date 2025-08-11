<?php
require_once '../../modelo/conexionBD.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idRol = isset($_POST['idRol']) ? intval($_POST['idRol']) : 0;
    if ($idRol <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID de rol inválido']);
        exit;
    }
    $conn = (new ConexionBD())->getConexion();
    $stmt = $conn->prepare('DELETE FROM rol WHERE idRol=?');
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error en prepare: ' . $conn->error]);
        $conn->close();
        exit;
    }
    $stmt->bind_param('i', $idRol);
    $ok = $stmt->execute();
    if ($ok) {
        echo json_encode(['success' => true, 'message' => 'Rol eliminado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar rol: ' . $stmt->error]);
    }
    $stmt->close();
    $conn->close();
    exit;
}
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
