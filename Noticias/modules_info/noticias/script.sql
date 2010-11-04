-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-10-2010 a las 17:53:21
-- Versión del servidor: 5.1.36
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(125) DEFAULT NULL,
  `introduccion` text,
  `contenido` text,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_images`
--

CREATE TABLE IF NOT EXISTS `noticia_images` (
  `id_noticia_images` int(11) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(11) DEFAULT NULL,
  `tipo_imagen` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_noticia_images`),
  KEY `fk_noticias_images` (`id_noticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `noticia_images`
--
ALTER TABLE `noticia_images`
  ADD CONSTRAINT `fk_noticias_images` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`) ON DELETE CASCADE ON UPDATE NO ACTION;