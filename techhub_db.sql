-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 28-04-2026 a las 00:00:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `techhub_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_orden`
--

CREATE TABLE `detalles_orden` (
  `id` int(11) NOT NULL,
  `orden_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `codigo_orden` varchar(50) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `usuario_id`, `codigo_orden`, `fecha`, `total`) VALUES
(1, 1, 'TH-6559-0F6D', '2026-04-27 21:45:22', 140000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`) VALUES
(1, 'MacBook Air M2', NULL, 1200000, 25, 'macbook.jpg'),
(2, 'Mouse Gamer RGB', NULL, 45000, 50, 'mouse.jpg'),
(3, 'Hatsune Miku V6', NULL, 70000, 46, 'miku.jpg'),
(4, 'Teclado Mecánico RGB Pink', NULL, 45990, 50, 'teclado.jpg'),
(5, 'Silla Gamer Orejas de Conejo', NULL, 189990, 50, 'silla.jpg'),
(6, 'Set de Keycaps Corazón', NULL, 15000, 50, 'keycaps.jpg'),
(7, 'Cámara Web Kawaii 4K', NULL, 32000, 50, 'webcam.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `rol` enum('admin','cliente') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `direccion`, `rol`) VALUES
(1, 'ale', 'alejandraacevedo9107@gmail.com', '$2y$10$DT4jCIVgc9NGyExVPVe4KOO5ajX/ySmFT/2d76fOZ81cbx634UKgu', NULL, 'cliente'),
(2, 'kawaii', 'kawaii@gmail.com', '$2y$10$joEAXHjYkf29gvtFiLyUXeroAngFDNdUi8M9MnqE6MNX9QdQSn2Ya', NULL, 'cliente'),
(3, 'holi', 'holi@gmail.com', '$2y$10$wBSQ36LlL5nZUozRfr6yruQZu8CalhwjM3mBR2m4aY.3WY94JkArm', NULL, 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_orden`
--
ALTER TABLE `detalles_orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_id` (`orden_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_orden`
--
ALTER TABLE `detalles_orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_orden`
--
ALTER TABLE `detalles_orden`
  ADD CONSTRAINT `detalles_orden_ibfk_1` FOREIGN KEY (`orden_id`) REFERENCES `ordenes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalles_orden_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
