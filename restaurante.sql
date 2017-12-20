-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2017 a las 02:47:36
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admi` int(6) NOT NULL,
  `id_usuario` int(6) DEFAULT NULL,
  `nombre_admi` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admi`, `id_usuario`, `nombre_admi`) VALUES
(1, 1, 'Gregorio Perez P.'),
(2, 5, 'Julian Peres'),
(3, 21, 'Jonhy Urango'),
(4, 24, 'cac dasdasd asdas'),
(5, 26, 'sdacsdasdascdasddas dasd asdas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(6) NOT NULL,
  `id_usuario` int(6) DEFAULT NULL,
  `nombre_mesa` varchar(20) DEFAULT NULL,
  `contra_mesa` varchar(20) DEFAULT NULL,
  `hora_registro` time DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `id_usuario`, `nombre_mesa`, `contra_mesa`, `hora_registro`, `fecha_registro`, `estado`, `activo`) VALUES
(2, 7, 'Mesa #2', '2rbsmesa2', '01:05:38', '2017-11-02', 1, 0),
(3, 8, 'Mesa #1', 'rbsmesa1', '01:07:44', '2017-11-02', 1, 0),
(4, 9, 'Mesa #3', 'rbsmesa3', '14:12:17', '2017-11-02', 1, 0),
(6, 16, 'Mesa #4', 'rbsmesa4', '15:28:41', '2017-11-09', 1, 0),
(7, 17, 'Mesa #5', 'rbsmesa5', '15:30:33', '2017-11-09', 1, 0),
(8, 18, 'Mesa #6', 'rbsmesa6', '15:33:02', '2017-11-09', 0, 0),
(9, 19, 'Mesa #8', 'rbsmesa8', '15:40:01', '2017-11-09', 0, 0),
(10, 20, 'Mesa #7', 'rbsmesa7', '15:41:41', '2017-11-09', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `valor` varchar(80) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `nombre`, `valor`, `fecha`) VALUES
(1, 'codigo_admi', 'elbuensabor2017administrador7676', '2017-10-07'),
(3, 'codigo_mesero', 'elbuensabor2017mesero4044', '2017-10-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` bigint(10) NOT NULL,
  `tipo_operacion` varchar(60) CHARACTER SET utf8 NOT NULL,
  `nombre_usuario` varchar(60) CHARACTER SET utf8 NOT NULL,
  `correo_usuario` varchar(60) CHARACTER SET utf8 NOT NULL,
  `valor_antiguo` varchar(120) CHARACTER SET utf8 NOT NULL,
  `valor_nuevo` varchar(120) CHARACTER SET utf8 NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id_log`, `tipo_operacion`, `nombre_usuario`, `correo_usuario`, `valor_antiguo`, `valor_nuevo`, `hora`, `fecha`) VALUES
(1, 'Cambio-codigo-reg-admi', 'Gregorio Perez', 'gregorio@hotmail.com', 'elbuensabor2017administrador7676', 'nuevo', '14:19:47', '2017-11-01'),
(2, 'Cambio-codigo-reg-admi', 'Gregorio Perez', 'gregorio@hotmail.com', 'elbuensabor2017administrador7676', 'elbuensabor2016administrador7676', '14:23:08', '2017-11-01'),
(3, 'Cambio-codigo-reg-admi', 'Gregorio Perez', 'gregorio@hotmail.com', 'elbuensabor2016administrador7676', 'elbuensabor2017administrador7676', '14:26:56', '2017-11-01'),
(4, 'Cambio-codigo-reg-admi', 'Gregorio Perez', 'gregorio@hotmail.com', 'elbuensabor2017administrador7676', 'elbuensabor2017administrador7676', '14:28:14', '2017-11-01'),
(5, 'Cambio-codigo-reg-mesero', 'Gregorio Perez', 'gregorio@hotmail.com', 'elbuensabor2017mesero4044', 'elbuensabor2016mesero4044', '14:36:19', '2017-11-01'),
(6, 'Cambio-codigo-reg-mesero', 'Gregorio Perez', 'gregorio@hotmail.com', 'elbuensabor2016mesero4044', 'elbuensabor2017mesero4044', '14:36:42', '2017-11-01'),
(7, 'Cambio-codigo-reg-admi', 'Gregorio Perez', 'gregorio@hotmail.com', 'elbuensabor2017administrador7676', '', '14:39:49', '2017-11-01'),
(8, 'Subida-de-producto', '1', '', '', 'Arroz de camarones', '00:00:00', '2017-11-07'),
(9, 'Subida-de-producto', '1', '', '', 'Arroz de camarones', '00:00:00', '2017-11-07'),
(10, 'Subida-de-producto', '1', '', '', 'Arroz de camarones', '00:00:00', '2017-11-07'),
(11, 'Subida-de-producto', '1', '', '', 'Arroz de camarones', '00:00:00', '2017-11-07'),
(12, 'Subida-de-producto', '1', '', '', 'Arroz de camarones', '00:00:00', '2017-11-07'),
(13, 'Subida-de-producto', '1', '', '', 'Arroz de camarones 2', '00:00:00', '2017-11-07'),
(14, 'Subida-de-producto', '1', '', '', 'Bandeja paisa', '00:00:00', '2017-11-07'),
(15, 'Subida-de-producto', '1', '', '', 'Casuela de mariscos', '00:00:00', '2017-11-07'),
(16, 'Subida-de-producto', '1', '', '', 'Agua de mar', '00:00:00', '2017-11-07'),
(17, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 5)', 'desactivada (0)', '14:06:29', '2017-11-08'),
(18, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 10)', 'desactivada (0)', '15:46:46', '2017-11-09'),
(19, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '10', 'reactivada (1)', '16:02:59', '2017-11-09'),
(20, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '10', 'reactivada (1)', '16:03:54', '2017-11-09'),
(21, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '10', 'reactivada (1)', '16:04:17', '2017-11-09'),
(22, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 10)', 'desactivada (0)', '16:05:27', '2017-11-09'),
(23, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 10)', 'desactivada (0)', '16:05:27', '2017-11-09'),
(24, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 9)', 'desactivada (0)', '16:05:49', '2017-11-09'),
(25, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '9', 'reactivada (1)', '16:06:16', '2017-11-09'),
(26, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 9)', 'desactivada (0)', '16:07:03', '2017-11-09'),
(27, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 9)', 'desactivada (0)', '16:07:04', '2017-11-09'),
(28, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 9)', 'desactivada (0)', '16:08:08', '2017-11-09'),
(29, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 9)', 'desactivada (0)', '16:08:08', '2017-11-09'),
(30, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 2)', 'desactivada (0)', '16:08:08', '2017-11-09'),
(31, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 8)', 'desactivada (0)', '16:09:11', '2017-11-09'),
(32, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 8)', 'desactivada (0)', '16:09:22', '2017-11-09'),
(33, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 7)', 'desactivada (0)', '16:09:22', '2017-11-09'),
(34, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 6)', 'desactivada (0)', '16:11:00', '2017-11-09'),
(35, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 6)', 'desactivada (0)', '16:11:02', '2017-11-09'),
(36, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 4)', 'desactivada (0)', '16:11:03', '2017-11-09'),
(37, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 6)', 'desactivada (0)', '16:11:11', '2017-11-09'),
(38, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 4)', 'desactivada (0)', '16:11:11', '2017-11-09'),
(39, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 3)', 'desactivada (0)', '16:11:11', '2017-11-09'),
(40, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '3', 'reactivada (1)', '16:33:06', '2017-11-09'),
(41, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '2', 'reactivada (1)', '17:01:22', '2017-11-09'),
(42, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '4', 'reactivada (1)', '17:02:08', '2017-11-09'),
(43, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '6', 'reactivada (1)', '17:02:51', '2017-11-09'),
(44, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 6)', 'desactivada (0)', '17:03:23', '2017-11-09'),
(45, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', 'Id mesa desactivada:  (SELECT valor FROM cliente WHERE id_cliente = 4)', 'desactivada (0)', '17:03:31', '2017-11-09'),
(46, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '4', 'reactivada (1)', '17:04:03', '2017-11-09'),
(47, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '6', 'reactivada (1)', '17:04:16', '2017-11-09'),
(48, 'Subida-de-producto', '1', '', '', 'Arroz con verduras', '00:00:00', '2017-11-09'),
(49, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '7', 'reactivada (1)', '22:24:41', '2017-11-09'),
(50, 'Eliminacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '7', 'desactivada (0)', '22:24:56', '2017-11-09'),
(51, 'Reactivacion-de-mesa', 'Gregorio Perez', 'gregorio@hotmail.com', '7', 'reactivada (1)', '22:26:41', '2017-11-09'),
(52, 'Eliminacion-de-Producto', 'Gregorio Perez', 'gregorio@hotmail.com', '5', 'desactivada (0)', '22:33:25', '2017-11-09'),
(53, 'Eliminacion-de-Producto', 'Gregorio Perez', 'gregorio@hotmail.com', '8', 'desactivada (0)', '22:33:58', '2017-11-09'),
(54, 'Reactivacion-de-producto', 'Admin id: 5', 'Admin id: 5', 'eliminado (0)', 'reactivado (1)', '23:31:40', '2017-11-09'),
(55, 'Subida-de-producto', '1', '', '', 'Arroz de pollo', '00:00:00', '2017-11-15'),
(56, 'Subida-de-producto', '1', '', '', 'Soda de agua', '00:00:00', '2017-11-16'),
(57, 'Edicion-de-producto', 'Admin id: 5', 'Admin id: 5', 'editado', 'editado', '05:59:48', '2017-11-16'),
(58, 'Edicion-de-producto', 'Admin id: 5', 'Admin id: 5', 'editado', 'editado', '06:02:02', '2017-11-16'),
(59, 'Edicion-de-producto', 'Admin id: 5', 'Admin id: 5', 'editado', 'editado', '06:04:05', '2017-11-16'),
(60, 'Edicion-de-producto', 'Admin id: 5', 'Admin id: 5', 'editado', 'editado', '06:06:31', '2017-11-16'),
(61, 'Edicion-de-producto', 'Admin id: 5', 'Admin id: 5', 'editado', 'editado', '06:06:46', '2017-11-16'),
(62, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id:  correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:24:47', '2017-11-16'),
(63, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:26:13', '2017-11-16'),
(64, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:26:18', '2017-11-16'),
(65, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:27:56', '2017-11-16'),
(66, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:28:04', '2017-11-16'),
(67, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:28:06', '2017-11-16'),
(68, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:28:08', '2017-11-16'),
(69, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:28:09', '2017-11-16'),
(70, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:28:11', '2017-11-16'),
(71, 'Eliminacion-de-mesero', 'Gregorio Perez', 'Admin id: 1 correo: gregorio@hotmail.com', 'Activo (1)', 'Desactivado (0)', '14:28:14', '2017-11-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesero`
--

CREATE TABLE `mesero` (
  `id_mesero` int(6) NOT NULL,
  `id_usuario` int(6) DEFAULT NULL,
  `nombre_mesero` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesero`
--

INSERT INTO `mesero` (`id_mesero`, `id_usuario`, `nombre_mesero`) VALUES
(1, 2, 'Enrrique Perez Gil'),
(2, 3, 'Julio Cardenas'),
(3, 4, 'Rafael Paz'),
(4, 22, 'Jose Gutieerez'),
(5, 23, 'Camilo Perez'),
(6, 25, 'Julian Martinez'),
(7, 27, 'Juliala Morelo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesero` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `estado_terminado` int(11) NOT NULL,
  `estado_esperando` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `cadena_identificadora` varchar(120) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_cliente`, `id_mesero`, `estado`, `estado_terminado`, `estado_esperando`, `hora`, `fecha`, `cadena_identificadora`) VALUES
(1, 8, 2, 2, 1, 1, '01:28:39', '2017-11-24', '2017-11-24-01:28:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_enlace`
--

CREATE TABLE `pedido_enlace` (
  `id_enlace_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesero` int(11) NOT NULL,
  `comentario` varchar(240) CHARACTER SET utf8 NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` int(11) NOT NULL,
  `estado_mesero_recibido` int(11) NOT NULL,
  `estado_mesero_entregado` int(11) NOT NULL,
  `cadena_identificadora` varchar(120) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido_enlace`
--

INSERT INTO `pedido_enlace` (`id_enlace_pedido`, `id_pedido`, `id_producto`, `id_cliente`, `id_mesero`, `comentario`, `cantidad`, `fecha`, `hora`, `estado`, `estado_mesero_recibido`, `estado_mesero_entregado`, `cadena_identificadora`) VALUES
(1, 1, 5, 8, 2, '', 1, '2017-11-24', '01:28:39', 0, 1, 1, '2017-11-24-01:28:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(240) CHARACTER SET utf8 NOT NULL,
  `ruta_imagen` varchar(120) CHARACTER SET utf8 NOT NULL,
  `precio` double NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int(11) NOT NULL,
  `tipo_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_usuario`, `nombre`, `descripcion`, `ruta_imagen`, `precio`, `fecha_registro`, `estado`, `tipo_producto`) VALUES
(5, 1, 'Arroz de camarones', 'Espectacular arroz con camarones fresco del mar cartagenero, plato rico en proteÃ­nas.', '5-Arroz de camarones.jpeg', 32500, '2017-11-09', 1, 1),
(7, 1, 'Bandeja paisa', 'Disfrute de la gastronomÃ­a colombiana con este rico y recargado plato antioqueÃ±o.', '1-Bandeja paisa.jpeg', 32500, '2017-11-07', 1, 1),
(8, 1, 'Casuela de mariscos', 'Rica casuela de especies marinas acompaÃ±adas de un buen arroz, para disfrutar las delicias del mar caribeÃ±o.', '1-Casuela de mariscos.jpeg', 54000, '2017-11-07', 0, 1),
(9, 1, 'Agua de mar', 'Deliciosa agua de mar, aromatizado con una deliciosa estrella marina.', '1-Agua de mar.png', 1400, '2017-11-07', 1, 2),
(10, 1, 'Arroz con verduras', 'Un rico y ligth plato de arroz colombiano con una variedad de nutritivas verduras frescas', '1-Arroz con verduras.jpeg', 25000, '2017-11-09', 1, 1),
(11, 1, 'Arroz de pollo', 'Delicioso arroz de pollo con verduras y muchas proteÃ­nas.', '1-Arroz de pollo.jpeg', 13000, '2017-11-15', 1, 1),
(12, 1, 'Soda de agua', 'Rica soda de agua fria', '1-Soda de agua.png', 2000, '2017-11-16', 1, 2);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `insertoProducto` AFTER INSERT ON `producto` FOR EACH ROW INSERT INTO log
	(tipo_operacion, nombre_usuario, valor_nuevo, fecha)
	VALUES
	('Subida-de-producto', NEW.id_usuario, NEW.nombre, NEW.fecha_registro)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(6) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(140) NOT NULL,
  `edad` int(11) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fecha_registro` date NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `correo`, `nombre`, `direccion`, `edad`, `password`, `fecha_registro`, `tipo_usuario`, `estado`) VALUES
(1, 'gregorito@gmail.com', 'Gregorio Perez P.', 'Zaragocilla #34-47', 0, '123123', '2017-10-20', 1, 1),
(2, 'kike@hotmail.com', 'Enrrique Perez Gil', 'Piedra Bolivar #20-11', 0, '123123123', '2017-10-20', 2, 1),
(3, 'julio@gmail.com', 'Julio Cardenas', '20 de Julio callejon Luz 32', 0, '123123123', '2017-10-20', 2, 1),
(4, 'rafael@outlook.com', 'Rafael Paz', 'Urb. Vista bella #201', 0, '123123', '2017-10-20', 2, 1),
(5, 'uno@hotmail.com', 'Julian Peres', 'Olaya', 0, '123123', '2017-10-20', 1, 1),
(7, 'Mesa #2', 'Mesa #2', '-cliente-', 0, '2rbsmesa2', '2017-11-02', 3, 1),
(8, 'Mesa #1', 'Mesa #1', '-cliente-', 0, '111111', '2017-11-02', 3, 1),
(9, 'Mesa #3', 'Mesa #3', '-cliente-', 0, 'rbsmesa3', '2017-11-02', 3, 1),
(16, 'Mesa #4', 'Mesa #4', '-cliente-', 0, 'rbsmesa4', '2017-11-09', 3, 1),
(17, 'Mesa #5', 'Mesa #5', '-cliente-', 0, 'rbsmesa5', '2017-11-09', 3, 1),
(18, 'Mesa #6', 'Mesa #6', '-cliente-', 0, 'rbsmesa6', '2017-11-09', 3, 0),
(19, 'Mesa #8', 'Mesa #8', '-cliente-', 0, 'rbsmesa8', '2017-11-09', 3, 0),
(20, 'Mesa #7', 'Mesa #7', '-cliente-', 0, 'rbsmesa7', '2017-11-09', 3, 0),
(21, 'jonny@gmail.com', 'Jonhy Urango', 'Bruselas carrera 40 31-8', 0, '123123123', '2017-11-09', 1, 1),
(22, 'joses@hotmail.com', 'Jose Gutieerez', 'Bocagrande 311', 0, '123123123', '2017-11-09', 2, 1),
(23, 'camilo@hotmail.com', 'Camilo Perez', 'OLAYA HERRERA RICAURTE', 0, '123123123', '2017-11-09', 2, 1),
(24, 'dasd@jdasda.com', 'cac dasdasd asdas', '1dasdasd dasd asdasdasd ', 0, '123123', '2017-11-09', 1, 1),
(25, 'julio@out.com', 'Julian Martinez', 'dsd dasdasdasd asdasd', 0, 'dsdasdasdasda', '2017-11-09', 2, 1),
(26, 'sdasdqq@dasdas.com', 'sdacsdasdascdasddas dasd asdas', 'dasdasa', 0, 'dasdasasasdas', '2017-11-09', 1, 1),
(27, 'jeremi@hotmail.com', 'Juliala Morelo', 'Barrio espaÃ±a #42-11', 0, '123123123', '2017-11-15', 2, 1);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `agregarUsuario` AFTER INSERT ON `usuario` FOR EACH ROW IF NEW.tipo_usuario = 1 THEN
	INSERT INTO administrador
	(id_usuario, nombre_admi)
	VALUES
	(NEW.id, NEW.nombre);
    
ELSEIF NEW.tipo_usuario = 2 THEN
	INSERT INTO mesero
	(id_usuario, nombre_mesero)
	VALUES
	(NEW.id, NEW.nombre);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL,
  `comentario` varchar(240) CHARACTER SET utf8 NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id`, `id_producto`, `valoracion`, `comentario`, `estado`, `fecha`, `hora`, `cliente`) VALUES
(1, 5, 5, 'Muy bueno', 1, '2017-11-24', '02:27:09', 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admi`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `mesero`
--
ALTER TABLE `mesero`
  ADD PRIMARY KEY (`id_mesero`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `pedido_enlace`
--
ALTER TABLE `pedido_enlace`
  ADD PRIMARY KEY (`id_enlace_pedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `mesero`
--
ALTER TABLE `mesero`
  MODIFY `id_mesero` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedido_enlace`
--
ALTER TABLE `pedido_enlace`
  MODIFY `id_enlace_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `mesero`
--
ALTER TABLE `mesero`
  ADD CONSTRAINT `mesero_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
