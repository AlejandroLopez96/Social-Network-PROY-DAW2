-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-06-2017 a las 05:29:38
-- Versión del servidor: 5.6.35
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `meowdaw2_social_network`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `following`
--

CREATE TABLE `following` (
  `id` int(255) NOT NULL,
  `user` int(255) DEFAULT NULL,
  `followed` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `following`
--

INSERT INTO `following` (`id`, `user`, `followed`) VALUES
(3, 2, 6),
(5, 2, 3),
(6, 8, 2),
(9, 8, 5),
(10, 8, 6),
(11, 8, 7),
(12, 8, 4),
(14, 10, 8),
(15, 10, 7),
(16, 10, 6),
(19, 2, 8),
(20, 3, 8),
(29, 11, 8),
(30, 8, 11),
(44, 8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user` int(255) DEFAULT NULL,
  `publication` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user`, `publication`) VALUES
(15, 8, 5),
(19, 8, 12),
(20, 8, 4),
(21, 8, 2),
(22, 8, 3),
(40, 2, 12),
(41, 2, 3),
(42, 2, 2),
(44, 2, 1),
(46, 8, 13),
(50, 8, 15),
(55, 3, 16),
(56, 3, 15),
(57, 3, 14),
(58, 3, 13),
(59, 3, 12),
(63, 3, 17),
(64, 8, 21),
(67, 8, 18),
(103, 3, 18),
(126, 3, 21),
(127, 3, 21),
(128, 8, 23),
(129, 8, 22),
(130, 8, 24),
(131, 8, 30),
(132, 8, 38),
(133, 8, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `type_id` int(255) DEFAULT NULL,
  `readed` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `extra` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `type_id`, `readed`, `created_at`, `extra`) VALUES
(1, 8, 'like', 2, '1', '2017-03-07 12:50:48', '16'),
(2, 8, 'like', 2, '1', '2017-03-07 12:55:34', '15'),
(3, 8, 'like', 2, '1', '2017-03-07 12:55:36', '14'),
(4, 8, 'follow', 2, '1', '2017-03-07 12:56:07', NULL),
(5, 8, 'like', 2, '1', '2017-03-08 08:58:21', '12'),
(6, 8, 'like', 2, '1', '2017-03-08 09:02:16', '3'),
(7, 8, 'like', 2, '1', '2017-03-08 10:09:35', '2'),
(8, 8, 'like', 8, '1', '2017-03-08 11:20:33', '15'),
(9, 8, 'like', 2, '1', '2017-03-09 08:34:00', '1'),
(10, 3, 'like', 8, '1', '2017-03-09 09:14:25', '6'),
(11, 8, 'like', 8, '1', '2017-03-09 09:35:30', '17'),
(12, 8, 'like', 8, '1', '2017-03-09 09:55:57', '18'),
(13, 8, 'like', 8, '1', '2017-03-09 09:57:56', '19'),
(14, 8, 'like', 3, '1', '2017-03-09 17:39:35', '14'),
(15, 8, 'like', 3, '1', '2017-03-09 17:39:38', '13'),
(16, 8, 'follow', 3, '1', '2017-03-09 17:39:51', NULL),
(17, 8, 'like', 2, '1', '2017-03-10 10:23:32', '14'),
(18, 3, 'follow', 8, '1', '2017-03-11 11:05:30', NULL),
(19, 3, 'follow', 8, '1', '2017-03-11 11:07:13', NULL),
(20, 3, 'follow', 8, '1', '2017-03-11 11:07:30', NULL),
(21, 8, 'like', 8, '1', '2017-03-11 11:23:17', '11'),
(22, 3, 'follow', 8, '1', '2017-03-11 11:23:34', NULL),
(23, 10, 'follow', 8, '0', '2017-05-26 11:22:58', NULL),
(24, 10, 'follow', 8, '0', '2017-05-26 11:26:08', NULL),
(25, 10, 'follow', 8, '0', '2017-05-26 11:26:35', NULL),
(26, 10, 'follow', 8, '0', '2017-05-26 11:26:36', NULL),
(27, 4, 'like', 8, '0', '2017-05-26 11:34:14', '10'),
(28, 8, 'like', 8, '1', '2017-05-26 11:41:35', '13'),
(29, 8, 'like', 8, '1', '2017-05-26 11:52:15', '15'),
(30, 8, 'follow', 11, '1', '2017-05-27 21:56:39', NULL),
(31, 11, 'follow', 8, '1', '2017-05-28 09:02:18', NULL),
(32, 8, 'like', 8, '1', '2017-05-28 09:07:28', '21'),
(33, 8, 'like', 8, '1', '2017-05-28 09:07:29', '20'),
(34, 8, 'like', 8, '1', '2017-05-28 18:55:24', '15'),
(35, 8, 'like', 3, '1', '2017-05-28 20:16:52', '21'),
(36, 8, 'like', 3, '1', '2017-05-28 20:16:52', '20'),
(37, 8, 'like', 3, '1', '2017-05-28 20:16:53', '18'),
(38, 8, 'like', 3, '1', '2017-05-28 20:16:55', '17'),
(39, 8, 'like', 3, '1', '2017-05-28 20:32:19', '16'),
(40, 8, 'like', 3, '1', '2017-05-28 20:32:20', '15'),
(41, 8, 'like', 3, '1', '2017-05-28 20:32:21', '14'),
(42, 8, 'like', 3, '1', '2017-05-28 20:32:21', '13'),
(43, 8, 'like', 3, '1', '2017-05-28 20:32:22', '12'),
(44, 8, 'like', 3, '1', '2017-05-28 20:44:28', '21'),
(45, 8, 'like', 3, '1', '2017-05-28 20:44:29', '20'),
(46, 8, 'like', 3, '1', '2017-05-28 20:44:30', '18'),
(47, 8, 'like', 3, '1', '2017-05-28 20:44:31', '17'),
(48, 8, 'like', 8, '1', '2017-05-29 05:44:41', '21'),
(49, 8, 'like', 8, '1', '2017-05-29 05:44:42', '20'),
(50, 8, 'like', 8, '1', '2017-05-29 05:44:45', '18'),
(51, 8, 'like', 8, '1', '2017-05-29 05:44:48', '18'),
(52, 3, 'like', 8, '1', '2017-05-29 09:54:27', '7'),
(53, 3, 'like', 8, '1', '2017-05-29 09:54:28', '7'),
(54, 3, 'like', 8, '1', '2017-05-29 09:54:28', '7'),
(55, 3, 'like', 8, '1', '2017-05-29 09:54:29', '7'),
(56, 3, 'like', 8, '1', '2017-05-29 09:54:30', '7'),
(57, 3, 'like', 8, '1', '2017-05-29 09:54:31', '7'),
(58, 3, 'like', 8, '1', '2017-05-29 09:54:32', '7'),
(59, 3, 'like', 8, '1', '2017-05-29 09:54:32', '7'),
(60, 3, 'like', 8, '1', '2017-05-29 09:54:33', '7'),
(61, 3, 'like', 8, '1', '2017-05-29 09:54:34', '7'),
(62, 3, 'follow', 8, '1', '2017-05-29 09:54:41', NULL),
(63, 3, 'follow', 8, '1', '2017-05-29 09:54:42', NULL),
(64, 3, 'follow', 8, '1', '2017-05-29 09:54:42', NULL),
(65, 3, 'follow', 8, '1', '2017-05-29 09:54:43', NULL),
(66, 3, 'follow', 8, '1', '2017-05-29 09:54:44', NULL),
(67, 3, 'follow', 8, '1', '2017-05-29 09:54:44', NULL),
(68, 3, 'follow', 8, '1', '2017-05-29 09:54:45', NULL),
(69, 3, 'follow', 8, '1', '2017-05-29 09:54:45', NULL),
(70, 3, 'follow', 8, '1', '2017-05-29 09:54:46', NULL),
(71, 3, 'follow', 8, '1', '2017-05-29 09:54:47', NULL),
(72, 3, 'follow', 8, '1', '2017-05-29 09:54:47', NULL),
(73, 3, 'follow', 8, '1', '2017-05-29 09:54:48', NULL),
(74, 3, 'follow', 8, '1', '2017-05-29 09:54:48', NULL),
(75, 3, 'follow', 8, '1', '2017-05-29 09:54:48', NULL),
(76, 8, 'like', 3, '1', '2017-05-29 10:03:45', '20'),
(77, 8, 'like', 3, '1', '2017-05-29 10:03:46', '21'),
(78, 8, 'like', 3, '1', '2017-05-29 10:03:48', '18'),
(79, 8, 'like', 3, '1', '2017-05-29 10:03:49', '20'),
(80, 8, 'like', 3, '1', '2017-05-29 10:03:50', '20'),
(81, 8, 'like', 3, '1', '2017-05-29 10:03:51', '20'),
(82, 8, 'like', 3, '1', '2017-05-29 10:03:52', '20'),
(83, 8, 'like', 3, '1', '2017-05-29 10:03:53', '20'),
(84, 8, 'like', 3, '1', '2017-05-29 10:03:57', '20'),
(85, 8, 'like', 3, '1', '2017-05-29 10:03:58', '21'),
(86, 8, 'like', 3, '1', '2017-05-29 10:03:59', '18'),
(87, 8, 'like', 3, '1', '2017-05-29 10:03:59', '20'),
(88, 8, 'like', 3, '1', '2017-05-29 10:04:00', '18'),
(89, 8, 'like', 3, '1', '2017-05-29 10:04:01', '20'),
(90, 8, 'like', 3, '1', '2017-05-29 10:04:02', '18'),
(91, 8, 'like', 3, '1', '2017-05-29 10:04:03', '18'),
(92, 8, 'like', 3, '1', '2017-05-29 10:04:04', '20'),
(93, 8, 'like', 3, '1', '2017-05-29 10:04:05', '21'),
(94, 8, 'like', 3, '1', '2017-05-29 10:04:06', '21'),
(95, 8, 'like', 3, '1', '2017-05-29 10:04:07', '20'),
(96, 8, 'like', 3, '1', '2017-05-29 10:04:08', '18'),
(97, 8, 'like', 3, '1', '2017-05-29 10:04:08', '20'),
(98, 8, 'like', 3, '1', '2017-05-29 10:04:09', '21'),
(99, 8, 'like', 3, '1', '2017-05-29 10:04:11', '21'),
(100, 8, 'like', 3, '1', '2017-05-29 10:04:14', '20'),
(101, 8, 'like', 3, '1', '2017-05-29 10:04:15', '18'),
(102, 8, 'like', 3, '1', '2017-05-29 10:04:18', '20'),
(103, 8, 'like', 3, '1', '2017-05-29 10:04:19', '21'),
(104, 8, 'like', 3, '1', '2017-05-29 10:04:20', '21'),
(105, 8, 'like', 3, '1', '2017-05-29 10:04:21', '21'),
(106, 8, 'like', 3, '1', '2017-05-29 10:04:23', '21'),
(107, 8, 'like', 3, '1', '2017-05-29 10:04:24', '21'),
(108, 8, 'like', 3, '1', '2017-05-29 10:04:25', '21'),
(109, 8, 'like', 3, '1', '2017-05-29 10:04:26', '21'),
(110, 8, 'like', 3, '1', '2017-05-29 10:04:26', '21'),
(111, 8, 'like', 3, '1', '2017-05-29 10:04:27', '21'),
(112, 8, 'like', 3, '1', '2017-05-29 10:04:28', '21'),
(113, 8, 'like', 3, '1', '2017-05-29 10:15:36', '21'),
(114, 8, 'like', 3, '1', '2017-05-29 10:15:37', '21'),
(115, 8, 'like', 3, '1', '2017-05-29 10:15:38', '21'),
(116, 8, 'like', 3, '1', '2017-05-29 10:15:39', '21'),
(117, 8, 'like', 3, '1', '2017-05-29 10:15:40', '21'),
(118, 8, 'like', 3, '1', '2017-05-29 10:15:42', '21'),
(119, 8, 'like', 3, '1', '2017-05-29 10:15:43', '21'),
(120, 8, 'like', 3, '1', '2017-05-29 10:15:44', '21'),
(121, 8, 'like', 3, '1', '2017-05-29 10:15:45', '21'),
(122, 8, 'like', 3, '1', '2017-05-29 10:15:46', '21'),
(123, 8, 'like', 3, '1', '2017-05-29 10:15:47', '21'),
(124, 8, 'like', 3, '1', '2017-05-29 10:15:48', '21'),
(125, 8, 'like', 3, '1', '2017-05-29 10:15:49', '21'),
(126, 8, 'like', 8, '1', '2017-06-01 05:29:51', '23'),
(127, 8, 'like', 8, '1', '2017-06-01 05:29:53', '22'),
(128, 8, 'like', 3, '1', '2017-06-01 10:21:33', '24'),
(129, 8, 'like', 3, '1', '2017-06-01 10:21:34', '23'),
(130, 8, 'like', 3, '1', '2017-06-01 10:21:34', '22'),
(131, 8, 'like', 3, '1', '2017-06-01 10:21:36', '22'),
(132, 8, 'like', 3, '1', '2017-06-01 10:21:37', '23'),
(133, 8, 'like', 3, '1', '2017-06-01 10:21:37', '23'),
(134, 8, 'like', 3, '1', '2017-06-01 10:21:38', '23'),
(135, 8, 'like', 3, '1', '2017-06-01 10:21:39', '23'),
(136, 8, 'like', 3, '1', '2017-06-01 10:21:39', '23'),
(137, 8, 'like', 3, '1', '2017-06-01 10:21:40', '23'),
(138, 8, 'like', 8, '1', '2017-06-03 09:13:20', '24'),
(139, 8, 'like', 8, '1', '2017-06-03 09:13:22', '30'),
(140, 8, 'like', 8, '0', '2017-06-08 16:08:35', '38'),
(141, 8, 'like', 8, '0', '2017-06-08 16:08:36', '37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `private_messages`
--

CREATE TABLE `private_messages` (
  `id` int(255) NOT NULL,
  `message` longtext COLLATE utf8_bin,
  `emitter` int(255) DEFAULT NULL,
  `receiver` int(255) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `readed` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `private_messages`
--

INSERT INTO `private_messages` (`id`, `message`, `emitter`, `receiver`, `file`, `image`, `readed`, `created_at`) VALUES
(1, 'Hola que tal', 8, 2, NULL, NULL, '1', '2017-03-08 11:33:11'),
(2, 'Holaaaa', 8, 2, '81488972923.pdf', '81488972923.jpeg', '1', '2017-03-08 11:35:23'),
(3, 'eiiiii', 2, 8, '21488974658.pdf', '21488974658.jpeg', '1', '2017-03-08 12:04:18'),
(4, 'olasdsdasdasda', 8, 2, '81488974800.pdf', '81488974800.jpeg', '1', '2017-03-08 12:06:40'),
(5, 'HOLA HOLA HOLA', 2, 8, NULL, NULL, '1', '2017-03-08 12:11:37'),
(6, 'COMO ESTAS', 2, 8, NULL, NULL, '1', '2017-03-08 12:11:44'),
(7, 'ENVIAME EL FICHERO DE CLASE EN PDF', 2, 8, NULL, NULL, '1', '2017-03-08 12:11:58'),
(8, 'QUE GUAY TU FOTO', 2, 8, NULL, NULL, '1', '2017-03-08 12:12:12'),
(9, 'QUE BIEN SE VE', 2, 8, NULL, NULL, '1', '2017-03-08 12:12:30'),
(10, 'holaaaa de nuevo', 2, 8, NULL, NULL, '1', '2017-03-08 13:28:22'),
(11, 'OLaaaaaaaa', 2, 8, NULL, NULL, '1', '2017-03-09 08:34:13'),
(12, 'sdadasdasdasdasdasdas', 3, 8, NULL, NULL, '1', '2017-05-28 20:16:31'),
(13, 'as', 3, 8, NULL, NULL, '1', '2017-05-28 20:32:49'),
(14, 'sadasd', 3, 8, NULL, NULL, '1', '2017-05-28 20:32:54'),
(15, 'asdasdas', 3, 8, NULL, NULL, '1', '2017-05-28 20:32:57'),
(16, 'asdasdasdas', 3, 8, NULL, NULL, '1', '2017-05-28 20:33:01'),
(17, 'asdasdasd', 3, 8, NULL, NULL, '1', '2017-05-28 20:33:05'),
(18, 'asdasdasdasd', 3, 8, NULL, NULL, '1', '2017-05-28 20:33:10'),
(19, 'asdasdasdasd', 3, 8, NULL, NULL, '1', '2017-05-28 20:33:14'),
(20, 'sdasdasda', 3, 8, NULL, NULL, '1', '2017-05-28 20:33:23'),
(21, 'sdasdasdaasdasasdd', 3, 8, NULL, NULL, '1', '2017-05-28 20:33:25'),
(22, '<aaa', 3, 8, NULL, NULL, '1', '2017-05-28 20:45:04'),
(23, 'Shdhd', 3, 8, NULL, NULL, '1', '2017-05-29 09:52:29'),
(24, 'Gwgsgg', 3, 8, NULL, NULL, '1', '2017-05-29 09:52:46'),
(25, 'sfdsdfsdfsdf', 8, 3, NULL, NULL, '1', '2017-05-29 09:55:12'),
(26, 'dfsdfsdfsdf', 8, 3, NULL, NULL, '1', '2017-05-29 09:55:21'),
(27, 'sssssss', 8, 3, NULL, NULL, '1', '2017-05-29 09:55:29'),
(28, 'qweqweqweqwe', 8, 3, NULL, NULL, '1', '2017-05-29 09:55:38'),
(29, 'aasdasdas', 8, 3, NULL, NULL, '1', '2017-05-29 09:58:04'),
(30, 'aaaa', 8, 3, NULL, NULL, '1', '2017-05-29 09:58:12'),
(31, 'wwweeeerrrr', 8, 3, NULL, NULL, '1', '2017-05-29 09:58:22'),
(32, 'rwerwerwe', 8, 3, NULL, NULL, '1', '2017-05-29 09:58:29'),
(33, 'dfsdfsdfsdf', 8, 3, NULL, NULL, '1', '2017-05-29 09:58:42'),
(34, 'sdfsfsdfsfsdf', 8, 3, NULL, NULL, '1', '2017-05-29 09:58:51'),
(35, 'sdfsfedfefsdfsd', 8, 3, NULL, NULL, '1', '2017-05-29 09:59:02'),
(36, 'dfsdfsdfsdfsdfsd', 8, 3, NULL, NULL, '1', '2017-05-29 09:59:14'),
(37, 'sdfsdfsdfsdfsdfsdf', 8, 3, NULL, NULL, '1', '2017-05-29 09:59:22'),
(38, 'fddfdg', 8, 3, NULL, NULL, '1', '2017-05-29 09:59:38'),
(39, 'cvxxcvvxcvxcv', 8, 3, NULL, NULL, '1', '2017-05-29 10:00:22'),
(40, 'ssdfsdfsdfsdf', 8, 3, NULL, NULL, '1', '2017-05-29 10:00:31'),
(41, 'dfsdfsdfsdfsd', 8, 3, NULL, NULL, '1', '2017-05-29 10:00:39'),
(42, 'sdfsdffdsdfsfsdfsf', 8, 3, NULL, NULL, '1', '2017-05-29 10:00:46'),
(43, 'dssdfdfdfdfsdfsdfssdf', 8, 3, NULL, NULL, '1', '2017-05-29 10:00:54'),
(44, 'sdffdssdfsdfsdfdfs', 8, 3, NULL, NULL, '1', '2017-05-29 10:01:01'),
(45, 'fdgdffgdfg', 8, 3, NULL, NULL, '1', '2017-05-29 10:01:20'),
(46, 'Hooo', 3, 8, NULL, NULL, '1', '2017-05-29 10:04:39'),
(47, 'Uxwbd', 3, 8, NULL, NULL, '1', '2017-05-29 10:05:24'),
(48, 'Tkgkgwjt', 3, 8, NULL, NULL, '1', '2017-05-29 10:07:23'),
(49, 'Gsgusngsg', 3, 8, NULL, NULL, '1', '2017-05-29 10:09:17'),
(50, 'Imbesi', 11, 8, NULL, NULL, '1', '2017-05-29 10:23:35'),
(51, 'Imbesi tu tsss', 8, 11, NULL, NULL, '0', '2017-05-29 12:43:45'),
(52, 'Imbesi tu tsss', 8, 11, NULL, NULL, '0', '2017-05-29 12:43:45'),
(53, 'Riekcncjjd', 3, 8, NULL, NULL, '1', '2017-06-01 05:31:31'),
(54, 'asdfasdfasdfasdf', 3, 8, NULL, NULL, '1', '2017-06-01 10:21:17'),
(55, 'asdfasdfasdf', 3, 8, NULL, NULL, '1', '2017-06-01 10:21:21'),
(56, 'Novea que calor se pasa aqui niña', 8, 11, NULL, '81496408351.jpeg', '0', '2017-06-02 12:59:11'),
(57, 'adasdadasdasdasdsada', 3, 8, NULL, NULL, '0', '2017-06-08 16:10:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE `publications` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `text` mediumtext COLLATE utf8_bin,
  `document` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `user_id`, `text`, `document`, `image`, `status`, `created_at`) VALUES
(1, 8, 'Hola mundo!!', NULL, NULL, NULL, '2017-03-05 22:32:50'),
(2, 8, 'Prueba de publicación', NULL, '81488753268.jpeg', NULL, '2017-03-05 22:34:28'),
(3, 8, 'Hola nueva prueba con todo', '81488753453.pdf', '81488753453.jpeg', NULL, '2017-03-05 22:37:33'),
(4, 2, 'Audi la mejor marca de coches', NULL, NULL, NULL, '2017-03-05 22:41:18'),
(5, 2, 'Me encanta AUDI', NULL, NULL, NULL, '2017-03-05 22:41:41'),
(6, 3, 'Soy fontanero de 44 años que le encanta el futbol', NULL, NULL, NULL, '2017-03-05 22:42:16'),
(7, 3, 'HALA MADRID!!', NULL, NULL, NULL, '2017-03-05 22:42:37'),
(9, 4, 'me gusta el mambo', NULL, NULL, NULL, '2017-03-05 22:43:37'),
(10, 4, 'Te ase una cachimba o q ase', NULL, NULL, NULL, '2017-03-05 22:43:53'),
(12, 8, 'vamoh a vel', NULL, NULL, NULL, '2017-03-07 09:09:20'),
(13, 8, 'aaa', '81495798486.pdf', NULL, NULL, '2017-05-26 11:34:46'),
(14, 8, 'qqqqq', NULL, NULL, NULL, '2017-05-26 11:42:37'),
(15, 8, 'qweqwe', NULL, NULL, NULL, '2017-05-26 11:42:42'),
(16, 8, 'Qqqqqqqqqqq', NULL, NULL, NULL, '2017-05-27 12:30:05'),
(17, 8, 'Iwkebhfskienfhusownfudiaoenfuowlenjxiiwfnfbjddudjsidosososjdjdkeiekndndikdndjidkfndkdndkfidmfkdidlendifnekdkxidlmdnfkjfidelenfnf', NULL, NULL, NULL, '2017-05-27 13:27:36'),
(18, 8, 'Wifieiwoqpciswos', NULL, '81495921893.jpeg', NULL, '2017-05-27 21:51:33'),
(21, 8, 'Gif', NULL, '81495962330.gif', NULL, '2017-05-28 09:05:30'),
(22, 8, 'Ola', '81496246554.pdf', '81496246554.gif', NULL, '2017-05-31 16:02:34'),
(23, 8, 'OLAAAAA', NULL, '81496259478.png', NULL, '2017-05-31 19:37:58'),
(24, 8, 'asdfasdfasfasdfasdfasdf', '81496311292.pdf', '81496311292.jpeg', NULL, '2017-06-01 10:01:32'),
(25, 3, 'asasdasd', '31496311460.pdf', '31496311460.png', NULL, '2017-06-01 10:04:20'),
(26, 8, 'Fjeisid', '81496384294.pdf', '81496384294.jpeg', NULL, '2017-06-02 06:18:14'),
(30, 8, 'Q PAZA', '81496481141.pdf', '81496481141.jpeg', NULL, '2017-06-03 09:12:21'),
(31, 8, 'aver', NULL, '81496505454.jpeg', NULL, '2017-06-03 15:57:34'),
(32, 8, 'asdasdas', NULL, '81496505511.jpeg', NULL, '2017-06-03 15:58:31'),
(33, 8, 'asdasdasdas', NULL, '81496506112.jpeg', NULL, '2017-06-03 16:08:32'),
(34, 8, 'asdsasda', NULL, '81496506160.jpeg', NULL, '2017-06-03 16:09:20'),
(35, 8, 'saddsadasdsadsa', NULL, '81496507493.jpeg', NULL, '2017-06-03 16:31:33'),
(36, 8, 'Madre mia Willyyyyyy', '81496518995.pdf', '81496518995.gif', NULL, '2017-06-03 19:43:15'),
(37, 8, 'Madre mia Willyyyyyy', '81496518997.pdf', '81496518997.gif', NULL, '2017-06-03 19:43:17'),
(38, 8, 'Diwowodnudoqowmfjxiaoqlebfusoowenfjdkdidodididldnehrospalwnfjospalqneufodpmqnwjricowowl', NULL, '81496655163.jpeg', NULL, '2017-06-05 09:32:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nick` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `bio` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `active` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `name`, `surname`, `password`, `nick`, `bio`, `active`, `image`) VALUES
(2, 'ROLE_USER', 'wisin@wisin.com', 'Wisin', 'Yandel', '$2y$04$9pgDE/hZt6nR0VQbYn5OU.5UU5yRbItA3utLVH./p4A9cLBLf8zRi', 'Wisin&Yandel', 'Esta es mi biografía', NULL, '21488712912.jpeg'),
(3, 'ROLE_USER', 'pepe@pepe.com', 'Pepito', 'Aasas', '$2y$04$jE7wqNZwinrfQlIu83a26ePrOEiEy.HqPNXJY7zJh9BXP84QmFvIe', 'pepe2', NULL, NULL, NULL),
(4, 'ROLE_USER', 'paco@paco.com', 'Paquito', 'Elchatarra', '$2y$04$l7A7nw2dSsqi8MlLwbGphOVBjFGGi7Q5K/dCjvMS7/TSEhG9npY3S', 'PaKiTo', NULL, NULL, NULL),
(5, 'ROLE_USER', 'fran@fran.com', 'Fracisco', 'Jones Grandes', '$2y$04$oGTcbqv12fnLZqi1Dv4g6uib4oGFEHhJLSTxay6VHghDSo/VQYjxe', 'FranCG', NULL, NULL, NULL),
(6, 'ROLE_USER', 'lola@lola.com', 'Lola', 'Mento Mucho', '$2y$04$iHnXAXhDcoBWCHSKauUxeuxKywRUZQlScu3/Zrj21FoLpe/npnrWC', 'LolaMM', NULL, NULL, NULL),
(7, 'ROLE_USER', 'silvino@silvino.com', 'Silvino', 'Matamoros', '$2y$04$6uNVUwH3msGwZo.ns9P1Ze0ZIyyx745GLuIuHUzf93iZW0wEKQkHS', 'SilvinoMatamoros', NULL, NULL, NULL),
(8, 'ROLE_USER', 'alex@alex.com', 'Alex', 'Lopez Ortiz', '$2y$04$YtBPUHoG.fXhfuYu4YGvvuToFY4ze38Btvi9MNe4TSOmPQFDVViVi', 'AlexLopezOrtiz9', 'Esta es mi biografía guapa....', NULL, '81488728897.jpeg'),
(10, 'ROLE_USER', 'junior@junior.com', 'Junior', 'Castillo Santana', '$2y$04$zytkXYFIl5DymeAXOpLG6OpZbNIQ.WVpvnbxYCH4R03zNxVtydgJG', 'JuniorSantana', NULL, NULL, NULL),
(11, 'ROLE_USER', 'anayudina@gmail.com', 'Ana', 'Yudina', '$2y$04$hMsHLVsh.ItuHSM7j90Eu.Ah.UOJxiX3Rq1KohRiUXWGfSqpjS5Pq', '9', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_following_users` (`user`),
  ADD KEY `fk_followed` (`followed`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_likes_publication` (`publication`),
  ADD KEY `fk_likes_users` (`user`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notifications_users` (`user_id`);

--
-- Indices de la tabla `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emmiter_privates` (`emitter`),
  ADD KEY `fk_receiver_privates` (`receiver`);

--
-- Indices de la tabla `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_publications_users` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uniques_fields` (`email`,`nick`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `following`
--
ALTER TABLE `following`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT de la tabla `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `fk_followed` FOREIGN KEY (`followed`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_following_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_publication` FOREIGN KEY (`publication`) REFERENCES `publications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_likes_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `fk_emmiter_privates` FOREIGN KEY (`emitter`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_receiver_privates` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `fk_publications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
