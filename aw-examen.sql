-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2020 a las 00:46:50
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aw-examen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aux`
--

CREATE TABLE `aux` (
  `ID` int(11) NOT NULL,
  `canción` int(11) NOT NULL,
  `lreprod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aux`
--

INSERT INTO `aux` (`ID`, `canción`, `lreprod`) VALUES
(1, 8, 1),
(2, 5, 1),
(3, 1, 2),
(4, 6, 2),
(5, 7, 2),
(6, 2, 3),
(7, 3, 3),
(8, 4, 3),
(9, 8, 3),
(10, 4, 2),
(25, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `ID` int(11) NOT NULL,
  `Título` varchar(30) NOT NULL,
  `Autor` varchar(30) NOT NULL,
  `Duración` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`ID`, `Título`, `Autor`, `Duración`) VALUES
(1, 'Bailando', 'Enrique Iglesias', 220),
(2, 'Thunderstruck', 'ACDC', 250),
(3, 'Help!', 'The Beatles', 250),
(4, 'The Wall', 'Pink Floyd', 300),
(5, 'Meteora', 'Linkin Park', 300),
(6, 'El baño', 'Enrique Iglesias', 300),
(7, 'Quizás', 'Enrique Iglesias', 300),
(8, 'Heavy', 'Linkin Park', 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lreprod`
--

CREATE TABLE `lreprod` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `RutaImg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lreprod`
--

INSERT INTO `lreprod` (`ID`, `UserID`, `Nombre`, `RutaImg`) VALUES
(1, 1, 'Linkin Park', 'disco1.jpg'),
(2, 1, 'Mix', 'disco2.jpg'),
(3, 1, 'Mix Club', 'disco3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Contraseña` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre`, `Contraseña`) VALUES
(1, 'Pepe123', 123),
(2, 'Julián', 123);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aux`
--
ALTER TABLE `aux`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `canción` (`canción`),
  ADD KEY `lreprod` (`lreprod`);

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indices de la tabla `lreprod`
--
ALTER TABLE `lreprod`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aux`
--
ALTER TABLE `aux`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lreprod`
--
ALTER TABLE `lreprod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aux`
--
ALTER TABLE `aux`
  ADD CONSTRAINT `aux_ibfk_1` FOREIGN KEY (`canción`) REFERENCES `canciones` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `aux_ibfk_2` FOREIGN KEY (`lreprod`) REFERENCES `lreprod` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
