-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2017 a las 16:40:04
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `social_network`
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
(24, 8, 3);

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
(44, 2, 1);

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
(18, 3, 'follow', 8, '0', '2017-03-11 11:05:30', NULL),
(19, 3, 'follow', 8, '0', '2017-03-11 11:07:13', NULL),
(20, 3, 'follow', 8, '0', '2017-03-11 11:07:30', NULL),
(21, 8, 'like', 8, '1', '2017-03-11 11:23:17', '11'),
(22, 3, 'follow', 8, '0', '2017-03-11 11:23:34', NULL);

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
(11, 'OLaaaaaaaa', 2, 8, NULL, NULL, '1', '2017-03-09 08:34:13');

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
(12, 8, 'vamoh a vel', NULL, NULL, NULL, '2017-03-07 09:09:20');

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
(8, 'ROLE_USER', 'alex@alex.com', 'Alex', 'Lopez Ortiz', '$2y$04$YtBPUHoG.fXhfuYu4YGvvuToFY4ze38Btvi9MNe4TSOmPQFDVViVi', 'AlexLopezOrtiz9', 'Esta es mi biografía guapa', NULL, '81488728897.jpeg'),
(10, 'ROLE_USER', 'junior@junior.com', 'Junior', 'Castillo Santana', '$2y$04$zytkXYFIl5DymeAXOpLG6OpZbNIQ.WVpvnbxYCH4R03zNxVtydgJG', 'JuniorSantana', NULL, NULL, NULL);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
