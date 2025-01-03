-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2024 a las 19:18:40
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `catalogo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `icono` text NOT NULL DEFAULT '<i class="bi bi-box"></i>',
  `orden` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`, `icono`, `orden`, `estado`) VALUES
(1, 'Varios', '<i class=\"bi bi-box\"></i>', NULL, 1),
(2, 'Samsung', '<i class=\"bi bi-box\"></i>', NULL, 1),
(3, 'Motorola', '<i class=\"bi bi-box\"></i>', NULL, 1),
(4, 'Apple', '<i class=\"bi bi-box\"></i>', NULL, 1),
(5, 'Xiaomi', '<i class=\"bi bi-box\"></i>', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `categoria_id` int(11) NOT NULL DEFAULT 1,
  `stock_actual` int(11) NOT NULL DEFAULT 0,
  `stock_min` int(11) NOT NULL DEFAULT 0,
  `costo` decimal(10,2) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `categoria_id`, `stock_actual`, `stock_min`, `costo`, `estado`) VALUES
(1, 'S24 Ultra', 'Samsung IA\r\nTiene 12Gb RAM\r\n512GB MES', 2, 0, 0, '2000000.00', 1),
(2, 'Xiaomi Redmi Note 13 Pro', '4G Dual SIM 256 GB negro 8 GB RAM', 5, 0, 0, '427000.00', 1),
(3, 'Iphone 16 Pro Max', 'Chip A18 Pro\r\nNeural Engine de 16 núcleos\r\nApple Intelligence\r\n1 TB', 4, 0, 0, '1600000.00', 1),
(4, 'Motorola E22', 'Celular casi nuevo, poco uso\r\n4 GB\r\n64Gb\r\nFunda incluida', 3, 1, 1, '245290.00', 1),
(5, 'Iphone 13 PRO MAX', '6GB RAM\r\n256GB MEM', 4, 0, 0, '770000.00', 1),
(6, 'A35', '8Gb RAM\r\nCAMARA FRONTAL 13MP\r\nPANTALLA 6.6', 2, 0, 0, '680000.00', 1),
(7, 'Galaxy S21 FE  5G Graphite 128GB', '• Nuestra pantalla de desplazamiento más suave con Super Smooth 120Hz\r\n• Cámara frontal de 32 MP con modo Noche para tus mejores selfies, incluso cuando solo brillan las estrellas\r\n• Nuestro chip más rápido ahora en el S21 FE\r\n• Cuidamos el planeta: No incluye cargador', 2, 1, 1, '1132999.00', 1),
(8, 'Samsung A54', 'Almacenamiento= 256GB\r\nProcesador Octa-Core 2.4GHz,2GHz\r\nRAM-8 GB', 2, 2, 1, '765000.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(4) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `apellido` text NOT NULL,
  `nombre` text NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL DEFAULT -1,
  `rol_id` tinyint(4) NOT NULL DEFAULT 2,
  `ult_login` datetime DEFAULT NULL,
  `motivo_eliminacion` text NOT NULL,
  `fecha_eliminacion` datetime DEFAULT NULL,
  `imagen_perfil` varchar(255) NOT NULL DEFAULT 'fondo0.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `email`, `apellido`, `nombre`, `usuario`, `password`, `creado`, `estado`, `rol_id`, `ult_login`, `motivo_eliminacion`, `fecha_eliminacion`, `imagen_perfil`) VALUES
(1, 'dakota.basan2014@gmail.com', 'Becerraa', 'dakota', 'produccion', '1234', '2024-10-24 18:39:32', 1, 1, '2024-12-17 15:14:54', '', '2024-12-19 04:41:11', 'fondo2.png'),
(3, 'dakota@gmail.com', 'AUDISIO', 'marcelo', 'usuariodakoo', '1234', '2024-11-22 23:31:25', 1, 2, '2024-11-29 18:04:29', '', '2024-12-18 19:19:40', 'fondo0.png'),
(5, 'dakota.basan2014@gmail.com', 'bazan', 'soreiya', 'admin', '1234', '2024-12-06 01:26:41', 1, 1, '2024-12-19 15:16:18', '', '2024-12-19 19:17:58', 'fondo4.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
