-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: database:3306
-- Tiempo de generación: 06-06-2025 a las 06:37:52
-- Versión del servidor: 8.4.4
-- Versión de PHP: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sibw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comentario`
--

CREATE TABLE `Comentario` (
  `id` int NOT NULL,
  `idPelicula` int DEFAULT NULL,
  `nombre_usuario` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comentario` text,
  `fecha` datetime DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `editado_por_moderador` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Comentario`
--

INSERT INTO `Comentario` (`id`, `idPelicula`, `nombre_usuario`, `email`, `comentario`, `fecha`, `idUsuario`, `editado_por_moderador`) VALUES
(26, 4, 'Usuario de Prueba', 'prueba@example.com', 'Este es un comentario de prueba.', '2025-06-05 03:59:52', NULL, 0),
(27, 3, 'laura', 'laurar@gmail.com', 'Muy bonita', '2025-06-05 04:03:27', NULL, 0),
(28, 1, 'Alba', 'alba@gmail.com', 'idiota', '2025-06-06 06:06:31', NULL, 0),
(29, 1, 'Alba', 'alba@gmail.com', 'Interesante', '2025-06-06 06:06:52', NULL, 0),
(30, 2, 'Alba', 'alba@gmail.com', 'idiota', '2025-06-06 06:07:13', NULL, 0),
(31, 2, 'Alba', 'alba@gmail.com', 'idiota', '2025-06-06 06:09:43', NULL, 0),
(32, 2, 'Alba', 'alba@gmail.com', 'idiota', '2025-06-06 06:13:03', NULL, 0),
(33, 2, 'Laura', 'laurariesco@gmail.com', 'La recomiendo!', '2025-06-06 06:13:28', NULL, 0),
(34, 2, 'Ale', 'alejandro@gmail.com', 'Bastante aburrida, pero bueno...', '2025-06-06 06:13:58', NULL, 0),
(35, 2, 'Laura', 'laurariesco@gmail.com', 'La recomiendo!', '2025-06-06 06:15:07', NULL, 0),
(36, 3, 'Sergio', 'sergio@gmail.com', 'El que hizo esta pelicula es un tonto', '2025-06-06 06:19:05', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hashtag`
--

