-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 14, 2020 at 10:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lindy`
--

-- --------------------------------------------------------

--
-- Table structure for table `departures`
--

CREATE TABLE `departures` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `line` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `client` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departures`
--

INSERT INTO `departures` (`id`, `product_id`, `quantity`, `lot`, `line`, `created_by`, `client`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 45, 'Molde 1', 'Linea 2', 1, 'Lindy', 'creada', 1, '2020-01-28 05:18:34', '2020-01-28 05:18:34'),
(2, 1, 45, 'Molde 1', 'Linea 2', 1, 'Lindy', 'creada', 2, '2020-01-28 05:18:34', '2020-01-28 05:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `molds`
--

CREATE TABLE `molds` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molds`
--

INSERT INTO `molds` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Molde 1', '2020-01-29 00:00:00', '2020-01-29 00:00:00'),
(2, 'Molde 2', '2020-01-29 00:00:00', '2020-01-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mold_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `mold_id`, `created_at`, `updated_at`) VALUES
(1, 'GPM0004', 'VITAGERUM, Vitaminas y Minerales.', 2, '2020-01-26 04:55:45', '2020-01-26 05:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_supplies`
--

CREATE TABLE `product_supplies` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `excess` decimal(3,2) NOT NULL DEFAULT '0.00',
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_supplies`
--

INSERT INTO `product_supplies` (`id`, `product_id`, `supply_id`, `quantity`, `excess`, `type`, `created_at`, `updated_at`) VALUES
(19, 1, 1, '100.0000', '1.20', 1, '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(20, 1, 2, '500.0000', '3.40', 1, '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(21, 1, 9, '1.0000', '0.80', 2, '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(22, 1, 8, '2.0000', '5.90', 2, '2020-01-30 01:45:49', '2020-01-30 01:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
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
-- Dumping data for table `supplies`
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
-- Table structure for table `supply_measurements`
--

CREATE TABLE `supply_measurements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supply_measurements`
--

INSERT INTO `supply_measurements` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Gramo', 'Gr', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(2, 'Kilogramo', 'Kg', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Mililitro', 'Ml', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(4, 'Litro', 'L', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(5, 'Pieza', 'Pieza', '2020-01-11 00:00:00', '2020-01-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supply_types`
--

CREATE TABLE `supply_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supply_types`
--

INSERT INTO `supply_types` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Materias Primas', 'A', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(2, 'Materias de Envase', 'B', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Material Impreso', 'C', '2020-01-15 00:00:00', '2020-01-15 00:00:00'),
(4, 'Material de Empaque', 'D', '2020-01-15 00:00:00', '2020-01-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Angel Garcia', 'angelrodriguez@ucol.mx', '3121812759', 1, NULL, '$2y$10$8.2N9tpdRRy431BL9bz7y.zlboUX.CZFR9NOgDlyTsOBGF8FkwUMG', NULL, '2019-10-19 19:56:12', '2019-10-19 19:56:12'),
(2, 'Usuario Supervisor', 'supervisor@lindy.com', NULL, 2, NULL, '$2y$10$zfS1CYtyUAXTo30.4PZ9CO2ddieWn.Sr9Nu4REkptZloUl.0J4k9e', NULL, '2020-01-11 20:13:30', '2020-01-11 20:13:30'),
(3, 'Alejandro Saldaña', 'alejandro@lyndy.com', NULL, 2, NULL, '$2y$10$d114ynQZlYZNQKAd4opM2e1mxspvKBA.aDqLnBTT67wW7el4HS5hi', NULL, '2020-01-11 22:30:27', '2020-01-11 22:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(2, 'Supervisor', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Químico', '2020-01-11 00:00:00', '2020-01-11 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departures`
--
ALTER TABLE `departures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `molds`
--
ALTER TABLE `molds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_supplies`
--
ALTER TABLE `product_supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply_measurements`
--
ALTER TABLE `supply_measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply_types`
--
ALTER TABLE `supply_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departures`
--
ALTER TABLE `departures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `molds`
--
ALTER TABLE `molds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_supplies`
--
ALTER TABLE `product_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supply_measurements`
--
ALTER TABLE `supply_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supply_types`
--
ALTER TABLE `supply_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
