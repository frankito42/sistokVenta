-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2021 a las 23:33:53
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

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
  `fechaVence` date DEFAULT NULL,
  `menorCentaje` decimal(11,2) NOT NULL,
  `mayorCentaje` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`articulo`, `nombre`, `costo`, `stockmin`, `cantidad`, `descripcion`, `imagen`, `categoria`, `codBarra`, `precioVenta`, `idEsta`, `idProveedor`, `mayoritario`, `keyTwoLabor`, `fechaVence`, `menorCentaje`, `mayorCentaje`) VALUES
(1, 'VACUNA DOG', '60.00', 10, 49, 'a', '', 19, '1', '108.51', 1, 7, '99.44', 1, NULL, '20.00', '10.00'),
(2, 'VACUNA CAT', '60.00', 10, -10, 'B', '', 20, '2', '498.99', 1, 7, '461.73', 1, '2022-02-16', '0.00', '0.00'),
(3, 'CREMA ARMADILLO', '41.00', 10, 148, 'D', '', 24, '3', '194.16', 1, 7, '177.99', 2, '2021-07-10', '20.00', '10.00'),
(5, 'd', '0.00', 2, 0, 'a', '', 21, '12222222', '0.00', 1, 0, '0.00', 1, '2021-07-21', '0.00', '0.00'),
(6, 'd', '100.50', 2, 0, 'dsa', '', 21, '123333333333333333333', '432.69', 1, 7, '433.76', 3, '2021-07-16', '0.00', '0.00'),
(7, 'dddddddddddd', '0.00', 3, 0, 'a', '', 21, '8', '0.00', 1, 0, '0.00', 2, '2021-07-13', '0.00', '0.00'),
(8, 'pichini', '0.00', 22, 0, 's', '', 19, '123123123123', '0.00', 1, 0, '0.00', 1, '2021-07-05', '0.00', '0.00');

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
(1, 1, 'VACUNA DOG', 1, '1360.00', '2021-05-11', 1),
(2, 2, 'VACUNA CAT', 6, '124.50', '2021-06-17', 2),
(3, 2, 'VACUNA CAT', 2, '107.25', '2021-06-17', 2),
(4, 3, 'VACUNA CAT', 1, '107.25', '2021-06-17', 2),
(5, 3, 'VACUNA CAT', 1, '115.90', '2021-06-17', 2),
(6, 3, 'CREMA ARMADILLO', 1, '52.58', '2021-06-17', 3),
(7, 3, 'CREMA ARMADILLO', 1, '59.69', '2021-06-17', 3);

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
(3, '2021-05-11', '003', '', 25, 1, '300'),
(4, '2021-05-18', '123123', 'asd', 7, 0, '11'),
(15, '2021-08-05', 'aasd', '', 7, 0, '0'),
(16, '2021-08-05', 'aasd', '', 7, 0, '0'),
(17, '2021-08-05', 'aasd', '', 7, 0, '0'),
(18, '2021-08-05', 'asdasd', '', 7, 0, '0'),
(19, '2021-08-05', 'asdasd', '', 7, 0, '0');

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
  `costo` decimal(11,2) NOT NULL,
  `transporte` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturaentrada`
--

INSERT INTO `facturaentrada` (`id`, `idEntrada`, `idArticulo`, `cantidad`, `fecha`, `costo`, `transporte`) VALUES
(3, 3, 3, 100, '2021-05-11', '1000.00', '0.00'),
(4, 4, 4, 111, '2021-05-18', '22.00', '0.00'),
(16, 19, 3, 50, '2021-08-05', '41.00', '0.00'),
(17, 19, 1, 50, '2021-08-05', '21.00', '0.00');

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
(1, '2021-05-11', '1360.00', 1),
(2, '2021-06-17', '961.50', 1),
(3, '2021-06-17', '335.42', 1);

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
  MODIFY `idDetalleVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  MODIFY `idEsta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `facturaentrada`
--
ALTER TABLE `facturaentrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
