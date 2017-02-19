-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2017 a las 14:48:53
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inventory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarticulo`
--

CREATE TABLE IF NOT EXISTS `tarticulo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo_modelo` int(11) NOT NULL,
  `codigo_unidad_medida` int(11) NOT NULL,
  `codigo_partida` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_modelo` (`codigo_modelo`),
  KEY `fk_codigo_unidad_medida` (`codigo_unidad_medida`),
  KEY `fk_codigo_partida01` (`codigo_partida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tarticulo`
--

INSERT INTO `tarticulo` (`codigo`, `nombre`, `descripcion`, `codigo_modelo`, `codigo_unidad_medida`, `codigo_partida`, `min`, `max`, `existencia`, `estatus`) VALUES
(1, 'AGUA', 'AGUA', 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcargo`
--

CREATE TABLE IF NOT EXISTS `tcargo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tcargo`
--

INSERT INTO `tcargo` (`codigo`, `nombre`, `estatus`) VALUES
(1, 'COORDINADOR DE AREA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tciudad`
--

CREATE TABLE IF NOT EXISTS `tciudad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `codigo_parroquia` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_parroquia` (`codigo_parroquia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tciudad`
--

INSERT INTO `tciudad` (`codigo`, `nombre`, `codigo_parroquia`, `estatus`) VALUES
(1, 'RIO ACARIGUA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tentrada`
--

CREATE TABLE IF NOT EXISTS `tentrada` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_usuario` int(11) NOT NULL,
  `rif_proveedor` varchar(12) NOT NULL,
  `nro_factura` int(11) NOT NULL,
  `fecha_factura` date NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `codigo_partida` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_partida` (`codigo_partida`),
  KEY `rif_proveedor` (`rif_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testado`
--

CREATE TABLE IF NOT EXISTS `testado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `testado`
--

INSERT INTO `testado` (`codigo`, `nombre`, `estatus`) VALUES
(1, 'PORTUGUESA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tlinea_entrada`
--

CREATE TABLE IF NOT EXISTS `tlinea_entrada` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_entrada` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_entrada` (`codigo_entrada`),
  KEY `fk_codigo_articulo` (`codigo_articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tlinea_salida`
--

CREATE TABLE IF NOT EXISTS `tlinea_salida` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_salida` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_salida` (`codigo_salida`),
  KEY `fk_codigo_articulo01` (`codigo_articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmarca`
--

CREATE TABLE IF NOT EXISTS `tmarca` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tmarca`
--

INSERT INTO `tmarca` (`codigo`, `nombre`, `estatus`) VALUES
(1, 'FORD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmodelo`
--

CREATE TABLE IF NOT EXISTS `tmodelo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `codigo_marca` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_marca` (`codigo_marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tmodelo`
--

INSERT INTO `tmodelo` (`codigo`, `nombre`, `codigo_marca`, `estatus`) VALUES
(1, 'FIESTA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmodulo`
--

CREATE TABLE IF NOT EXISTS `tmodulo` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` int(1) NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  `icono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_modulo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tmodulo`
--

INSERT INTO `tmodulo` (`id_modulo`, `nombre`, `estatus`, `posicion`, `icono`, `url_modulo`) VALUES
(6, 'CONFIGURACION', 1, 2, '', ''),
(7, 'SEGURIDAD', 1, 3, '', ''),
(8, 'LOCALIZACION', 0, 1, '', ''),
(9, 'INVENTARIO', 0, 4, '', ''),
(10, 'REPORTES', 0, 6, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmunicipio`
--

CREATE TABLE IF NOT EXISTS `tmunicipio` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `codigo_estado` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_estado` (`codigo_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tmunicipio`
--

INSERT INTO `tmunicipio` (`codigo`, `nombre`, `codigo_estado`, `estatus`) VALUES
(1, 'ARAURE', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tparroquia`
--

CREATE TABLE IF NOT EXISTS `tparroquia` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `codigo_municipio` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  KEY `fk_codigo_municipio` (`codigo_municipio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tparroquia`
--

INSERT INTO `tparroquia` (`codigo`, `nombre`, `codigo_municipio`, `estatus`) VALUES
(1, 'RIO ACARIGUA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpartida`
--

CREATE TABLE IF NOT EXISTS `tpartida` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(15) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tpartida`
--

INSERT INTO `tpartida` (`codigo`, `identificador`, `nombre`, `descripcion`, `estatus`) VALUES
(1, '1344JJJJH75', 'LIQUIDOS', 'LIQUIDOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpersonal`
--

CREATE TABLE IF NOT EXISTS `tpersonal` (
  `cedula` varchar(8) NOT NULL,
  `nacionalidad` char(1) NOT NULL DEFAULT 'V',
  `nombres` varchar(60) NOT NULL,
  `appellidos` varchar(60) NOT NULL,
  `sexo` char(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `codigo_ciudad` int(11) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `codigo_unidad` int(11) NOT NULL,
  `codigo_cargo` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cedula`),
  KEY `fk_codigo_ciudad01` (`codigo_ciudad`),
  KEY `fk_codigo_unidad` (`codigo_unidad`),
  KEY `fk_codigo_cargo` (`codigo_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tpersonal`
--

INSERT INTO `tpersonal` (`cedula`, `nacionalidad`, `nombres`, `appellidos`, `sexo`, `fecha_nacimiento`, `correo`, `telefono`, `codigo_ciudad`, `direccion`, `codigo_unidad`, `codigo_cargo`, `estatus`) VALUES
('19455541', 'E', 'CARLOS', 'VARGAS', 'F', '1991-01-09', 'CARLOS-VARGAS2011@HOTMAIL.COM', '04160984343', 1, 'URB SAN JOSE', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproveedor`
--

CREATE TABLE IF NOT EXISTS `tproveedor` (
  `rif` varchar(12) NOT NULL,
  `razon_social` varchar(60) NOT NULL,
  `codigo_ciudad` int(11) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rif`),
  KEY `fk_codigo_ciudad` (`codigo_ciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tproveedor`
--

INSERT INTO `tproveedor` (`rif`, `razon_social`, `codigo_ciudad`, `direccion`, `correo`, `telefono`, `estatus`) VALUES
('J194555411', 'FRONTUARI', 1, 'LOS VALCANES', 'FRONTUARI@GMAIL.COM', '04160983434', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trol`
--

CREATE TABLE IF NOT EXISTS `trol` (
  `codigo` int(1) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` char(1) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `trol`
--

INSERT INTO `trol` (`codigo`, `nombre`, `estatus`) VALUES
(3, 'WEB MASTER', '1'),
(4, 'ALMACENISTA', ''),
(5, 'ADMINISTRADOR', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trol_servicio`
--

CREATE TABLE IF NOT EXISTS `trol_servicio` (
  `id_rol_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`id_rol_servicio`),
  KEY `id_rol` (`id_rol`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=91 ;

--
-- Volcado de datos para la tabla `trol_servicio`
--

INSERT INTO `trol_servicio` (`id_rol_servicio`, `id_rol`, `id_servicio`, `estatus`) VALUES
(51, 3, 1, 0),
(52, 3, 2, 0),
(53, 3, 3, 0),
(54, 3, 4, 0),
(70, 5, 5, 0),
(71, 5, 20, 0),
(72, 5, 6, 0),
(73, 5, 21, 0),
(74, 5, 7, 0),
(75, 5, 22, 0),
(76, 5, 8, 0),
(77, 5, 9, 0),
(78, 5, 10, 0),
(79, 5, 11, 0),
(80, 5, 12, 0),
(81, 5, 13, 0),
(82, 5, 14, 0),
(83, 5, 15, 0),
(84, 5, 16, 0),
(85, 5, 17, 0),
(86, 4, 20, 0),
(87, 4, 18, 0),
(88, 4, 19, 0),
(89, 4, 21, 0),
(90, 4, 22, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsalida`
--

CREATE TABLE IF NOT EXISTS `tsalida` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_usuario` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `cedula_personal` varchar(8) NOT NULL,
  `nro_solicitud` int(11) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  KEY `fk_cedula_personal` (`cedula_personal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tservicio`
--

CREATE TABLE IF NOT EXISTS `tservicio` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` int(1) NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  `icono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_servicio`),
  KEY `id_modulo` (`id_modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `tservicio`
--

INSERT INTO `tservicio` (`id_servicio`, `id_modulo`, `nombre`, `url`, `estatus`, `posicion`, `icono`) VALUES
(1, 7, 'MODULO', 'vistaTmodulo.php', 1, 1, ''),
(2, 7, 'SERVICIO', 'vistaTservicio.php', 1, 2, ''),
(3, 7, 'ROL', 'vistaTrol.php', 1, 3, ''),
(4, 7, 'USUARIO', 'vistaTusuario.php', 1, 4, ''),
(5, 8, 'ESTADO', 'vistaTestado.php', 0, 1, ''),
(6, 8, 'MUNICIPIO', 'vistaTmunicipio.php', 0, 2, ''),
(7, 8, 'PARROQUIA', 'vistaTparroquia.php', 0, 3, ''),
(8, 8, 'CIUDAD', 'vistaTciudad.php', 0, 4, ''),
(9, 6, 'CARGO', 'vistaTcargo.php', 0, 7, ''),
(10, 6, 'MARCA', 'vistaTmarca.php', 0, 8, ''),
(11, 6, 'MODELO', 'vistaTmodelo.php', 0, 9, ''),
(12, 6, 'UNIDAD DE MEDIDA', 'vistaTuniad_medida.php', 0, 10, ''),
(13, 6, 'DEPARTAMENTO', 'vistaTunidad.php', 0, 11, ''),
(14, 6, 'PARTIDA', 'vistaTpartida.php', 0, 12, ''),
(15, 6, 'PROVEEDOR', 'vistaTproveedor.php', 0, 14, ''),
(16, 6, 'PERSONAL', 'vistaTpersonal.php', 0, 16, ''),
(17, 6, 'ARTICULO', 'vistaTarticulo.php', 0, 17, ''),
(18, 9, 'RECEPCION', 'vistaTentrada.php', 0, 1, ''),
(19, 9, 'DESPACHO', 'vistaTsalida.php', 0, 2, ''),
(20, 10, 'REPORTE DE INVENTARIO', 'vistaReporte_de_inventario.php', 0, 1, ''),
(21, 10, 'LISTA DE RECEPCIONES', 'vistaLista_de_recepciones.php', 0, 2, ''),
(22, 10, 'LISTA DE DESPACHOS', 'vistaLista_de_despachos.php', 0, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tuniad_medida`
--

CREATE TABLE IF NOT EXISTS `tuniad_medida` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tuniad_medida`
--

INSERT INTO `tuniad_medida` (`codigo`, `nombre`, `estatus`) VALUES
(1, 'KILOGRAMOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tunidad`
--

CREATE TABLE IF NOT EXISTS `tunidad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tunidad`
--

INSERT INTO `tunidad` (`codigo`, `nombre`, `correo`, `telefono`, `estatus`) VALUES
(1, 'INFORMATICA', 'INFORMATICA@UNA.COM', '02556217144', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario`
--

CREATE TABLE IF NOT EXISTS `tusuario` (
  `nombre_usu` char(25) COLLATE utf8_spanish_ci NOT NULL,
  `clave` char(41) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(1) NOT NULL,
  `pregunta` text COLLATE utf8_spanish_ci NOT NULL,
  `respuesta` text COLLATE utf8_spanish_ci NOT NULL,
  `intentos` int(11) NOT NULL DEFAULT '0',
  `estatus` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT '1',
  `nombre_completo` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_usuario`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tusuario`
--

INSERT INTO `tusuario` (`nombre_usu`, `clave`, `tipo`, `pregunta`, `respuesta`, `intentos`, `estatus`, `nombre_completo`, `correo`, `id_usuario`) VALUES
('WEBMASTER', 'CARLOS19455541', 3, 'COLOR', 'ROJO', 0, '1', 'WEB MASTER', 'WEBMASTER@GMAIL.COM', 1),
('ALMACENISTA', '123456', 4, 'COLOR', 'VERDE', 0, '1', 'ALMACENISTA', 'ALMACENISTA@GMAIL.COM', 3),
('ADMINISTRADOR', '123456', 5, 'COLOR', 'NARANJA', 0, '1', 'ADMINISTRADOR', 'ADMINISTRADOR@GMAIL.COM', 4);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tarticulo`
--
ALTER TABLE `tarticulo`
  ADD CONSTRAINT `fk_codigo_modelo` FOREIGN KEY (`codigo_modelo`) REFERENCES `tmodelo` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_partida01` FOREIGN KEY (`codigo_partida`) REFERENCES `tpartida` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_unidad_medida` FOREIGN KEY (`codigo_unidad_medida`) REFERENCES `tuniad_medida` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tciudad`
--
ALTER TABLE `tciudad`
  ADD CONSTRAINT `fk_codigo_parroquia` FOREIGN KEY (`codigo_parroquia`) REFERENCES `tparroquia` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tentrada`
--
ALTER TABLE `tentrada`
  ADD CONSTRAINT `fk_codigo_partida` FOREIGN KEY (`codigo_partida`) REFERENCES `tpartida` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rif_proveedor` FOREIGN KEY (`rif_proveedor`) REFERENCES `tproveedor` (`rif`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tlinea_entrada`
--
ALTER TABLE `tlinea_entrada`
  ADD CONSTRAINT `fk_codigo_articulo` FOREIGN KEY (`codigo_articulo`) REFERENCES `tarticulo` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_entrada` FOREIGN KEY (`codigo_entrada`) REFERENCES `tentrada` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tlinea_salida`
--
ALTER TABLE `tlinea_salida`
  ADD CONSTRAINT `fk_codigo_articulo01` FOREIGN KEY (`codigo_articulo`) REFERENCES `tarticulo` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_salida` FOREIGN KEY (`codigo_salida`) REFERENCES `tsalida` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tmodelo`
--
ALTER TABLE `tmodelo`
  ADD CONSTRAINT `fk_codigo_marca` FOREIGN KEY (`codigo_marca`) REFERENCES `tmarca` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tmunicipio`
--
ALTER TABLE `tmunicipio`
  ADD CONSTRAINT `fk_codigo_estado` FOREIGN KEY (`codigo_estado`) REFERENCES `testado` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tparroquia`
--
ALTER TABLE `tparroquia`
  ADD CONSTRAINT `fk_codigo_municipio` FOREIGN KEY (`codigo_municipio`) REFERENCES `tmunicipio` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tpersonal`
--
ALTER TABLE `tpersonal`
  ADD CONSTRAINT `fk_codigo_cargo` FOREIGN KEY (`codigo_cargo`) REFERENCES `tcargo` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_ciudad01` FOREIGN KEY (`codigo_ciudad`) REFERENCES `tciudad` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codigo_unidad` FOREIGN KEY (`codigo_unidad`) REFERENCES `tunidad` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tproveedor`
--
ALTER TABLE `tproveedor`
  ADD CONSTRAINT `fk_codigo_ciudad` FOREIGN KEY (`codigo_ciudad`) REFERENCES `tciudad` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `trol_servicio`
--
ALTER TABLE `trol_servicio`
  ADD CONSTRAINT `trol_servicio_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `trol` (`codigo`),
  ADD CONSTRAINT `trol_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `tservicio` (`id_servicio`);

--
-- Filtros para la tabla `tsalida`
--
ALTER TABLE `tsalida`
  ADD CONSTRAINT `fk_cedula_personal` FOREIGN KEY (`cedula_personal`) REFERENCES `tpersonal` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tservicio`
--
ALTER TABLE `tservicio`
  ADD CONSTRAINT `tservicio_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `tmodulo` (`id_modulo`);

--
-- Filtros para la tabla `tusuario`
--
ALTER TABLE `tusuario`
  ADD CONSTRAINT `tusuario_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `trol` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
