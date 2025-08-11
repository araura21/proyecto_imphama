<?php
require_once '../../modelo/conexionBD.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    if ($nombre === '' || $apellido === '' || $cedula === '' || $telefono === '' || $correo === '') {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
        exit;
    }
    $conn = (new connectionDB())->connection();
    $stmt = $conn->prepare('INSERT INTO empleado (nombre, apellido, cedula, telefono, correo) VALUES (?, ?, ?, ?, ?)');
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error en prepare: ' . $conn->error]);
        $conn->close();
        exit;
    }
    $stmt->bind_param('sssss', $nombre, $apellido, $cedula, $telefono, $correo);
    $ok = $stmt->execute();
    if ($ok) {
        echo json_encode(['success' => true, 'message' => 'Empleado agregado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar empleado: ' . $stmt->error]);
    }
    $stmt->close();
    $conn->close();
    exit;
}
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
