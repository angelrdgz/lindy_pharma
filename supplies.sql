-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2020 at 09:27 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lindy`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogs`
--

CREATE TABLE `catalogs` (
  `id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catalogs`
--

INSERT INTO `catalogs` (`id`, `code`, `type`, `name`, `created_at`, `updated_at`) VALUES
(1, 'G01', 'cfdi', 'Adquisición de mercancias', '2020-03-08 18:34:10', '2020-03-08 18:34:10'),
(2, 'G02', 'cfdi', 'Devoluciones, descuentos o bonificaciones', '2020-03-08 18:34:10', '2020-03-08 18:34:10'),
(3, 'G03', 'cfdi', 'Gastos en general', '2020-04-16 11:25:26', '2020-04-16 11:25:26'),
(4, 'I01', 'cfdi', 'Construcciones', '2020-04-16 11:29:46', '2020-04-16 11:29:46'),
(5, 'I08', 'cfdi', 'Otras máquinas y equipos', '2020-04-16 11:31:19', '2020-04-16 11:31:19'),
(6, 'P01', 'cfdi', 'Por definir', '2020-04-16 11:31:43', '2020-04-16 11:31:43'),
(7, 'MN', 'currency', 'Moneda nacional', '2020-04-16 16:10:12', '2020-04-16 16:10:12'),
(8, 'USD', 'currency', 'Dolares americanos', '2020-04-16 16:10:12', '2020-04-16 16:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact` varchar(80) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `neight` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `contact`, `phone`, `address`, `neight`, `city`, `state`, `zip`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cliente 1.1.1', '1', '1', '1', '2', '3', '4', '5', 'Cliente 1.1', 1, '2020-02-22 23:25:37', '2020-02-27 04:47:59'),
(2, 'Ricardo Castañeda', 'Ricardo', '3121812759', 'xyz', 'trt', 'rtr', 'rtrt', '12312', 'ricardoenrique_111@hotmail.com', 1, '2020-02-27 04:51:02', '2020-02-27 04:51:02'),
(3, 'NATURA EXTRACTA', 'ISABEL ROMERO', '3318509443', 'Cerezo 1221', 'Del Fresno', 'Guadalajara', 'Jalisco', '44900', 'Isabel.Romero@naturaextracta.com', 1, '2020-04-06 12:51:44', '2020-04-06 12:51:44'),
(4, 'MEDIX', 'ARNULFO GONZALEZ', '552736 0179', 'x', 'x', 'x', 'x', 'x', 'aggonzalez@medix.com.mx', 1, '2020-04-07 13:05:47', '2020-04-07 13:05:47'),
(5, 'FARMACOS HISPANOAMERICANOS', 'LORENA', '55', 'A', 'A', 'A', 'A', 'A', 'A', 1, '2020-04-07 19:41:02', '2020-04-07 19:41:02'),
(6, 'MARCA PROPIA', 'ALEJANDRO SALDAÑA', '331543 2480', 'Av San Jose 1210', 'Los  Cajetes', 'Zapopan', 'Jalisco', '45234', 'alejandros@lindypharma.com.mx', 1, '2020-04-14 11:35:38', '2020-04-14 11:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `consecutive` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `area_id`, `name`, `consecutive`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dirección Operativo', '1000', '2020-03-30 13:04:32', '2020-03-30 13:04:32'),
(2, 2, 'Administración', '3000', '2020-03-30 13:04:32', '2020-03-30 13:04:32'),
(3, 3, 'Dirección Técnica', '2000', '2020-03-30 13:05:35', '2020-03-30 13:05:35'),
(4, 4, 'Comercial', '500', '2020-03-30 13:05:35', '2020-03-30 13:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `decreases`
--

CREATE TABLE `decreases` (
  `id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `entrance_item_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `decreases`
--

INSERT INTO `decreases` (`id`, `supply_id`, `entrance_item_id`, `quantity`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 8, '1.00', 'Se me cayóx', 1, '2020-03-18 23:35:21', '2020-03-19 00:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `departures`
--

CREATE TABLE `departures` (
  `id` int(11) NOT NULL,
  `order_number` varchar(10) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `quantity_real` bigint(20) DEFAULT NULL,
  `lot` varchar(100) NOT NULL,
  `line` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `expired_date` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departures`
--

INSERT INTO `departures` (`id`, `order_number`, `recipe_id`, `quantity`, `quantity_real`, `lot`, `line`, `created_by`, `client_id`, `status`, `type`, `visible`, `expired_date`, `created_at`, `updated_at`) VALUES
(1, 'OT-0001', 7, 1000000, NULL, 'PRUEBA01', 'PRUEBA', 6, 1, 'Pesado', 1, 1, NULL, '2020-04-28 09:49:01', '2020-04-28 10:03:46'),
(2, 'OT-0001', 7, 1000000, NULL, 'PRUEBA01', 'PRUEBA', 6, 1, 'Pesado', 2, 0, NULL, '2020-04-28 09:49:04', '2020-04-28 10:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `departure_items`
--

CREATE TABLE `departure_items` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `supplie_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `excess` decimal(3,2) NOT NULL,
  `order_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departure_items`
--

INSERT INTO `departure_items` (`id`, `departure_id`, `supplie_id`, `quantity`, `excess`, `order_number`) VALUES
(1, 1, 25, '20.00', '0.00', NULL),
(2, 2, 2, '750.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entrances`
--

CREATE TABLE `entrances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cfdi_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `requisition` varchar(60) NOT NULL,
  `department` varchar(60) NOT NULL,
  `owner` varchar(150) NOT NULL,
  `mader` varchar(150) NOT NULL,
  `authorizer` varchar(150) NOT NULL,
  `cost_id` int(11) NOT NULL,
  `expected_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrances`
--

INSERT INTO `entrances` (`id`, `user_id`, `cfdi_id`, `supplier_id`, `requisition`, `department`, `owner`, `mader`, `authorizer`, `cost_id`, `expected_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'prueba 1', 'Operaciones', 'alejandro', 'alejandro', 'alejandro', 1, '2020-12-12', '2020-04-28 08:50:45', '2020-04-28 08:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `entrance_comments`
--

CREATE TABLE `entrance_comments` (
  `id` int(11) NOT NULL,
  `entrance_id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrance_comments`
--

INSERT INTO `entrance_comments` (`id`, `entrance_id`, `comment`) VALUES
(4, 1, 'esta es una prueba');

-- --------------------------------------------------------

--
-- Table structure for table `entrance_items`
--

CREATE TABLE `entrance_items` (
  `id` int(11) NOT NULL,
  `entrance_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `comments` text,
  `order_number` int(11) DEFAULT NULL,
  `cups` int(11) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `reanalized_date` date DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `lot_supplier` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrance_items`
--

INSERT INTO `entrance_items` (`id`, `entrance_id`, `supply_id`, `quantity`, `price`, `currency_id`, `comments`, `order_number`, `cups`, `expired_date`, `reanalized_date`, `status`, `lot_supplier`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '750.0000', '8.35', 8, NULL, NULL, 75, '2022-12-12', NULL, 'Aprobada', NULL, '2020-04-28 08:50:46', '2020-04-28 09:41:12'),
(2, 1, 3, '400.0000', '1.58', 8, NULL, NULL, NULL, NULL, NULL, 'Rechazada', NULL, '2020-04-28 08:50:46', '2020-04-28 08:53:30'),
(3, 1, 25, '100.0000', '1.00', 8, NULL, NULL, 25, '2022-05-12', NULL, 'Aprobada', NULL, '2020-04-28 08:50:46', '2020-04-28 09:41:12'),
(4, 1, 2, '250.0000', '8.35', 8, NULL, NULL, 25, '2020-11-03', NULL, 'Rechazada', NULL, '2020-04-28 09:19:25', '2020-04-28 09:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `entrance_supplies`
--

CREATE TABLE `entrance_supplies` (
  `id` int(11) NOT NULL,
  `departure_id` int(11) NOT NULL,
  `supplie_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `entrance_number` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Logbooks`
--

CREATE TABLE `Logbooks` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(250) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Logbooks`
--

INSERT INTO `Logbooks` (`id`, `type_id`, `title`, `content`, `icon`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Order de Fabricación Creada', 'Se ha creado el usuario \"Tal\" con el rol \"Tal\"', 'fas fa-user', 1, '2020-02-27 20:17:25', '2020-02-26 20:17:25'),
(2, 2, 'Usuario Modificado', 'El usuario \"Tal\" ah sido modificado.', 'fas fa-user', 2, '2020-02-27 20:17:25', '2020-02-26 20:17:25'),
(3, 4, 'Orden de Compra Actualizada', 'Se ha actualizado la orden de compra #3 al estatus \"Revisada\".', 'fas fa-cart-arrow-down', 1, '2020-02-27 22:05:04', '2020-02-27 22:05:04'),
(4, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #1000 ha sido cancelada', 'fas fa-clipboard', 3, '2020-02-27 22:20:03', '2020-02-27 22:20:03'),
(5, 2, 'Cliente Modificado', 'El cliente \"Cliente 1.1.1\" ha sido modificado', 'fas fa-user-tie', 1, '2020-02-27 04:47:59', '2020-02-27 04:47:59'),
(6, 1, 'Cliente Creado', 'El cliente \"Ricardo Castañeda\" ha sido creado', 'fas fa-user-tie', 1, '2020-02-27 04:51:02', '2020-02-27 04:51:02'),
(7, 3, 'Orden de Compra Cancelada', 'La orden de compra #\"3\" ha sido cancelada', 'fas fa-cart-arrow-down', 1, '2020-02-27 05:28:07', '2020-02-27 05:28:07'),
(8, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #\"OT-0001\" ha sido cancelada', 'fas fa-clipboard', 1, '2020-02-27 05:37:04', '2020-02-27 05:37:04'),
(9, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0002 ha sido cancelada', 'fas fa-clipboard', 1, '2020-02-29 14:07:44', '2020-02-29 14:07:44'),
(10, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0002 ha sido cancelada', 'fas fa-clipboard', 1, '2020-02-29 14:09:10', '2020-02-29 14:09:10'),
(11, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0002 ha sido cancelada', 'fas fa-clipboard', 1, '2020-02-29 14:10:50', '2020-02-29 14:10:50'),
(12, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-02.5\" ha sido creado', 'fas fa-clipboard', 1, '2020-02-29 14:14:24', '2020-02-29 14:14:24'),
(13, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 1, '2020-02-29 14:16:25', '2020-02-29 14:16:25'),
(14, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0002\" ha sido creado', 'fas fa-clipboard', 1, '2020-02-29 14:17:20', '2020-02-29 14:17:20'),
(15, 1, 'Orden de Compra Modificada', 'La orden de compra #\"6\" ha sido creada', 'fas fa-cart-arrow-down', 1, '2020-02-29 18:25:41', '2020-02-29 18:25:41'),
(16, 3, 'Orden de Compra Cancelada', 'La orden de compra #\"5\" ha sido cancelada', 'fas fa-cart-arrow-down', 1, '2020-02-29 18:25:56', '2020-02-29 18:25:56'),
(17, 1, 'Insumo Creado', 'El insumo con el código \"A-00008\" ha sido creado', 'fas fa-capsules', 1, '2020-02-29 19:01:18', '2020-02-29 19:01:18'),
(18, 2, 'Insumo Modificado', 'El insumo con el código \"A-00008\" ha sido modificado', 'fas fa-capsules', 1, '2020-02-29 19:03:25', '2020-02-29 19:03:25'),
(19, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 1, '2020-03-04 04:19:48', '2020-03-04 04:19:48'),
(20, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 1, '2020-03-04 04:46:59', '2020-03-04 04:46:59'),
(21, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-11 21:51:10', '2020-03-11 21:51:10'),
(22, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-11 21:58:50', '2020-03-11 21:58:50'),
(23, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-11 21:59:00', '2020-03-11 21:59:00'),
(24, 1, 'Orden de Compra Modificada', 'La orden de compra #\"7\" ha sido creada', 'fas fa-cart-arrow-down', 1, '2020-03-11 22:22:53', '2020-03-11 22:22:53'),
(25, 1, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido creada', 'fas fa-cart-arrow-down', 1, '2020-03-20 01:37:44', '2020-03-20 01:37:44'),
(26, 1, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido creada', 'fas fa-cart-arrow-down', 1, '2020-03-20 01:39:29', '2020-03-20 01:39:29'),
(27, 1, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido creada', 'fas fa-cart-arrow-down', 1, '2020-03-20 01:41:50', '2020-03-20 01:41:50'),
(28, 1, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido creada', 'fas fa-cart-arrow-down', 1, '2020-03-20 21:39:15', '2020-03-20 21:39:15'),
(29, 2, 'Insumo Modificado', 'El insumo con el código \"A-00001\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-20 22:08:21', '2020-03-20 22:08:21'),
(30, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-22 14:50:09', '2020-03-22 14:50:09'),
(31, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-22 14:52:31', '2020-03-22 14:52:31'),
(32, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-22 14:52:36', '2020-03-22 14:52:36'),
(33, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-23 14:07:47', '2020-03-23 14:07:47'),
(34, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-25 21:02:53', '2020-03-25 21:02:53'),
(35, 1, 'Receta Creada', 'La receta con el código \"sdasasdasd\" ha sido creada', 'fas fa-flask', 1, '2020-03-30 14:26:08', '2020-03-30 14:26:08'),
(36, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-02.5\" ha sido creado', 'fas fa-clipboard', 1, '2020-03-30 14:33:49', '2020-03-30 14:33:49'),
(37, 1, 'Producto Creado', 'El producto con el código \"XYZ-0001\" ha sido creado', 'fas fa-flask', 1, '2020-03-30 17:01:20', '2020-03-30 17:01:20'),
(38, 2, 'Producto Modificado', 'El producto con el código \"XYZ-0001\" ha sido modificado', 'fas fa-flask', 1, '2020-03-30 17:10:43', '2020-03-30 17:10:43'),
(39, 2, 'Producto Modificado', 'El producto con el código \"XYZ-0001\" ha sido modificado', 'fas fa-flask', 1, '2020-03-30 17:11:37', '2020-03-30 17:11:37'),
(40, 2, 'Producto Modificado', 'El producto con el código \"XYZ-0001\" ha sido modificado', 'fas fa-flask', 1, '2020-03-30 17:11:43', '2020-03-30 17:11:43'),
(41, 2, 'Producto Modificado', 'El producto con el código \"XYZ-0001\" ha sido modificado', 'fas fa-flask', 1, '2020-03-30 17:11:48', '2020-03-30 17:11:48'),
(42, 2, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido modificada', 'fas fa-cart-arrow-down', 1, '2020-03-30 19:15:22', '2020-03-30 19:15:22'),
(43, 1, 'Insumo Creado', 'El insumo con el código \"A-00009\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 19:59:52', '2020-03-30 19:59:52'),
(44, 1, 'Insumo Creado', 'El insumo con el código \"A-00010\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:00:42', '2020-03-30 20:00:42'),
(45, 1, 'Insumo Creado', 'El insumo con el código \"A-00011\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:01:00', '2020-03-30 20:01:00'),
(46, 1, 'Insumo Creado', 'El insumo con el código \"A-00012\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:01:21', '2020-03-30 20:01:21'),
(47, 1, 'Insumo Creado', 'El insumo con el código \"A-00013\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:01:39', '2020-03-30 20:01:39'),
(48, 1, 'Insumo Creado', 'El insumo con el código \"A-00014\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:02:06', '2020-03-30 20:02:06'),
(49, 1, 'Insumo Creado', 'El insumo con el código \"A-00015\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:02:27', '2020-03-30 20:02:27'),
(50, 1, 'Insumo Creado', 'El insumo con el código \"A-00016\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:02:47', '2020-03-30 20:02:47'),
(51, 1, 'Insumo Creado', 'El insumo con el código \"A-00017\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:04:26', '2020-03-30 20:04:26'),
(52, 1, 'Insumo Creado', 'El insumo con el código \"A-00018\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:04:48', '2020-03-30 20:04:48'),
(53, 1, 'Insumo Creado', 'El insumo con el código \"A-00019\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:05:06', '2020-03-30 20:05:06'),
(54, 1, 'Insumo Creado', 'El insumo con el código \"C-00002\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:50:21', '2020-03-30 20:50:21'),
(55, 2, 'Insumo Modificado', 'El insumo con el código \"A-00002\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 19:59:55', '2020-03-31 19:59:55'),
(56, 2, 'Insumo Modificado', 'El insumo con el código \"A-00006\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 20:00:50', '2020-03-31 20:00:50'),
(57, 2, 'Insumo Modificado', 'El insumo con el código \"A-00033\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 20:01:57', '2020-03-31 20:01:57'),
(58, 2, 'Insumo Modificado', 'El insumo con el código \"A-00028\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 20:02:51', '2020-03-31 20:02:51'),
(59, 2, 'Insumo Modificado', 'El insumo con el código \"A-00007\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 20:04:27', '2020-03-31 20:04:27'),
(60, 2, 'Insumo Modificado', 'El insumo con el código \"A-00063\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:37:56', '2020-03-31 21:37:56'),
(61, 2, 'Insumo Modificado', 'El insumo con el código \"A-00051\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:42:13', '2020-03-31 21:42:13'),
(62, 1, 'Insumo Creado', 'El insumo con el código \"A-00079\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 21:43:31', '2020-03-31 21:43:31'),
(63, 2, 'Insumo Modificado', 'El insumo con el código \"A-00079\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:45:02', '2020-03-31 21:45:02'),
(64, 2, 'Insumo Modificado', 'El insumo con el código \"A-00079\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:45:24', '2020-03-31 21:45:24'),
(65, 2, 'Insumo Modificado', 'El insumo con el código \"A-00051\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:46:24', '2020-03-31 21:46:24'),
(66, 1, 'Insumo Creado', 'El insumo con el código \"A-00072\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 21:49:06', '2020-03-31 21:49:06'),
(67, 2, 'Insumo Modificado', 'El insumo con el código \"A-00072\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:49:26', '2020-03-31 21:49:26'),
(68, 1, 'Insumo Creado', 'El insumo con el código \"A-00092\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 21:51:47', '2020-03-31 21:51:47'),
(69, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:52:14', '2020-03-31 21:52:14'),
(70, 1, 'Insumo Creado', 'El insumo con el código \"A-00090\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 21:55:45', '2020-03-31 21:55:45'),
(71, 2, 'Insumo Modificado', 'El insumo con el código \"A-00090\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:56:15', '2020-03-31 21:56:15'),
(72, 2, 'Insumo Modificado', 'El insumo con el código \"A-00021\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:56:42', '2020-03-31 21:56:42'),
(73, 2, 'Insumo Modificado', 'El insumo con el código \"A-00058\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:57:03', '2020-03-31 21:57:03'),
(74, 2, 'Insumo Modificado', 'El insumo con el código \"A-00015\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 21:58:54', '2020-03-31 21:58:54'),
(75, 1, 'Insumo Creado', 'El insumo con el código \"A-00073\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 22:00:25', '2020-03-31 22:00:25'),
(76, 2, 'Insumo Modificado', 'El insumo con el código \"A-00073\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:00:51', '2020-03-31 22:00:51'),
(77, 2, 'Insumo Modificado', 'El insumo con el código \"A-00073\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:01:24', '2020-03-31 22:01:24'),
(78, 2, 'Insumo Modificado', 'El insumo con el código \"A-00010\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:06:20', '2020-03-31 22:06:20'),
(79, 2, 'Insumo Modificado', 'El insumo con el código \"A-00054\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:06:49', '2020-03-31 22:06:49'),
(80, 2, 'Insumo Modificado', 'El insumo con el código \"A-00071\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:07:20', '2020-03-31 22:07:20'),
(81, 1, 'Insumo Creado', 'El insumo con el código \"A-00077\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 22:08:44', '2020-03-31 22:08:44'),
(82, 2, 'Insumo Modificado', 'El insumo con el código \"A-00077\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:09:04', '2020-03-31 22:09:04'),
(83, 2, 'Insumo Modificado', 'El insumo con el código \"A-00035\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:09:42', '2020-03-31 22:09:42'),
(84, 2, 'Insumo Modificado', 'El insumo con el código \"A-00041\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:10:22', '2020-03-31 22:10:22'),
(85, 2, 'Insumo Modificado', 'El insumo con el código \"A-00032\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:10:59', '2020-03-31 22:10:59'),
(86, 2, 'Insumo Modificado', 'El insumo con el código \"A-00027\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:11:51', '2020-03-31 22:11:51'),
(87, 2, 'Insumo Modificado', 'El insumo con el código \"A-00026\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:12:26', '2020-03-31 22:12:26'),
(88, 2, 'Insumo Modificado', 'El insumo con el código \"A-00042\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:13:01', '2020-03-31 22:13:01'),
(89, 2, 'Insumo Modificado', 'El insumo con el código \"A-00023\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:13:40', '2020-03-31 22:13:40'),
(90, 2, 'Insumo Modificado', 'El insumo con el código \"A-00053\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:14:19', '2020-03-31 22:14:19'),
(91, 2, 'Insumo Modificado', 'El insumo con el código \"A-00013\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:14:54', '2020-03-31 22:14:54'),
(92, 2, 'Insumo Modificado', 'El insumo con el código \"A-00049\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:15:33', '2020-03-31 22:15:33'),
(93, 1, 'Insumo Creado', 'El insumo con el código \"A-00074\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 22:17:18', '2020-03-31 22:17:18'),
(94, 2, 'Insumo Modificado', 'El insumo con el código \"A-00074\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:17:53', '2020-03-31 22:17:53'),
(95, 2, 'Insumo Modificado', 'El insumo con el código \"A-00040\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:18:29', '2020-03-31 22:18:29'),
(96, 2, 'Insumo Modificado', 'El insumo con el código \"A-00006\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:19:11', '2020-03-31 22:19:11'),
(97, 2, 'Insumo Modificado', 'El insumo con el código \"A-00040\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:22:15', '2020-03-31 22:22:15'),
(98, 2, 'Insumo Modificado', 'El insumo con el código \"A-00043\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:22:35', '2020-03-31 22:22:35'),
(99, 2, 'Insumo Modificado', 'El insumo con el código \"A-00056\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:23:04', '2020-03-31 22:23:04'),
(100, 2, 'Insumo Modificado', 'El insumo con el código \"A-00028\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:23:57', '2020-03-31 22:23:57'),
(101, 2, 'Insumo Modificado', 'El insumo con el código \"A-00031\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:24:57', '2020-03-31 22:24:57'),
(102, 2, 'Insumo Modificado', 'El insumo con el código \"A-00044\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:25:33', '2020-03-31 22:25:33'),
(103, 2, 'Insumo Modificado', 'El insumo con el código \"A-00002\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:26:52', '2020-03-31 22:26:52'),
(104, 1, 'Insumo Creado', 'El insumo con el código \"A-00080\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 22:28:44', '2020-03-31 22:28:44'),
(105, 2, 'Insumo Modificado', 'El insumo con el código \"A-00080\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:29:08', '2020-03-31 22:29:08'),
(106, 2, 'Insumo Modificado', 'El insumo con el código \"A-00002\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:30:43', '2020-03-31 22:30:43'),
(107, 2, 'Insumo Modificado', 'El insumo con el código \"A-00003\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:31:48', '2020-03-31 22:31:48'),
(108, 2, 'Insumo Modificado', 'El insumo con el código \"A-00022\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:32:26', '2020-03-31 22:32:26'),
(109, 2, 'Insumo Modificado', 'El insumo con el código \"A-00025\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:32:55', '2020-03-31 22:32:55'),
(110, 2, 'Insumo Modificado', 'El insumo con el código \"A-00064\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:33:29', '2020-03-31 22:33:29'),
(111, 2, 'Insumo Modificado', 'El insumo con el código \"A-00024\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:34:15', '2020-03-31 22:34:15'),
(112, 2, 'Insumo Modificado', 'El insumo con el código \"A-00004\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:35:39', '2020-03-31 22:35:39'),
(113, 2, 'Insumo Modificado', 'El insumo con el código \"A-00050\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:36:15', '2020-03-31 22:36:15'),
(114, 2, 'Insumo Modificado', 'El insumo con el código \"A-00012\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:37:55', '2020-03-31 22:37:55'),
(115, 2, 'Insumo Modificado', 'El insumo con el código \"A-00038\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:39:23', '2020-03-31 22:39:23'),
(116, 2, 'Insumo Modificado', 'El insumo con el código \"A-00046\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:40:00', '2020-03-31 22:40:00'),
(117, 2, 'Insumo Modificado', 'El insumo con el código \"A-00012\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:40:53', '2020-03-31 22:40:53'),
(118, 2, 'Insumo Modificado', 'El insumo con el código \"A-00011\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:41:41', '2020-03-31 22:41:41'),
(119, 2, 'Insumo Modificado', 'El insumo con el código \"A-00039\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:42:43', '2020-03-31 22:42:43'),
(120, 2, 'Insumo Modificado', 'El insumo con el código \"A-00005\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:43:42', '2020-03-31 22:43:42'),
(121, 2, 'Insumo Modificado', 'El insumo con el código \"A-00052\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:44:16', '2020-03-31 22:44:16'),
(122, 2, 'Insumo Modificado', 'El insumo con el código \"A-00037\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:44:53', '2020-03-31 22:44:53'),
(123, 2, 'Insumo Modificado', 'El insumo con el código \"A-00034\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:45:36', '2020-03-31 22:45:36'),
(124, 1, 'Insumo Creado', 'El insumo con el código \"A-00075\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 22:46:49', '2020-03-31 22:46:49'),
(125, 2, 'Insumo Modificado', 'El insumo con el código \"A-00075\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:47:19', '2020-03-31 22:47:19'),
(126, 2, 'Insumo Modificado', 'El insumo con el código \"A-00001\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:48:06', '2020-03-31 22:48:06'),
(127, 2, 'Insumo Modificado', 'El insumo con el código \"A-00070\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:48:30', '2020-03-31 22:48:30'),
(128, 1, 'Insumo Creado', 'El insumo con el código \"A-00076\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 22:49:22', '2020-03-31 22:49:22'),
(129, 2, 'Insumo Modificado', 'El insumo con el código \"A-00076\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:49:41', '2020-03-31 22:49:41'),
(130, 2, 'Insumo Modificado', 'El insumo con el código \"A-00059\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:51:27', '2020-03-31 22:51:27'),
(131, 2, 'Insumo Modificado', 'El insumo con el código \"A-00066\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:52:31', '2020-03-31 22:52:31'),
(132, 2, 'Insumo Modificado', 'El insumo con el código \"A-00048\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:53:16', '2020-03-31 22:53:16'),
(133, 2, 'Insumo Modificado', 'El insumo con el código \"A-00019\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:53:49', '2020-03-31 22:53:49'),
(134, 2, 'Insumo Modificado', 'El insumo con el código \"A-00014\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:54:27', '2020-03-31 22:54:27'),
(135, 2, 'Insumo Modificado', 'El insumo con el código \"A-00016\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:55:13', '2020-03-31 22:55:13'),
(136, 1, 'Insumo Creado', 'El insumo con el código \"A-00093\" ha sido creado', 'fas fa-capsules', 1, '2020-03-31 22:56:54', '2020-03-31 22:56:54'),
(137, 2, 'Insumo Modificado', 'El insumo con el código \"A-00093\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:57:04', '2020-03-31 22:57:04'),
(138, 2, 'Insumo Modificado', 'El insumo con el código \"A-00008\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:58:34', '2020-03-31 22:58:34'),
(139, 2, 'Insumo Modificado', 'El insumo con el código \"A-00007\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:58:57', '2020-03-31 22:58:57'),
(140, 2, 'Insumo Modificado', 'El insumo con el código \"A-00009\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:59:14', '2020-03-31 22:59:14'),
(141, 2, 'Insumo Modificado', 'El insumo con el código \"A-00018\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 22:59:43', '2020-03-31 22:59:43'),
(142, 2, 'Insumo Modificado', 'El insumo con el código \"A-00020\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:00:04', '2020-03-31 23:00:04'),
(143, 2, 'Insumo Modificado', 'El insumo con el código \"A-00017\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:00:24', '2020-03-31 23:00:24'),
(144, 2, 'Insumo Modificado', 'El insumo con el código \"A-00021\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:00:46', '2020-03-31 23:00:46'),
(145, 2, 'Insumo Modificado', 'El insumo con el código \"A-00030\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:01:08', '2020-03-31 23:01:08'),
(146, 2, 'Insumo Modificado', 'El insumo con el código \"A-00036\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:01:36', '2020-03-31 23:01:36'),
(147, 2, 'Insumo Modificado', 'El insumo con el código \"A-00047\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:02:12', '2020-03-31 23:02:12'),
(148, 2, 'Insumo Modificado', 'El insumo con el código \"A-00058\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:02:35', '2020-03-31 23:02:35'),
(149, 2, 'Insumo Modificado', 'El insumo con el código \"A-00045\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:03:00', '2020-03-31 23:03:00'),
(150, 2, 'Insumo Modificado', 'El insumo con el código \"A-00057\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:03:25', '2020-03-31 23:03:25'),
(151, 2, 'Insumo Modificado', 'El insumo con el código \"A-00069\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:03:46', '2020-03-31 23:03:46'),
(152, 2, 'Insumo Modificado', 'El insumo con el código \"A-00068\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:04:04', '2020-03-31 23:04:04'),
(153, 2, 'Insumo Modificado', 'El insumo con el código \"A-00065\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:04:24', '2020-03-31 23:04:24'),
(154, 2, 'Insumo Modificado', 'El insumo con el código \"A-00067\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:04:55', '2020-03-31 23:04:55'),
(155, 2, 'Insumo Modificado', 'El insumo con el código \"A-00062\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:05:41', '2020-03-31 23:05:41'),
(156, 2, 'Insumo Modificado', 'El insumo con el código \"A-00063\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:06:09', '2020-03-31 23:06:09'),
(157, 2, 'Insumo Modificado', 'El insumo con el código \"A-00029\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:07:15', '2020-03-31 23:07:15'),
(158, 2, 'Insumo Modificado', 'El insumo con el código \"A-00033\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-31 23:07:44', '2020-03-31 23:07:44'),
(159, 2, 'Insumo Modificado', 'El insumo con el código \"A-00001\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-01 13:46:31', '2020-04-01 13:46:31'),
(160, 2, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido modificada', 'fas fa-cart-arrow-down', 3, '2020-04-01 13:57:23', '2020-04-01 13:57:23'),
(161, 1, 'Receta Creada', 'La receta con el código \"G-00001\" ha sido creada', 'fas fa-flask', 3, '2020-04-01 14:03:02', '2020-04-01 14:03:02'),
(162, 1, 'Orden de Compra Modificada', 'La orden de compra #\"4\" ha sido creada', 'fas fa-cart-arrow-down', 3, '2020-04-01 14:06:18', '2020-04-01 14:06:18'),
(163, 2, 'Orden de Compra Modificada', 'La orden de compra #\"4\" ha sido modificada', 'fas fa-cart-arrow-down', 3, '2020-04-01 14:08:20', '2020-04-01 14:08:20'),
(164, 2, 'Orden de Compra Modificada', 'La orden de compra #\"4\" ha sido modificada', 'fas fa-cart-arrow-down', 3, '2020-04-01 14:08:57', '2020-04-01 14:08:57'),
(165, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-03.5\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-01 15:08:06', '2020-04-01 15:08:06'),
(166, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-03.5\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-01 15:10:04', '2020-04-01 15:10:04'),
(167, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-03.5\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-06 11:53:13', '2020-04-06 11:53:13'),
(168, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-06 11:57:15', '2020-04-06 11:57:15'),
(169, 2, 'Receta Modificada', 'La receta con el código \"G-00001\" ha sido modificada', 'fas fa-flask', 3, '2020-04-06 12:04:29', '2020-04-06 12:04:29'),
(170, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-06 12:04:56', '2020-04-06 12:04:56'),
(171, 1, 'Receta Creada', 'La receta con el código \"A-00100\" ha sido creada', 'fas fa-flask', 3, '2020-04-06 12:08:22', '2020-04-06 12:08:22'),
(172, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0002\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-06 12:08:48', '2020-04-06 12:08:48'),
(173, 2, 'Receta Modificada', 'La receta con el código \"GPM0001\" ha sido modificada', 'fas fa-flask', 3, '2020-04-06 12:35:34', '2020-04-06 12:35:34'),
(174, 2, 'Receta Modificada', 'La receta con el código \"GPM0001\" ha sido modificada', 'fas fa-flask', 3, '2020-04-06 12:36:06', '2020-04-06 12:36:06'),
(175, 2, 'Receta Modificada', 'La receta con el código \"GPM0001\" ha sido modificada', 'fas fa-flask', 3, '2020-04-06 12:39:43', '2020-04-06 12:39:43'),
(176, 1, 'Insumo Creado', 'El insumo con el código \"A-00082\" ha sido creado', 'fas fa-capsules', 3, '2020-04-06 12:42:58', '2020-04-06 12:42:58'),
(177, 1, 'Insumo Creado', 'El insumo con el código \"A-00081\" ha sido creado', 'fas fa-capsules', 3, '2020-04-06 12:44:28', '2020-04-06 12:44:28'),
(178, 2, 'Receta Modificada', 'La receta con el código \"GPM0003\" ha sido modificada', 'fas fa-flask', 3, '2020-04-06 12:46:30', '2020-04-06 12:46:30'),
(179, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0003\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-06 12:47:52', '2020-04-06 12:47:52'),
(180, 1, 'Cliente Creado', 'El cliente \"NATURA EXTRACTA\" ha sido creado', 'fas fa-user-tie', 3, '2020-04-06 12:51:44', '2020-04-06 12:51:44'),
(181, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0003 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-06 12:52:40', '2020-04-06 12:52:40'),
(182, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0003 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-06 12:52:53', '2020-04-06 12:52:53'),
(183, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0003 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-06 12:53:21', '2020-04-06 12:53:21'),
(184, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:01:55', '2020-04-06 13:01:55'),
(185, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:07:00', '2020-04-06 13:07:00'),
(186, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:07:57', '2020-04-06 13:07:57'),
(187, 2, 'Receta Modificada', 'La receta con el código \"GPM0005\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:11:05', '2020-04-06 13:11:05'),
(188, 1, 'Receta Creada', 'La receta con el código \"GPM0006\" ha sido creada', 'fas fa-flask', 6, '2020-04-06 13:13:33', '2020-04-06 13:13:33'),
(189, 2, 'Receta Modificada', 'La receta con el código \"GPM0006\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:13:50', '2020-04-06 13:13:50'),
(190, 2, 'Receta Modificada', 'La receta con el código \"GPM0006\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:14:07', '2020-04-06 13:14:07'),
(191, 2, 'Receta Modificada', 'La receta con el código \"GPM0006\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:14:22', '2020-04-06 13:14:22'),
(192, 2, 'Receta Modificada', 'La receta con el código \"GPM0006\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:15:30', '2020-04-06 13:15:30'),
(193, 2, 'Receta Modificada', 'La receta con el código \"GPM0006\" ha sido modificada', 'fas fa-flask', 6, '2020-04-06 13:15:56', '2020-04-06 13:15:56'),
(194, 1, 'Receta Creada', 'La receta con el código \"GPM007\" ha sido creada', 'fas fa-flask', 6, '2020-04-06 13:19:09', '2020-04-06 13:19:09'),
(195, 2, 'Insumo Modificado', 'El insumo con el código \"A-00001\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-06 14:15:34', '2020-04-06 14:15:34'),
(196, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 11:09:08', '2020-04-07 11:09:08'),
(197, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 11:09:35', '2020-04-07 11:09:35'),
(198, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 11:09:56', '2020-04-07 11:09:56'),
(199, 2, 'Molde Modificado', 'El molde con el código \"14OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-07 11:10:36', '2020-04-07 11:10:36'),
(200, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 11:35:19', '2020-04-07 11:35:19'),
(201, 2, 'Receta Modificada', 'La receta con el código \"GPM002\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 11:40:02', '2020-04-07 11:40:02'),
(202, 1, 'Insumo Creado', 'El insumo con el código \"A-00078\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:04:28', '2020-04-07 12:04:28'),
(203, 1, 'Insumo Creado', 'El insumo con el código \"A-00083\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:06:14', '2020-04-07 12:06:14'),
(204, 1, 'Insumo Creado', 'El insumo con el código \"A-00084\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:11:37', '2020-04-07 12:11:37'),
(205, 1, 'Insumo Creado', 'El insumo con el código \"A-00085\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:13:02', '2020-04-07 12:13:02'),
(206, 1, 'Insumo Creado', 'El insumo con el código \"A-00086\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:14:39', '2020-04-07 12:14:39'),
(207, 1, 'Insumo Creado', 'El insumo con el código \"A-00087\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:17:07', '2020-04-07 12:17:07'),
(208, 1, 'Insumo Creado', 'El insumo con el código \"A-00088\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:19:15', '2020-04-07 12:19:15'),
(209, 1, 'Insumo Creado', 'El insumo con el código \"A-00089\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:29:32', '2020-04-07 12:29:32'),
(210, 1, 'Insumo Creado', 'El insumo con el código \"A-00090\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:33:49', '2020-04-07 12:33:49'),
(211, 2, 'Insumo Modificado', 'El insumo con el código \"A-00090\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-07 12:34:36', '2020-04-07 12:34:36'),
(212, 2, 'Insumo Modificado', 'El insumo con el código \"A-00090\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-07 12:36:07', '2020-04-07 12:36:07'),
(213, 1, 'Insumo Creado', 'El insumo con el código \"A-00091\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:40:41', '2020-04-07 12:40:41'),
(214, 1, 'Insumo Creado', 'El insumo con el código \"A-00092\" ha sido creado', 'fas fa-capsules', 3, '2020-04-07 12:41:13', '2020-04-07 12:41:13'),
(215, 2, 'Receta Modificada', 'La receta con el código \"GPM0003\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 12:48:20', '2020-04-07 12:48:20'),
(216, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0004\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-07 12:49:27', '2020-04-07 12:49:27'),
(217, 1, 'Cliente Creado', 'El cliente \"MEDIX\" ha sido creado', 'fas fa-user-tie', 3, '2020-04-07 13:05:47', '2020-04-07 13:05:47'),
(218, 2, 'Receta Modificada', 'La receta con el código \"GPM0005\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 13:06:27', '2020-04-07 13:06:27'),
(219, 2, 'Receta Modificada', 'La receta con el código \"GPM0005\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 13:07:53', '2020-04-07 13:07:53'),
(220, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0002 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-07 13:10:17', '2020-04-07 13:10:17'),
(221, 2, 'Receta Modificada', 'La receta con el código \"GPM0003\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 14:25:25', '2020-04-07 14:25:25'),
(222, 2, 'Receta Modificada', 'La receta con el código \"GPM0003\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 14:26:18', '2020-04-07 14:26:18'),
(223, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 16:26:22', '2020-04-07 16:26:22'),
(224, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 16:28:49', '2020-04-07 16:28:49'),
(225, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-07 16:32:34', '2020-04-07 16:32:34'),
(226, 1, 'Receta Creada', 'La receta con el código \"PRUEBA\" ha sido creada', 'fas fa-flask', 3, '2020-04-07 16:34:37', '2020-04-07 16:34:37'),
(227, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0005\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-07 16:35:45', '2020-04-07 16:35:45'),
(228, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-07 16:37:45', '2020-04-07 16:37:45'),
(229, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-07 16:38:03', '2020-04-07 16:38:03'),
(230, 1, 'Cliente Creado', 'El cliente \"FARMACOS HISPANOAMERICANOS\" ha sido creado', 'fas fa-user-tie', 3, '2020-04-07 19:41:02', '2020-04-07 19:41:02'),
(231, 2, 'Receta Modificada', 'La receta con el código \"PRUEBA\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 19:49:29', '2020-04-07 19:49:29'),
(232, 2, 'Receta Modificada', 'La receta con el código \"PRUEBA2\" ha sido modificada', 'fas fa-flask', 3, '2020-04-07 19:52:16', '2020-04-07 19:52:16'),
(233, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0006\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-07 19:52:57', '2020-04-07 19:52:57'),
(234, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0006 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-07 19:54:40', '2020-04-07 19:54:40'),
(235, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-07 19:54:47', '2020-04-07 19:54:47'),
(236, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-07 19:55:33', '2020-04-07 19:55:33'),
(237, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-07 19:55:56', '2020-04-07 19:55:56'),
(238, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-07 19:57:22', '2020-04-07 19:57:22'),
(239, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-07 19:57:59', '2020-04-07 19:57:59'),
(240, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0007\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-07 19:59:02', '2020-04-07 19:59:02'),
(241, 2, 'Insumo Modificado', 'El insumo con el código \"A-00085\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:27:04', '2020-04-08 12:27:04'),
(242, 2, 'Insumo Modificado', 'El insumo con el código \"A-00085\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:28:37', '2020-04-08 12:28:37'),
(243, 2, 'Insumo Modificado', 'El insumo con el código \"A-00029\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:29:10', '2020-04-08 12:29:10'),
(244, 2, 'Insumo Modificado', 'El insumo con el código \"A-00078\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:36:16', '2020-04-08 12:36:16'),
(245, 2, 'Insumo Modificado', 'El insumo con el código \"A-00084\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:36:50', '2020-04-08 12:36:50'),
(246, 2, 'Insumo Modificado', 'El insumo con el código \"A-00015\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:38:41', '2020-04-08 12:38:41'),
(247, 2, 'Insumo Modificado', 'El insumo con el código \"A-00057\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:39:14', '2020-04-08 12:39:14'),
(248, 2, 'Insumo Modificado', 'El insumo con el código \"A-00015\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:45:47', '2020-04-08 12:45:47'),
(249, 2, 'Insumo Modificado', 'El insumo con el código \"A-00057\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 12:46:24', '2020-04-08 12:46:24'),
(250, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 12:55:45', '2020-04-08 12:55:45'),
(251, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 12:59:26', '2020-04-08 12:59:26'),
(252, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 13:14:40', '2020-04-08 13:14:40'),
(253, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 13:16:11', '2020-04-08 13:16:11'),
(254, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 13:17:42', '2020-04-08 13:17:42'),
(255, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 13:20:12', '2020-04-08 13:20:12'),
(256, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 13:28:14', '2020-04-08 13:28:14'),
(257, 2, 'Receta Modificada', 'La receta con el código \"GPM0004\" ha sido modificada', 'fas fa-flask', 3, '2020-04-08 13:28:38', '2020-04-08 13:28:38'),
(258, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0007 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:18:57', '2020-04-08 16:18:57'),
(259, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:19:05', '2020-04-08 16:19:05'),
(260, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:19:17', '2020-04-08 16:19:17'),
(261, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0007 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:19:26', '2020-04-08 16:19:26'),
(262, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0007 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:19:39', '2020-04-08 16:19:39'),
(263, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:19:53', '2020-04-08 16:19:53'),
(264, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-08 16:21:09', '2020-04-08 16:21:09'),
(265, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0008\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-08 16:22:16', '2020-04-08 16:22:16'),
(266, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0008 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:23:46', '2020-04-08 16:23:46'),
(267, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0008 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:23:56', '2020-04-08 16:23:56'),
(268, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0008 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:24:07', '2020-04-08 16:24:07'),
(269, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-08 16:24:22', '2020-04-08 16:24:22'),
(270, 2, 'Insumo Modificado', 'El insumo con el código \"C-00001\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-09 11:10:08', '2020-04-09 11:10:08'),
(271, 2, 'Insumo Modificado', 'El insumo con el código \"C-00001\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-09 11:12:52', '2020-04-09 11:12:52'),
(272, 2, 'Insumo Modificado', 'El insumo con el código \"C-00002\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-09 11:14:07', '2020-04-09 11:14:07'),
(273, 1, 'Insumo Creado', 'El insumo con el código \"C-00003\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:15:22', '2020-04-09 11:15:22'),
(274, 1, 'Insumo Creado', 'El insumo con el código \"C-00004\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:16:31', '2020-04-09 11:16:31'),
(275, 1, 'Insumo Creado', 'El insumo con el código \"C-00005\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:17:30', '2020-04-09 11:17:30'),
(276, 1, 'Insumo Creado', 'El insumo con el código \"C-00006\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:18:23', '2020-04-09 11:18:23'),
(277, 1, 'Insumo Creado', 'El insumo con el código \"C-00007\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:19:11', '2020-04-09 11:19:11'),
(278, 1, 'Insumo Creado', 'El insumo con el código \"C-00008\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:20:16', '2020-04-09 11:20:16'),
(279, 1, 'Insumo Creado', 'El insumo con el código \"C-00009\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:21:14', '2020-04-09 11:21:14'),
(280, 1, 'Insumo Creado', 'El insumo con el código \"C-00010\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:22:47', '2020-04-09 11:22:47'),
(281, 1, 'Insumo Creado', 'El insumo con el código \"C-00011\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:23:50', '2020-04-09 11:23:50'),
(282, 1, 'Insumo Creado', 'El insumo con el código \"C-00012\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:25:05', '2020-04-09 11:25:05'),
(283, 1, 'Insumo Creado', 'El insumo con el código \"C-00013\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:27:00', '2020-04-09 11:27:00'),
(284, 1, 'Insumo Creado', 'El insumo con el código \"C-00014\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:28:06', '2020-04-09 11:28:06'),
(285, 1, 'Insumo Creado', 'El insumo con el código \"C-00015\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:29:03', '2020-04-09 11:29:03'),
(286, 1, 'Insumo Creado', 'El insumo con el código \"C-00016\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:32:39', '2020-04-09 11:32:39'),
(287, 1, 'Insumo Creado', 'El insumo con el código \"C-00017\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:33:37', '2020-04-09 11:33:37'),
(288, 1, 'Insumo Creado', 'El insumo con el código \"C-00018\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:34:38', '2020-04-09 11:34:38'),
(289, 1, 'Insumo Creado', 'El insumo con el código \"C-00019\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:36:21', '2020-04-09 11:36:21'),
(290, 1, 'Insumo Creado', 'El insumo con el código \"C-00020\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:37:14', '2020-04-09 11:37:14'),
(291, 1, 'Insumo Creado', 'El insumo con el código \"C-00021\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:37:59', '2020-04-09 11:37:59'),
(292, 1, 'Insumo Creado', 'El insumo con el código \"C-00022\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:38:51', '2020-04-09 11:38:51'),
(293, 2, 'Insumo Modificado', 'El insumo con el código \"D-00001\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-09 11:41:59', '2020-04-09 11:41:59'),
(294, 1, 'Insumo Creado', 'El insumo con el código \"D-00002\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:43:06', '2020-04-09 11:43:06'),
(295, 1, 'Insumo Creado', 'El insumo con el código \"D-00003\" ha sido creado', 'fas fa-capsules', 3, '2020-04-09 11:43:55', '2020-04-09 11:43:55'),
(296, 1, 'Receta Creada', 'La receta con el código \"GSA0001\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 17:32:20', '2020-04-09 17:32:20'),
(297, 1, 'Receta Creada', 'La receta con el código \"GSA0002\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 17:35:00', '2020-04-09 17:35:00'),
(298, 1, 'Receta Creada', 'La receta con el código \"GSA0003\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 17:40:19', '2020-04-09 17:40:19'),
(299, 1, 'Receta Creada', 'La receta con el código \"GSA0004\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 17:42:25', '2020-04-09 17:42:25'),
(300, 1, 'Receta Creada', 'La receta con el código \"GSA0005\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 17:46:50', '2020-04-09 17:46:50'),
(301, 1, 'Receta Creada', 'La receta con el código \"GSA0006\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 17:54:24', '2020-04-09 17:54:24'),
(302, 2, 'Receta Modificada', 'La receta con el código \"GSA0006\" ha sido modificada', 'fas fa-flask', 3, '2020-04-09 17:56:12', '2020-04-09 17:56:12'),
(303, 1, 'Receta Creada', 'La receta con el código \"GSA0007\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 18:02:39', '2020-04-09 18:02:39'),
(304, 1, 'Receta Creada', 'La receta con el código \"GSA0008\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 18:07:48', '2020-04-09 18:07:48'),
(305, 1, 'Receta Creada', 'La receta con el código \"GSA0009\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 19:17:54', '2020-04-09 19:17:54'),
(306, 1, 'Receta Creada', 'La receta con el código \"GSA0010\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 19:20:48', '2020-04-09 19:20:48'),
(307, 1, 'Receta Creada', 'La receta con el código \"GSA0011\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 19:21:46', '2020-04-09 19:21:46'),
(308, 1, 'Receta Creada', 'La receta con el código \"GSA0012\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 19:24:30', '2020-04-09 19:24:30'),
(309, 1, 'Receta Creada', 'La receta con el código \"GSA0013\" ha sido creada', 'fas fa-flask', 3, '2020-04-09 19:28:51', '2020-04-09 19:28:51'),
(310, 2, 'Receta Modificada', 'La receta con el código \"GSA0013\" ha sido modificada', 'fas fa-flask', 3, '2020-04-13 14:57:40', '2020-04-13 14:57:40'),
(311, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-13 15:00:10', '2020-04-13 15:00:10'),
(312, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0008 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:08:03', '2020-04-13 15:08:03'),
(313, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:08:21', '2020-04-13 15:08:21'),
(314, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:09:26', '2020-04-13 15:09:26'),
(315, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0009\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-13 15:10:32', '2020-04-13 15:10:32'),
(316, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0009 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:12:12', '2020-04-13 15:12:12'),
(317, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0009 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:12:21', '2020-04-13 15:12:21'),
(318, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0010\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-13 15:13:39', '2020-04-13 15:13:39'),
(319, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0010 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:23:42', '2020-04-13 15:23:42'),
(320, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0010 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:23:59', '2020-04-13 15:23:59'),
(321, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0010 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:39:31', '2020-04-13 15:39:31'),
(322, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0005 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-13 15:44:51', '2020-04-13 15:44:51'),
(323, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0010 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-14 09:41:05', '2020-04-14 09:41:05'),
(324, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0008 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-14 09:41:16', '2020-04-14 09:41:16');
INSERT INTO `Logbooks` (`id`, `type_id`, `title`, `content`, `icon`, `created_by`, `created_at`, `updated_at`) VALUES
(325, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0007 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-14 09:41:22', '2020-04-14 09:41:22'),
(326, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0004 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-14 09:41:55', '2020-04-14 09:41:55'),
(327, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0009 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-14 09:42:00', '2020-04-14 09:42:00'),
(328, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0001 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-14 09:42:04', '2020-04-14 09:42:04'),
(329, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-14 09:44:53', '2020-04-14 09:44:53'),
(330, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0011\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-14 09:48:10', '2020-04-14 09:48:10'),
(331, 2, 'Insumo Modificado', 'El insumo con el código \"A-00001\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-14 10:17:49', '2020-04-14 10:17:49'),
(332, 2, 'Insumo Modificado', 'El insumo con el código \"A-00001\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-14 10:18:16', '2020-04-14 10:18:16'),
(333, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-14 10:19:06', '2020-04-14 10:19:06'),
(334, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0012\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-14 10:19:57', '2020-04-14 10:19:57'),
(335, 1, 'Receta Creada', 'La receta con el código \"GSA0013\" ha sido creada', 'fas fa-flask', 3, '2020-04-14 11:27:18', '2020-04-14 11:27:18'),
(336, 1, 'Cliente Creado', 'El cliente \"MARCA PROPIA\" ha sido creado', 'fas fa-user-tie', 3, '2020-04-14 11:35:38', '2020-04-14 11:35:38'),
(337, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-14 11:36:45', '2020-04-14 11:36:45'),
(338, 2, 'Receta Modificada', 'La receta con el código \"GSA0013\" ha sido modificada', 'fas fa-flask', 3, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(339, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0001 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-15 11:29:23', '2020-04-15 11:29:23'),
(340, 3, 'Orden de Fabricación Cancelada', 'La orden de fabricación #OT-0001 ha sido cancelada', 'fas fa-clipboard', 3, '2020-04-15 11:29:29', '2020-04-15 11:29:29'),
(341, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0002\" ha sido creado', 'fas fa-clipboard', 3, '2020-04-15 11:30:32', '2020-04-15 11:30:32'),
(342, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 6, '2020-04-15 12:05:03', '2020-04-15 12:05:03'),
(343, 2, 'Insumo Modificado', 'El insumo con el código \"A-00061\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-15 17:47:28', '2020-04-15 17:47:28'),
(344, 2, 'Insumo Modificado', 'El insumo con el código \"A-00061\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-15 17:49:33', '2020-04-15 17:49:33'),
(345, 1, 'Receta Creada', 'La receta con el código \"GSA0014\" ha sido creada', 'fas fa-flask', 6, '2020-04-15 18:00:46', '2020-04-15 18:00:46'),
(346, 2, 'Receta Modificada', 'La receta con el código \"GSA0014\" ha sido modificada', 'fas fa-flask', 6, '2020-04-15 18:01:56', '2020-04-15 18:01:56'),
(347, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0002\" ha sido creado', 'fas fa-clipboard', 6, '2020-04-15 18:02:41', '2020-04-15 18:02:41'),
(348, 2, 'Receta Modificada', 'La receta con el código \"GSA0014\" ha sido modificada', 'fas fa-flask', 6, '2020-04-16 09:44:43', '2020-04-16 09:44:43'),
(349, 2, 'Insumo Modificado', 'El insumo con el código \"A-00090\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:41:56', '2020-04-16 10:41:56'),
(350, 2, 'Insumo Modificado', 'El insumo con el código \"A-00040\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:42:44', '2020-04-16 10:42:44'),
(351, 2, 'Insumo Modificado', 'El insumo con el código \"A-00070\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:44:43', '2020-04-16 10:44:43'),
(352, 2, 'Insumo Modificado', 'El insumo con el código \"A-00006\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:47:12', '2020-04-16 10:47:12'),
(353, 2, 'Insumo Modificado', 'El insumo con el código \"A-00033\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:54:18', '2020-04-16 10:54:18'),
(354, 2, 'Insumo Modificado', 'El insumo con el código \"A-00028\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:54:55', '2020-04-16 10:54:55'),
(355, 2, 'Insumo Modificado', 'El insumo con el código \"A-00007\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:55:24', '2020-04-16 10:55:24'),
(356, 2, 'Insumo Modificado', 'El insumo con el código \"A-00063\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 10:55:58', '2020-04-16 10:55:58'),
(357, 2, 'Insumo Modificado', 'El insumo con el código \"A-00002\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:02:41', '2020-04-16 11:02:41'),
(358, 2, 'Insumo Modificado', 'El insumo con el código \"A-00043\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:05:22', '2020-04-16 11:05:22'),
(359, 2, 'Insumo Modificado', 'El insumo con el código \"A-00011\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:06:03', '2020-04-16 11:06:03'),
(360, 2, 'Insumo Modificado', 'El insumo con el código \"A-00034\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:06:43', '2020-04-16 11:06:43'),
(361, 2, 'Insumo Modificado', 'El insumo con el código \"A-00047\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:07:50', '2020-04-16 11:07:50'),
(362, 2, 'Insumo Modificado', 'El insumo con el código \"A-00016\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:08:23', '2020-04-16 11:08:23'),
(363, 2, 'Insumo Modificado', 'El insumo con el código \"A-00075\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:08:59', '2020-04-16 11:08:59'),
(364, 2, 'Insumo Modificado', 'El insumo con el código \"A-00066\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:09:39', '2020-04-16 11:09:39'),
(365, 2, 'Insumo Modificado', 'El insumo con el código \"A-00077\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:10:20', '2020-04-16 11:10:20'),
(366, 2, 'Insumo Modificado', 'El insumo con el código \"A-00032\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:10:51', '2020-04-16 11:10:51'),
(367, 2, 'Insumo Modificado', 'El insumo con el código \"A-00035\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:11:13', '2020-04-16 11:11:13'),
(368, 2, 'Insumo Modificado', 'El insumo con el código \"A-00073\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:11:52', '2020-04-16 11:11:52'),
(369, 2, 'Insumo Modificado', 'El insumo con el código \"A-00019\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:12:29', '2020-04-16 11:12:29'),
(370, 2, 'Insumo Modificado', 'El insumo con el código \"A-00025\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 11:12:59', '2020-04-16 11:12:59'),
(371, 1, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido creada', 'fas fa-cart-arrow-down', 3, '2020-04-16 12:12:00', '2020-04-16 12:12:00'),
(372, 3, 'Orden de Compra Cancelada', 'La orden de compra #\"1\" ha sido cancelada', 'fas fa-cart-arrow-down', 3, '2020-04-16 12:28:33', '2020-04-16 12:28:33'),
(373, 1, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido creada', 'fas fa-cart-arrow-down', 3, '2020-04-16 12:31:48', '2020-04-16 12:31:48'),
(374, 2, 'Insumo Modificado', 'El insumo con el código \"A-00021\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 13:56:38', '2020-04-16 13:56:38'),
(375, 2, 'Insumo Modificado', 'El insumo con el código \"A-00010\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 13:57:05', '2020-04-16 13:57:05'),
(376, 2, 'Insumo Modificado', 'El insumo con el código \"A-00031\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 13:57:34', '2020-04-16 13:57:34'),
(377, 2, 'Insumo Modificado', 'El insumo con el código \"A-00014\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 13:58:26', '2020-04-16 13:58:26'),
(378, 2, 'Insumo Modificado', 'El insumo con el código \"A-00076\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 13:58:53', '2020-04-16 13:58:53'),
(379, 2, 'Insumo Modificado', 'El insumo con el código \"A-00031\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:12:53', '2020-04-16 14:12:53'),
(380, 2, 'Insumo Modificado', 'El insumo con el código \"A-00023\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:13:12', '2020-04-16 14:13:12'),
(381, 2, 'Insumo Modificado', 'El insumo con el código \"A-00044\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:13:48', '2020-04-16 14:13:48'),
(382, 2, 'Insumo Modificado', 'El insumo con el código \"A-00074\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:14:18', '2020-04-16 14:14:18'),
(383, 2, 'Insumo Modificado', 'El insumo con el código \"A-00027\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:14:38', '2020-04-16 14:14:38'),
(384, 2, 'Insumo Modificado', 'El insumo con el código \"A-00037\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:15:07', '2020-04-16 14:15:07'),
(385, 2, 'Insumo Modificado', 'El insumo con el código \"A-00022\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:18:11', '2020-04-16 14:18:11'),
(386, 2, 'Insumo Modificado', 'El insumo con el código \"A-00041\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:18:44', '2020-04-16 14:18:44'),
(387, 2, 'Insumo Modificado', 'El insumo con el código \"A-00024\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:21:32', '2020-04-16 14:21:32'),
(388, 2, 'Insumo Modificado', 'El insumo con el código \"A-00042\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:22:19', '2020-04-16 14:22:19'),
(389, 2, 'Insumo Modificado', 'El insumo con el código \"A-00048\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:22:57', '2020-04-16 14:22:57'),
(390, 2, 'Insumo Modificado', 'El insumo con el código \"A-00053\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:23:21', '2020-04-16 14:23:21'),
(391, 2, 'Insumo Modificado', 'El insumo con el código \"A-00039\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:23:47', '2020-04-16 14:23:47'),
(392, 2, 'Insumo Modificado', 'El insumo con el código \"A-00080\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:24:16', '2020-04-16 14:24:16'),
(393, 2, 'Insumo Modificado', 'El insumo con el código \"A-00049\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:24:37', '2020-04-16 14:24:37'),
(394, 2, 'Insumo Modificado', 'El insumo con el código \"A-00002\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:24:59', '2020-04-16 14:24:59'),
(395, 2, 'Insumo Modificado', 'El insumo con el código \"A-00026\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:25:52', '2020-04-16 14:25:52'),
(396, 2, 'Insumo Modificado', 'El insumo con el código \"A-00073\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:26:25', '2020-04-16 14:26:25'),
(397, 2, 'Insumo Modificado', 'El insumo con el código \"A-00050\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:27:01', '2020-04-16 14:27:01'),
(398, 2, 'Insumo Modificado', 'El insumo con el código \"A-00046\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:28:38', '2020-04-16 14:28:38'),
(399, 2, 'Insumo Modificado', 'El insumo con el código \"A-00013\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:29:02', '2020-04-16 14:29:02'),
(400, 2, 'Insumo Modificado', 'El insumo con el código \"A-00036\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:29:55', '2020-04-16 14:29:55'),
(401, 2, 'Insumo Modificado', 'El insumo con el código \"A-00036\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:30:09', '2020-04-16 14:30:09'),
(402, 2, 'Insumo Modificado', 'El insumo con el código \"A-00038\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:30:35', '2020-04-16 14:30:35'),
(403, 2, 'Insumo Modificado', 'El insumo con el código \"A-00015\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:31:43', '2020-04-16 14:31:43'),
(404, 2, 'Insumo Modificado', 'El insumo con el código \"A-00052\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:32:16', '2020-04-16 14:32:16'),
(405, 2, 'Insumo Modificado', 'El insumo con el código \"A-00064\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:32:36', '2020-04-16 14:32:36'),
(406, 2, 'Insumo Modificado', 'El insumo con el código \"A-00071\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:33:05', '2020-04-16 14:33:05'),
(407, 2, 'Insumo Modificado', 'El insumo con el código \"A-00070\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:33:44', '2020-04-16 14:33:44'),
(408, 2, 'Insumo Modificado', 'El insumo con el código \"A-00090\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:34:32', '2020-04-16 14:34:32'),
(409, 2, 'Insumo Modificado', 'El insumo con el código \"A-00092\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:42:23', '2020-04-16 14:42:23'),
(410, 2, 'Insumo Modificado', 'El insumo con el código \"A-00003\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 14:42:58', '2020-04-16 14:42:58'),
(411, 2, 'Insumo Modificado', 'El insumo con el código \"A-00005\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 15:02:15', '2020-04-16 15:02:15'),
(412, 2, 'Insumo Modificado', 'El insumo con el código \"A-00004\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 15:02:46', '2020-04-16 15:02:46'),
(413, 2, 'Insumo Modificado', 'El insumo con el código \"A-00056\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 15:03:11', '2020-04-16 15:03:11'),
(414, 2, 'Insumo Modificado', 'El insumo con el código \"A-00002\" ha sido modificado', 'fas fa-capsules', 3, '2020-04-16 15:03:48', '2020-04-16 15:03:48'),
(415, 2, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido modificada', 'fas fa-cart-arrow-down', 3, '2020-04-16 16:20:23', '2020-04-16 16:20:23'),
(416, 1, 'Receta Creada', 'La receta con el código \"GPM0003\" ha sido creada', 'fas fa-flask', 6, '2020-04-17 10:16:38', '2020-04-17 10:16:38'),
(417, 2, 'Receta Modificada', 'La receta con el código \"GPM0003\" ha sido modificada', 'fas fa-flask', 6, '2020-04-17 10:17:15', '2020-04-17 10:17:15'),
(418, 2, 'Receta Modificada', 'La receta con el código \"GPM0003\" ha sido modificada', 'fas fa-flask', 6, '2020-04-17 10:17:43', '2020-04-17 10:17:43'),
(419, 1, 'Producto Creado', 'El producto con el código \"GPM0003A\" ha sido creado', 'fas fa-flask', 6, '2020-04-17 10:21:00', '2020-04-17 10:21:00'),
(420, 2, 'Molde Modificado', 'El molde con el código \"03OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-17 12:29:28', '2020-04-17 12:29:28'),
(421, 2, 'Receta Modificada', 'La receta con el código \"GSA0014\" ha sido modificada', 'fas fa-flask', 6, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(422, 2, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido modificada', 'fas fa-cart-arrow-down', 3, '2020-04-21 10:29:31', '2020-04-21 10:29:31'),
(423, 2, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-21 10:30:51', '2020-04-21 10:30:51'),
(424, 2, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido modificada', 'fas fa-cart-arrow-down', 6, '2020-04-21 10:35:13', '2020-04-21 10:35:13'),
(425, 2, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido modificada', 'fas fa-cart-arrow-down', 6, '2020-04-21 10:39:26', '2020-04-21 10:39:26'),
(426, 2, 'Orden de Compra Modificada', 'La orden de compra #\"2\" ha sido modificada', 'fas fa-cart-arrow-down', 6, '2020-04-21 10:51:08', '2020-04-21 10:51:08'),
(427, 1, 'Orden de Compra Modificada', 'La orden de compra #\"3\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-21 11:52:32', '2020-04-21 11:52:32'),
(428, 1, 'Orden de Compra Modificada', 'La orden de compra #\"4\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-21 11:55:33', '2020-04-21 11:55:33'),
(429, 1, 'Orden de Compra Modificada', 'La orden de compra #\"5\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-22 10:21:08', '2020-04-22 10:21:08'),
(430, 1, 'Insumo Creado', 'El insumo con el código \"A-00094\" ha sido creado', 'fas fa-capsules', 2, '2020-04-22 10:47:53', '2020-04-22 10:47:53'),
(431, 1, 'Insumo Creado', 'El insumo con el código \"A-00095\" ha sido creado', 'fas fa-capsules', 2, '2020-04-22 10:48:43', '2020-04-22 10:48:43'),
(432, 2, 'Insumo Modificado', 'El insumo con el código \"A-00095\" ha sido modificado', 'fas fa-capsules', 2, '2020-04-22 10:50:00', '2020-04-22 10:50:00'),
(433, 2, 'Insumo Modificado', 'El insumo con el código \"A-00094\" ha sido modificado', 'fas fa-capsules', 2, '2020-04-22 10:50:35', '2020-04-22 10:50:35'),
(434, 3, 'Orden de Compra Cancelada', 'La orden de compra #\"1\" ha sido cancelada', 'fas fa-cart-arrow-down', 2, '2020-04-22 10:53:53', '2020-04-22 10:53:53'),
(435, 3, 'Orden de Compra Cancelada', 'La orden de compra #\"1\" ha sido cancelada', 'fas fa-cart-arrow-down', 2, '2020-04-22 10:53:58', '2020-04-22 10:53:58'),
(436, 1, 'Insumo Creado', 'El insumo con el código \"A-00096\" ha sido creado', 'fas fa-capsules', 3, '2020-04-22 11:53:27', '2020-04-22 11:53:27'),
(437, 1, 'Insumo Creado', 'El insumo con el código \"A-00097\" ha sido creado', 'fas fa-capsules', 3, '2020-04-22 11:54:41', '2020-04-22 11:54:41'),
(438, 2, 'Orden de Compra Modificada', 'La orden de compra #\"5\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-22 12:42:14', '2020-04-22 12:42:14'),
(439, 2, 'Orden de Compra Modificada', 'La orden de compra #\"5\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-22 13:00:03', '2020-04-22 13:00:03'),
(440, 2, 'Orden de Compra Modificada', 'La orden de compra #\"5\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-22 13:04:09', '2020-04-22 13:04:09'),
(441, 1, 'Receta Creada', 'La receta con el código \"GSA0016\" ha sido creada', 'fas fa-flask', 6, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(442, 2, 'Molde Modificado', 'El molde con el código \"03TRE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-23 12:25:56', '2020-04-23 12:25:56'),
(443, 2, 'Molde Modificado', 'El molde con el código \"08OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-23 12:39:46', '2020-04-23 12:39:46'),
(444, 2, 'Molde Modificado', 'El molde con el código \"08OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-23 12:42:54', '2020-04-23 12:42:54'),
(445, 2, 'Molde Modificado', 'El molde con el código \"08OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-23 12:43:08', '2020-04-23 12:43:08'),
(446, 2, 'Molde Modificado', 'El molde con el código \"03TRE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-23 12:43:35', '2020-04-23 12:43:35'),
(447, 2, 'Molde Modificado', 'El molde con el código \"08OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-23 12:43:52', '2020-04-23 12:43:52'),
(448, 2, 'Molde Modificado', 'El molde con el código \"03OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-23 12:44:48', '2020-04-23 12:44:48'),
(449, 2, 'Orden de Compra Modificada', 'La orden de compra #\"5\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-23 14:42:46', '2020-04-23 14:42:46'),
(450, 1, 'Orden de Compra Modificada', 'La orden de compra #\"7\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-24 15:01:38', '2020-04-24 15:01:38'),
(451, 3, 'Orden de Compra Cancelada', 'La orden de compra #\"7\" ha sido cancelada', 'fas fa-cart-arrow-down', 2, '2020-04-24 15:02:14', '2020-04-24 15:02:14'),
(452, 2, 'Orden de Compra Modificada', 'La orden de compra #\"7\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-25 12:53:04', '2020-04-25 12:53:04'),
(453, 1, 'Orden de Compra Modificada', 'La orden de compra #\"8\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-25 12:58:16', '2020-04-25 12:58:16'),
(454, 2, 'Orden de Compra Modificada', 'La orden de compra #\"8\" ha sido modificada', 'fas fa-cart-arrow-down', 6, '2020-04-25 13:06:28', '2020-04-25 13:06:28'),
(455, 2, 'Receta Modificada', 'La receta con el código \"GSA0006\" ha sido modificada', 'fas fa-flask', 3, '2020-04-27 10:11:40', '2020-04-27 10:11:40'),
(456, 2, 'Receta Modificada', 'La receta con el código \"GSA0006\" ha sido modificada', 'fas fa-flask', 6, '2020-04-27 16:28:25', '2020-04-27 16:28:25'),
(457, 2, 'Receta Modificada', 'La receta con el código \"GSA0007\" ha sido modificada', 'fas fa-flask', 3, '2020-04-27 16:50:09', '2020-04-27 16:50:09'),
(458, 2, 'Receta Modificada', 'La receta con el código \"GSA0006\" ha sido modificada', 'fas fa-flask', 6, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(459, 1, 'Orden de Compra Modificada', 'La orden de compra #\"9\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-27 17:40:28', '2020-04-27 17:40:28'),
(460, 2, 'Orden de Compra Modificada', 'La orden de compra #\"9\" ha sido modificada', 'fas fa-cart-arrow-down', 2, '2020-04-27 17:56:17', '2020-04-27 17:56:17'),
(461, 2, 'Orden de Compra Modificada', 'La orden de compra #\"9\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-27 18:02:39', '2020-04-27 18:02:39'),
(462, 1, 'Orden de Compra Modificada', 'La orden de compra #\"10\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-27 18:12:01', '2020-04-27 18:12:01'),
(463, 2, 'Orden de Compra Modificada', 'La orden de compra #\"10\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-27 18:19:32', '2020-04-27 18:19:32'),
(464, 2, 'Orden de Compra Modificada', 'La orden de compra #\"10\" ha sido modificada', 'fas fa-cart-arrow-down', 6, '2020-04-27 18:31:30', '2020-04-27 18:31:30'),
(465, 1, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido creada', 'fas fa-cart-arrow-down', 2, '2020-04-28 08:50:46', '2020-04-28 08:50:46'),
(466, 2, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-28 08:53:30', '2020-04-28 08:53:30'),
(467, 2, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido modificada', 'fas fa-cart-arrow-down', 2, '2020-04-28 09:19:25', '2020-04-28 09:19:25'),
(468, 2, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido modificada', 'fas fa-cart-arrow-down', 4, '2020-04-28 09:21:39', '2020-04-28 09:21:39'),
(469, 2, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido modificada', 'fas fa-cart-arrow-down', 6, '2020-04-28 09:26:02', '2020-04-28 09:26:02'),
(470, 2, 'Orden de Compra Modificada', 'La orden de compra #\"1\" ha sido modificada', 'fas fa-cart-arrow-down', 6, '2020-04-28 09:41:12', '2020-04-28 09:41:12'),
(471, 2, 'Receta Modificada', 'La receta con el código \"PRUEBA01\" ha sido modificada', 'fas fa-flask', 6, '2020-04-28 09:47:57', '2020-04-28 09:47:57'),
(472, 1, 'Orden de Fabricació Creada', 'La orden de fabricación \"OT-0001\" ha sido creado', 'fas fa-clipboard', 6, '2020-04-28 09:49:04', '2020-04-28 09:49:04'),
(473, 2, 'Producto Modificado', 'El producto con el código \"PT00PRUEBA\" ha sido modificado', 'fas fa-flask', 3, '2020-04-28 10:10:02', '2020-04-28 10:10:02'),
(474, 2, 'Molde Modificado', 'El molde con el código \"08OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-29 09:28:21', '2020-04-29 09:28:21'),
(475, 2, 'Molde Modificado', 'El molde con el código \"08OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-30 10:23:16', '2020-04-30 10:23:16'),
(476, 2, 'Molde Modificado', 'El molde con el código \"14OVE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-04-30 10:27:48', '2020-04-30 10:27:48'),
(477, 2, 'Molde Modificado', 'El molde con el código \"08TOE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-05-05 11:27:21', '2020-05-05 11:27:21'),
(478, 2, 'Molde Modificado', 'El molde con el código \"06CUE-01\" ha sido modificado', 'fas fa-dice-d20', 3, '2020-05-05 11:27:31', '2020-05-05 11:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `logbook_types`
--

CREATE TABLE `logbook_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logbook_types`
--

INSERT INTO `logbook_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'success', '2020-02-26 20:15:35', '2020-02-26 20:15:35'),
(2, 'warning', '2020-02-26 20:15:58', '2020-02-26 20:15:58'),
(3, 'danger', '2020-02-26 20:15:58', '2020-02-26 20:15:58'),
(4, 'info', '2020-02-26 20:15:58', '2020-02-26 20:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `molds`
--

CREATE TABLE `molds` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `minimals` decimal(10,2) NOT NULL,
  `long_mm` decimal(10,2) NOT NULL,
  `width_mm` decimal(10,2) NOT NULL,
  `caps_long` int(11) DEFAULT NULL,
  `caps_circ` int(11) DEFAULT NULL,
  `kilograms` decimal(10,2) NOT NULL,
  `reference_product` varchar(100) DEFAULT NULL,
  `observations` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molds`
--

INSERT INTO `molds` (`id`, `code`, `type`, `created_at`, `updated_at`, `minimals`, `long_mm`, `width_mm`, `caps_long`, `caps_circ`, `kilograms`, `reference_product`, `observations`) VALUES
(1, '16OBE-01', 'Oblongos', '2020-01-29 00:00:00', '2020-02-23 04:22:41', '16.00', '22.00', '10.00', 9, 32, '272.92', 'DIABION', NULL),
(2, '03OVE-01', 'Ovales', '2020-01-29 00:00:00', '2020-04-23 12:44:48', '3.00', '12.00', '7.00', 16, 41, '49.44', 'SAW PALMETO/ADETREX', 'Comprobado el consumo de gelatina en la realidad'),
(3, '20OBE-01', 'Oblongos', '2020-02-23 04:25:07', '2020-02-23 04:25:07', '20.00', '26.00', '10.00', 8, 32, '307.03', 'LACRIVIT, VITAGERUM', NULL),
(4, '24OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '24.00', '28.54', '11.68', 7, 29, '387.19', NULL, NULL),
(5, '29OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '29.00', '26.25', '12.00', 7, 29, '387.19', 'AMINOTER', NULL),
(6, '29OBE-02', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '29.00', '28.50', '10.50', 7, 29, '387.19', NULL, NULL),
(7, '29OBL-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '29.00', '29.33', '11.35', 7, 29, '387.19', NULL, NULL),
(8, '31OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '31.00', '28.80', '11.76', 7, 29, '387.19', NULL, NULL),
(9, '32OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '32.00', '28.87', '11.91', 7, 29, '387.19', NULL, NULL),
(10, '06OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '6.00', '14.29', '9.05', 14, 36, '155.95', NULL, NULL),
(11, '08OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-04-30 10:23:16', '8.00', '15.50', '9.82', 13, 34, '85.00', 'ADETREX PLUS', 'comprobado el consumo de gelatina en la realidad'),
(12, '10OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '10.00', '16.53', '10.47', 12, 32, '204.69', NULL, NULL),
(13, '14OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-04-30 10:27:48', '14.00', '18.50', '11.51', 11, 30, '165.00', 'KRILL', 'comprobado el consumo de gelatina en la realidad'),
(14, '20OVL-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '20.00', '22.00', '13.00', 0, 0, '0.00', NULL, NULL),
(15, '03TRE-01', 'Especiales', '2020-03-31 00:36:17', '2020-04-23 12:43:35', '3.00', '9.54', '9.34', 20, 34, '52.81', 'Smilez', 'comprobado el consumo de gelatina en la realidad'),
(16, '06CUE-01', 'Especiales', '2020-03-31 00:36:17', '2020-05-05 11:27:31', '6.00', '10.00', '10.00', 16, 32, '153.52', NULL, 'CUADRADO'),
(17, '08TOE-01', 'Especiales', '2020-03-31 00:36:17', '2020-05-05 11:27:21', '8.00', '16.20', '9.00', 10, 24, '327.50', NULL, 'TORTUGAS'),
(18, '22SUE-01', 'Especiales', '2020-03-31 00:36:17', '2020-03-31 00:36:17', '22.50', '12.00', '12.00', 6, 32, '409.38', NULL, 'SUPOSITORIO'),
(19, '40OXE-01', 'Especiales', '2020-03-31 00:36:17', '2020-03-31 00:36:17', '40.00', '24.93', '16.30', 8, 22, '446.59', NULL, 'OVULO');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `presentation` varchar(150) NOT NULL,
  `form` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_expire` date NOT NULL,
  `lot` varchar(50) NOT NULL,
  `status` varchar(75) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `packages_supplies`
--

CREATE TABLE `packages_supplies` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `entrance_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'GPM0003A', 'ACEITE DE KRILL 500 mg (SUPERBA 2)', '0.00', '2020-04-17 10:21:00', '2020-04-17 10:21:00'),
(2, 'PT00PRUEBA', 'PRUEBA', '0.00', '2020-04-28 10:07:08', '2020-04-28 10:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_recipes`
--

CREATE TABLE `product_recipes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `excess` decimal(3,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_recipes`
--

INSERT INTO `product_recipes` (`id`, `product_id`, `recipe_id`, `quantity`, `excess`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '5000.00', '0.00', '2020-04-17 10:21:00', '2020-04-17 10:21:00'),
(2, 2, 7, '50.00', '0.00', '2020-04-28 10:10:02', '2020-04-28 10:10:02');

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_supplies`
--

INSERT INTO `product_supplies` (`id`, `product_id`, `supply_id`, `quantity`, `excess`, `created_at`, `updated_at`) VALUES
(1, 1, 9, '1.0000', '0.00', '2020-04-17 10:21:00', '2020-04-17 10:21:00'),
(2, 2, 9, '2.0000', '0.00', '2020-04-28 10:10:02', '2020-04-28 10:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mold_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `code`, `name`, `stock`, `mold_id`, `created_at`, `updated_at`) VALUES
(1, 'GSA0013', 'ADETREX VITAMINA A, D3 CON ACEITE DE LINAZA', '0.00', 2, '2020-04-14 11:27:18', '2020-04-14 11:27:18'),
(2, 'GSA0014', 'ADETREX PLUS (Vitamina A, D3, C y Equinacea purpurea)', '0.00', 10, '2020-04-15 18:00:46', '2020-04-15 18:01:56'),
(3, 'GPM0003', 'ACEITE DE KRILL 500 mg (SUPERBA 2)', '0.00', 13, '2020-04-17 10:16:38', '2020-04-17 10:16:38'),
(4, 'GSA0016', 'SMILEZ 200 mg (MENTA-EUCALIPTO)', '0.00', 15, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(5, 'GSA0006', 'TORTUVITAS (Vitaminas A, D3 y C) sabor mango', '0.00', 17, '2020-04-27 08:53:11', '2020-04-27 08:53:11'),
(6, 'GSA0007', 'TORTUVITAS (Vitaminas A, D3 y C) sabor manzana verde', '0.00', 17, '2020-04-27 08:54:55', '2020-04-27 16:50:09'),
(7, 'PRUEBA01', 'PRUEBA01', '0.00', 1, '2020-04-28 09:44:12', '2020-04-28 09:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_products`
--

CREATE TABLE `recipe_products` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_supplies`
--

CREATE TABLE `recipe_supplies` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `excess` decimal(3,2) NOT NULL DEFAULT '0.00',
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_supplies`
--

INSERT INTO `recipe_supplies` (`id`, `recipe_id`, `supply_id`, `quantity`, `excess`, `type`, `created_at`, `updated_at`) VALUES
(11, 1, 15, '0.5000', '0.00', 1, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(12, 1, 44, '0.0050', '0.00', 1, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(13, 1, 80, '179.4950', '0.00', 1, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(14, 1, 1, '138.2324', '0.00', 2, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(15, 1, 84, '140.0000', '0.00', 2, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(16, 1, 3, '70.0000', '0.00', 2, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(17, 1, 4, '0.5391', '0.00', 2, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(18, 1, 5, '0.2100', '0.00', 2, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(19, 1, 37, '0.3185', '0.00', 2, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(20, 1, 60, '0.7000', '0.00', 2, '2020-04-15 11:28:54', '2020-04-15 11:28:54'),
(91, 3, 88, '500.0000', '0.00', 1, '2020-04-17 10:17:43', '2020-04-17 10:17:43'),
(92, 3, 1, '300.0000', '0.00', 2, '2020-04-17 10:17:43', '2020-04-17 10:17:43'),
(93, 3, 2, '300.0000', '0.00', 2, '2020-04-17 10:17:43', '2020-04-17 10:17:43'),
(94, 3, 74, '75.0000', '0.00', 2, '2020-04-17 10:17:43', '2020-04-17 10:17:43'),
(95, 3, 3, '75.0000', '0.00', 2, '2020-04-17 10:17:43', '2020-04-17 10:17:43'),
(96, 2, 15, '0.5000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(97, 2, 44, '0.0050', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(98, 2, 61, '100.0000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(99, 2, 80, '180.0000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(100, 2, 65, '50.0000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(101, 2, 35, '123.6150', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(102, 2, 27, '4.5000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(103, 2, 28, '9.0000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(104, 2, 26, '1.9800', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(105, 2, 30, '0.2000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(106, 2, 31, '0.2000', '0.00', 1, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(107, 2, 1, '292.6225', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(108, 2, 84, '300.0000', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(109, 2, 3, '150.0000', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(110, 2, 4, '1.2000', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(111, 2, 5, '0.4500', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(112, 2, 10, '1.7625', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(113, 2, 36, '0.2475', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(114, 2, 37, '0.5775', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(115, 2, 38, '1.8000', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(116, 2, 60, '1.3400', '0.00', 2, '2020-04-20 16:28:51', '2020-04-20 16:28:51'),
(117, 4, 1, '118.9764', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(118, 4, 84, '108.0000', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(119, 4, 3, '54.0000', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(120, 4, 83, '12.0000', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(121, 4, 81, '6.0000', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(122, 4, 4, '0.4800', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(123, 4, 5, '0.1800', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(124, 4, 86, '0.3600', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(125, 4, 36, '0.0036', '0.00', 3, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(126, 4, 1, '118.9671', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(127, 4, 84, '108.0000', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(128, 4, 3, '54.0000', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(129, 4, 83, '12.0000', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(130, 4, 81, '6.0000', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(131, 4, 4, '0.4800', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(132, 4, 5, '0.1800', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(133, 4, 86, '0.3600', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(134, 4, 36, '0.0129', '0.00', 2, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(135, 4, 79, '151.8400', '0.00', 1, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(136, 4, 124, '13.0000', '0.00', 1, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(137, 4, 123, '35.0000', '0.00', 1, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(138, 4, 86, '0.1600', '0.00', 1, '2020-04-22 14:17:26', '2020-04-22 14:17:26'),
(160, 6, 61, '100.0000', '0.00', 1, '2020-04-27 16:50:09', '2020-04-27 16:50:09'),
(161, 6, 1, '276.9775', '0.00', 2, '2020-04-27 16:50:09', '2020-04-27 16:50:09'),
(162, 5, 61, '100.0000', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(163, 5, 15, '0.5000', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(164, 5, 44, '2.0000', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(165, 5, 1, '226.2000', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(166, 5, 81, '8.3200', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(167, 5, 83, '155.9800', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(168, 5, 85, '6.0000', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(169, 5, 86, '1.0000', '0.00', 1, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(170, 5, 1, '278.1775', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(171, 5, 2, '270.0000', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(172, 5, 3, '150.0000', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(173, 5, 83, '30.0000', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(174, 5, 81, '15.0000', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(175, 5, 4, '1.2000', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(176, 5, 5, '0.4500', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(177, 5, 86, '1.8000', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(178, 5, 82, '0.4350', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(179, 5, 36, '0.0375', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(180, 5, 85, '2.9000', '0.00', 2, '2020-04-27 16:54:16', '2020-04-27 16:54:16'),
(181, 7, 25, '20.0000', '0.00', 1, '2020-04-28 09:47:57', '2020-04-28 09:47:57'),
(182, 7, 2, '750.0000', '0.00', 2, '2020-04-28 09:47:57', '2020-04-28 09:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `neight` varchar(120) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `phone` varchar(80) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact`, `address`, `neight`, `city`, `state`, `zip`, `rfc`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'ALIFARMA, S.A. DE C.V.', 'Susana Campos', 'Cerrada de Colima No. 4', 'Col. Roma', 'Cuauhtemoc', 'CDMX', '6700', '', '55 5207 7275', 'ventas@alifarma.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(2, 'ACEITES GRASAS Y DERIVADOS, S.A. DEC.V.', 'Luis Fernando Ochoa ', 'Av. Vallarta 5106', 'Juan Manuel Vallarta', 'Zapopan', 'Jalisco', '45120', '', '33 3880 3872 / 33 3880 3880', 'ventaspt@agydsa.net', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(3, 'ADVANCERS MX, S.A. DE C.V.', 'Tomás Benítez', 'Coruña 209 A', 'Bosques de las Cumbres', 'Monterrey', 'Nuevo León', '64619', '', '81 8300 0105 / 81 1077 5258', 'tomas.benitez@advancersw.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(4, 'ALFADELTA, S.A. DE C.V.', 'Estela de la Garza', 'Valle de Oaxaca No. 27', 'Vista del Valle Electricista', 'Naucalpan de Juárez', 'Estado de México', '53290', '', '55 5373 3560 / 55 2640 6125 Ext. 14', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(5, 'ALMACÉN DE DROGAS LA PAZ, S.A. DE C.V.', '', 'Av. España No. 1806', 'Moderna', 'Guadalajara', 'Jalisco', '44190', '', '33 3812 4444 / 33 3812 4496', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(6, 'AMÉRICA ALIMENTOS, S.A. DE C.V.', 'Ivan de la Rosa', 'Av. Santa Ana Tepetitlán No. 316 B', 'Agrícola', 'Zapopan', 'Jalisco', '45236', '', '33 3612 2510 Ext. 110', 'en2@americaalimentos.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(7, 'API GLOBAL, S.A. DE C.V.', '', 'Av. López Mateos Sur 1820-14', 'Campo Polo', 'Guadalajara', 'Jalisco', '', '', '33 3647 9365', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(8, 'ASHLAND CHEMICAL DE MÉXICO, S.A. DE C.V.', 'Alba González', 'Gobernador Francisco Fagoaga No. 103', 'San Miguel Chapultepec', 'Deleg. Miguel Hidalgo', 'CDMX', '11850', '', '33 1519 6757', 'albagonzalez@ashland.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(9, 'BERNARDO TAPIA HERNÁNDEZ', 'Bernardo Tapia Porras', 'Constancia No. 397', 'Col. Obrera', 'Guadalajara', 'Jalisco', '44420', '', '33 1137 4948', 'moldurastapatias@hotmail.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(10, 'BOMBAS DE VACÍO Y DESHIDRATACIÓN, S.A. DE C.V.', 'Yolanda Serrano Ramírez', 'Calle 6 Sur Manzana 7 Lote 14', 'Ciudad Industrial ', '', 'Hidalgo', '43800', '', '55 5659 8999 / 55 5659 8948', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(11, 'BLANCA ESTELA RAMÍREZ LLAMAS', '', 'Privada España No. 169', 'La Duraznera', 'Guadalajara', 'Jalisco', '', '', '33 3860 7707', 'mantenimientolab@yahoo.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(12, 'CENTRO BOTÁNICO AZTECA, S.A. DE C.V.', '', 'Calle San Simón 24 A', 'Merced Balbuena', 'Venustiano Carranza', 'CDMX', '15810', '', '55 5542 1382 / 55 5542 9991', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(13, 'CENTRO DE DIAGNÓSTICO MICROBIOLÓGICO E INMUNOMOLECULAR, SAPI DE CV', 'Jazmín Hernández', 'Volcán Vesubio No. 6193', 'El Colli Urbano', 'Zapopan', 'Jalisco', '45070', '', '', 'jazmin.hernandez@corp-imt.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(14, 'CENTRO DE VALIDACIÓN Y CALIBRACIÓN DE OCCIDENTE, S.A. DE C.V.', 'Gerardo Rios Herrera', 'Sirio No. 5644', 'Arboledas', 'Zapopan', 'Jalisco', '45070', '', '33 1174 8908', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(15, 'CENTURY LABORATORIES, S.A. DE C.V.', 'Christian G Galindo Torres', 'La Villa No. 882', 'Industrial Vallejo', 'Azcapotzalco', 'CDMX', '2300', '', '55 5567 4111 / cel 55 2569 3933', 'cosmeticos@clabs.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(16, 'CERAS UNIVERSALES, S.A. DE C.V.', 'Gabriel Amezcua', 'Cerrada de Río San Buanaventura 7', 'El Arenal Tepepan', 'Tlalpan', 'CDMX', '14610', '', '33 3673 0713', 'gabrielamezcua@prodigy.net.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(17, 'COMPONENTES Y EQUIPOS ELECTROMECÁNICOS, S.A. DE C.V.', '', 'Colón No. 581', 'Guadalajara Centro', 'Guadalajara', 'Jalisco', '44100', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(18, 'CORREDURÍA PÚBLICA 42 DE JALISCO, S.C.', '', '', '', 'Zapopan', 'Jalisco', '45050', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(19, 'CUEVAS RODRÍGUEZ Y ASESORES, S.C.', 'Elda García Romero', 'Calle Sagitario No. 3856', 'La Calma', 'Zapopan', 'Jalisco', '45070', '', '33 3121 7927 / 33 3123 0814 / Cel. 33 1874 7177', 'elda@cuevasrodriguez.com.mx; carlosleon@cuevasrodriguez.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(20, 'CUSTOMS&MMMG, S.A. DE C.V.', 'Lic. Francisco Medina', 'Prado de los Pirules No. 1178', 'Prados de Tepeyac', 'Zapopan', 'Jalisco', '45050', '', '33 3616 5009', 'francisco.medina@customsmmmg.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(21, 'CRISTINA ROSALES BRUN', 'Diseñadora', '', '', '', '', '', '', '33 3955 4565', 'cristinarosalesbrun@gmail.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(22, 'DANTE ANTONIO RIVERA ORTIZ', 'Consumibles para limpieza y sanitarios', 'Juan José Arreola No. 1361', 'Col. Educadores Jaliscienses', 'Tonalá', 'Jalisco', '45404', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(23, 'DAVID GUTIÉRREZ DE LA PAZ', 'Tapas de acrílico', '', '', '', '', '45239', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(24, 'DISTRIBUIDORA CIENTÍFICA DE LABORATORIOS, S.A. DE C.V.', 'Fernando Solis', 'C. Ahuitzotl 4952', 'Nueva España', 'Guadalajara', 'Jalisco', '44980', '', '33 1380 0047 / 33 1380 0048 / Cel 33 1339 7192', 'ventas3@dicilab.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(25, 'DUPLI-COPY, S. DE R.L. DE C.V.', '', 'Calle Federico E. Ibarra No. 1095', 'Santa Mónica', 'Guadalajara', 'Jalisco', '44220', '', '', 'almacendupli.copy@gmail.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(26, 'DQ MICROBIOLOGÍA LABORATORIOS, S.A. DE C.V.', 'Andrés Gutiérrez', 'Calle Alemania No. 100', 'México 68', 'Naucalpan de Juárez', 'Estado de México', '53260', '', '33 3612 6439', 'ventas_soportegdl@dq.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(27, 'ELECTRO INDUSTRIAL OLIDE, S.A. DE C.V.', '', 'Av. 8 de Julio No. 3610', 'Lomas de Polanco', 'Guadalajara', 'Jalisco', '44960', '', '33 3645 2018 / 33 3645 4855 / 33 3646 2799', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(28, 'EMILIA MARÍA DE LOURDES TEJEDO MARTÍNEZ', 'Enrique Ordoñana r', 'San Uriel No. 687', 'Chapalita Oriente', 'Zapopan', 'Jalisco', '', '', '33 3121 8852 / 33 3647 0986', 'fexgrupopapelero@prodigy.net.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(29, 'ENAR REPRESENTACIONES, S.A. DE C.V.', '', 'Calle Día No. 2566', 'Jardines del Bosque', 'Guadalajara', 'Jalisco', '44520', '', '33 3121 0033', 'gustavo@enarfiltros.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(30, 'EQUIPOS, MÁQUINAS Y REFACCIONES, S.A. DE C.V.', 'Luis Alberto Pacheco-Rosy Hernández', 'Calle Mojonera No. 1552', 'Col. 8 de Julio', 'Guadalajara', 'Jalisco', '44910', '', '33 3812 2131 / 33 3812 2055 / 33 3812 2839', 'luis.pacheco@emyr.com.mx; rosy.hernandez@emyr.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(31, 'EQUIPOS Y CONEXIONES INOXIDABLES DE JALISCO, S.A. DE C.V.', '', 'Calle 25 de mayo No. 2482 Int A', 'Hogares de Nuevo Mëxico', 'Zapopan', 'Jalisco', '45203', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(32, 'EVANS R&R, S.A. DE C.V.', '', 'Av. Gobernador Curiel 1825A', 'Ferrocarril', 'Guadalajara', 'Jalisco', '44440', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(33, 'FARMACÉUTICOS KAZANN, S.A. DE C.V.', 'Karina Peña', 'Bahía de Huatulco No. 146', 'Agua Blanca Industrial', 'Zapopan', 'Jalisco', '45235', '', '33 3624 2738', 'gerencia.ventas@farmaceuticoskazann.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(34, 'FMA JOHNSON DE OCCIDENTE, S.A. DE C.V.', 'Daniel Ramírez', 'Av. Cruz del Sur 3119', 'Jardines de la Cruz', 'Guadalajara', 'Jalisco', '44950', '', '33 3645 0450', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(35, 'FUTURE FOODS, S.A. DE C.V.', 'Karina Pérez García', 'Convento Belém de los Padres No. 18', 'Valle de los Pinos', 'Tlalnepantla de Baz', 'Estado de México', '54040', '', '55 5362 5089 / 55 5362 5355 Ext. 106', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(36, 'GABRIEL CERDA PIZANO', '', 'Trabajadores de Turismo No. 15', 'Fovissste Morelos', 'Morelia', 'Michoacán', '58120', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(37, 'HUMBERTO ORÍGENES ROMERO PORRAS', 'Mariana Contreras', 'Longinos Cadena No. 2136', 'Polanco', 'Guadalajara', 'Jalisco', '44960', '', '33 3144 7735', 'alcoholeradeoccidente.81@outlook.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(38, 'IGNACIO DE LOYOLA BARBA ROMERO', 'Lorena Peredes Carranza', 'Olmo No. 1350', 'Del Fresno', 'Guadalajara', 'Jalisco', '44900', '', '33 3812 6618', 'lore_par91@hotmail.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(39, 'INTEGRADORA DE COMPRESORES EN MÉXICO, S.A. DE C.V.', 'kArla Aragón', 'Dinamarca 1221', 'Moderna', 'Guadalajara', 'Jalisco', '44190', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(40, 'INFRA, S.A. DE C.V.', 'Victorino Enciso', 'Dr. R. Michel No. 1709', 'Atlas', 'Guadalajara', 'Jalisco', '44870', '', '33 3668 2082', 'gasesgdl@infra.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(41, 'INGENIERÍA APLICADA EN ENFRIAMIENTO, S.A. DE C.V.', 'Román E. Alfaro Alcocer', 'Tabachines No. 3771', 'Loma Bonita Ejidal', 'Zapopan', 'Jalisco', '45085', '', '33 3645 8847 / Cel 33 1893 3032', 'romanealfaro@hotmail.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(42, 'INGENIERÍA EN BÁSCULAS, S. DE R.L. DE C.V.', 'Edgar Ivan Rodríguez González', 'Simón Bolivar 599', 'Barrera', 'Guadalajara', 'Jalisco', '44150', '', '33 3616 1604 / 33 3616 4556', 'erodriguez@lacasadelabascula.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(43, 'INOXIMEXICO CL, S.A. DE C.V.', '', 'Calle 6 No. 2539', 'Zona Industrial', 'Guadalajara', 'Jalisco', '44940', '', '33 2001 6713', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(44, 'FEDERICO ISAAC GUTIÉRREZ', '', 'Cerro de Cuautla 683', 'Loma Bonita Ejidal', 'Zapopan', 'Jalisco', '45085', '', '33 3632 0803', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(45, 'JOSE EDUARDO ASCANIO RODRÍGUEZ', 'Eduardo Ascanio', 'Calle Sagitario No. 3856', 'La Calma', 'Zapopan', 'Jalisco', '45070', '', '33 3121 7927 / 33 3123 0814 / Cel. 33 3106 5258', 'eascanio@megasat.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(46, 'JAVIER BARBA VERGARA', 'Ivan Barba Vergara', 'Circuito Madrigal No. 40362', 'Santa Isabel', 'Zapopan', 'Jalisco', '45110', '', 'Cel 33 1918 4464', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(47, 'JOSÉ DE JESÚS TOSTADO RAMÍREZ', 'Patricia Haro', 'Calle Bilbao No. 2606', 'Col. Santa Elena Alcalde', 'Guadalajara', 'Jalisco', '44220', '', '33 3126 1014 / 33 1199 5744', 'jesustostado@extinguidoresromo.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(48, 'JORGE ANTONIO SILVA ROSALES', '', 'Calle Isla Contoy 3075 Int 4', 'Parques Colón', 'Tlaquepaque', 'Jalisco', '45608', '', '33 3645 1808', 'jsilva@isotecc.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(49, 'LA NUEVA PERLA, S.A. DE C.V.', 'Victoria Morales Luna', 'Joaquín Angulo 188', 'Centro', 'Guadalajara', 'Jalisco', '44280', '', '33 3613 8245 / 33 3614  5388 / 33 3126 3789', 'laperla6a@gmail.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(50, 'MARÍA GUADALUPE LÓPEZ VELASCO', '', 'Av. San Blas 2605 Int 36', 'Parques Santa Cruz del Valle', 'Tlaquepaque', 'Jalisco', '45555', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(51, 'MARÍA GUADALUPE RODRÍGUEZ GUZMÁN', '', 'Rosal No. 2047', 'Palmira', 'Zapopan', 'Jalisco', '45236', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(52, 'MARÍA MERCEDES MERCADO LANDEROS', '', 'Calle Himno NO. 2525', 'Col. Guadalajara Oriente', 'Guadalajara', 'Jalisco', '44700', '', '33-3651-8573 / 33-3651-6258 / nextel 33-1284-9779 ID 62*15*18451', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(53, 'MAQUINARIA FARMACÉUTICA GALEECA, S. DE R.L. DE C.V.', '', 'Biblia 175', 'La Duraznera', 'Tlaquepaque', 'Jalisco', '45580', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(54, 'MEGAFARMA, S.A. DE C.V.', '', 'Narciso Mendoza No. 15', 'Manuel Ávila Camacho', 'Deleg. Miguel Hidalgo', 'CDMX', '11610', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(55, 'MILENIUM ASOCIACIÓN, S.A. DE C.V.', '', 'Alberta 1909', 'Colomos Providencia', 'Guadalajara', 'Jalisco', '44660', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(56, 'NOVATEC PAGANI, S.A. DE C.V.', 'Miguel Delgado', 'Calle 3 No. 946', 'Zona Industrial', 'Guadalajara', 'Jalisco', '44949', '', '33 3811 2641 / 33 3811 3192 / 33 3811 2641', 'migueld@novatec.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(57, 'POCHTECA MATERIAS PRIMAS, S.A. DE C.V.', 'Elizabeth García', 'Manuel Reyes Veramendi 6', 'San Miguel Chapultepec', 'Deleg. Miguel Hidalgo', 'CDMX', '11850', '', '33 37960202 Ext 15141 / 33 1862 2235', 'egarciav@pochteca.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(58, 'PHARMACHEM, S.A. DE C.V.', 'Daniel Luna', 'Privada de Agustín Gutiérrez No. 125', 'General Pedro María Anaya', 'Deleg. Benito Juárez', 'CDMX', '3340', '', 'Cel 55 3011 0238', 'danielluna@pharmachem.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(59, 'PRESTADORA DE SERVICIOS PROFILE, S.C.', '', 'Xochitl 236', 'Ciudad del Sol', 'Zapopan', 'Jalisco', '45050', '', '33 3793 8610', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(60, 'PROESA TECNOGAS, S.A. DE C.V.', 'CRISTINA PEREDO', 'La Paz No. 76', 'Mexicaltzingo', 'Guadalajara', 'Jalisco', '44180', '', '33 3942 8500 / 33 3942 8547', 'cperedo@soyproesa.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(61, 'PROQUIFA, S.A. DE C.V.', 'Karina Banderas García', '', '', '', '', '', '', '33 4770 1170 Ext 103 / Cel 55 4370 5527', 'kbanderas@proquifa.net', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(62, 'PROVEEDORA DE SEGURIDAD INDUSTRIAL DEL GOLFO, S.A. DE C.V.', 'Elisa Álvarez Escobedo', 'Blvd. Adolfo López Mateos 4000', 'Universidad Poniente', 'Tampico', 'Tamaulipas', '89336', '', '33 3812 9843 Ext 110', 'tiendagdl@vallenproveedora.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(63, 'PROVILAB, S.A. DE C.V.', 'Luis Alfonso Muñoz', 'Químicos 408', 'El marqués', 'Querétaro', 'Querétaro', '76047', '', '', 'ventas@provilab.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(64, 'QUÍMICA BARSA, A. DE R.L.', 'Jorge Saldivar', 'Andrés Molina Enríquez No. 310', 'Sinatel', 'Iztapalapa', 'CDMX', '9470', '', '55 5672 1317 / 55 5672 3404', 'quimicabarsa@prodigy.net.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(65, 'QUÍMICOS FARMACÉUTICOS E INDUSTRIALES, S.A. DE C.V.', 'Guadalupe Lizeth Aguilar', 'Galeana 8', 'Zaragoza', 'Tlaltizapan Santa Rosa 30', 'Morelos', '62770', '', '73 4343 3371', 'lizeth@qfi.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(66, 'QUÍMICA FARMACÉUTICA ESTEROIDAL, S.A. DE C.V.', 'Stefanie Ramírez', 'Cerrada 15 de septiembre No. 140', 'Francisco Villa, San Juan Ixtayopan', 'Deleg. Tláhuac', 'CDMX', '13520', '', '55 5848 4765 Ext 106', 'sramirez@quifaest.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(67, 'RICARDO LARA MILLÁN ', '', '', '', '', '', '', '', '', 'ricardo@zipvisual.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(68, 'RESPIREX USA INC', 'Guillermo Amaya', '1001 S. Dairy Ashford Rd., Ste. 225', '', 'Houston', 'Texas', '77077', '', 'USA  713 781 4292', 'sales@respirexusa.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(69, 'SAMUEL HUERTA TREVIÑO', 'Edith Varilla', 'Escuela Militar de Aviación 56', 'Ladrón de Guevara', 'Guadalajara', 'Jalisco', '44600', '', '33 1917 5655', 'edith.varilla@innotrev.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(70, 'SANICHEM LATINOAMERICA, S.A. DE C.V.', 'Ing. Ernesto Olivera Hernández', 'San Francisco 2437', 'Valle de la Misericordia', 'Tlaquepaque', 'Jalisco', '45615', '', '33 1588 4015', 'ventas-zmg@sanichem.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(71, 'CONSTRUCTORA SEAMEX, S.A. DE C.V.', '', 'Atenor Sala No. 60', 'Atenor Salas', 'Deleg. Benito Juárez', 'CDMX', '3010', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(72, 'SILVIA DEL PILAR JIMÉNEZ GÓMEZ (MAQPACK)', 'Liz Hernández', 'Av. Patria 966', 'Echeverría', 'Guadalajara', 'Jalisco', '44970', '', '33 3367 4467 / 33 3343 4487', 'liz@maqpack.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(73, 'SNAIL PHARMA INDUSTRY CO. LTD.', '', '', '', '', '', '', '', '', 'daphne@snailpharma.com', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(74, 'TECNIENVASES PLÁSTICOS, S.A. DE C.V.', 'Brenda Zepeda', 'Montemorelos 164', 'Loma Bonita', 'Zapopan', 'Jalisco', '45087', '', '', 'brendazepeda@tecnienvasessa.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(75, 'TECNOLOGÍA DIGITAL EN TELECOMUNICACIONES, S.A. DE C.V.', 'Diego Alvarez / Carlos Alvarez', '', '', 'Zapopan', 'Jalisco', '45080', '', '33 2733 3920 / Cel 33 3814 0223', 'administracion@todotel.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(76, 'TEMPER DE GUADALAJARA, S.A. DE C.V.', 'Blanca López González', 'Fermín Riestra 1105,', 'Moderna', 'Guadalajara', 'Jalisco', '44190', '', '33 3613 9226 / 33 3613 9235 / 3636 3613 9236', 'ventas6gdl@tempergdl.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(77, 'TERAMOTO SEGURO', '', 'José Guadalupe Zuno 2040', 'Americana', 'Guadalajara', 'Jalisco', '44160', '', '33 3818 1451 / 336 3818 1452 / 33 3630 9330', 'comprobantesfiscales@teramoto.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(78, 'TERAMOTO SEGURO', '', 'José Guadalupe Zuno 2040', 'Americana', 'Guadalajara', 'Jalisco', '44160', '', '33 3818 1451 / 336 3818 1452 / 33 3630 9330', 'notificacion@teramoto.com.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(79, 'UNIVERSIDAD AUTÓNOMA DE GUADALAJARA, A.C.', 'Lydia Olvera Ávila', 'Av. Patria 1201', 'Lomas del Valle', 'Zapopan', 'Jalisco', '45129', '', '33 3648 8470 / 33 3648 8824', 'lydia.olvera@edu.uag.mx', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(80, 'UNIVERSIDAD DE GUADALAJARA', '', '', '', '', '', '', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(81, 'UNITED PARCEL SERVICE DE MÉXICO, S.A. DE C.V.', '', 'Eugenia No. 189', 'Narvarte Oriente', 'Deleg. Benito Juárez', 'CDMX', '3020', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27'),
(82, 'LYSI', '?', '?', '?', '?', '?', '1111', '1111', '1111', '1111', '2020-04-08 12:28:20', '2020-04-08 12:28:20'),
(83, 'BIORIGINAL', 'KATT BERGEN/CAMERON KUPPER', '?', '?', '?', '?', '1111', '1111', '1111', 'alejandros@lindypharma.com.mx', '2020-04-08 12:34:58', '2020-04-08 12:34:58'),
(84, 'DSM JIANGSHAN PHARMACEUTICAL, JIANGSU CHINA', '???', '???', '???', '???', '???', '1111', '1111', '1111', '1111', '2020-04-08 12:41:25', '2020-04-08 12:41:25'),
(85, 'DSM NUTRITIONAL PRODUCTS AG, SISSELN SWITZERLAND', '???', '???', '???', '???', '???', '1111', '1111', '1111', '1111', '2020-04-08 12:45:13', '2020-04-08 12:45:13'),
(86, 'NO DEFINIDO', '???', '?', '?', '?', '?', '1111', '1111', '1111', '1111', '2020-04-09 11:10:45', '2020-04-09 11:10:45'),
(88, 'BIOEXTRACTO', 'URIEL HUERTA', 'A', 'A', 'A', 'A', '1111', '1111', '1111', 'uriel@', '2020-04-15 17:49:08', '2020-04-15 17:49:08'),
(89, 'SESAJAL', 'ALVARO ALBANEZ', 'Calle 22, No, 2332', 'Zona Industrial', 'Guadalajara', 'Jalisco', '44940', NULL, '3134 3470', 'alvaro.albanez@sesajal.com', '2020-04-16 10:40:25', '2020-04-16 10:40:25'),
(90, 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '1', '1', '1', 'NA', '2020-04-16 12:52:37', '2020-04-16 12:52:37'),
(91, 'KAZANN', 'KARINA', 'X', 'X', 'X', 'X', '1111', '1111', '1111', 'alejandros@lindypharma.com.mx', '2020-04-22 10:49:29', '2020-04-22 10:49:29');

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
  `stock` decimal(15,2) DEFAULT '0.00',
  `price` decimal(10,4) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `name`, `code`, `type_id`, `measurement_use`, `measurement_buy`, `stock`, `price`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'AGUA PURIFICADA NIVEL 1', 'A-00001', 1, 6, 2, '0.00', '2.0000', 1, '2020-01-16 02:50:46', '2020-04-28 09:26:02'),
(2, 'GELATINA LB 175 NF8', 'A-00002', 1, 6, 2, '0.00', '0.0000', 3, '2020-01-16 03:03:55', '2020-04-28 10:03:56'),
(3, 'GLICEROL', 'A-00003', 1, 6, 2, '0.00', '0.0000', 57, '2020-01-16 03:05:00', '2020-04-28 09:26:02'),
(4, 'METIL PARABENO SODICO (Nipagin)', 'A-00004', 1, 6, 2, '0.00', '0.0000', 1, '2020-01-16 03:07:02', '2020-04-16 15:02:46'),
(5, 'PROPIL PARABENO SODICO (Nipazol)', 'A-00005', 1, 6, 2, '0.00', '0.0000', 1, '2020-01-16 03:07:21', '2020-04-16 15:02:15'),
(6, 'PVDC /PVC 60 g/cm CRISTAL calibre y medidas', 'B-00001', 2, 6, 4, '0.00', '0.0000', 1, '2020-01-16 03:08:00', '2020-04-07 13:08:42'),
(7, 'Frasco PEAD bco 100 ml R-38', 'B-00002', 2, 6, 4, '0.00', '0.0000', 1, '2020-01-16 03:08:19', '2020-01-16 03:08:19'),
(8, 'Etiqueta de Aceite de Krill F. Similares', 'C-00001', 3, 5, 5, '0.00', '0.0000', 86, '2020-01-16 03:08:42', '2020-04-09 11:12:52'),
(9, 'CAJA COLECTIVA DC C-16, 40X25X13.8cm', 'D-00001', 4, 5, 5, '0.00', '0.0000', 86, '2020-01-16 03:09:04', '2020-04-09 11:41:59'),
(10, 'BIOXIDO DE TITANIO 19-380-C', 'A-00006', 1, 6, 2, '0.00', '0.0000', 15, '2020-01-16 03:09:36', '2020-04-16 10:47:12'),
(11, 'COLORANTE OXIDO NEGRO AZABACHE', 'A-00007', 1, 6, 2, '0.00', '0.0000', 15, '2020-01-16 03:10:45', '2020-04-16 10:55:24'),
(12, 'COLORANTE ROJO No. 6', 'A-00008', 1, 6, 2, '0.00', '0.0000', 1, '2020-02-29 19:01:18', '2020-03-31 22:58:34'),
(13, 'SABOR VAINILLA MADAGASCAR', 'A-00009', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 19:59:52', '2020-03-31 22:59:14'),
(14, 'ACIDO FOLICO (Vitamina B9)', 'A-00010', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 20:00:42', '2020-04-16 13:57:05'),
(15, 'PALMITATO DE RETINOL 1.7 MUI (Vitamina A)', 'A-00011', 1, 6, 2, '0.00', '0.0000', 58, '2020-03-30 20:01:00', '2020-04-16 11:06:03'),
(16, 'MONONITRATO DE TIAMINA (Vitamina B1)', 'A-00012', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 20:01:21', '2020-03-31 22:40:53'),
(17, 'CLORHIDRATO DE PIRIDOXINA (Vitamina B6)', 'A-00013', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 20:01:39', '2020-04-16 14:29:02'),
(18, 'CIANOCOBALAMINA (Vitamina B12)', 'A-00014', 1, 6, 2, '0.00', '0.0000', 64, '2020-03-30 20:02:06', '2020-04-16 13:58:26'),
(19, 'ACIDO ASCORBICO (Vitamina C) GMP', 'A-00015', 1, 6, 2, '0.00', '0.0000', 84, '2020-03-30 20:02:27', '2020-04-16 14:31:43'),
(20, 'ACETATO DE DL ALFA TOCOFEROL (Vitamina E)', 'A-00016', 1, 6, 2, '0.00', '0.0000', 58, '2020-03-30 20:02:47', '2020-04-16 11:08:23'),
(21, 'POLINICOTINATO DE CROMO 12.35 %', 'A-00017', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 20:04:26', '2020-03-31 23:00:24'),
(22, 'OXIDO DE MAGNESIO LIGERO', 'A-00018', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 20:04:48', '2020-03-31 22:59:43'),
(23, 'SULFATO DE ZINC MONOHIDRATADO', 'A-00019', 1, 6, 2, '0.00', '0.0000', 65, '2020-03-30 20:05:06', '2020-04-16 11:12:29'),
(24, 'LEVADURA DE SELENIO AL 0.2 %', 'A-00020', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:12:41', '2020-03-31 23:00:04'),
(25, 'ACEITE DE SOYA', 'A-00021', 1, 6, 2, '80000000.00', '0.0000', 2, '2020-03-30 14:49:26', '2020-04-28 10:03:46'),
(26, 'LAURIL SULFATO DE SODIO', 'A-00022', 1, 6, 2, '0.00', '0.0000', 57, '2020-03-30 14:49:26', '2020-04-16 14:18:11'),
(27, 'CERA DE ABEJA', 'A-00023', 1, 6, 2, '0.00', '0.0000', 16, '2020-03-30 14:49:26', '2020-04-16 14:13:12'),
(28, 'ACEITE VEGETAL HIDROGENADO (Manteca Vegetal)', 'A-00024', 1, 6, 2, '0.00', '0.0000', 2, '2020-03-30 14:49:26', '2020-04-16 14:21:32'),
(29, 'LECITINA DE SOYA', 'A-00025', 1, 6, 2, '0.00', '0.0000', 2, '2020-03-30 14:49:26', '2020-04-16 11:12:59'),
(30, 'BUTILHIDROXITOLUENO (BHT)', 'A-00026', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:25:52'),
(31, 'BUTILHIDROXIANISOL (BHA)', 'A-00027', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:14:38'),
(32, 'EXTRACTO DE ARANDANO AZUL 35.8 % (Vaccinium myrtillus L)', 'A-00028', 1, 6, 2, '0.00', '0.0000', 54, '2020-03-30 14:49:26', '2020-04-16 10:54:55'),
(33, 'ACEITE DE PESCADO AL 30 %, 18/12 EPA y DHA GMP', 'A-00029', 1, 6, 2, '0.00', '0.0000', 82, '2020-03-30 14:49:26', '2020-04-08 12:29:10'),
(34, 'LACTOFERRINA BOVINA', 'A-00030', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 23:01:08'),
(35, 'FOSFATO DIBASICO DE  CALCIO ANHIDRO', 'A-00031', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:12:53'),
(36, 'COLORANTE AZUL No. 1', 'A-00032', 1, 6, 2, '0.00', '0.0000', 15, '2020-03-30 14:49:26', '2020-04-16 11:10:51'),
(37, 'COLORANTE ROJO No. 40', 'A-00033', 1, 6, 2, '0.00', '0.0000', 15, '2020-03-30 14:49:26', '2020-04-16 10:54:18'),
(38, 'OXIDO ROJO MEDIO (16-CS-208)', 'A-00034', 1, 6, 2, '0.00', '0.0000', 15, '2020-03-30 14:49:26', '2020-04-16 11:06:43'),
(39, 'OXIDO AMARILLO OCRE (16-CS-201)', 'A-00035', 1, 6, 2, '0.00', '0.0000', 15, '2020-03-30 14:49:26', '2020-04-16 11:11:13'),
(40, 'MONONITRATO DE TIAMINA (Vitamina B1)', 'A-00036', 1, 6, 2, '0.00', '0.0000', 58, '2020-03-30 14:49:26', '2020-04-16 14:30:09'),
(41, 'RIBOFLAVINA BASE (Vitamina B2)', 'A-00037', 1, 6, 2, '0.00', '0.0000', 58, '2020-03-30 14:49:26', '2020-04-16 14:15:07'),
(42, 'NICOTINAMIDA (Vitamina B3)', 'A-00038', 1, 6, 2, '0.00', '0.0000', 58, '2020-03-30 14:49:26', '2020-04-16 14:30:35'),
(43, 'PANTOTENATO DE CALCIO (Vitamina B5)', 'A-00039', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:23:47'),
(44, 'COLECALCIFEROL (Vitamina D3)', 'A-00040', 1, 6, 2, '0.00', '0.0000', 35, '2020-03-30 14:49:26', '2020-04-16 10:42:44'),
(45, 'ASCORBATO DE CALCIO', 'A-00041', 1, 6, 2, '0.00', '0.0000', 6, '2020-03-30 14:49:26', '2020-04-16 14:18:44'),
(46, 'BITARTRATO DE COLINA', 'A-00042', 1, 6, 2, '0.00', '0.0000', 35, '2020-03-30 14:49:26', '2020-04-16 14:22:19'),
(47, 'D-BIOTINA', 'A-00043', 1, 6, 2, '0.00', '0.0000', 6, '2020-03-30 14:49:26', '2020-04-16 11:05:22'),
(48, 'FUMARATO FERROSO', 'A-00044', 1, 6, 2, '0.00', '0.0000', 6, '2020-03-30 14:49:26', '2020-04-16 14:13:48'),
(49, 'GLICINATO DE MAGNESIO', 'A-00045', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 23:03:00'),
(50, 'OXIDO DE ZINC', 'A-00046', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:28:38'),
(51, 'SULFATO DE COBRE PENTAHIDRATADO', 'A-00047', 1, 6, 2, '0.00', '0.0000', 65, '2020-03-30 14:49:26', '2020-04-16 11:07:50'),
(52, 'SULFATO DE MANGANESO MONOHIDRATADO', 'A-00048', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-27 18:31:30'),
(53, 'CLORURO DE POTASIO', 'A-00049', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:24:37'),
(54, 'MOLIBDATO DE SODIO DIHIDRATADO', 'A-00050', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:27:01'),
(55, 'Sulfato de Cobalto heptahidratado', 'A-00051', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 21:46:24'),
(56, 'QUERCETINA DIHIDRATADA 95 %', 'A-00052', 1, 6, 2, '0.00', '0.0000', 6, '2020-03-30 14:49:26', '2020-04-16 14:32:16'),
(57, 'CLORHIDRATO DE LISINA', 'A-00053', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:23:21'),
(58, 'Adenosina', 'A-00054', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 22:06:49'),
(59, 'Ácido Linoleico', 'A-00055', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(60, 'ETILVAINILLINA', 'A-00056', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 15:03:11'),
(61, 'ACIDO ASCORBICO REGULAR (Vitamina C) FG', 'A-00057', 1, 6, 2, '0.00', '0.0000', 84, '2020-03-30 14:49:26', '2020-04-08 12:46:24'),
(62, 'ACEITE MINERAL NF85', 'A-00058', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 23:02:35'),
(63, 'SULFATO DE COBRE ANHIDRO', 'A-00059', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 22:51:27'),
(64, 'Mezcla Medix (Consignada)', 'A-00060', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(65, 'EXTRACTO DE EQUINACEA PURPUREA AL 4%', 'A-00061', 1, 6, 2, '0.00', '120.0000', 88, '2020-03-30 14:49:26', '2020-04-15 17:49:33'),
(66, 'NIACINA (Ácido nicotínico)', 'A-00062', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 23:05:41'),
(67, 'COENZIMA Q10 (Ubidecarenona)', 'A-00063', 1, 6, 2, '0.00', '0.0000', 6, '2020-03-30 14:49:26', '2020-04-16 10:55:58'),
(68, 'LUTEINA AL 5 %', 'A-00064', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:32:36'),
(69, 'SULFATO FERROSO ANHIDRO', 'A-00065', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 23:04:24'),
(70, 'SULFATO DE MAGNESIO ANHIDRO', 'A-00066', 1, 6, 2, '0.00', '0.0000', 65, '2020-03-30 14:49:26', '2020-04-16 11:09:39'),
(71, 'SULFATO DE ZINC ANHIDRO', 'A-00067', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 23:04:55'),
(72, 'ACEITE DE ARGAN (grado alimento)', 'A-00068', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-21 10:51:08'),
(73, 'YODURO DE POTASIO', 'A-00069', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-03-31 23:03:46'),
(74, 'POLYSORB 85/70/00 ROQUETTE', 'A-00070', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-30 14:49:26', '2020-04-16 14:33:44'),
(75, 'ALCOHOL ETILICO 96 °C', 'A-00071', 1, 6, 2, '0.00', '0.0000', 4, '2020-03-30 14:49:26', '2020-04-16 14:33:05'),
(76, 'ETIQUETA DE COLAGENO HIDROLIZADO 500g, VP', 'C-00002', 3, 5, 5, '0.00', '0.0000', 86, '2020-03-30 20:50:21', '2020-04-09 11:14:07'),
(77, 'SULFATO DE COBALTO HEPTAHIDRATADO', 'A-00079', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-31 21:43:31', '2020-03-31 21:45:24'),
(78, 'ACEITE DE CARTAMO ALTO OLEICO REFINADO', 'A-00072', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-31 21:49:06', '2020-03-31 21:49:26'),
(79, 'ACEITE DE GIRASOL', 'A-00092', 1, 6, 2, '0.00', '2.5000', 89, '2020-03-31 21:51:47', '2020-04-16 14:42:23'),
(80, 'ACEITE DE LINAZA ORGANICA EXTRA VIRGEN', 'A-00090', 1, 6, 2, '0.00', '1.5000', 89, '2020-03-31 21:55:45', '2020-04-16 14:34:32'),
(81, 'ACIDO CITRICO', 'A-00073', 1, 6, 2, '0.00', '0.0000', 5, '2020-03-31 22:00:25', '2020-04-16 14:26:25'),
(82, 'COLORANTE AMARILLO No.5', 'A-00077', 1, 6, 2, '0.00', '0.0000', 15, '2020-03-31 22:08:44', '2020-04-16 11:10:20'),
(83, 'HIDROLIZADO DE GELATINA (COLAGENO)', 'A-00074', 1, 6, 2, '0.00', '0.0000', 3, '2020-03-31 22:17:18', '2020-04-16 14:14:18'),
(84, 'GELATINA PS 175 NF8', 'A-00080', 1, 6, 2, '0.00', '0.0000', 3, '2020-03-31 22:28:44', '2020-04-16 14:24:16'),
(85, 'SABOR MANGO CON COLOR 02-8355-C', 'A-00075', 1, 6, 2, '0.00', '0.0000', 15, '2020-03-31 22:46:49', '2020-04-16 11:08:59'),
(86, 'SUCRALOSA', 'A-00076', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-31 22:49:22', '2020-04-16 13:58:53'),
(87, 'TRIETANOLAMINA', 'A-00093', 1, 6, 2, '0.00', '0.0000', 1, '2020-03-31 22:56:54', '2020-03-31 22:57:04'),
(88, 'ACEITE DE KRILL', 'A-00082', 1, 6, 2, '0.00', '360.0000', 1, '2020-04-06 12:42:58', '2020-04-06 12:42:58'),
(89, 'ASTAXANTINA AL 10%, OLEORRESINA', 'A-00081', 1, 6, 2, '0.00', '1.0000', 1, '2020-04-06 12:44:28', '2020-04-06 12:44:28'),
(90, 'ACEITE DE PESCADO AL 55% 33/22 EPA&DHA', 'A-00078', 1, 6, 2, '0.00', '14.0000', 83, '2020-04-07 12:04:28', '2020-04-08 12:36:16'),
(91, 'ACEITE DE HIGADO DE TIBURON ADICIONADO CON VIT A&D', 'A-00083', 1, 6, 2, '0.00', '1.0000', 1, '2020-04-07 12:06:14', '2020-04-07 12:06:14'),
(92, 'ACEITE DE PESCADO AL 55% 33/22 EPA&DHA HE002', 'A-00084', 1, 6, 2, '0.00', '14.0000', 82, '2020-04-07 12:11:37', '2020-04-08 12:36:50'),
(93, 'ACEITE DE PESCADO AL 30 %, 18/12 EPA y DHA HO307 FG', 'A-00085', 1, 6, 2, '0.00', '7.0000', 82, '2020-04-07 12:13:02', '2020-04-08 12:28:37'),
(94, 'ACEITE DE BACALAO AL 18% 8-10 EPA&DHA', 'A-00086', 1, 6, 2, '0.00', '7.0000', 1, '2020-04-07 12:14:39', '2020-04-25 13:06:28'),
(95, 'ACEITE DE BACALAO DEL 17 AL 19% 7/10 EPA&DHA', 'A-00087', 1, 6, 2, '0.00', '5.0000', 1, '2020-04-07 12:17:07', '2020-04-07 12:17:07'),
(96, 'ACEITE DE SALMON DEL 16 AL 19% (3.2/4.7/11 EPA,DHA&DPA)', 'A-00088', 1, 6, 2, '0.00', '5.0000', 1, '2020-04-07 12:19:15', '2020-04-07 12:19:15'),
(97, 'ACEITE DE ARENQUE (7/7/1 EPA,DHA&DPA)', 'A-00089', 1, 6, 2, '0.00', '5.0000', 1, '2020-04-07 12:29:32', '2020-04-07 12:29:32'),
(99, 'ACEITE DE PESCADO EE AL 70% DHA', 'A-00091', 1, 6, 2, '0.00', '18.0000', 1, '2020-04-07 12:40:41', '2020-04-07 12:40:41'),
(101, 'ETIQUETA UNIDECAR Q10 30 CAPS, VP', 'C-00003', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:15:22', '2020-04-09 11:15:22'),
(102, 'ETIQUETA OMEGA 3 30 CAPS, VP', 'C-00004', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:16:31', '2020-04-09 11:16:31'),
(103, 'ETIQUETA SOIE VIT E/ARGAN 60 CAPS', 'C-00005', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:17:30', '2020-04-09 11:17:30'),
(104, 'ETIQUETA DTREXCAL 60 CAPS, VP', 'C-00006', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:18:23', '2020-04-09 11:18:23'),
(105, 'ETIQUETA +50 30 CAPS, VP', 'C-00007', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:19:11', '2020-04-09 11:19:11'),
(106, 'ETIQUETA MINDHA 70 90 CAPS, VP', 'C-00008', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:20:16', '2020-04-09 11:20:16'),
(107, 'ETIQUETA NEO NAT 30 CAPS, VP', 'C-00009', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:21:14', '2020-04-09 11:21:14'),
(108, 'ETIQUETA SIMISOYA 100 CAPS, F.SIMILARES', 'C-00010', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:22:47', '2020-04-09 11:22:47'),
(109, 'ETIQUETA TORTUVITAS SABOR MANGO 100 CAPS, VP', 'C-00011', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:23:50', '2020-04-09 11:23:50'),
(110, 'ETIQUETA LACRIVIT 90 CAPS, VP', 'C-00012', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:25:05', '2020-04-09 11:25:05'),
(111, 'ETIQUETA ASTAXANTINA 40mg 30 CAPS', 'C-00013', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:27:00', '2020-04-09 11:27:00'),
(112, 'ETIQUETA TORTUVITAS SABOR MANZANA 100 CAPS, VP', 'C-00014', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:28:06', '2020-04-09 11:28:06'),
(113, 'ETIQUETA ADETREX 120 CAPS, VP', 'C-00015', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:29:03', '2020-04-09 11:29:03'),
(114, 'ETIQUETA TORTUVITAS SABOR MANGO 200 CAPS, VP', 'C-00016', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:32:39', '2020-04-09 11:32:39'),
(115, 'ETIQUETA TORTUVITAS SABOR MORA 200 CAPS, VP', 'C-00017', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:33:37', '2020-04-09 11:33:37'),
(116, 'ETIQUETA TORTUVITAS SABOR MANZANA 200 CAPS, VP', 'C-00018', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:34:38', '2020-04-09 11:34:38'),
(117, 'ETIQUETA ADETREX PLUS 120 CAPS, VP', 'C-00019', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:36:21', '2020-04-09 11:36:21'),
(118, 'ETIQUETA LECITINA DE SOYA 1,200mg 100 CAPS, VP', 'C-00020', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:37:14', '2020-04-09 11:37:14'),
(119, 'ETIQUETA LECITINA DE SOYA 850mg 100 CAPS, VP', 'C-00021', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:37:59', '2020-04-09 11:37:59'),
(120, 'ETIQUETA TORTUVITAS SABOR MORA 100 CAPS, VP', 'C-00022', 3, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:38:51', '2020-04-09 11:38:51'),
(121, 'CAJA COLECTIVA DC C-17, 52.3X41.3X31.4cm', 'D-00002', 4, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:43:06', '2020-04-09 11:43:06'),
(122, 'TAPA BLANCA A PRUEBA DE NIÑOS S/SELLO R-38', 'D-00003', 4, 5, 5, '0.00', '0.0000', 86, '2020-04-09 11:43:55', '2020-04-09 11:43:55'),
(123, 'ACEITE ESENCIAL DE MENTA PIPERITA', 'A-00094', 1, 6, 2, '0.00', '1.0000', 91, '2020-04-22 10:47:53', '2020-04-22 10:50:35'),
(124, 'ACEITE ESENCIAL DE EUCALIPTO 70/75', 'A-00095', 1, 6, 2, '0.00', '1.0000', 91, '2020-04-22 10:48:43', '2020-04-22 10:50:00'),
(125, 'SABOR MANZANA VERDE CON COLOR 02-8328-C', 'A-00096', 1, 6, 2, '0.00', '1.0000', 15, '2020-04-22 11:53:27', '2020-04-22 11:53:27'),
(126, 'SABOR MORA AZUL CON COLOR 02-8327-C', 'A-00097', 1, 6, 2, '0.00', '1.0000', 15, '2020-04-22 11:54:41', '2020-04-22 11:54:41');

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
(1, 'Gramo', 'gr', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(2, 'Kilogramo', 'kg', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Mililitro', 'ml', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(4, 'Litro', 'l', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(5, 'Pieza', 'pza', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(6, 'Miligramos', 'mg', '2020-02-29 13:02:51', '2020-02-29 13:02:51');

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
(4, 'Material de Empaque', 'D', '2020-01-15 00:00:00', '2020-01-15 00:00:00'),
(5, 'Indirectos', 'E', '2020-04-14 09:31:42', '2020-04-14 09:31:42');

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
(1, 'Angel Garcia', 'angelrodriguez@ucol.mx', '3121812759', 1, NULL, '$2y$10$OucV2LRaxsrMtXCP8qCtNOy4Q9hD24yx4/YafZBDjlIhGrh4Ak/pK', NULL, '2019-10-19 19:56:12', '2020-02-25 07:30:20'),
(2, 'Lic. Paula Karina González López', 'compras@lindypharma.com.mx', NULL, 4, NULL, '$2y$10$6mMjAnmdaTF.EVsUUQjwpuNRSUbW9PtPc/9wLPFp4kighVvjmwQ1u', NULL, '2020-01-11 20:13:30', '2020-04-21 15:15:14'),
(3, 'IQ Carlos Alejandro Saldaña Pajarito', 'alejandros@lindypharma.com.mx', NULL, 1, NULL, '$2y$10$VMzq8W45tNlZoPJQXS97.OTPh0wBSln49puQIm4gQPpk3tkSyfOfe', NULL, '2020-01-11 22:30:27', '2020-04-01 02:12:37'),
(4, 'Usuario almacenista', 'almacen@lindypharma.com', NULL, 3, NULL, '$2y$10$UfwJyb.oZ5ltzlIxfQfdcOXtERUW6Zn8fhF3ge6t6kUwZXCSxQkGy', NULL, '2020-02-24 03:07:18', '2020-04-16 17:54:04'),
(5, 'Usuario ventas', 'ventas@lindypharma.com', NULL, 5, NULL, '$2y$10$HUxhD68hJwMT3UAvwyS0kONdTAZQxSNbu43e63wSm7XTboJHXGvyK', NULL, '2020-02-24 03:08:03', '2020-02-25 08:01:59'),
(6, 'QFB Karla Guadalupe Becerra Jimenez', 'kbecerra@lindypharma.com.mx', NULL, 2, NULL, '$2y$10$LTiqzqdx18rCnZKc2.ovGueB7t.8DO19xmcRnP1svkj2nOunZtorS', NULL, '2020-02-25 07:57:23', '2020-04-22 14:28:47');

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
(2, 'Dirección de Calidad', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(3, 'Almacenista', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(4, 'Compras', '2020-02-20 00:00:00', '2020-02-20 00:00:00'),
(5, 'Ventas', '2020-02-23 13:02:44', '2020-02-23 13:02:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decreases`
--
ALTER TABLE `decreases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departures`
--
ALTER TABLE `departures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departure_items`
--
ALTER TABLE `departure_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entrances`
--
ALTER TABLE `entrances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entrance_comments`
--
ALTER TABLE `entrance_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entrance_items`
--
ALTER TABLE `entrance_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entrance_supplies`
--
ALTER TABLE `entrance_supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Logbooks`
--
ALTER TABLE `Logbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logbook_types`
--
ALTER TABLE `logbook_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `molds`
--
ALTER TABLE `molds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages_supplies`
--
ALTER TABLE `packages_supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_recipes`
--
ALTER TABLE `product_recipes`
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
-- Indexes for table `recipe_products`
--
ALTER TABLE `recipe_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_supplies`
--
ALTER TABLE `recipe_supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `catalogs`
--
ALTER TABLE `catalogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `decreases`
--
ALTER TABLE `decreases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departures`
--
ALTER TABLE `departures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departure_items`
--
ALTER TABLE `departure_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entrances`
--
ALTER TABLE `entrances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `entrance_comments`
--
ALTER TABLE `entrance_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entrance_items`
--
ALTER TABLE `entrance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entrance_supplies`
--
ALTER TABLE `entrance_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Logbooks`
--
ALTER TABLE `Logbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT for table `logbook_types`
--
ALTER TABLE `logbook_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `molds`
--
ALTER TABLE `molds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages_supplies`
--
ALTER TABLE `packages_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_recipes`
--
ALTER TABLE `product_recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_supplies`
--
ALTER TABLE `product_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipe_products`
--
ALTER TABLE `recipe_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipe_supplies`
--
ALTER TABLE `recipe_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `supply_measurements`
--
ALTER TABLE `supply_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supply_types`
--
ALTER TABLE `supply_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
