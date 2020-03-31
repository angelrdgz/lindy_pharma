-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2020 at 05:18 PM
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
(2, 'G02', 'cfdi', 'Devoluciones, descuentos o bonificaciones', '2020-03-08 18:34:10', '2020-03-08 18:34:10');

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
(2, 'Ricardo Castañeda', 'Ricardo', '3121812759', 'xyz', 'trt', 'rtr', 'rtrt', '12312', 'ricardoenrique_111@hotmail.com', 1, '2020-02-27 04:51:02', '2020-02-27 04:51:02');

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
  `quantity` int(11) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `line` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departures`
--

INSERT INTO `departures` (`id`, `order_number`, `recipe_id`, `quantity`, `lot`, `line`, `created_by`, `client_id`, `status`, `type`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'OT-0001', 1, 350, 'ABC-123', 'Linea 2', 1, 2, 'Creada', 1, 1, '2020-03-04 04:46:58', '2020-03-04 04:46:58'),
(2, 'OT-0001', 1, 350, 'ABC-123', 'Linea 2', 1, 2, 'Creada', 2, 1, '2020-03-04 04:46:59', '2020-03-04 04:46:59'),
(3, 'OT-0002', 3, 100, 'sdada213', '3sed3a', 1, 2, 'Creada', 1, 1, '2020-03-30 14:33:11', '2020-03-30 14:33:11'),
(4, 'OT-02.5', 3, 100, 'sdada213', '3sed3a', 1, 2, 'Creada', 1, 1, '2020-03-30 14:33:49', '2020-03-30 14:33:49'),
(5, 'OT-02.5', 3, 100, 'sdada213', '3sed3a', 1, 2, 'Creada', 2, 1, '2020-03-30 14:33:49', '2020-03-30 14:33:49');

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
(1, 1, 1, '100.00', '1.20', 8),
(2, 1, 2, '500.00', '3.40', NULL),
(3, 2, 9, '1.00', '0.80', NULL),
(4, 2, 8, '2.00', '5.90', NULL),
(5, 3, 1, '123.00', '0.00', NULL),
(6, 3, 2, '22.00', '3.00', NULL),
(7, 4, 1, '123.00', '0.00', NULL),
(8, 4, 2, '22.00', '3.00', NULL),
(9, 5, 4, '232.00', '4.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entrances`
--

CREATE TABLE `entrances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cfdi_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `requisition` varchar(60) NOT NULL,
  `department` varchar(60) NOT NULL,
  `owner` varchar(150) NOT NULL,
  `mader` varchar(150) NOT NULL,
  `authorizer` varchar(150) NOT NULL,
  `cost_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrances`
--

INSERT INTO `entrances` (`id`, `user_id`, `cfdi_id`, `supplier_id`, `status`, `requisition`, `department`, `owner`, `mader`, `authorizer`, `cost_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Creada', 'sadsaasdsada', 'asdas', '', '', '', 0, '2020-03-20 01:41:21', '2020-03-20 01:41:21'),
(2, 1, 1, 1, 'Creada', 'sadsaasdsada', 'asdas', '', '', '', 0, '2020-03-20 01:41:50', '2020-03-20 01:41:50'),
(3, 1, 1, 2, 'Aprobada', '0024', 'Operaciones', 'y', 'x', 'z', 1, '2020-03-20 21:39:15', '2020-03-25 21:02:53');

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
(1, 2, 'asdasdadsad'),
(9, 3, 'Entregar despues de las 17:00');

-- --------------------------------------------------------

--
-- Table structure for table `entrance_items`
--

