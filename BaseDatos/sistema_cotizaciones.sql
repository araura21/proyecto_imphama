-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-08-2025 a las 14:35:41
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
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `direccion`, `creado_at`) VALUES
(1, 'Santiago', 'Alvarado', '0101010101', '0991010101', 'santiago.alvarado@example.com', 'Av. Siempre Viva 742', '2025-08-10 00:31:25'),
(2, 'Camila', 'Bravo', '0101010102', '0991010102', 'camila.bravo@example.com', 'Calle Falsa 123', '2025-08-10 00:31:25'),
(3, 'Mateo', 'Castro', '0101010103', '0991010103', 'mateo.castro@example.com', 'Av. Central 456', '2025-08-10 00:31:25'),
(4, 'Valentina', 'Díaz', '0101010104', '0991010104', 'valentina.diaz@example.com', 'Calle Luna 789', '2025-08-10 00:31:25'),
(5, 'Lucas', 'Espinoza', '0101010105', '0991010105', 'lucas.espinoza@example.com', 'Av. Sol 321', '2025-08-10 00:31:25'),
(6, 'Isabella', 'Fernández', '0101010106', '0991010106', 'isabella.fernandez@example.com', 'Calle Estrella 654', '2025-08-10 00:31:25'),
(7, 'Tomás', 'García', '0101010107', '0991010107', 'tomas.garcia@example.com', 'Av. Mar 987', '2025-08-10 00:31:25'),
(8, 'Martina', 'Hernández', '0101010108', '0991010108', 'martina.hernandez@example.com', 'Calle Río 147', '2025-08-10 00:31:25'),
(9, 'Diego', 'Ibarra', '0101010109', '0991010109', 'diego.ibarra@example.com', 'Av. Lago 258', '2025-08-10 00:31:25'),
(10, 'Lucía', 'Jiménez', '0101010110', '0991010110', 'lucia.jimenez@example.com', 'Calle Monte 369', '2025-08-10 00:31:25'),
(11, 'Sebastián', 'Klein', '0101010111', '0991010111', 'sebastian.klein@example.com', 'Av. Valle 101', '2025-08-10 00:31:25'),
(12, 'Mía', 'López', '0101010112', '0991010112', 'mia.lopez@example.com', 'Calle Pino 202', '2025-08-10 00:31:25'),
(13, 'Julián', 'Morales', '0101010113', '0991010113', 'julian.morales@example.com', 'Av. Selva 303', '2025-08-10 00:31:25'),
(14, 'Sofía', 'Núñez', '0101010114', '0991010114', 'sofia.nunez@example.com', 'Calle Prado 404', '2025-08-10 00:31:25'),
(15, 'Gabriel', 'Ortiz', '0101010115', '0991010115', 'gabriel.ortiz@example.com', 'Av. Río 505', '2025-08-10 00:31:25'),
(16, 'Emma', 'Pérez', '0101010116', '0991010116', 'emma.perez@example.com', 'Calle Palma 606', '2025-08-10 00:31:25'),
(17, 'Martín', 'Quintero', '0101010117', '0991010117', 'martin.quintero@example.com', 'Av. Cielo 707', '2025-08-10 00:31:25'),
(18, 'Natalia', 'Ramírez', '0101010118', '0991010118', 'natalia.ramirez@example.com', 'Calle Lago 808', '2025-08-10 00:31:25'),
(19, 'Jorge', 'Santos', '0101010119', '0991010119', 'jorge.santos@example.com', 'Av. Nieve 909', '2025-08-10 00:31:25'),
(20, 'Camila', 'Torres', '0101010120', '0991010120', 'camila.torres@example.com', 'Calle Sol 010', '2025-08-10 00:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idCotizacion` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha_emision` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `notas` text,
  `total` decimal(15,2) DEFAULT '0.00',
  `estado` enum('borrador','enviada','aceptada','rechazada') DEFAULT 'borrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idCotizacion`, `idCliente`, `idUsuario`, `fecha_emision`, `notas`, `total`, `estado`) VALUES
(1, 1, 1, '2025-08-10 00:31:25', 'Cotización para equipo completo', '4500.00', 'borrador'),
(2, 2, 2, '2025-08-10 00:31:25', 'Oferta especial para cliente VIP', '1230.50', 'enviada'),
(3, 3, 3, '2025-08-10 00:31:25', 'Cotización válida 30 días', '6789.99', 'aceptada'),
(4, 4, 4, '2025-08-10 00:31:25', 'Incluye instalación y soporte', '2345.00', 'rechazada'),
(5, 5, 5, '2025-08-10 00:31:25', 'Precios sujetos a cambio', '789.90', 'borrador'),
(6, 6, 6, '2025-08-10 00:31:25', 'Descuento aplicado', '3420.00', 'enviada'),
(7, 7, 7, '2025-08-10 00:31:25', 'Entrega urgente', '1560.25', 'aceptada'),
(8, 8, 8, '2025-08-10 00:31:25', 'Cotización para empresa', '9999.99', 'rechazada'),
(9, 9, 9, '2025-08-10 00:31:25', 'Plan de pagos disponible', '1200.00', 'borrador'),
(10, 10, 10, '2025-08-10 00:31:25', 'Precio especial por volumen', '5400.50', 'enviada'),
(11, 11, 11, '2025-08-10 00:31:25', 'Oferta válida hasta fin de mes', '890.00', 'aceptada'),
(12, 12, 12, '2025-08-10 00:31:25', 'Incluye garantía extendida', '3210.75', 'rechazada'),
(13, 13, 13, '2025-08-10 00:31:25', 'Precios competitivos', '450.60', 'borrador'),
(14, 14, 14, '2025-08-10 00:31:25', 'Atención personalizada', '2700.00', 'enviada'),
(15, 15, 15, '2025-08-10 00:31:25', 'Servicio postventa incluido', '3300.99', 'aceptada'),
(16, 16, 16, '2025-08-10 00:31:25', 'Financiamiento aprobado', '7500.00', 'rechazada'),
(17, 17, 17, '2025-08-10 00:31:25', 'Descuentos por temporada', '4200.20', 'borrador'),
(18, 18, 18, '2025-08-10 00:31:25', 'Incluye instalación', '1399.99', 'enviada'),
(19, 19, 19, '2025-08-10 00:31:25', 'Entrega programada', '2300.00', 'aceptada'),
(20, 20, 20, '2025-08-10 00:31:25', 'Garantía limitada', '1100.00', 'rechazada');

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
(3, 3, 3, 3, 3, 5, '85.75', '428.75', 'Descuento por volumen aplicado'),
(4, 4, 4, 4, 4, 3, '25.00', '75.00', ''),
(5, 5, 5, 5, 5, 1, '150.00', '150.00', ''),
(6, 6, 6, 6, 6, 4, '80.00', '320.00', ''),
(7, 7, 7, 7, 7, 10, '95.00', '950.00', ''),
(8, 8, 8, 8, 8, 8, '45.00', '360.00', ''),
(9, 9, 9, 9, 9, 1, '600.00', '600.00', ''),
(10, 10, 10, 10, 10, 2, '230.00', '460.00', ''),
(11, 11, 11, 11, 11, 1, '350.00', '350.00', ''),
(12, 12, 12, 12, 12, 3, '60.00', '180.00', ''),
(13, 13, 13, 13, 13, 2, '110.00', '220.00', ''),
(14, 14, 14, 14, 14, 5, '70.00', '350.00', ''),
(15, 15, 15, 15, 15, 1, '80.00', '80.00', ''),
(16, 16, 16, 16, 16, 4, '300.00', '1200.00', ''),
(17, 17, 17, 17, 17, 2, '250.00', '500.00', ''),
(18, 18, 18, 18, 18, 7, '40.00', '280.00', ''),
(19, 19, 19, 19, 19, 3, '500.00', '1500.00', 'Urgente'),
(20, 20, 20, 20, 20, 1, '1000.00', '1000.00', '');

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
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `creado_at`) VALUES
(1, 'Juan', 'Pérez', '0102030405', '0991234567', 'juan.perez@example.com', '2025-08-10 00:31:25'),
(2, 'María', 'González', '0102030406', '0992345678', 'maria.gonzalez@example.com', '2025-08-10 00:31:25'),
(3, 'Carlos', 'Rodríguez', '0102030407', '0993456789', 'carlos.rodriguez@example.com', '2025-08-10 00:31:25'),
(4, 'Ana', 'López', '0102030408', '0994567890', 'ana.lopez@example.com', '2025-08-10 00:31:25'),
(5, 'Luis', 'Martínez', '0102030409', '0995678901', 'luis.martinez@example.com', '2025-08-10 00:31:25'),
(6, 'Sofía', 'Hernández', '0102030410', '0996789012', 'sofia.hernandez@example.com', '2025-08-10 00:31:25'),
(7, 'Pedro', 'Ramírez', '0102030411', '0997890123', 'pedro.ramirez@example.com', '2025-08-10 00:31:25'),
(8, 'Laura', 'Torres', '0102030412', '0998901234', 'laura.torres@example.com', '2025-08-10 00:31:25'),
(9, 'Diego', 'Flores', '0102030413', '0999012345', 'diego.flores@example.com', '2025-08-10 00:31:25'),
(10, 'Elena', 'Vargas', '0102030414', '0990123456', 'elena.vargas@example.com', '2025-08-10 00:31:25'),
(11, 'José', 'Morales', '0102030415', '0981234567', 'jose.morales@example.com', '2025-08-10 00:31:25'),
(12, 'Marta', 'Castillo', '0102030416', '0982345678', 'marta.castillo@example.com', '2025-08-10 00:31:25'),
(13, 'Andrés', 'Sánchez', '0102030417', '0983456789', 'andres.sanchez@example.com', '2025-08-10 00:31:25'),
(14, 'Gabriela', 'Ramírez', '0102030418', '0984567890', 'gabriela.ramirez@example.com', '2025-08-10 00:31:25'),
(15, 'Ricardo', 'Mendoza', '0102030419', '0985678901', 'ricardo.mendoza@example.com', '2025-08-10 00:31:25'),
(16, 'Natalia', 'Cruz', '0102030420', '0986789012', 'natalia.cruz@example.com', '2025-08-10 00:31:25'),
(17, 'Fernando', 'Gómez', '0102030421', '0987890123', 'fernando.gomez@example.com', '2025-08-10 00:31:25'),
(18, 'Patricia', 'Rojas', '0102030422', '0988901234', 'patricia.rojas@example.com', '2025-08-10 00:31:25'),
(19, 'Samuel', 'Paredes', '0102030423', '0989012345', 'samuel.paredes@example.com', '2025-08-10 00:31:25'),
(20, 'Verónica', 'Silva', '0102030424', '0980123456', 'veronica.silva@example.com', '2025-08-10 00:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text,
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `descripcion`, `creado_at`) VALUES
(1, 'Laptop Gamer XYZ', 'Laptop con procesador i7, 16GB RAM, SSD 512GB', '2025-08-10 00:31:25'),
(2, 'Monitor 24\" FullHD', 'Monitor LED de 24 pulgadas con resolución FullHD', '2025-08-10 00:31:25'),
(3, 'Teclado Mecánico RGB', 'Teclado con switches mecánicos y retroiluminación RGB', '2025-08-10 00:31:25'),
(4, 'Mouse Óptico USB', 'Mouse ergonómico con sensor óptico de alta precisión', '2025-08-10 00:31:25'),
(5, 'Impresora Láser', 'Impresora láser monocromática, velocidad 20ppm', '2025-08-10 00:31:25'),
(6, 'Router WiFi AC1200', 'Router inalámbrico con doble banda AC1200', '2025-08-10 00:31:25'),
(7, 'Disco Duro Externo 1TB', 'Disco duro portátil USB 3.0, 1TB de capacidad', '2025-08-10 00:31:25'),
(8, 'Memoria RAM DDR4 8GB', 'Módulo de memoria RAM DDR4, 8GB', '2025-08-10 00:31:25'),
(9, 'Smartphone Android 11', 'Teléfono inteligente con Android 11 y cámara 48MP', '2025-08-10 00:31:25'),
(10, 'Tablet 10\" 64GB', 'Tablet de 10 pulgadas con 64GB de almacenamiento', '2025-08-10 00:31:25'),
(11, 'Monitor Curvo 27\"', 'Monitor curvo de 27 pulgadas, resolución QHD', '2025-08-10 00:31:25'),
(12, 'Cámara Web HD', 'Cámara web con resolución HD para videollamadas', '2025-08-10 00:31:25'),
(13, 'Auriculares Bluetooth', 'Auriculares inalámbricos con Bluetooth 5.0', '2025-08-10 00:31:25'),
(14, 'Fuente de Poder 600W', 'Fuente de poder certificada 80 Plus Bronze', '2025-08-10 00:31:25'),
(15, 'Gabinete ATX', 'Gabinete para PC con ventilación frontal', '2025-08-10 00:31:25'),
(16, 'Tarjeta Gráfica GTX 1660', 'Tarjeta gráfica NVIDIA GTX 1660 6GB', '2025-08-10 00:31:25'),
(17, 'Procesador AMD Ryzen 5', 'Procesador AMD Ryzen 5 5600X, 6 núcleos', '2025-08-10 00:31:25'),
(18, 'Monitor 4K UHD 32\"', 'Monitor 32 pulgadas 4K UHD', '2025-08-10 00:31:25'),
(19, 'Teclado Inalámbrico', 'Teclado inalámbrico compacto con Bluetooth', '2025-08-10 00:31:25'),
(20, 'Mousepad Gamer XL', 'Mousepad extra grande con superficie texturizada', '2025-08-10 00:31:25');

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
(3, 3, 3, '85.7500', 50, 'USD', '7.00', '3.00', 1, '0.00', '0.00', 3, 'Almacén Central', 1, 500, 'DHL', 1, 'BrandC', 'MK-RGB', 'RGB', '45x15x5 cm', '0.8kg', 'Plástico', 'Corea', 'CE, RoHS', 18, '5 años', 'Norma FCC', '30 días', 'Multa 3%', 1, 1, 1, 0, 'Incluye manual de usuario', '2025-08-10 00:31:25'),
(4, 4, 4, '25.0000', 100, 'USD', '0.00', '1.00', 1, '0.00', '0.00', 2, 'Almacén Secundario', 1, 1000, 'Camión', 1, 'BrandD', 'MOP-100', 'Negro', '12x7x4 cm', '0.15kg', 'Plástico', 'China', 'ISO9001', 6, '1 año', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 0, 0, '', '2025-08-10 00:31:25'),
(5, 5, 5, '150.0000', 15, 'USD', '0.00', '5.00', 1, '20.00', '0.00', 10, 'Almacén Principal', 1, 150, 'Camión', 1, 'BrandE', 'IL-200', 'Blanco', '30x25x20 cm', '4kg', 'Metal', 'Japón', 'ISO9001', 12, '3 años', 'Norma FCC', '30 días', 'Multa 7%', 1, 1, 1, 1, 'Garantía extendida', '2025-08-10 00:31:25'),
(6, 6, 6, '80.0000', 30, 'USD', '10.00', '0.00', 1, '7.00', '0.00', 4, 'Sucursal Sur', 1, 250, 'Paquetería', 1, 'BrandF', 'RT-AC1200', 'Negro', '20x15x8 cm', '0.7kg', 'Plástico', 'Taiwán', 'FCC', 18, '2 años', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 0, 0, '', '2025-08-10 00:31:25'),
(7, 7, 7, '95.0000', 40, 'USD', '8.00', '2.00', 1, '5.00', '0.00', 5, 'Almacén Central', 1, 300, 'Camión', 1, 'BrandG', 'HDD-1TB', 'Negro', '13x8x2 cm', '0.3kg', 'Metal', 'China', 'CE', 24, '3 años', 'Norma FCC', '30 días', 'Multa 4%', 1, 1, 1, 0, '', '2025-08-10 00:31:25'),
(8, 8, 8, '45.0000', 60, 'USD', '5.00', '1.00', 1, '0.00', '0.00', 3, 'Almacén Secundario', 1, 600, 'Paquetería', 1, 'BrandH', 'RAM-8GB', 'Negro', '13x3x0.5 cm', '0.1kg', 'Plástico', 'Corea', 'RoHS', 12, '1 año', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 0, 0, '', '2025-08-10 00:31:25'),
(9, 9, 9, '600.0000', 25, 'USD', '0.00', '0.00', 1, '10.00', '0.00', 7, 'Sucursal Norte', 1, 200, 'Camión', 1, 'BrandI', 'SP-A11', 'Negro, Azul', '16x7x1 cm', '0.4kg', 'Vidrio y plástico', 'China', 'ISO9001', 24, '5 años', 'Norma FCC', '30 días', 'Multa 5%', 1, 1, 1, 1, 'Garantía extendida', '2025-08-10 00:31:25'),
(10, 10, 10, '230.0000', 35, 'USD', '7.00', '3.00', 1, '8.00', '0.00', 6, 'Almacén Central', 1, 350, 'Paquetería', 1, 'BrandJ', 'TB-64G', 'Negro', '25x15x1 cm', '0.3kg', 'Metal y plástico', 'Taiwán', 'FCC', 18, '3 años', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 1, 0, '', '2025-08-10 00:31:25'),
(11, 11, 11, '350.0000', 10, 'USD', '0.00', '0.00', 1, '5.00', '0.00', 4, 'Sucursal Este', 1, 120, 'Camión', 1, 'BrandK', 'MC-HD', 'Negro', '10x10x10 cm', '0.25kg', 'Plástico', 'Corea', 'CE', 12, '2 años', 'Norma FCC', '30 días', 'Multa 2%', 1, 1, 0, 0, '', '2025-08-10 00:31:25'),
(12, 12, 12, '60.0000', 40, 'USD', '3.00', '0.00', 1, '3.00', '0.00', 3, 'Almacén Norte', 1, 450, 'Paquetería', 1, 'BrandL', 'WB-HD', 'Negro', '5x5x5 cm', '0.2kg', 'Metal', 'China', 'RoHS', 18, '1 año', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 1, 0, '', '2025-08-10 00:31:25'),
(13, 13, 13, '110.0000', 25, 'USD', '0.00', '5.00', 1, '7.00', '0.00', 7, 'Sucursal Oeste', 1, 300, 'Camión', 1, 'BrandM', 'AB-BT', 'Negro', '15x15x10 cm', '0.3kg', 'Plástico', 'Taiwán', 'ISO9001', 24, '3 años', 'Norma FCC', '30 días', 'Multa 4%', 1, 1, 1, 1, '', '2025-08-10 00:31:25'),
(14, 14, 14, '70.0000', 15, 'USD', '2.00', '0.00', 1, '4.00', '0.00', 4, 'Almacén Central', 1, 180, 'Paquetería', 1, 'BrandN', 'FP-600', 'Negro', '20x15x8 cm', '0.7kg', 'Metal', 'China', 'FCC', 12, '2 años', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 0, 0, '', '2025-08-10 00:31:25'),
(15, 15, 15, '80.0000', 50, 'USD', '10.00', '3.00', 1, '5.00', '0.00', 3, 'Sucursal Sur', 1, 600, 'Camión', 1, 'BrandO', 'GB-ATX', 'Negro', '50x20x40 cm', '7kg', 'Metal', 'Corea', 'CE', 36, '5 años', 'Norma FCC', '30 días', 'Multa 6%', 1, 1, 1, 1, '', '2025-08-10 00:31:25'),
(16, 16, 16, '300.0000', 20, 'USD', '0.00', '0.00', 1, '12.00', '0.00', 10, 'Almacén Principal', 1, 150, 'Camión', 1, 'BrandP', 'GTX-1660', 'Negro', '25x15x4 cm', '0.9kg', 'Plástico y metal', 'China', 'ISO9001', 24, '4 años', 'Norma CE', '30 días', 'Multa 5%', 1, 1, 1, 0, '', '2025-08-10 00:31:25'),
(17, 17, 17, '250.0000', 15, 'USD', '5.00', '1.00', 1, '7.00', '0.00', 7, 'Sucursal Norte', 1, 200, 'Paquetería', 1, 'BrandQ', 'RY-5600X', 'Negro', '10x10x5 cm', '0.5kg', 'Metal', 'Taiwán', 'FCC', 18, '3 años', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 1, 0, '', '2025-08-10 00:31:25'),
(18, 18, 18, '550.0000', 30, 'USD', '7.00', '0.00', 1, '10.00', '0.00', 5, 'Almacén Central', 1, 350, 'Camión', 1, 'BrandR', '4KUHD-32', 'Negro', '70x40x10 cm', '3.2kg', 'Plástico y metal', 'Corea', 'RoHS', 24, '5 años', 'Norma FCC', '30 días', 'Multa 5%', 1, 1, 1, 1, '', '2025-08-10 00:31:25'),
(19, 19, 19, '40.0000', 60, 'USD', '3.00', '0.00', 1, '2.00', '0.00', 3, 'Sucursal Este', 1, 500, 'Paquetería', 1, 'BrandS', 'TK-BT', 'Blanco', '30x10x2 cm', '0.6kg', 'Plástico', 'China', 'ISO9001', 12, '1 año', 'Norma CE', 'Contado', 'Sin penalizaciones', 0, 1, 0, 0, '', '2025-08-10 00:31:25'),
(20, 20, 20, '15.0000', 80, 'USD', '5.00', '1.00', 1, '1.00', '0.00', 2, 'Almacén Secundario', 1, 800, 'Camión', 1, 'BrandT', 'MP-XL', 'Negro', '80x30x0.3 cm', '0.3kg', 'Tela', 'Taiwán', 'FCC', 12, '2 años', 'Norma CE', '30 días', 'Multa 2%', 1, 1, 1, 0, '', '2025-08-10 00:31:25');

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
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `ruc`, `nombre_empresa`, `telefono`, `correo`, `direccion`, `creado_at`) VALUES
(1, '1234567890001', 'Proveedor Uno S.A.', '0991111111', 'contacto@proveedor1.com', 'Av. Principal 123', '2025-08-10 00:31:25'),
(2, '2234567890002', 'Proveedor Dos Ltda.', '0992222222', 'contacto@proveedor2.com', 'Calle Secundaria 45', '2025-08-10 00:31:25'),
(3, '3234567890003', 'Proveedor Tres', '0993333333', 'ventas@proveedortres.com', 'Av. Central 789', '2025-08-10 00:31:25'),
(4, '4234567890004', 'Proveedor Cuatro', '0994444444', 'info@proveedor4.com', 'Calle 10 #20-30', '2025-08-10 00:31:25'),
(5, '5234567890005', 'Proveedor Cinco', '0995555555', 'ventas@proveedor5.com', 'Av. Las Flores 100', '2025-08-10 00:31:25'),
(6, '6234567890006', 'Proveedor Seis', '0996666666', 'contacto@proveedor6.com', 'Calle Los Pinos 77', '2025-08-10 00:31:25'),
(7, '7234567890007', 'Proveedor Siete', '0997777777', 'info@proveedor7.com', 'Av. El Sol 11', '2025-08-10 00:31:25'),
(8, '8234567890008', 'Proveedor Ocho', '0998888888', 'ventas@proveedor8.com', 'Calle Las Rosas 45', '2025-08-10 00:31:25'),
(9, '9234567890009', 'Proveedor Nueve', '0999999999', 'contacto@proveedor9.com', 'Av. Los Andes 88', '2025-08-10 00:31:25'),
(10, '1034567890010', 'Proveedor Diez', '0981111111', 'info@proveerdiez.com', 'Calle Principal 5', '2025-08-10 00:31:25'),
(11, '1134567890011', 'Proveedor Once', '0982222222', 'ventas@proveedonce.com', 'Av. Segunda 12', '2025-08-10 00:31:25'),
(12, '1234567890012', 'Proveedor Doce', '0983333333', 'contacto@proveerdoce.com', 'Calle Tercera 33', '2025-08-10 00:31:25'),
(13, '1334567890013', 'Proveedor Trece', '0984444444', 'info@proveertrece.com', 'Av. Cuarta 44', '2025-08-10 00:31:25'),
(14, '1434567890014', 'Proveedor Catorce', '0985555555', 'ventas@proveercatorce.com', 'Calle Quinta 55', '2025-08-10 00:31:25'),
(15, '1534567890015', 'Proveedor Quince', '0986666666', 'contacto@proveerquince.com', 'Av. Sexta 66', '2025-08-10 00:31:25'),
(16, '1634567890016', 'Proveedor Dieciseis', '0987777777', 'info@proveerdieciseis.com', 'Calle Séptima 77', '2025-08-10 00:31:25'),
(17, '1734567890017', 'Proveedor Diecisiete', '0988888888', 'ventas@proveerdieciete.com', 'Av. Octava 88', '2025-08-10 00:31:25'),
(18, '1834567890018', 'Proveedor Dieciocho', '0989999999', 'contacto@proveerdieciocho.com', 'Calle Novena 99', '2025-08-10 00:31:25'),
(19, '1934567890019', 'Proveedor Diecinueve', '0971111111', 'info@proveerdiecinueve.com', 'Av. Décima 101', '2025-08-10 00:31:25'),
(20, '2034567890020', 'Proveedor Veinte', '0972222222', 'ventas@proveerveinte.com', 'Calle Once 202', '2025-08-10 00:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `permisos` json DEFAULT NULL,
  `creado_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`, `descripcion`, `permisos`, `creado_at`) VALUES
