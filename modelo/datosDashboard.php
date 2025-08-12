<?php
include_once 'conexionBD.php';

class DatosDashboard {
    private $conn;

    public function __construct() {
        $db = new connectionDB();
        $this->conn = $db->connection();
    }

    public function contar($tabla) {
        $consulta = "SELECT COUNT(*) AS total FROM $tabla";
        $resultado = mysqli_query($this->conn, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['total'];
    }

    public function contarCotizacionesPorEstado($estado) {
        $consulta = "SELECT COUNT(*) AS total FROM cotizacion WHERE estado = '$estado'";
        $resultado = mysqli_query($this->conn, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['total'];
    }

    public function proveedorConMasProductos() {
        $consulta = "SELECT p.nombre_empresa, COUNT(*) as total 
                     FROM producto_detalle pd
                     JOIN proveedor p ON pd.idProveedor = p.idProveedor
                     GROUP BY pd.idProveedor
                     ORDER BY total DESC LIMIT 1";
        $resultado = mysqli_query($this->conn, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['nombre_empresa'];
    }

    public function proveedorConMenosProductos() {
        $consulta = "SELECT p.nombre_empresa, COUNT(*) as total 
                     FROM producto_detalle pd
                     JOIN proveedor p ON pd.idProveedor = p.idProveedor
                     GROUP BY pd.idProveedor
                     ORDER BY total ASC LIMIT 1";
        $resultado = mysqli_query($this->conn, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['nombre_empresa'];
    }

    public function mejorCliente() {
        $consulta = "SELECT c.nombre, c.apellido, COUNT(*) as total 
                     FROM cotizacion co
                     JOIN cliente c ON co.idCliente = c.idCliente
                     WHERE co.estado = 'aceptada'
                     GROUP BY co.idCliente
                     ORDER BY total DESC LIMIT 1";
        $resultado = mysqli_query($this->conn, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila ? $fila['nombre'] . ' ' . $fila['apellido'] : 'N/A';
    }

    public function getTotales() {
        return [
            'Roles' => $this->contar('rol'),
            'Empleados' => $this->contar('empleado'),
            'Usuarios' => $this->contar('usuario'),
            'Productos' => $this->contar('producto'),
            'Proveedores' => $this->contar('proveedor'),
            'Clientes' => $this->contar('cliente')
        ];
    }
}
?>
