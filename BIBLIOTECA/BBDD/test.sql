-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2024 a las 18:29:55
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS `biblioteca`;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `DNI` varchar(9) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDO` varchar(30) NOT NULL,
  `DIRECCION` varchar(40) NOT NULL,
  PRIMARY KEY (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `CODIGO` int(11) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(40) NOT NULL,
  `AUTOR` varchar(40) NOT NULL,
  PRIMARY KEY (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestar`
--

CREATE TABLE `prestar` (
  `DNI_USUARIO` varchar(9) NOT NULL,
  `CODIGO_LIBRO` int(11) NOT NULL,
  `FECHA_ENTREGA` date NOT NULL,
  PRIMARY KEY (`DNI_USUARIO`, `CODIGO_LIBRO`, `FECHA_ENTREGA`),
  KEY `FK_DNI_USUARIO` (`DNI_USUARIO`),
  KEY `FK_COD_LIBRO` (`CODIGO_LIBRO`),
  CONSTRAINT `prestar_ibfk_1` FOREIGN KEY (`CODIGO_LIBRO`) REFERENCES `libro` (`CODIGO`) ON DELETE CASCADE,
  CONSTRAINT `prestar_ibfk_2` FOREIGN KEY (`DNI_USUARIO`) REFERENCES `usuario` (`DNI`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
