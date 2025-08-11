<?php
require_once '../../modelo/conexionBD.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : '';
    $idEmpleado = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : '';
    $idRol = isset($_POST['idRol']) ? $_POST['idRol'] : '';
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';

    if (empty($idUsuario) || empty($idEmpleado) || empty($idRol) || empty($usuario) || empty($estado)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    $db = new connectionDB();
    $conn = $db->connection();

    // Validar si el empleado ya está registrado con ese rol (excepto el usuario actual)
    $stmt = $conn->prepare('SELECT idUsuario FROM usuario WHERE idEmpleado = ? AND idRol = ? AND idUsuario != ?');
    $stmt->bind_param('iii', $idEmpleado, $idRol, $idUsuario);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El empleado ya está registrado con ese rol.']);
        exit;
    }
    $stmt->close();

    // Validar si el usuario (correo) ya existe para otro usuario
    $stmt = $conn->prepare('SELECT idUsuario FROM usuario WHERE usuario = ? AND idUsuario != ?');
    $stmt->bind_param('si', $usuario, $idUsuario);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El correo ya está registrado como usuario.']);
        exit;
    }
    $stmt->close();

    // Si se envía una nueva contraseña, actualizarla
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET idEmpleado = ?, idRol = ?, usuario = ?, password_hash = ?, estado = ? WHERE idUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisssi', $idEmpleado, $idRol, $usuario, $password_hash, $estado, $idUsuario);
    } else {
        $sql = "UPDATE usuario SET idEmpleado = ?, idRol = ?, usuario = ?, estado = ? WHERE idUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iissi', $idEmpleado, $idRol, $usuario, $estado, $idUsuario);
    }
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar usuario.']);
    }
    $stmt->close();
    $conn->close();
    exit;
}
echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