(1, 'Administrador', 'Acceso total al sistema', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(2, 'Bodeguero', 'Gestiona productos y stock', '{\"menu_productos\": 1, \"menu_proveedores\": 0, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(3, 'Gestor de Proveedores', 'Gestiona proveedores', '{\"menu_productos\": 0, \"menu_proveedores\": 1, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(4, 'Gestor de Ventas', 'Gestiona ventas y cotizaciones', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(5, 'Auditor', 'Solo lectura de reportes', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(6, 'Contador', 'Acceso a finanzas', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(7, 'Cliente', 'Acceso limitado a cotizaciones', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(8, 'Soporte', 'Atiende soporte técnico', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(9, 'Marketing', 'Acceso a productos y promociones', '{\"menu_productos\": 1, \"menu_proveedores\": 0, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(10, 'Administrador Secundario', 'Administrador con permisos limitados', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(11, 'Gerente', 'Gestiona todo el sistema', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(12, 'Vendedor', 'Gestiona ventas y clientes', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(13, 'Logística', 'Gestiona entregas', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(14, 'Operador', 'Opera la plataforma', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(15, 'Analista', 'Analiza datos y reportes', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(16, 'Compras', 'Gestiona compras y proveedores', '{\"menu_productos\": 0, \"menu_proveedores\": 1, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(17, 'Supervisor', 'Supervisa operaciones', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(18, 'Director', 'Toma decisiones', '{\"menu_productos\": 1, \"menu_proveedores\": 1, \"menu_cotizaciones\": 1}', '2025-08-10 00:31:25'),
(19, 'Practicante', 'Acceso muy limitado', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25'),
(20, 'Invitado', 'Acceso anónimo', '{\"menu_productos\": 0, \"menu_proveedores\": 0, \"menu_cotizaciones\": 0}', '2025-08-10 00:31:25');

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
(1, 1, 'administrador@sistema.com', MD5('admin'), 1, 'activo', '2025-08-10 00:31:25'),
(2, 2, 'maria.gonzalez@example.com', '1234567', 2, 'activo', '2025-08-10 00:31:25'),
(3, 3, 'carlos.rodriguez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 3, 'activo', '2025-08-10 00:31:25'),
(4, 4, 'ana.lopez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 4, 'activo', '2025-08-10 00:31:25'),
(5, 5, 'luis.martinez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 5, 'activo', '2025-08-10 00:31:25'),
(6, 6, 'sofia.hernandez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 6, 'activo', '2025-08-10 00:31:25'),
(7, 7, 'pedro.ramirez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 7, 'activo', '2025-08-10 00:31:25'),
(8, 8, 'laura.torres@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 8, 'activo', '2025-08-10 00:31:25'),
(9, 9, 'diego.flores@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 9, 'activo', '2025-08-10 00:31:25'),
(10, 10, 'elena.vargas@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 10, 'activo', '2025-08-10 00:31:25'),
(11, 11, 'jose.morales@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 11, 'activo', '2025-08-10 00:31:25'),
(12, 12, 'marta.castillo@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 12, 'activo', '2025-08-10 00:31:25'),
(13, 13, 'andres.sanchez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 13, 'activo', '2025-08-10 00:31:25'),
(14, 14, 'gabriela.ramirez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 14, 'activo', '2025-08-10 00:31:25'),
(15, 15, 'ricardo.mendoza@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 15, 'activo', '2025-08-10 00:31:25'),
(16, 16, 'natalia.cruz@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 16, 'activo', '2025-08-10 00:31:25'),
(17, 17, 'fernando.gomez@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 17, 'activo', '2025-08-10 00:31:25'),
(18, 18, 'patricia.rojas@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 18, 'activo', '2025-08-10 00:31:25'),
(19, 19, 'samuel.paredes@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 19, 'activo', '2025-08-10 00:31:25'),
(20, 20, 'veronica.silva@example.com', 'a2d679bed5c2f57e3540f88caa01d559c26a0df07df451b9d099d0a84bd5cf05', 20, 'activo', '2025-08-10 00:31:25');

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
  ADD KEY `idUsuario` (`idUsuario`);

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
  ADD PRIMARY KEY (`idRol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

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
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