CREATE TABLE `Hashtag` (
  `id` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Hashtag`
--

INSERT INTO `Hashtag` (`id`, `nombre`) VALUES
(1, 'drama'),
(2, 'romance');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Palabrota`
--

CREATE TABLE `Palabrota` (
  `id` int NOT NULL,
  `palabra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Palabrota`
--

INSERT INTO `Palabrota` (`id`, `palabra`) VALUES
(1, 'estúpido'),
(2, 'idiota'),
(3, 'tonto'),
(4, 'imbécil'),
(5, 'cretino'),
(6, 'baboso'),
(7, 'gilipollas'),
(8, 'subnormal'),
(9, 'capullo'),
(10, 'zorro'),
(11, 'burro'),
(12, 'bobo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `actores` text,
  `enlace_imdb` text,
  `enlace_wiki` text,
  `imagenes` text,
  `publicado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `imagen`, `fecha`, `director`, `descripcion`, `actores`, `enlace_imdb`, `enlace_wiki`, `imagenes`, `publicado`) VALUES
(1, 'Joker', 'd66eaf36ae62c4cf1e48f2282ebdaf71.jpg', '2019-10-04', 'Todd Phillips', 'Joker es una película de drama y crimen centrada en Arthur Fleck, un hombre con problemas mentales que se transforma en el infame Joker. Ofrece una mirada profunda sobre la salud mental, la soledad y la violencia en la sociedad.', 'Joaquin Phoenix, Robert De Niro, Zazie Beetz, Frances Conroy, Brett Cullen', 'https://www.imdb.com/title/tt7286456/', 'https://es.wikipedia.org/wiki/Joker_(pel%C3%ADcula_de_2019)', 'joker1.jpg,joker2.jpg', 1),
(2, 'Scarface', 'POSTER-SCARFACE.jpg.webp', '1983-12-09', 'Brian De Palma', 'Scarface sigue la historia de Tony Montana, un inmigrante cubano que se convierte en un temido narcotraficante en Miami. La película destaca por su violencia cruda y la memorable actuación de Al Pacino.', 'Al Pacino, Michelle Pfeiffer, Steven Bauer, Mary Elizabeth Mastrantonio, Robert Loggia', 'https://www.imdb.com/title/tt0086250/', 'https://es.wikipedia.org/wiki/Scarface_(pel%C3%ADcula_de_1983)', 'scarface1.jpg,scarface2.jpg', 1),
(3, 'Mamma Mia!', 'poster_mamma_mia.png', '2008-07-18', 'Phyllida Lloyd', 'Mamma Mia! es un musical alegre basado en canciones de ABBA, que narra cómo Sophie intenta descubrir quién es su padre en la víspera de su boda, mientras revive el pasado de su madre Donna.', 'Meryl Streep, Amanda Seyfried, Pierce Brosnan, Colin Firth, Stellan Skarsgård', 'https://www.imdb.com/title/tt0795421/', 'https://es.wikipedia.org/wiki/Mamma_Mia!_(pel%C3%ADcula)', 'mamma1.jpg,mamma2.jpg', 1),
(4, 'Vaiana', 'nuevos-posters-de-la-pelicula-vaiana-de-disney-original.jpg', '2016-11-23', 'Ron Clements y John Musker', 'Vaiana es una aventura animada de Disney sobre una joven que desafía al océano para salvar a su pueblo. Con la ayuda del semidiós Maui, explora el poder de la identidad y el legado cultural polinesio.', 'Auli\'i Cravalho, Dwayne Johnson, Rachel House, Temuera Morrison, Nicole Scherzinger', 'https://www.imdb.com/title/tt3521164/', 'https://es.wikipedia.org/wiki/Vaiana', 'vaiana1.jpg,vaiana2.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pelicula_Hashtag`
--

CREATE TABLE `Pelicula_Hashtag` (
  `id_pelicula` int NOT NULL,
  `id_hashtag` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('normal','moderador','gestor','root') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(1, 'Laura', 'laurariesco@gmail.com', '$2y$10$8PhsbSOuCZtuQvqEY7Q2Z.zfB8Kv.JaaqqZ../IRE1PVgryvcVGRq', 'gestor'),
(2, 'Alba', 'albag@gmail.com', '$2y$10$eVt2OQfrwX/Hk00OMoasheoo9eSmQmMf29JWQqYqmGbixqORf.fIK', 'moderador'),
(3, 'UsuarioNormal', 'normal@demo.com', '$2y$10$Ae0tw3GeKjbAv6eT6dC0xub6qQynL12zEecYi4WXBjB0LGKbr2zUO', 'normal'),
(4, 'UsuarioModerador', 'moderador@demo.com', '$2y$10$Ae0tw3GeKjbAv6eT6dC0xub6qQynL12zEecYi4WXBjB0LGKbr2zUO', 'moderador'),
(5, 'UsuarioGestor', 'gestor@demo.com', '$2y$10$Ae0tw3GeKjbAv6eT6dC0xub6qQynL12zEecYi4WXBjB0LGKbr2zUO', 'gestor'),
(6, 'Ale', 'ale@gmail.com', '$2y$10$yYclAUbBqRPBnitMZYjG1OLNRCd6PzkR8p9dyTNBbVdc8Zot75NxG', 'root'),
(9, 'Sergio', 'sergio@gmail.com', '$2y$10$UEjU8xT6cCEZ3BqrHJxBhui2vxlb5WvOurevNuVRWCH6QnMNQ1nbO', 'root');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPelicula` (`idPelicula`),
  ADD KEY `fk_usuario_comentario` (`idUsuario`);

--
-- Indices de la tabla `Hashtag`
--
ALTER TABLE `Hashtag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `Palabrota`
--
ALTER TABLE `Palabrota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Pelicula_Hashtag`
--
ALTER TABLE `Pelicula_Hashtag`
  ADD PRIMARY KEY (`id_pelicula`,`id_hashtag`),
  ADD KEY `id_hashtag` (`id_hashtag`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Comentario`
--
ALTER TABLE `Comentario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `Hashtag`
--
ALTER TABLE `Hashtag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Palabrota`
--
ALTER TABLE `Palabrota`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idPelicula`) REFERENCES `Pelicula` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario_comentario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `Pelicula_Hashtag`
--
ALTER TABLE `Pelicula_Hashtag`
  ADD CONSTRAINT `pelicula_hashtag_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `Pelicula` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelicula_hashtag_ibfk_2` FOREIGN KEY (`id_hashtag`) REFERENCES `Hashtag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
