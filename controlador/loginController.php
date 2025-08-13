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
    $stmt = $conn->prepare('SELECT idUsuario, usuario, password_hash, estado, idRol, idEmpleado FROM usuario WHERE usuario = ? LIMIT 1');
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (($row['password_hash'] === $contrasena || password_verify($contrasena, $row['password_hash'])) && $row['estado'] === 'activo') {
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['idUsuario'] = $row['idUsuario'];
                // Obtener nombre y apellido del empleado
                if (isset($row['idEmpleado'])) {
                    $stmtEmp = $conn->prepare('SELECT nombre, apellido FROM empleado WHERE idEmpleado = ? LIMIT 1');
                    $stmtEmp->bind_param('i', $row['idEmpleado']);
                    $stmtEmp->execute();
                    $resultEmp = $stmtEmp->get_result();
                    if ($empRow = $resultEmp->fetch_assoc()) {
                        $_SESSION['nombre'] = $empRow['nombre'];
                        $_SESSION['apellido'] = $empRow['apellido'];
                    }
                    $stmtEmp->close();
                }
                // Obtener permisos del rol
                $stmtPerm = $conn->prepare('SELECT permisos FROM rol WHERE idRol = ? LIMIT 1');
                $stmtPerm->bind_param('i', $row['idRol']);
                $stmtPerm->execute();
                $resultPerm = $stmtPerm->get_result();
                if ($permRow = $resultPerm->fetch_assoc()) {
                    // Se espera que permisos sea un string tipo JSON o CSV
                    $permisos = [];
                    $permisosRaw = $permRow['permisos'];
                    if ($permisosRaw) {
                        // Si es JSON
                        $decoded = json_decode($permisosRaw, true);
                        if (is_array($decoded)) {
                            $permisos = $decoded;
                        } else {
                            // Si es CSV
                            $permisos = array_map('trim', explode(',', $permisosRaw));
                        }
                    }
                    $_SESSION['permisos'] = $permisos;
                } else {
                    $_SESSION['permisos'] = [];
                }
                $stmtPerm->close();
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
        header('Location: ../index.php?error=' . urlencode($error) . '&usuario=' . urlencode($usuario));
        exit();
    }
}
?>
