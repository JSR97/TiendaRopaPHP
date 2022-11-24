-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2022 a las 18:31:02
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `corregida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `codDetallePedido` int(4) NOT NULL,
  `codPedido` int(4) NOT NULL,
  `codProd` int(4) NOT NULL,
  `unidades` int(3) NOT NULL,
  `talla` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `codDetalleVenta` int(4) NOT NULL,
  `codVenta` int(4) NOT NULL,
  `codProd` int(4) NOT NULL,
  `unidades` int(3) NOT NULL,
  `talla` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`codDetalleVenta`, `codVenta`, `codProd`, `unidades`, `talla`) VALUES
(38, 22, 2, 4, 'S'),
(39, 22, 3, 1, 'S'),
(40, 22, 1, 1, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `codFactura` int(4) NOT NULL,
  `codPedido` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `codPedido` int(4) NOT NULL,
  `codProv` int(4) NOT NULL,
  `importeTotal` decimal(5,2) NOT NULL,
  `fecha` date NOT NULL,
  `aceptado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codProd` int(4) NOT NULL,
  `pvp` decimal(5,2) NOT NULL,
  `nomProd` varchar(15) NOT NULL,
  `imagen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codProd`, `pvp`, `nomProd`, `imagen`) VALUES
(1, '55.99', 'Messi', 'imagenesTienda/messi.jpg'),
(2, '50.99', 'Cristiano', 'imagenesTienda/cristiano.jpg'),
(3, '56.99', 'Zapas', 'imagenesTienda/zapatillas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productotalla`
--

CREATE TABLE `productotalla` (
  `idTalla` int(4) NOT NULL,
  `codProd` int(4) NOT NULL,
  `stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productotalla`
--

INSERT INTO `productotalla` (`idTalla`, `codProd`, `stock`) VALUES
(1, 1, 6),
(2, 1, 9),
(3, 1, 5),
(4, 1, 5),
(1, 2, 10),
(2, 2, 5),
(3, 2, 7),
(4, 2, 10),
(1, 3, 7),
(2, 3, 6),
(3, 3, 5),
(4, 3, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `codProv` int(4) NOT NULL,
  `nomProv` varchar(16) NOT NULL,
  `numCuenta` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`codProv`, `nomProv`, `numCuenta`) VALUES
(1, 'Snipes', '1111'),
(2, 'Inditex', '1234'),
(3, 'Parisian', '1723'),
(4, 'Albanos', '9999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `idTalla` int(4) NOT NULL,
  `nomTalla` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`idTalla`, `nomTalla`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `codTicket` int(4) NOT NULL,
  `codVenta` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`codTicket`, `codVenta`) VALUES
(18, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codUser` int(4) NOT NULL,
  `user` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `numCuenta` varchar(16) NOT NULL,
  `tipoUser` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codUser`, `user`, `password`, `email`, `direccion`, `numCuenta`, `tipoUser`) VALUES
(1, 'pepe', '1234', 's.r.julio97@gmail.com', 'Calle Cristo de los Milagros', '345', 'usuario'),
(2, 'Pedro', '1234', 'Pedro@gmail.com', 'la calle', '1231213', 'Gerente'),
(3, 'yo', '12345', 'asdas@gmail.com', 'wer', '345', 'usuario'),
(8, 'camisetas', '12345', 'hhh@gmail.com', 'hhh', 'hhhh', 'usuario'),
(9, 'camis', '12345', 's.r.julio97@gmail.com', 'Calle Cristo de los Milagros', 'ES11111111111111', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `codVenta` int(4) NOT NULL,
  `codUser` int(4) NOT NULL,
  `importeTotal` decimal(5,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`codVenta`, `codUser`, `importeTotal`, `fecha`) VALUES
(22, 1, '316.94', '2022-06-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`codDetallePedido`),
  ADD KEY `codPedido` (`codPedido`),
  ADD KEY `codProd` (`codProd`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`codDetalleVenta`),
  ADD KEY `codProd` (`codProd`),
  ADD KEY `FK_VENTA` (`codVenta`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`codFactura`),
  ADD KEY `codPedido` (`codPedido`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`codPedido`),
  ADD KEY `codProv` (`codProv`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codProd`);

--
-- Indices de la tabla `productotalla`
--
ALTER TABLE `productotalla`
  ADD PRIMARY KEY (`codProd`,`idTalla`),
  ADD KEY `idTalla` (`idTalla`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`codProv`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`idTalla`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`codTicket`),
  ADD KEY `codVenta` (`codVenta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUser`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`codVenta`),
  ADD KEY `codUser` (`codUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `codDetallePedido` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `codDetalleVenta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `codFactura` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `codPedido` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codProd` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `codProv` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `idTalla` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `codTicket` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codUser` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `codVenta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`codPedido`) REFERENCES `pedido` (`codPedido`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`codProd`) REFERENCES `producto` (`codProd`);

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `FK_VENTA` FOREIGN KEY (`codVenta`) REFERENCES `venta` (`codVenta`),
  ADD CONSTRAINT `detalleventa_ibfk_1` FOREIGN KEY (`codProd`) REFERENCES `producto` (`codProd`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`codPedido`) REFERENCES `pedido` (`codPedido`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`codProv`) REFERENCES `proveedores` (`codProv`);

--
-- Filtros para la tabla `productotalla`
--
ALTER TABLE `productotalla`
  ADD CONSTRAINT `productotalla_ibfk_1` FOREIGN KEY (`idTalla`) REFERENCES `talla` (`idTalla`),
  ADD CONSTRAINT `productotalla_ibfk_2` FOREIGN KEY (`codProd`) REFERENCES `producto` (`codProd`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`codVenta`) REFERENCES `venta` (`codVenta`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`codUser`) REFERENCES `usuario` (`codUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
