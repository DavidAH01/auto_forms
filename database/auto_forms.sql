-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2016 a las 04:09:36
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Estructura de tabla para la tabla `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
`id` int(11) NOT NULL,
  `administrator_id` int(11) NOT NULL,
  `type` varchar(3) NOT NULL,
  `table` varchar(100) NOT NULL,
  `record_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `administrable_table`
--

CREATE TABLE IF NOT EXISTS `administrable_table` (
`id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
`id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1',
  `is_super_administrator` tinyint(1) DEFAULT '0',
  `permissions` text,
  `recovery_hash` varchar(100) NOT NULL,
  `recovery_date` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `email`, `password`, `state`, `is_super_administrator`, `permissions`, `recovery_hash`, `recovery_date`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$97TNMTHAuDWXXQBvwvwi0uHQZVpQ2A6zFhq1bfwWaABDm6FQn7khy', 1, 1, '', 'Bn0Hk7rImAF9DryXCULk.2F9', '2016-01-31 05:14:19', '2016-01-18 00:00:00', '2016-02-15 01:59:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
`id` int(11) NOT NULL,
  `google_analytics_code` varchar(30) DEFAULT NULL,
  `website_description` text,
  `website_keywords` text,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuration`
--

INSERT INTO `configuration` (`id`, `google_analytics_code`, `website_description`, `website_keywords`, `updated_at`) VALUES
(1, '', '', '', '2016-03-18 11:00:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` varchar(48) NOT NULL,
  `end_date` varchar(48) NOT NULL,
  `all_day` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `administrator_id` int(11) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0',
  `is_private` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
`id` int(11) NOT NULL,
  `gallery_id` varchar(100) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Indices de la tabla `activity`
--
ALTER TABLE `activity`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `administrable_table`
--
ALTER TABLE `administrable_table`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `administrator`
--
ALTER TABLE `administrator`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuration`
--
ALTER TABLE `configuration`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `upload`
--
ALTER TABLE `upload`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity`
--
ALTER TABLE `activity`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `administrable_table`
--
ALTER TABLE `administrable_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `administrator`
--
ALTER TABLE `administrator`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `configuration`
--
ALTER TABLE `configuration`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `task`
--
ALTER TABLE `task`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `upload`
--
ALTER TABLE `upload`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
