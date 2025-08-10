<?php
session_start();
require_once '../modelo/conexionBD.php';

if (isset($_SESSION['usuario'])) {
    header('Location: ../vista/administrador.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';
    if ($usuario !== '' && $contrasena !== '') {
        $db = new connectionDB();
        $conn = $db->connection();
        $stmt = $conn->prepare('SELECT idUsuario, usuario, password_hash, estado FROM usuario WHERE usuario = ? LIMIT 1');
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (($row['password_hash'] === $contrasena || password_verify($contrasena, $row['password_hash'])) && $row['estado'] === 'activo') {
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['idUsuario'] = $row['idUsuario'];
                header('Location: ../vista/administrador.php');
                exit();
            } else {
                $error = 'Usuario o contraseña incorrectos, o usuario inactivo.';
            }
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
        $stmt->close();
        $conn->close();
    } else {
        $error = 'Complete todos los campos.';
    }
    if ($error !== '') {
        header('Location: ../vista/login.php?error=' . urlencode($error) . '&usuario=' . urlencode($usuario));
        exit();
    }
}
?>