CREATE TABLE `entrance_items` (
  `id` int(11) NOT NULL,
  `entrance_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `comments` text,
  `order_number` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrance_items`
--

INSERT INTO `entrance_items` (`id`, `entrance_id`, `supply_id`, `quantity`, `price`, `comments`, `order_number`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2434.0000', '2344324.00', NULL, NULL, '2020-03-20 01:41:50', '2020-03-20 01:41:50'),
(9, 3, 4, '100.0000', '120.00', NULL, NULL, '2020-03-30 19:15:22', '2020-03-30 19:15:22');

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
(54, 1, 'Insumo Creado', 'El insumo con el código \"C-00002\" ha sido creado', 'fas fa-capsules', 1, '2020-03-30 20:50:21', '2020-03-30 20:50:21');

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
(2, '03OVE-01', 'Ovales', '2020-01-29 00:00:00', '2020-02-23 04:23:52', '3.00', '12.00', '7.00', 16, 41, '119.82', 'SAW PALMETO', NULL),
(3, '20OBE-01', 'Oblongos', '2020-02-23 04:25:07', '2020-02-23 04:25:07', '20.00', '26.00', '10.00', 8, 32, '307.03', 'LACRIVIT, VITAGERUM', NULL),
(4, '24OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '24.00', '28.54', '11.68', 7, 29, '387.19', NULL, NULL),
(5, '29OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '29.00', '26.25', '12.00', 7, 29, '387.19', 'AMINOTER', NULL),
(6, '29OBE-02', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '29.00', '28.50', '10.50', 7, 29, '387.19', NULL, NULL),
(7, '29OBL-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '29.00', '29.33', '11.35', 7, 29, '387.19', NULL, NULL),
(8, '31OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '31.00', '28.80', '11.76', 7, 29, '387.19', NULL, NULL),
(9, '32OBE-01', 'Oblongos', '2020-03-31 00:20:39', '2020-03-31 00:20:39', '32.00', '28.87', '11.91', 7, 29, '387.19', NULL, NULL),
(10, '06OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '6.00', '14.29', '9.05', 14, 36, '155.95', NULL, NULL),
(11, '08OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '8.00', '15.50', '9.82', 13, 34, '177.83', NULL, NULL),
(12, '10OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '10.00', '16.53', '10.47', 12, 32, '204.69', NULL, NULL),
(13, '14OVE-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '14.00', '18.50', '11.50', 11, 30, '238.18', 'KRILL', NULL),
(14, '20OVL-01', 'Ovales', '2020-03-31 00:29:19', '2020-03-31 00:29:19', '20.00', '22.00', '13.00', 0, 0, '0.00', NULL, NULL),
(15, '03TRE-01', 'Especiales', '2020-03-31 00:36:17', '2020-03-31 00:36:17', '3.00', '9.54', '9.34', 20, 34, '115.59', NULL, 'TRIANGULAR'),
(16, '06CUE-01', 'Especiales', '2020-03-31 00:36:17', '2020-03-31 00:36:17', '6.00', '10.00', '10.00', 16, 32, '153.52', NULL, 'TORTUGAS'),
(17, '08TOE-01', 'Especiales', '2020-03-31 00:36:17', '2020-03-31 00:36:17', '8.00', '16.20', '9.00', 10, 24, '327.50', NULL, 'CUADRADO'),
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
  `fom` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_expire` date NOT NULL,
  `lot` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `product_id`, `client_id`, `quantity`, `presentation`, `fom`, `price`, `date_expire`, `lot`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '23123.00', 'sadadas', '', '0.00', '2020-03-28', 'sadasd', 1, '2020-03-20 20:28:07', '2020-03-20 20:28:07'),
(2, 1, 1, '23123.00', 'sadadas', '', '0.00', '2020-03-28', 'sadasd', 1, '2020-03-20 20:29:05', '2020-03-20 20:29:05'),
(3, 5, 2, '1000.00', 'Nueva presentación', '', '0.00', '2020-04-30', 'LOT-0001', 1, '2020-03-30 17:19:22', '2020-03-30 17:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `packages_supplies`
--

CREATE TABLE `packages_supplies` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `excess` decimal(3,2) NOT NULL,
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
(1, 'GPM0004', 'VITAGERUM, Vitaminas y Minerales.', '0.00', '2020-01-26 04:55:45', '2020-01-26 05:25:46'),
(2, 'XYZ-0001', 'Producto Terminado #2', '0.00', '2020-03-30 16:58:02', '2020-03-30 16:58:02'),
(3, 'XYZ-0001', 'Producto Terminado #2', '0.00', '2020-03-30 17:00:34', '2020-03-30 17:00:34'),
(4, 'XYZ-0001', 'Producto Terminado #2', '0.00', '2020-03-30 17:01:02', '2020-03-30 17:01:02'),
(5, 'XYZ-0001', 'Producto Terminado #2', '0.00', '2020-03-30 17:01:20', '2020-03-30 17:01:20');

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
(1, 4, 1, '100.00', '1.00', '2020-03-30 17:01:02', '2020-03-30 17:01:02'),
(7, 5, 1, '100.00', '1.00', '2020-03-30 17:11:48', '2020-03-30 17:11:48');

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
(19, 1, 1, '100.0000', '1.20', '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(20, 1, 2, '500.0000', '3.40', '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(21, 1, 9, '1.0000', '0.80', '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(22, 1, 8, '2.0000', '5.90', '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(34, 5, 3, '180.0000', '3.50', '2020-03-30 17:11:48', '2020-03-30 17:11:48'),
(35, 5, 6, '350.5000', '1.00', '2020-03-30 17:11:48', '2020-03-30 17:11:48');

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
(1, 'GPM0004', 'VITAGERUM, Vitaminas y Minerales.', '0.00', 2, '2020-01-26 04:55:45', '2020-01-26 05:25:46'),
(2, 'dsfsdfsdfs', 'sfdffsdfdsf', '0.00', 3, '2020-03-30 14:19:55', '2020-03-30 14:19:55'),
(3, 'sdasasdasd', 'asdasdsadsad', '0.00', 2, '2020-03-30 14:26:08', '2020-03-30 14:26:08');

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
(19, 1, 1, '100.0000', '1.20', 1, '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(20, 1, 2, '500.0000', '3.40', 1, '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(21, 1, 9, '1.0000', '0.80', 2, '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(22, 1, 8, '2.0000', '5.90', 2, '2020-01-30 01:45:49', '2020-01-30 01:45:49'),
(23, 3, 4, '232.0000', '4.00', 2, '2020-03-30 14:26:08', '2020-03-30 14:26:08'),
(24, 3, 1, '123.0000', '0.00', 1, '2020-03-30 14:26:08', '2020-03-30 14:26:08'),
(25, 3, 2, '22.0000', '3.00', 1, '2020-03-30 14:26:08', '2020-03-30 14:26:08');

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
(81, 'UNITED PARCEL SERVICE DE MÉXICO, S.A. DE C.V.', '', 'Eugenia No. 189', 'Narvarte Oriente', 'Deleg. Benito Juárez', 'CDMX', '3020', '', '', '', '2020-03-31 00:11:27', '2020-03-31 00:11:27');

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
(1, 'Agua Purificada Nivel 1', 'A-00001', 1, 6, 4, '0.00', '2020-01-16 02:50:46', '2020-03-20 22:08:21'),
(2, 'Gelatina LB 175 B', 'A-00002', 1, 6, 2, '0.00', '2020-01-16 03:03:55', '2020-01-16 03:03:55'),
(3, 'Glicerol', 'A-00003', 1, 6, 4, '0.00', '2020-01-16 03:05:00', '2020-01-16 03:05:00'),
(4, 'Metilparabeno sódico (Nipagin)', 'A-00004', 1, 6, 4, '100000.00', '2020-01-16 03:07:02', '2020-03-25 21:02:53'),
(5, 'Propilparabeno sódico (Nipazol)', 'A-00005', 1, 6, 4, '0.00', '2020-01-16 03:07:21', '2020-01-16 03:07:21'),
(6, 'PVDC /PVC 60 g/cm CRISTAL calibre y medidas', 'B-00001', 2, 6, 4, '0.00', '2020-01-16 03:08:00', '2020-01-16 03:08:00'),
(7, 'Frasco PEAD bco 100 ml R-38', 'B-00002', 2, 6, 4, '0.00', '2020-01-16 03:08:19', '2020-01-16 03:08:19'),
(8, 'Etiqueta de Aceite de Krill F. Similares', 'C-00001', 3, 6, 5, '0.00', '2020-01-16 03:08:42', '2020-01-16 03:08:42'),
(9, 'Caja colectiva doble corrugado de 50 x 50 x50', 'D-00001', 4, 6, 5, '0.00', '2020-01-16 03:09:04', '2020-01-16 03:09:04'),
(10, 'Bióxido de Titanio 19-380-C', 'A-00006', 1, 6, 4, '0.00', '2020-01-16 03:09:36', '2020-01-16 03:09:36'),
(11, 'Colorante óxido negro azabache', 'A-00007', 1, 6, 2, '0.00', '2020-01-16 03:10:45', '2020-01-16 03:10:45'),
(12, 'Colorante Rojo No. 6', 'A-00008', 1, 6, 2, '0.00', '2020-02-29 19:01:18', '2020-02-29 19:03:25'),
(13, 'Sabor Vainilla Madagascar', 'A-00009', 1, 6, 2, '0.00', '2020-03-30 19:59:52', '2020-03-30 19:59:52'),
(14, 'Ácido Fólico (Vitamina B9)', 'A-00010', 1, 6, 2, '0.00', '2020-03-30 20:00:42', '2020-03-30 20:00:42'),
(15, 'Palmitato de Retinol 1.7 MUI (Vitamina A)', 'A-00011', 1, 6, 2, '0.00', '2020-03-30 20:01:00', '2020-03-30 20:01:00'),
(16, 'Mononitrato de Tiamina (Vitamina B1)', 'A-00012', 1, 6, 2, '0.00', '2020-03-30 20:01:21', '2020-03-30 20:01:21'),
(17, 'Clorhidrato de Piridoxina (Vitamina B6)', 'A-00013', 1, 6, 2, '0.00', '2020-03-30 20:01:39', '2020-03-30 20:01:39'),
(18, 'Cianocobalamina (Vitamina B12)', 'A-00014', 1, 6, 2, '0.00', '2020-03-30 20:02:06', '2020-03-30 20:02:06'),
(19, 'Ácido Ascórbico (Vitamina C)', 'A-00015', 1, 6, 2, '0.00', '2020-03-30 20:02:27', '2020-03-30 20:02:27'),
(20, 'Acetato de Alfa tocoferol (Vitamina E)', 'A-00016', 1, 6, 2, '0.00', '2020-03-30 20:02:47', '2020-03-30 20:02:47'),
(21, 'Polinicotinato de Cromo al 12.35 %', 'A-00017', 1, 6, 2, '0.00', '2020-03-30 20:04:26', '2020-03-30 20:04:26'),
(22, 'Óxido de Magnesio ligero', 'A-00018', 1, 6, 2, '0.00', '2020-03-30 20:04:48', '2020-03-30 20:04:48'),
(23, 'Sulfato de Zinc Monohidratado', 'A-00019', 1, 6, 2, '0.00', '2020-03-30 20:05:06', '2020-03-30 20:05:06'),
(24, 'Levadura de Selenio al 0.2 %', 'A-00020', 1, 6, 2, '0.00', '2020-03-30 14:12:41', '2020-03-30 14:12:41'),
(25, 'Aceite de Soya', 'A-00021', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(26, 'Lauril Sulfato de Sodio', 'A-00022', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(27, 'Cera de Abejas', 'A-00023', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(28, 'Aceite Vegetal Hidrogenado (Manteca Vegetal)', 'A-00024', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(29, 'Lecitina de soya', 'A-00025', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(30, 'Butilhidroxitolueno (BHT)', 'A-00026', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(31, 'Butilhidroxianisol (BHA)', 'A-00027', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(32, 'Extracto arándano azul 35.8 % (Vaccinium myrtillus L)', 'A-00028', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(33, 'Aceite de pescado al 30 % con concentración 18/12 EPA y DHA', 'A-00029', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(34, 'Lactoferrina bovina', 'A-00030', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(35, 'Fosfato dibásico de calcio anhidro', 'A-00031', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(36, 'Colorante Azul No. 1', 'A-00032', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(37, 'Colorante Rojo No. 40', 'A-00033', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(38, 'Oxido Rojo Medio (16-CS-208)', 'A-00034', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(39, 'Oxido Amarillo Ocre (16-CS-201)', 'A-00035', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(40, 'Mononitrato de Tiamina (Vitamina B1)', 'A-00036', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(41, 'Riboflavina base (Vitamina B2)', 'A-00037', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(42, 'Nicotinamida', 'A-00038', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(43, 'Pantotenato de Calcio', 'A-00039', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(44, 'Colecalciferol (Vitamina D3)', 'A-00040', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(45, 'Ascorbato de Calcio', 'A-00041', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(46, 'Birtratato de Colina', 'A-00042', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(47, 'D-Biotina', 'A-00043', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(48, 'Fumarato Ferroso', 'A-00044', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(49, 'Glicinato de Magnesio', 'A-00045', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(50, 'Oxido de Zinc', 'A-00046', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(51, 'Sulfato de Cobre Pentahidratado', 'A-00047', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(52, 'Sulfato de Manganeso Monohidratado', 'A-00048', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(53, 'Cloruro de Potasio', 'A-00049', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(54, 'Molibdato de Sodio DIHIDRATADO', 'A-00050', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(55, 'Sulfato de Cobalto heptahidratado', 'A-00051', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(56, 'Quercetina Dihidratada 95 %', 'A-00052', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(57, 'Clorhidrato de Lisina', 'A-00053', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(58, 'Adenosina', 'A-00054', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(59, 'Ácido Linoleico', 'A-00055', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(60, 'Etilvainillina', 'A-00056', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(61, 'Ácido Ascórbico regular (Vitamina C)', 'A-00057', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(62, 'Aceite Mineral NF85', 'A-00058', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(63, 'Sulfato de cobre anhidro', 'A-00059', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(64, 'Mezcla Medix (Consignada)', 'A-00060', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(65, 'Negro  Oxido Azabache', 'A-00061', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(66, 'Niacina (Ácido nicotínico)', 'A-00062', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(67, 'Coenzima Q10 (Ubidecarenona)', 'A-00063', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(68, 'Luteína al 5 %', 'A-00064', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(69, 'Sulfato Ferroso anhidro', 'A-00065', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(70, 'Sulfato de Magnesio anhidro', 'A-00066', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(71, 'Sulfato de Zinc Anhidro', 'A-00067', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(72, 'Aceite de Argán (grado alimento)', 'A-00068', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(73, 'Yoduro de Potasio', 'A-00069', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(74, 'POLYSORB 85/70/00 ROQUETTE', 'A-00070', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(75, 'Alcohol etílico 96 °C', 'A-00071', 1, 6, 2, '0.00', '2020-03-30 14:49:26', '2020-03-30 14:49:26'),
(76, 'Aluminio impreso \"Generico Diabion FH\"', 'C-00002', 3, 6, 2, '0.00', '2020-03-30 20:50:21', '2020-03-30 20:50:21');

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
(6, 'MIligramos', 'mg', '2020-02-29 13:02:51', '2020-02-29 13:02:51');

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
(1, 'Angel Garcia', 'angelrodriguez@ucol.mx', '3121812759', 1, NULL, '$2y$10$OucV2LRaxsrMtXCP8qCtNOy4Q9hD24yx4/YafZBDjlIhGrh4Ak/pK', NULL, '2019-10-19 19:56:12', '2020-02-25 07:30:20'),
(2, 'Usuario Compras', 'compas@lindypharma.com', NULL, 4, NULL, '$2y$10$2Odxtv5sXCkY681iVCN32ulYpe6s6o18ZmcS37AlWIU5KSV.SfsqC', NULL, '2020-01-11 20:13:30', '2020-02-25 08:01:51'),
(3, 'Alejandro Saldaña', 'alejandro@lyndy.com', NULL, 1, NULL, '$2y$10$chA02ExRwrYpL8Hr6Lu1c.ohb2HtM5GYcG0YzRfk3agdP/qZSdieW', NULL, '2020-01-11 22:30:27', '2020-02-25 07:57:32'),
(4, 'Usuario almacenista', 'almacen@lindypharma.com', NULL, 3, NULL, '$2y$10$lvaryw5RcAEgFY/ZWRn5le2lFK8FZZmZgz2Ysf4y5KM7u4CdRVvvy', NULL, '2020-02-24 03:07:18', '2020-02-25 08:01:45'),
(5, 'Usuario ventas', 'ventas@lindypharma.com', NULL, 5, NULL, '$2y$10$HUxhD68hJwMT3UAvwyS0kONdTAZQxSNbu43e63wSm7XTboJHXGvyK', NULL, '2020-02-24 03:08:03', '2020-02-25 08:01:59'),
(6, 'Karla', 'karla@lindy.com', NULL, 2, NULL, '$2y$10$AVME96FW6X09nZ8ZO62Szef314.OHtkz0y9BJpaErL6.X/CFjUnJG', NULL, '2020-02-25 07:57:23', '2020-02-25 07:57:23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departure_items`
--
ALTER TABLE `departure_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `entrances`
--
ALTER TABLE `entrances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `entrance_comments`
--
ALTER TABLE `entrance_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `entrance_items`
--
ALTER TABLE `entrance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `entrance_supplies`
--
ALTER TABLE `entrance_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Logbooks`
--
ALTER TABLE `Logbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages_supplies`
--
ALTER TABLE `packages_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_recipes`
--
ALTER TABLE `product_recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_supplies`
--
ALTER TABLE `product_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipe_products`
--
ALTER TABLE `recipe_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipe_supplies`
--
ALTER TABLE `recipe_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `supply_measurements`
--
ALTER TABLE `supply_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supply_types`
--
ALTER TABLE `supply_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
6