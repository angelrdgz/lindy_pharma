-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-01-2020 a las 15:41:18
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `lindy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Producto 1', '2020-01-15 00:00:00', '2020-01-15 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplies`
--

CREATE TABLE `supplies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(15) NOT NULL,
  `type_id` int(11) NOT NULL,
  `measurement_use` int(11) NOT NULL,
  `measurement_buy` int(2) NOT NULL,
  `stock` decimal(10,2) DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `supplies`
--

INSERT INTO `supplies` (`id`, `name`, `code`, `type_id`, `measurement_use`, `measurement_buy`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Agua Purificada Nivel 1', 'A-00001', 1, 3, 4, '0.00', '2020-01-16 02:50:46', '2020-01-16 03:02:59'),
(2, 'Gelatina LB 175 B', 'A-00002', 1, 1, 2, '0.00', '2020-01-16 03:03:55', '2020-01-16 03:03:55'),
(3, 'Glicerol', 'A-00003', 1, 3, 4, '0.00', '2020-01-16 03:05:00', '2020-01-16 03:05:00'),
(4, 'Metilparabeno sódico (Nipagin)', 'A-00004', 1, 3, 4, '0.00', '2020-01-16 03:07:02', '2020-01-16 03:07:02'),
(5, 'Propilparabeno sódico (Nipazol)', 'A-00005', 1, 3, 4, '0.00', '2020-01-16 03:07:21', '2020-01-16 03:07:21'),
(6, 'PVDC /PVC 60 g/cm CRISTAL calibre y medidas', 'B-00001', 2, 3, 4, '0.00', '2020-01-16 03:08:00', '2020-01-16 03:08:00'),
(7, 'Frasco PEAD bco 100 ml R-38', 'B-00002', 2, 3, 4, '0.00', '2020-01-16 03:08:19', '2020-01-16 03:08:19'),
(8, 'Etiqueta de Aceite de Krill F. Similares', 'C-00001', 3, 5, 5, '0.00', '2020-01-16 03:08:42', '2020-01-16 03:08:42'),
(9, 'Caja colectiva doble corrugado de 50 x 50 x50', 'D-00001', 4, 5, 5, '0.00', '2020-01-16 03:09:04', '2020-01-16 03:09:04'),
(10, 'Bióxido de Titanio 19-380-C', 'A-00006', 1, 3, 4, '0.00', '2020-01-16 03:09:36', '2020-01-16 03:09:36'),
(11, 'Colorante óxido negro azabache', 'A-00007', 1, 1, 2, '0.00', '2020-01-16 03:10:45', '2020-01-16 03:10:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supply_measurements`
--

CREATE TABLE `supply_measurements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `supply_measurements`
--

INSERT INTO `supply_measurements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gramo', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(2, 'Kilogramo', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Mililitro', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(4, 'Litro', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(5, 'Pieza', '2020-01-11 00:00:00', '2020-01-11 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supply_types`
--

CREATE TABLE `supply_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `supply_types`
--

INSERT INTO `supply_types` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Materias Primas', 'A', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(2, 'Materias de Envase', 'B', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Material Impreso', 'C', '2020-01-15 00:00:00', '2020-01-15 00:00:00'),
(4, 'Material de Empaque', 'D', '2020-01-15 00:00:00', '2020-01-15 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Angel Garcia', 'angelrodriguez@ucol.mx', '3121812759', 1, NULL, '$2y$10$8.2N9tpdRRy431BL9bz7y.zlboUX.CZFR9NOgDlyTsOBGF8FkwUMG', NULL, '2019-10-19 19:56:12', '2019-10-19 19:56:12'),
(2, 'Usuario Supervisor', 'supervisor@lindy.com', NULL, 2, NULL, '$2y$10$zfS1CYtyUAXTo30.4PZ9CO2ddieWn.Sr9Nu4REkptZloUl.0J4k9e', NULL, '2020-01-11 20:13:30', '2020-01-11 20:13:30'),
(3, 'Alejandro Saldaña', 'alejandro@lyndy.com', NULL, 2, NULL, '$2y$10$d114ynQZlYZNQKAd4opM2e1mxspvKBA.aDqLnBTT67wW7el4HS5hi', NULL, '2020-01-11 22:30:27', '2020-01-11 22:30:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(2, 'Supervisor', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Químico', '2020-01-11 00:00:00', '2020-01-11 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `supply_measurements`
--
ALTER TABLE `supply_measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `supply_types`
--
ALTER TABLE `supply_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `supply_measurements`
--
ALTER TABLE `supply_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `supply_types`
--
ALTER TABLE `supply_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
