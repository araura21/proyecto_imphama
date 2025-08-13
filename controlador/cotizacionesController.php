<?php
// controlador/cotizacionesController.php

$action = isset($_GET['action']) ? $_GET['action'] : 'listar';

switch ($action) {
    case 'listar':
        include '../vista/cotizaciones.php';
        break;
    // Puedes agregar más acciones aquí (agregar, eliminar, editar) si lo necesitas
    default:
        include '../vista/cotizaciones.php';
        break;
}
?>
