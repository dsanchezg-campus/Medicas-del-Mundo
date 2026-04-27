-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2026 a las 12:36:58
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
-- Base de datos: `mdm_db`
--
CREATE DATABASE IF NOT EXISTS `mdm_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mdm_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque`
--

CREATE TABLE IF NOT EXISTS `bloque` (
  `id_bloque` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `texto` text NOT NULL,
  `orden` int(11) NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `icono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bloque`),
  KEY `fk_id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `orden` int(11) NOT NULL,
  `img_cat` varchar(255) NOT NULL,
  `id_madre` int(11) DEFAULT NULL,
  `fecha_actualizacion` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_categoria`),
  KEY `FOREIGN KEY` (`id_madre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `orden`, `img_cat`, `id_madre`, `fecha_actualizacion`) VALUES
(9, 'Paquete', 'MArcso ', 1, 'images.jfif', 10, '2026-03-20'),
(13, 'Guapeton', 'Saúl es bob y no sabe como funciona el protátil', 1, 'Gemini_Generated_Image_4w5r24w5r24w5r24.png', 10, '2026-04-22'),
(14, 'Dario', 'Deja de fumar', 2, '25cf0ae42c21b7f10ff572c3e5373e30.jpg', 11, '2007-06-22'),
(16, 'Contratos', 'Aquí aprenderas sobre contratos', 1, '69ef31e13ab91_Gemini_Generated_Image_4w5r24w5r24w5r24.png', NULL, '2026-04-27'),
(17, 'me pica la cacatua', 'abc', 1, '69ef32e0c02bb_caca gorda.jfif', NULL, '2026-04-27'),
(18, 'Perro Xanches', 'No es magia ,son tus impuestos.', 1, '69ef3348dbdd8_AAFF_CORTE_FOTOS-WEB_SIN_VOTA_600x332-582x322.png', NULL, '2026-04-27'),
(19, 'amego segarro', 'rico bocata jamon ibérico denominacion de origen cariñena', 1, '69ef33d3e517e_amego.jpg', NULL, '2026-04-27'),
(22, 'HJ', 'G', 1, '69ef3bdc7cc6b_wesley-snipes-by-nigel-parry.webp', NULL, '2026-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extra`
--

CREATE TABLE IF NOT EXISTS `extra` (
  `id_extra` int(11) NOT NULL AUTO_INCREMENT,
  `id_bloque` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `url` text NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  PRIMARY KEY (`id_extra`),
  KEY `id_bloque` (`id_bloque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `fecha_actualizacion` date NOT NULL DEFAULT current_timestamp(),
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_faq`),
  KEY `FOREIGN KEY` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'editora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` text NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `nombre`, `id_rol`) VALUES
(2, 'medica@gmail.es', '$2y$10$MzXOzF.W8JfpsCpDYsxq0OwcNPIigBbXVx6EGzpVoqYzbUtI97ZbO', 'Admin25', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bloque`
--
ALTER TABLE `bloque`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `extra`
--
ALTER TABLE `extra`
  ADD CONSTRAINT `extra_ibfk_1` FOREIGN KEY (`id_bloque`) REFERENCES `bloque` (`id_bloque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
