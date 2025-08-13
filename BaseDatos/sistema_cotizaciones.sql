-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-08-2025 a las 01:42:04
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_cotizaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `direccion`, `estado`, `creado_at`) VALUES
(1, 'Santiago', 'Alvarado', '0101010101', '0991010101', 'santiago.alvarado@example.com', 'Av. Siempre Viva 742', 'activo', '2025-08-10 00:31:25'),
(2, 'Camila', 'Bravo', '0101010102', '0991010102', 'camila.bravo@example.com', 'Calle Falsa 123', 'activo', '2025-08-10 00:31:25'),
(3, 'Mateo', 'Castro', '0101010103', '0991010103', 'mateo.castro@example.com', 'Av. Central 456', 'activo', '2025-08-10 00:31:25'),
(4, 'Valentina', 'Díaz', '0101010104', '0991010104', 'valentina.diaz@example.com', 'Calle Luna 789', 'activo', '2025-08-10 00:31:25'),
(5, 'Lucas', 'Espinoza', '0101010105', '0991010105', 'lucas.espinoza@example.com', 'Av. Sol 321', 'activo', '2025-08-10 00:31:25'),
(6, 'Isabella', 'Fernández', '0101010106', '0991010106', 'isabella.fernandez@example.com', 'Calle Estrella 654', 'activo', '2025-08-10 00:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idCotizacion` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha_emision` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `notas` text,
  `estado` enum('borrador','enviada','aceptada','rechazada') DEFAULT 'borrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idCotizacion`, `idProducto`, `idCliente`, `idUsuario`, `fecha_emision`, `notas`, `estado`) VALUES
(1, 2, 1, 1, '2025-08-10 00:31:25', 'Cotización para equipo completo', 'borrador'),
(2, 2, 2, 2, '2025-08-10 00:31:25', 'Oferta especial para cliente VIP', 'enviada'),
(3, 2, 3, 3, '2025-08-10 00:31:25', 'Cotización válida 30 días', 'aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion_detalle`
--

CREATE TABLE `cotizacion_detalle` (
  `idDetalle` int(11) NOT NULL,
  `idCotizacion` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idProductoDetalle` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(15,2) NOT NULL,
  `precio_total` decimal(15,2) NOT NULL,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cotizacion_detalle`
--

INSERT INTO `cotizacion_detalle` (`idDetalle`, `idCotizacion`, `idProducto`, `idProveedor`, `idProductoDetalle`, `cantidad`, `precio_unitario`, `precio_total`, `observaciones`) VALUES
(1, 1, 1, 1, 1, 2, '1200.50', '2401.00', 'Incluye envío gratuito'),
(2, 2, 2, 2, 2, 1, '180.00', '180.00', ''),
(3, 3, 3, 3, 3, 5, '85.75', '428.75', 'Descuento por volumen aplicado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `estado`, `creado_at`) VALUES
(1, 'Juan', 'Pérez', '1755368753', '0991234567', 'juan.perez@example.com', 'activo', '2025-08-10 00:31:25'),
(2, 'María', 'González', '0102030406', '0992345678', 'maria.gonzalez@example.com', 'activo', '2025-08-10 00:31:25'),
(3, 'Carlos', 'Rodríguez', '0102030407', '0993456789', 'carlos.rodriguez@example.com', 'activo', '2025-08-10 00:31:25'),
(4, 'Ana', 'López', '0102030408', '0994567890', 'ana.lopez@example.com', 'activo', '2025-08-10 00:31:25'),
(26, 'jose', 'leiton', '1720020112', '0979357401', 'jileit@hotmail.com', 'activo', '2025-08-12 22:24:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text,
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `descripcion`, `creado_at`, `estado`) VALUES
(1, 'Laptop Gamer XYZ', 'Laptop con procesador i7, 16GB RAM, SSD 512GB', '2025-08-10 00:31:25', 'activo'),
(2, 'Monitor 24\" FullHD', 'Monitor LED de 24 pulgadas con resolución FullHD', '2025-08-10 00:31:25', 'activo'),
(3, 'Teclado Mecánico RGB', 'Teclado con switches mecánicos y retroiluminación RGB', '2025-08-10 00:31:25', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_detalle`
--

CREATE TABLE `producto_detalle` (
  `idDetalle` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `precio_unitario` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `cantidad` int(11) DEFAULT '1',
  `moneda` varchar(10) DEFAULT 'USD',
  `descuento_volumen` decimal(5,2) DEFAULT '0.00',
  `descuento_promocional` decimal(5,2) DEFAULT '0.00',
  `impuestos_incluidos` tinyint(1) DEFAULT '1',
  `costo_envio` decimal(12,2) DEFAULT '0.00',
  `costo_instalacion` decimal(12,2) DEFAULT '0.00',
  `tiempo_entrega_dias` int(11) DEFAULT NULL,
  `lugar_entrega` varchar(100) DEFAULT NULL,
  `disponibilidad_inmediata` tinyint(1) DEFAULT '0',
  `capacidad_suministro_mensual` int(11) DEFAULT NULL,
  `metodo_transporte` varchar(100) DEFAULT NULL,
  `entregas_parciales` tinyint(1) DEFAULT '1',
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `colores_disponibles` varchar(200) DEFAULT NULL,
  `tamano_dimensiones` varchar(100) DEFAULT NULL,
  `peso` varchar(50) DEFAULT NULL,
  `material` varchar(100) DEFAULT NULL,
  `pais_origen` varchar(100) DEFAULT NULL,
  `certificaciones` varchar(255) DEFAULT NULL,
  `garantia_mes` int(11) DEFAULT NULL,
  `durabilidad_estimada` varchar(100) DEFAULT NULL,
  `cumplimiento_normas` varchar(255) DEFAULT NULL,
  `condiciones_pago` varchar(100) DEFAULT NULL,
  `penalizaciones_retraso` varchar(255) DEFAULT NULL,
  `devolucion` tinyint(1) DEFAULT '0',
  `soporte_postventa` tinyint(1) DEFAULT '0',
  `servicio_tecnico_incluido` tinyint(1) DEFAULT '0',
  `capacitacion_incluida` tinyint(1) DEFAULT '0',
  `observaciones` text,
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto_detalle`
--

INSERT INTO `producto_detalle` (`idDetalle`, `idProducto`, `idProveedor`, `precio_unitario`, `cantidad`, `moneda`, `descuento_volumen`, `descuento_promocional`, `impuestos_incluidos`, `costo_envio`, `costo_instalacion`, `tiempo_entrega_dias`, `lugar_entrega`, `disponibilidad_inmediata`, `capacidad_suministro_mensual`, `metodo_transporte`, `entregas_parciales`, `marca`, `modelo`, `colores_disponibles`, `tamano_dimensiones`, `peso`, `material`, `pais_origen`, `certificaciones`, `garantia_mes`, `durabilidad_estimada`, `cumplimiento_normas`, `condiciones_pago`, `penalizaciones_retraso`, `devolucion`, `soporte_postventa`, `servicio_tecnico_incluido`, `capacitacion_incluida`, `observaciones`, `creado_at`) VALUES
(1, 1, 1, '1200.5000', 10, 'USD', '5.00', '2.00', 1, '15.00', '0.00', 7, 'Almacén Central', 1, 100, 'Camión', 1, 'BrandA', 'XYZ-1000', 'Negro, Rojo', '35x25x2 cm', '2kg', 'Plástico y metal', 'China', 'ISO9001', 24, '3 años', 'Norma CE', '30 días', 'Multa 5%', 1, 1, 1, 0, 'Garantía extendida opcional', '2025-08-10 00:31:25'),
(2, 2, 2, '180.0000', 20, 'USD', '3.00', '0.00', 1, '5.00', '0.00', 5, 'Sucursal Norte', 1, 200, 'Camión', 1, 'BrandB', 'M24FHD', 'Negro', '55x35x5 cm', '3kg', 'Plástico', 'Taiwán', 'ISO14001', 12, '2 años', 'Norma FCC', 'Contado', 'Sin penalizaciones', 0, 1, 0, 1, '', '2025-08-10 00:31:25'),
(3, 3, 3, '85.7500', 50, 'USD', '7.00', '3.00', 1, '0.00', '0.00', 3, 'Almacén Central', 1, 500, 'DHL', 1, 'BrandC', 'MK-RGB', 'RGB', '45x15x5 cm', '0.8kg', 'Plástico', 'Corea', 'CE, RoHS', 18, '5 años', 'Norma FCC', '30 días', 'Multa 3%', 1, 1, 1, 0, 'Incluye manual de usuario', '2025-08-10 00:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `ruc` varchar(50) DEFAULT NULL,
  `nombre_empresa` varchar(200) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `ruc`, `nombre_empresa`, `telefono`, `correo`, `direccion`, `estado`, `creado_at`) VALUES
(1, '1234567890001', 'Proveedor Uno S.A.', '0991111111', 'contacto@proveedor1.com', 'Av. Principal 123', 'activo', '2025-08-10 00:31:25'),
(2, '2234567890002', 'Proveedor Dos Ltda.', '0992222222', 'contacto@proveedor2.com', 'Calle Secundaria 45', 'activo', '2025-08-10 00:31:25'),
(3, '3234567890003', 'Proveedor Tres', '0993333333', 'ventas@proveedortres.com', 'Av. Central 789', 'activo', '2025-08-10 00:31:25'),
(4, '4234567890004', 'Proveedor Cuatro', '0994444444', 'info@proveedor4.com', 'Calle 10 #20-30', 'activo', '2025-08-10 00:31:25'),
(5, '5234567890005', 'Proveedor Cinco', '0995555555', 'ventas@proveedor5.com', 'Av. Las Flores 100', 'activo', '2025-08-10 00:31:25'),
(6, '6234567890006', 'Proveedor Seis', '0996666666', 'contacto@proveedor6.com', 'Calle Los Pinos 77', 'activo', '2025-08-10 00:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `permisos` json DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`, `permisos`, `estado`, `creado_at`) VALUES
(1, 'Administrador', '[\"roles\", \"empleados\", \"usuarios\"]', 'activo', '2025-08-10 00:31:25'),
(2, 'Bodeguero', '[\"productos\", \"detalleProductos\"]', 'activo', '2025-08-10 00:31:25'),
(3, 'Gestor de proveedores', '[\"detalleProductos\", \"clientes\"]', 'activo', '2025-08-10 00:31:25'),
(4, 'Gestor de Ventas', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 1}', 'activo', '2025-08-10 00:31:25'),
(5, 'Auditor', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 0}', 'activo', '2025-08-10 00:31:25'),
(6, 'Contador', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 1}', 'activo', '2025-08-10 00:31:25'),
(37, 'JoseRol', '[\"dashboard\", \"auditoria\", \"roles\", \"usuarios\", \"proveedores\", \"empleados\", \"clientes\", \"productos\", \"detalleProductos\", \"cotizaciones\", \"generarCotizacion\"]', 'activo', '2025-08-12 22:24:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `idRol` int(11) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idEmpleado`, `usuario`, `password_hash`, `idRol`, `estado`, `creado_at`) VALUES
(1, 1, 'administrador@sistema.com', '$2y$10$jzdGjJ5zwCPqlg.Ul/PhzO3mFw27slkKzuK6Ud.QN4kbk.2NJGR7W', 1, 'activo', '2025-08-10 00:31:25'),
(2, 2, 'maria.gonzalez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 2, 'activo', '2025-08-10 00:31:25'),
(3, 3, 'carlos.rodriguez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 3, 'activo', '2025-08-10 00:31:25'),
(4, 4, 'ana.lopez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 4, 'activo', '2025-08-10 00:31:25'),
(5, 2, 'luis.martinez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 5, 'activo', '2025-08-10 00:31:25'),
(6, 3, 'sofia.hernandez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 6, 'activo', '2025-08-10 00:31:25'),
(30, 26, 'jileit@hotmail.com', '$2y$10$S2o9EJYuXopw/WDVzbYWhe/2CaztNVdwr1q0gtlqu/vWEwY4JLEuG', 37, 'activo', '2025-08-12 22:25:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idCotizacion`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `cotizacion_detalle`
--
ALTER TABLE `cotizacion_detalle`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `idCotizacion` (`idCotizacion`),
  ADD KEY `cotizacion_detalle_ibfk_2_idx` (`idProducto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`),
  ADD UNIQUE KEY `ruc` (`ruc`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `idEmpleado` (`idEmpleado`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `idCotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cotizacion_detalle`
--
ALTER TABLE `cotizacion_detalle`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cotizacion_detalle`
--
ALTER TABLE `cotizacion_detalle`
  ADD CONSTRAINT `cotizacion_detalle_ibfk_1` FOREIGN KEY (`idCotizacion`) REFERENCES `cotizacion` (`idCotizacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `cotizacion_detalle_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  ADD CONSTRAINT `producto_detalle_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_detalle_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
