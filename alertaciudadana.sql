-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2025 a las 00:25:47
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
-- Base de datos: `alertaciudadana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `Descripcion` varchar(8000) NOT NULL,
  `Foto` varchar(100) NOT NULL,
  `tipo` int(100) NOT NULL,
  `Latitud` float NOT NULL,
  `Longitud` float NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `Descripcion`, `Foto`, `tipo`, `Latitud`, `Longitud`, `id_usuario`) VALUES
(1, 'tengo habree', '', 0, -33.226, -54.3761, 9),
(2, 'Hay maestros no megusta xd ', '1763074376_download (1).jpg', 0, -33.2228, -54.3955, 9),
(3, 'negro gaayyy', '1763077391_Yo bien insanote.jfif', 0, -33.2217, -54.3792, 8),
(4, 'problema de bache', '1763316746_download.jpg', 0, -33.2284, -54.378, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Gmail` varchar(100) NOT NULL,
  `Contrasela` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Usuario`, `Gmail`, `Contrasela`) VALUES
(3, 'Negro', 'negro1234@gmail.com', 'negro123456'),
(5, 'Jhon troño gordo', 'tronioogordo69@gmail.com', 'troño2007'),
(6, 'martin', 'tilin45@gmail.com', '123'),
(7, 'Joe Metridash', 'JoeMetriDash|@gmail.com', 'JoeMetri'),
(8, 'UwuSaurio', 'Uwuonichan123@gmail.com', 'dametupitito'),
(9, 'martin', 'trologay@gmail.com', '12345678'),
(10, 'UTU', 'martin99@gmail.com', '12345678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Gmail` (`Gmail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
