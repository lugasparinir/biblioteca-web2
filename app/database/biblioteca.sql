-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2025 a las 18:52:02
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

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre`, `descripcion`) VALUES
(1, 'romance', 'amores muy bonitos'),
(2, 'terror', 'para asustarse a la noche'),
(3, 'fantasia', 'cosas magicas que usualmene disfrutan los niños'),
(4, 'comedia', 'para pasar un buen rato y reirse');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `titulo`, `autor`, `descripcion`, `id_genero`) VALUES
(17, 'romeo y julieta', 'william', 'tragica y clasica historia de amor', 1),
(18, 'emma', 'jane austen', 'romance y descubrimiento personal de epoca', 1),
(19, 'el hobbit', 'tolkien', 'comienzo de el señor de los anillos', 3),
(21, 'it', 'stephen king', 'un payaso asesino asusta un grupo de niños', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `contraseña` text NOT NULL,
  `rol` varchar(50) DEFAULT 'LECTOR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `contraseña`, `rol`) VALUES
(1, 'lucero@gmail.com', '$2a$10$LRqtlXsJSWkRWYAAEkU8WuA3ZCoKaFsLsC7EkrnQTKiWPpmQzL7Wy', 'LECTOR'),
(2, 'pepe@gmail.com', '$2a$10$ssT82fv.HLxrD5uhOhFxJu1RtDVh9CbRVk3uw.oTRMaSBom4uaNv6', 'LECTOR'),
(3, 'webadmin', '$2a$08$RiCm8sReuYI1OXAXEy8ccORY4kobyxIYRnb5hGF6Zk9iEJGj0FKqW', 'ADMIN');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id-genero` (`id_genero`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

