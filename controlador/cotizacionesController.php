<?php
// controlador/cotizacionesController.php

$action = isset($_GET['action']) ? $_GET['action'] : 'listar';

switch ($action) {
    case 'listar':
        include '../vista/cotizaciones.php';
        break;
    case 'agregar':
        include 'cotizaciones/agregarCotizacion.php';
        break;
    case 'editar':
        include 'cotizaciones/editarCotizacion.php';
        break;
    case 'eliminar':
        include 'cotizaciones/eliminarCotizacion.php';
        break;
    default:
        include '../vista/cotizaciones.php';
        break;
}
?>
