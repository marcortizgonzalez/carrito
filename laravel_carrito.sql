-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2022 a las 17:28:35
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel_carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_camiseta`
--

CREATE TABLE `tbl_camiseta` (
  `id` int(11) NOT NULL,
  `nombre_cami` varchar(50) NOT NULL,
  `precio_cami` int(3) NOT NULL,
  `talla_cami` enum('XS','S','M','L','XL') DEFAULT NULL,
  `foto_cami` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_camiseta`
--

INSERT INTO `tbl_camiseta` (`id`, `nombre_cami`, `precio_cami`, `talla_cami`, `foto_cami`) VALUES
(1, 'Camiseta de fútbol \'FC Barcelona 21-22 3rd\'', 19, '', 'uploads/barcelona3.png'),
(3, 'Camiseta de fútbol \'FC Barcelona 21-22 3rd\'', 19, '', 'uploads/barcelona3.png'),
(4, 'Camiseta de fútbol \'FC Barcelona 21-2sdasd2 3rd\'', 18, '', 'uploads/barcelona3.png'),
(5, 'Camiseta de fútbol \'FC Barcelona 21dsfs-2sdasd2 3r', 22, '', 'uploads/barcelona3.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL,
  `nombre_usu` varchar(30) NOT NULL,
  `correo_usu` varchar(50) NOT NULL,
  `pass_usu` varchar(10) NOT NULL,
  `rol_usu` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id`, `nombre_usu`, `correo_usu`, `pass_usu`, `rol_usu`) VALUES
(1, 'Admin', 'admin@admin.com', '1234', 'admin'),
(2, 'Marc', 'marc@carrito.com', '1234', 'usuario'),
(3, 'Ivan', 'ivan@carrito.com', '1234', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_camiseta`
--
ALTER TABLE `tbl_camiseta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_camiseta`
--
ALTER TABLE `tbl_camiseta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
