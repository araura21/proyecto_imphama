<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEmpleado = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : '';
    $idRol = isset($_POST['idRol']) ? $_POST['idRol'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';

    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    if (empty($idEmpleado) || empty($idRol) || empty($usuario) || empty($password) || empty($estado)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    $db = new connectionDB();
    $conn = $db->connection();

    // Validar si el empleado ya está registrado como usuario con el mismo rol
    $stmt = $conn->prepare('SELECT idUsuario FROM usuario WHERE idEmpleado = ? AND idRol = ?');
    $stmt->bind_param('ii', $idEmpleado, $idRol);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El empleado ya está registrado con ese rol.']);
        exit;
    }
    $stmt->close();

    // Validar si el nombre de usuario (correo) ya existe
    $stmt = $conn->prepare('SELECT idUsuario FROM usuario WHERE usuario = ?');
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El correo ya está registrado como usuario.']);
        exit;
    }
    $stmt->close();

    // Hash de la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $stmt = $conn->prepare('INSERT INTO usuario (idEmpleado, idRol, usuario, password_hash, estado) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('iisss', $idEmpleado, $idRol, $usuario, $password_hash, $estado);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar usuario.']);
    }
    $stmt->close();
    $conn->close();
    exit;
}

echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
