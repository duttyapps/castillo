-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-04-2017 a las 03:02:52
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `castillo`
--
CREATE DATABASE IF NOT EXISTS `castillo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `castillo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_compras`
--

CREATE TABLE `carrito_compras` (
  `ID` int(11) NOT NULL,
  `ID_PROD` int(11) NOT NULL,
  `ID_CAT` int(11) DEFAULT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `ESTADO` char(1) NOT NULL DEFAULT 'P',
  `IP_CLIENTE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrito_compras`
--

INSERT INTO `carrito_compras` (`ID`, `ID_PROD`, `ID_CAT`, `CANTIDAD`, `ESTADO`, `IP_CLIENTE`) VALUES
(1, 4, 2, 7, 'P', '::1'),
(7, 6, 1, 3, 'P', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_productos`
--

CREATE TABLE `categoria_productos` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `ACTIVO` char(1) NOT NULL DEFAULT '1',
  `LINK` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_productos`
--

INSERT INTO `categoria_productos` (`ID`, `NOMBRE`, `ACTIVO`, `LINK`) VALUES
(1, 'Vinos', '1', 'vinos'),
(2, 'Piscos', '1', 'piscos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_habitaciones`
--

CREATE TABLE `hotel_habitaciones` (
  `ID` int(11) NOT NULL,
  `HOTEL_ID` int(11) NOT NULL,
  `NOMBRE` int(11) DEFAULT NULL,
  `DESCRIPCION` int(11) DEFAULT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `CAPACIDAD` int(11) NOT NULL,
  `DISPONIBLE` int(11) NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hotel_habitaciones`
--

INSERT INTO `hotel_habitaciones` (`ID`, `HOTEL_ID`, `NOMBRE`, `DESCRIPCION`, `CANTIDAD`, `CAPACIDAD`, `DISPONIBLE`, `PRECIO`) VALUES
(1, 1, 0, NULL, 1, 2, 2, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `ID` int(250) NOT NULL,
  `HOTEL_ID` int(250) NOT NULL,
  `NOMBRE` varchar(2500) NOT NULL,
  `DESCRIPCION` varchar(2500) NOT NULL,
  `CANTIDAD` int(250) NOT NULL,
  `CAPACIDAD` int(250) NOT NULL,
  `DISPONIBLE` char(1) NOT NULL,
  `PRECIO` int(250) NOT NULL,
  `ACTIVO` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`ID`, `HOTEL_ID`, `NOMBRE`, `DESCRIPCION`, `CANTIDAD`, `CAPACIDAD`, `DISPONIBLE`, `PRECIO`, `ACTIVO`) VALUES
(1, 0, 'Hotel Madre Perla', 'El Castillo de Chancay cuenta con dos hospedajes , uno en la parte baja llamado \"Hotel Madre Perla\" y Otra la parte alta con vista al mar llamado \" Hotel Camelot \" .\n\nHotel Madre Perla\n\nPequeño hostal que data de 1920, con habitaciones de corte económico y servicios básicos como baño: privado, agua caliente y fría, TV LCD con cable, Wifi, teléfono  de servicios, cochera,todas las habitaciones han sido decoradas con muebles antiguos a fin de guardar el estilo del Castillo.\n\nHotel Camelot\n\nHospedaje para la gente más exigente, con habitaciones con vista al mar y servicios vip y una mesa de billar con una sala para reuniones especiales con  baño: privado, agua caliente y fría, TV LCD con cable, Wifi, teléfono  de servicios, cochera,Alojamiento Hostal Castillo', 0, 0, '', 0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_envio`
--

CREATE TABLE `metodo_envio` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `DESCRIPCION` varchar(2500) DEFAULT NULL,
  `CARGO` double NOT NULL DEFAULT '0',
  `ACTIVO` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `metodo_envio`
--

INSERT INTO `metodo_envio` (`ID`, `NOMBRE`, `DESCRIPCION`, `CARGO`, `ACTIVO`) VALUES
(1, 'Envío a Domicilio', 'Envío a todo Lima y Huaral...', 15, '1'),
(2, 'Recojo en Tienda', 'Recoger en Castillo de Chancay', 0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `ID` int(250) NOT NULL,
  `TITULO` varchar(2500) NOT NULL,
  `CONTENIDO` varchar(2500) NOT NULL,
  `FECHA_REG` date NOT NULL,
  `USUARIO` varchar(2500) NOT NULL,
  `LINK` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `CONTENIDO` mediumtext,
  `LINK` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(250) NOT NULL,
  `ID_CAT` int(250) NOT NULL,
  `ID_SUBCAT` int(11) DEFAULT NULL,
  `NOMBRE` varchar(2500) NOT NULL,
  `DESCRIPCION` varchar(2500) NOT NULL,
  `DESCRIPCION_CORTA` varchar(2500) DEFAULT NULL,
  `PRECIO` double NOT NULL,
  `FECHA_REG` date NOT NULL,
  `ACTIVO` char(1) NOT NULL DEFAULT '1',
  `LINK` varchar(2500) NOT NULL,
  `USUARIO` varchar(250) NOT NULL,
  `STOCK` int(11) NOT NULL DEFAULT '0',
  `RECOMENDADO` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `ID_CAT`, `ID_SUBCAT`, `NOMBRE`, `DESCRIPCION`, `DESCRIPCION_CORTA`, `PRECIO`, `FECHA_REG`, `ACTIVO`, `LINK`, `USUARIO`, `STOCK`, `RECOMENDADO`) VALUES
(4, 2, NULL, 'Pisco Acholado', 'Hola Mundo!', 'Pisco Acholado de gran calidad', 20.5, '2017-04-05', '1', 'pisco-acholado', 'ADMINISTRADOR', 5, '1'),
(5, 2, NULL, 'Pisco Italia', 'Hola Mundo!', 'Pisco Italia de gran calidad', 33.56, '2017-04-09', '1', 'pisco-italia', 'ADMINISTRADOR', 5, '1'),
(6, 1, NULL, 'Borgoña', 'Hola Mundo!', 'Vino Borgoña de gran calidad', 45.9, '2017-04-09', '1', 'borgo-a', 'ADMINISTRADOR', 5, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `ID` int(250) NOT NULL,
  `NOMBRE` varchar(2500) NOT NULL,
  `DESCRIPCION` varchar(2500) DEFAULT NULL,
  `FECHA_REG` date NOT NULL,
  `FECHA_INI` date NOT NULL,
  `FECHA_FIN` date NOT NULL,
  `ACTIVO` char(1) NOT NULL DEFAULT '1',
  `LINK` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`ID`, `NOMBRE`, `DESCRIPCION`, `FECHA_REG`, `FECHA_INI`, `FECHA_FIN`, `ACTIVO`, `LINK`) VALUES
(1, 'Promoción de Prueba', '<small>*Promoción no válida feriados</small>', '2017-03-26', '2017-03-26', '2017-07-31', '1', 'promocion-prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_hotel`
--

CREATE TABLE `reserva_hotel` (
  `ID` int(11) NOT NULL,
  `ID_HOTEL` int(11) NOT NULL,
  `ID_HABITACION` int(11) NOT NULL,
  `FECHA_RESERVA` date NOT NULL,
  `CHECK_IN` date NOT NULL,
  `CHECK_OUT` date NOT NULL,
  `HABITACIONES` int(11) NOT NULL,
  `ADULTOS` int(11) NOT NULL,
  `MENORES` int(11) NOT NULL,
  `TRATAMIENTO` varchar(250) NOT NULL,
  `NOMBRES` varchar(255) NOT NULL,
  `APELLIDOS` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(253) DEFAULT NULL,
  `TELEFONO` varchar(18) DEFAULT NULL,
  `PAIS` varchar(50) DEFAULT NULL,
  `CIUDAD` varchar(50) DEFAULT NULL,
  `DIRECCION` varchar(250) DEFAULT NULL,
  `EMPRESA` varchar(269) DEFAULT NULL,
  `DETALLE` varchar(500) DEFAULT NULL,
  `TOTAL` int(11) NOT NULL,
  `ESTADO` char(1) NOT NULL DEFAULT 'P',
  `IP` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segt_administrator`
--

CREATE TABLE `segt_administrator` (
  `ID` int(11) NOT NULL,
  `USUARIO` varchar(255) NOT NULL,
  `PASSWORD` varchar(250) NOT NULL,
  `NOMBRES` varchar(250) NOT NULL,
  `FECHA_REG` date NOT NULL,
  `ULT_CON` date DEFAULT NULL,
  `ULT_IP` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `segt_administrator`
--

INSERT INTO `segt_administrator` (`ID`, `USUARIO`, `PASSWORD`, `NOMBRES`, `FECHA_REG`, `ULT_CON`, `ULT_IP`) VALUES
(1, 'ADMIN', 'ADMIN', 'ADMINISTRADOR', '2017-03-15', '2017-04-11', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(250) NOT NULL,
  `CONTENIDO` mediumtext,
  `ACTIVO` char(1) NOT NULL DEFAULT '1',
  `LINK` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`ID`, `TITULO`, `CONTENIDO`, `ACTIVO`, `LINK`) VALUES
(1, 'Eventos', '<img src=\"https://s3.amazonaws.com/images.ecwid.com/images/wysiwyg/category/10406918/21497377/1483422997059-725954878/IMG_9603_png\" class=\"img-responsive\">\r\n</p><p><span>El Castillo Chancay ofrece un ambiente ideal con hoteles, restaurantes, parque acuático, museos e infraestructura para eventos de Empresas e Instituciones:\r\n	</span>\r\n</p><div>\r\n	<ul>\r\n		<li><span>Matrimonios, bautizos y celebraciones.</span></li>\r\n		<li><span>Lanzamientos y presentaciones de ventas.</span></li>\r\n		<li><span>Conferencias y reuniones institucionales.</span></li>\r\n		<li><span>Filmaciones y locaciones visuales.</span></li>\r\n	</ul>\r\n<iframe src=\"https://app.box.com/embed_widget/s/47lvp6vanouwhd0jv7ucz1486fpgbmpq?view=icon&amp;sort=name&amp;direction=ASC&amp;theme=gray\" width=\"100%\" height=\"600\" frameborder=\"0\" allowfullscreen=\"\" webkitallowfullscreen=\"\" msallowfullscreen=\"\"> </iframe></div></div></div><table class=\"ecwid-productBrowser-subcategories-mainTable\" cellpadding=\"0\" cellspacing=\"0\" style=\"display: none;\" aria-hidden=\"true\"><colgroup><col><col><col><col><col><col></colgroup><tbody></tbody></table><div class=\"ecwid-productBrowser-category ecwid-enableDetailedTaxes\"><div><div class=\"ecwid-results-topPanel\" aria-hidden=\"true\" style=\"display: none;\"><div class=\"ecwid-results-topPanel-itemsCountLabel-cell\" style=\"display: none;\"><div class=\"ecwid-results-topPanel-itemsCountLabel\">Mostrando 1-0 de 0 resultados</div></div><div class=\"ecwid-results-topPanel-controlsPanel\"><div class=\"ecwid-results-topPanel-viewAsPanel\"><div class=\"gwt-Label\">Ver Como: </div><div class=\"ecwid-results-topPanel-viewAsPanel-link\">Modulo</div><div class=\"ecwid-results-topPanel-viewAsPanel-current\">Lista</div><div class=\"ecwid-results-topPanel-viewAsPanel-link\">Tabla</div></div><div class=\"ecwid-results-topPanel-sortByPanel\"><div class=\"gwt-Label\">Ordenar por</div><select class=\"gwt-ListBox\"><option value=\"normal\"></option><option value=\"addedTimeDesc\">Añadido el:</option><option value=\"priceAsc\">Precio: menor a mayor</option><option value=\"priceDesc\">Precio: mayor a menor</option><option value=\"nameAsc\">Nombre: A a la Z</option><option value=\"nameDesc\">Nombre: Z a la A</option></select></div></div></div><table cellpadding=\"0\" cellspacing=\"0\" class=\"ecwid-ProductsList-content\" style=\"width: 100%;\"><colgroup><col></colgroup><tbody><tr><td><div class=\"ecwid-productBrowser-productsList\" aria-hidden=\"true\" style=\"display: none;\"><div><table class=\"ecwid-productBrowser-productsListContainer ecwid-productBrowser-productsList-v2\" cellspacing=\"0\" cellpadding=\"0\" style=\"width: 100%; border-collapse: separate;\"><colgroup><col><col><col width=\"100%\"></colgroup><tbody></tbody></table></div></div></td></tr><tr><td><table cellpadding=\"0\" cellspacing=\"0\" aria-hidden=\"true\" style=\"width: 100%; display: none;\"><colgroup><col></colgroup><tbody><tr><td align=\"center\"><div class=\"ecwid-pager ecwid-pager-hasTopSeparator\"><a class=\"ecwid-poweredBy\" href=\"http://www.ecwid.com?utm_source=10406918&amp;utm_medium=powered-by-link&amp;utm_campaign=Ecwid%20stores\" target=\"_blank\">Con tecnología Ecwid</a><span class=\"ecwid-pager-link ecwid-pager-link-disabled ecwid-pager-prev-label\" style=\"visibility: hidden; display: none;\">« <span>Anterior</span></span><span class=\"gwt-InlineLabel\" style=\"visibility: hidden;\"> | </span><span class=\"gwt-InlineLabel\">Página: </span><span class=\"gwt-InlineLabel\" style=\"visibility: hidden;\"> | </span><span class=\"ecwid-pager-link ecwid-pager-link-disabled ecwid-pager-next-label\" style=\"visibility: hidden; display: none;\"><span>Siguiente</span> »</span></div></td></tr></tbody></table></td></tr></tbody></table></div></div><div></div></div></div></td></tr><tr><td align=\"left\" style=\"vertical-align: top;\"><div aria-hidden=\"true\" style=\"display: none;\"></div></td></tr></tbody></table>', '1', 'eventos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria_productos`
--

CREATE TABLE `subcategoria_productos` (
  `ID` int(11) NOT NULL,
  `ID_CAT` int(11) NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `ACTIVO` char(1) NOT NULL DEFAULT '1',
  `LINK` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_compras`
--
ALTER TABLE `carrito_compras`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `carrito_compras_ID_uindex` (`ID`);

--
-- Indices de la tabla `categoria_productos`
--
ALTER TABLE `categoria_productos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `categoria_productos_ID_uindex` (`ID`);

--
-- Indices de la tabla `hotel_habitaciones`
--
ALTER TABLE `hotel_habitaciones`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `hotel_habitaciones_ID_uindex` (`ID`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_INDX` (`ID`);

--
-- Indices de la tabla `metodo_envio`
--
ALTER TABLE `metodo_envio`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `metodo_envio_ID_uindex` (`ID`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_INDX` (`ID`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `paginas_ID_uindex` (`ID`),
  ADD UNIQUE KEY `paginas_LINK_uindex` (`LINK`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `productos_ID_uindex` (`ID`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_INDX` (`ID`);

--
-- Indices de la tabla `reserva_hotel`
--
ALTER TABLE `reserva_hotel`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `reserva_hotel_ID_uindex` (`ID`);

--
-- Indices de la tabla `segt_administrator`
--
ALTER TABLE `segt_administrator`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `segt_administrator_ID_uindex` (`ID`),
  ADD UNIQUE KEY `segt_administrator_USUARIO_uindex` (`USUARIO`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `paginas_ID_uindex` (`ID`),
  ADD UNIQUE KEY `paginas_LINK_uindex` (`LINK`);

--
-- Indices de la tabla `subcategoria_productos`
--
ALTER TABLE `subcategoria_productos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `subcategoria_productos_ID_uindex` (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_compras`
--
ALTER TABLE `carrito_compras`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `categoria_productos`
--
ALTER TABLE `categoria_productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `hotel_habitaciones`
--
ALTER TABLE `hotel_habitaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `metodo_envio`
--
ALTER TABLE `metodo_envio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `reserva_hotel`
--
ALTER TABLE `reserva_hotel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `segt_administrator`
--
ALTER TABLE `segt_administrator`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `subcategoria_productos`
--
ALTER TABLE `subcategoria_productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
