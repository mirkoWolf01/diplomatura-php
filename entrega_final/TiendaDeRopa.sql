-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-10-2026 a las 05:34:27
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
-- Base de datos: `TiendaDeRopa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo_producto` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` float UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo_producto`, `nombre`, `precio`, `stock`) VALUES
(1, 'Camiseta manga corta blanca básica', 25000, 325),
(1112, 'Pantalon Deportivo Corto Negro Marca Abidas', 19999, 104),
(3121, 'Jean Recto Azul Marino', 34000, 332),
(3122, 'Sombrero Vaquero Color Beige', 7999, 43),
(3123, 'Gorro de Lana Azul', 4300, 45),
(3124, 'Chaqueta de Cuero sintetico negro', 43999, 17),
(3125, 'Camisa corte en V blanca', 19999, 34),
(3126, 'Botines XTREME marca Nice color rosa chicle', 31999, 51),
(3127, 'Pantalon de Vestir recto color azul marino', 42999, 16),
(3128, 'Camiseta Argentina edicion Messi x Supercampeones Umbro', 78999, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `mail`, `contraseña`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$U3IN85zOzH.9XO3jaEH/feHriwb5.Uom7qjMxS6YzbEO7RjBNiNcu'),
(2, 'Marcelo', 'marce@gmail.com', '$2y$10$QbzHb2ux1PnERi/UweLxS.HFpZ2.fHV.oCyY9oXcAJxEBsY47jHhm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3129;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
