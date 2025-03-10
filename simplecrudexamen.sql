-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-03-2025 a las 01:09:48
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simplecrudexamen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_disabled` tinyint(1) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `is_disabled`, `updated_at`) VALUES
(1, 'user1', 'user1@example.com', 'password1', '2025-03-09 23:32:16', 0, '2025-03-09 23:34:31'),
(2, 'user2', 'user2@example.com', 'password2', '2025-03-09 23:32:16', 0, '2025-03-09 23:34:31'),
(3, 'user3', 'user3@example.com', 'password3', '2025-03-09 23:32:16', 0, '2025-03-09 23:34:31'),
(4, 'user4', 'user4@example.com', 'password4', '2025-03-09 23:32:16', 0, '2025-03-09 23:34:31'),
(5, 'user5', 'user5@example.com', 'password5', '2025-03-09 23:32:16', 0, '2025-03-09 23:34:31'),
(6, 'adsdasd', 'asdasdas@gmail.com', '$2y$10$r/xjsQ.2LRevfVgdD1UiC.pyNUO3cw.UZh/XL4VG95sKs2gi.OmUC', '2025-03-09 23:14:45', 0, '2025-03-09 23:35:02'),
(7, 'jfksdnjfk', 'fsdfsdf@gmail.com', '$2y$10$GcrTDuP0SAzb6AngLj2mlOeIOuaL6a2DUZsk.23G68ICu33PHE1sK', '2025-03-10 00:02:50', 0, '2025-03-10 00:02:50'),
(8, 'vcxvxcv', 'vxcvxcv@gmail.com', '$2y$10$J7VPozK8iTxWdrnkOE.RK.pX3eyHgeA0KrEFFDjojtPWJ9UWG32Ma', '2025-03-10 00:06:56', 0, '2025-03-10 00:06:56');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
