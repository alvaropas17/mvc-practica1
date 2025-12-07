-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2025 a las 16:57:48
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
-- Base de datos: `adopciones`
--
CREATE DATABASE IF NOT EXISTS `adopciones` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `adopciones`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `imagen` varchar(255) NOT NULL,
  `fecha_subida` date NOT NULL,
  `nombre_animal` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `especie` varchar(255) NOT NULL,
  `edad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `contrasenia` varchar(255) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `rol` varchar(15) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`contrasenia`, `sexo`, `rol`, `localidad`, `nombre`, `id_usuario`) VALUES
('$2y$10$bAEG6j6Y1.LyJ5SZvVxVe.JHRDw2riD0Py/eCrYpLUUIbeI3URHyi', 'Hombre', 'Admin', 'Lorca', 'jose', 1),
('$2y$10$.ElE2Lm5yuZmvJn1AAvreOkdCPYK3RFkthjijkRzooMjCq4nIQfqO', 'Hombre', 'visor', 'Jum', 'alvaro', 5),
('$2y$10$7D/I881ShpFOhPVdPtIIxuL3nS7j.PYl0MWMh0.Q8dijKKWQ284.q', 'adfbb', 'Admin', 'afadsfad', 'asdf', 6),
('$2y$10$oJgtL6cUZD9d8I2CHGYT/OhuPjUZwGIs8HZHmlhIPx0uBk8Js8Zu6', 'sfbsfb', 'editor', 'asfasdf', 'lola', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animales`
--
ALTER TABLE `animales`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
