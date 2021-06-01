-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2021 a las 21:46:23
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stocksistem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `articulo` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT '0',
  `costo` decimal(11,2) DEFAULT 0.00,
  `stockmin` int(11) DEFAULT 0,
  `cantidad` int(11) DEFAULT 0,
  `descripcion` text DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `codBarra` varchar(40) NOT NULL,
  `precioVenta` decimal(11,2) NOT NULL,
  `idEsta` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `mayoritario` decimal(11,2) NOT NULL,
  `keyTwoLabor` int(11) NOT NULL,
  `fechaVence` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`articulo`, `nombre`, `costo`, `stockmin`, `cantidad`, `descripcion`, `imagen`, `categoria`, `codBarra`, `precioVenta`, `idEsta`, `idProveedor`, `mayoritario`, `keyTwoLabor`, `fechaVence`) VALUES
(1, 'VACUNA DOG', '320.00', 10, 299, 'a', '', 19, '1', '528.00', 1, 7, '492.80', 1, NULL),
(2, 'VACUNA CAT', '320.00', 10, 200, 'B', '', 20, '2', '528.00', 1, 7, '492.80', 1, NULL),
(3, 'CREMA ARMADILLO', '22.00', 10, 111, 'D', '', 24, '3', '24.42', 1, 21, '24.42', 2, NULL),
(4, 'VACUNA ARMADILLO', '22.00', 10, 111, 'A', '', 24, '', '24.42', 1, 7, '24.42', 0, NULL),
(5, 'd', '0.00', 2, 0, 'a', '', 21, '12222222', '0.00', 1, 0, '0.00', 1, NULL),
(6, 'd', '0.00', 2, 0, 'dsa', '', 21, '123333333333333333333', '0.00', 1, 0, '0.00', 3, NULL),
(7, 'dddddddddddd', '0.00', 3, 0, 'a', '', 21, '8', '0.00', 1, 0, '0.00', 2, NULL),
(8, 'pichini', '0.00', 22, 0, 's', '', 19, '123123123123', '0.00', 1, 0, '0.00', 1, '2023-02-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombreCategoria`) VALUES
(19, 'red'),
(20, 'yellow'),
(21, 'green'),
(22, 'gray'),
(23, 'pink'),
(24, 'white'),
(25, 'black'),
(26, 'brown');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `idDetalleVenta` int(11) NOT NULL,
  `idV` int(11) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `cantidadV` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `fecha` date NOT NULL,
  `idArticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`idDetalleVenta`, `idV`, `nombreProducto`, `cantidadV`, `precio`, `fecha`, `idArticulo`) VALUES
(1, 1, 'VACUNA DOG', 1, '1360.00', '2021-05-11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `idEntrada` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nFactura` varchar(100) NOT NULL,
  `observacion` text NOT NULL,
  `idProve` int(11) NOT NULL,
  `keyLaboratorio` int(11) NOT NULL,
  `transporte` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`idEntrada`, `fecha`, `nFactura`, `observacion`, `idProve`, `keyLaboratorio`, `transporte`) VALUES
(1, '2021-05-11', '001', '', 7, 2, '300'),
(2, '2021-05-11', '2', '', 21, 3, '300'),
(3, '2021-05-11', '003', '', 25, 1, '300'),
(4, '2021-05-18', '123123', 'asd', 7, 0, '11'),
(5, '2021-05-18', 'asd', 'asd', 21, 0, '11'),
(6, '2021-05-21', '55', 'l', 21, 0, '10'),
(7, '2021-05-27', '555', '', 7, 0, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento`
--

CREATE TABLE `establecimiento` (
  `idEsta` int(11) NOT NULL,
  `nombreEsta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `establecimiento`
--

INSERT INTO `establecimiento` (`idEsta`, `nombreEsta`) VALUES
(1, 'Lauchi Danmontti');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaentrada`
--

CREATE TABLE `facturaentrada` (
  `id` int(11) NOT NULL,
  `idEntrada` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `costo` int(11) NOT NULL,
  `transporte` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturaentrada`
--

INSERT INTO `facturaentrada` (`id`, `idEntrada`, `idArticulo`, `cantidad`, `fecha`, `costo`, `transporte`) VALUES
(1, 1, 1, 100, '2021-05-11', 800, '0'),
(2, 2, 2, 100, '2021-05-11', 900, '0'),
(3, 3, 3, 100, '2021-05-11', 1000, '0'),
(4, 4, 4, 111, '2021-05-18', 22, '0'),
(5, 5, 3, 11, '2021-05-18', 22, '0'),
(6, 6, 1, 100, '2021-05-21', 1010, '0'),
(7, 7, 1, 100, '2021-05-27', 320, '0'),
(8, 7, 2, 100, '2021-05-27', 320, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorios`
--

CREATE TABLE `laboratorios` (
  `idLaboratorio` int(11) NOT NULL,
  `nombreLaboratorio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `laboratorios`
--

INSERT INTO `laboratorios` (`idLaboratorio`, `nombreLaboratorio`) VALUES
(1, 'New labor'),
(2, 'Animals secure'),
(3, 'Dr plus'),
(4, 'Red cats');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `nombreP` varchar(50) NOT NULL,
  `direccionP` varchar(50) NOT NULL,
  `telefonoP` varchar(50) NOT NULL,
  `informacionExtra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombreP`, `direccionP`, `telefonoP`, `informacionExtra`) VALUES
(7, 'DOG DOGGY', 'PERROS', '3718659852', 'DOG DOG DOG'),
(21, 'CAT CATS', 'Mateu 567', '3718563125', 'GATOS TOP'),
(25, 'ARMAZON', 'Ruta 86', '3718569253', 'ARMADILLOS YELLOW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `pass`) VALUES
(1, 'pancho', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `fechaV` date NOT NULL,
  `totalV` decimal(11,2) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idVenta`, `fechaV`, `totalV`, `idUser`) VALUES
(1, '2021-05-11', '1360.00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`articulo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`idDetalleVenta`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`idEntrada`);

--
-- Indices de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  ADD PRIMARY KEY (`idEsta`);

--
-- Indices de la tabla `facturaentrada`
--
ALTER TABLE `facturaentrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`idLaboratorio`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `idDetalleVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  MODIFY `idEsta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `facturaentrada`
--
ALTER TABLE `facturaentrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `idLaboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
