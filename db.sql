-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2020 at 10:14 PM
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
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `line` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departures`
--

INSERT INTO `departures` (`id`, `order_number`, `product_id`, `quantity`, `lot`, `line`, `created_by`, `client_id`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'OT-0001', 1, 350, 'ABC-123', 'Linea 2', 1, 2, 'Creada', 1, '2020-03-04 04:46:58', '2020-03-04 04:46:58'),
(2, 'OT-0001', 1, 350, 'ABC-123', 'Linea 2', 1, 2, 'Creada', 2, '2020-03-04 04:46:59', '2020-03-04 04:46:59');

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
(4, 2, 8, '2.00', '5.90', NULL);

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrances`
--

INSERT INTO `entrances` (`id`, `user_id`, `cfdi_id`, `supplier_id`, `status`, `requisition`, `department`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Creada', 'sadsaasdsada', 'asdas', '2020-03-20 01:41:21', '2020-03-20 01:41:21'),
(2, 1, 1, 1, 'Creada', 'sadsaasdsada', 'asdas', '2020-03-20 01:41:50', '2020-03-20 01:41:50'),
(3, 1, 1, 2, 'Aprobada', '0024', 'Operaciones', '2020-03-20 21:39:15', '2020-03-20 21:39:15');

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
(2, 3, 'Entregar despues de las 17:00');

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
(2, 3, 4, '100.0000', '120.00', NULL, NULL, '2020-03-20 21:39:15', '2020-03-20 21:39:15');

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
(29, 2, 'Insumo Modificado', 'El insumo con el código \"A-00001\" ha sido modificado', 'fas fa-capsules', 1, '2020-03-20 22:08:21', '2020-03-20 22:08:21');

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
  `caps_long` int(11) NOT NULL,
  `caps_circ` int(11) NOT NULL,
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
(3, '20OBE-01', 'Oblongos', '2020-02-23 04:25:07', '2020-02-23 04:25:07', '20.00', '26.00', '10.00', 8, 32, '307.03', 'LACRIVIT, VITAGERUM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `presentation` varchar(150) NOT NULL,
  `date_expire` date NOT NULL,
  `lot` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `product_id`, `client_id`, `quantity`, `presentation`, `date_expire`, `lot`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdfdf', 1, 1, '23123.00', 'sadadas', '2020-03-28', 'sadasd', 1, '2020-03-20 20:28:07', '2020-03-20 20:28:07'),
(2, 'sdfsdfdf', 1, 1, '23123.00', 'sadadas', '2020-03-28', 'sadasd', 1, '2020-03-20 20:29:05', '2020-03-20 20:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `package_supplies`
--

CREATE TABLE `package_supplies` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `excess` decimal(3,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package_supplies`
--

INSERT INTO `package_supplies` (`id`, `package_id`, `supply_id`, `quantity`, `excess`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '11.0000', '2.00', '2020-03-20 20:28:07', '2020-03-20 20:28:07'),
(2, 2, 4, '11.0000', '2.00', '2020-03-20 20:29:05', '2020-03-20 20:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mold_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `stock`, `mold_id`, `created_at`, `updated_at`) VALUES
(1, 'GPM0004', 'VITAGERUM, Vitaminas y Minerales.', '0.00', 2, '2020-01-26 04:55:45', '2020-01-26 05:25:46');

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
  `phone` varchar(18) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact`, `address`, `neight`, `city`, `state`, `zip`, `rfc`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Stefanny Jacqueline Velazquez Hernández', 'ANGEL DAVID GARCÍA RODRIGUEZ', 'Padre Xavier Scheifler 835, Int 118\r\n				', 'Parques del Bosque', 'San Pedro Tlaquepaque', 'Jalisco', '25609', 'VEHS890726BH5', '+52 1 312 1812759', 'angelrodriguez@ucol.mx', '2020-03-01 01:05:15', '2020-03-06 04:28:09'),
(2, 'Alejandro Saldaña', 'Karla Becerra', 'Av San Jose 1210', 'Los  Cajetes', 'Zapopan', 'Jalisco', '45234', NULL, '3315432480', 'angelrodriguez@ucol.mx', '2020-03-20 21:37:06', '2020-03-20 21:37:06');

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
(1, 'Agua Purificada Nivel 1', 'A-00001', 1, 3, 4, '1000.00', '2020-01-16 02:50:46', '2020-03-20 22:08:21'),
(2, 'Gelatina LB 175 B', 'A-00002', 1, 1, 2, '0.00', '2020-01-16 03:03:55', '2020-01-16 03:03:55'),
(3, 'Glicerol', 'A-00003', 1, 3, 4, '0.00', '2020-01-16 03:05:00', '2020-01-16 03:05:00'),
(4, 'Metilparabeno sódico (Nipagin)', 'A-00004', 1, 3, 4, '0.00', '2020-01-16 03:07:02', '2020-01-16 03:07:02'),
(5, 'Propilparabeno sódico (Nipazol)', 'A-00005', 1, 3, 4, '0.00', '2020-01-16 03:07:21', '2020-01-16 03:07:21'),
(6, 'PVDC /PVC 60 g/cm CRISTAL calibre y medidas', 'B-00001', 2, 3, 4, '0.00', '2020-01-16 03:08:00', '2020-01-16 03:08:00'),
(7, 'Frasco PEAD bco 100 ml R-38', 'B-00002', 2, 3, 4, '0.00', '2020-01-16 03:08:19', '2020-01-16 03:08:19'),
(8, 'Etiqueta de Aceite de Krill F. Similares', 'C-00001', 3, 5, 5, '0.00', '2020-01-16 03:08:42', '2020-01-16 03:08:42'),
(9, 'Caja colectiva doble corrugado de 50 x 50 x50', 'D-00001', 4, 5, 5, '0.00', '2020-01-16 03:09:04', '2020-01-16 03:09:04'),
(10, 'Bióxido de Titanio 19-380-C', 'A-00006', 1, 3, 4, '0.00', '2020-01-16 03:09:36', '2020-01-16 03:09:36'),
(11, 'Colorante óxido negro azabache', 'A-00007', 1, 1, 2, '0.00', '2020-01-16 03:10:45', '2020-01-16 03:10:45'),
(12, 'Colorante Rojo No. 6', 'A-00008', 1, 6, 2, '0.00', '2020-02-29 19:01:18', '2020-02-29 19:03:25');

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
(5, 'Pieza', 'Pieza', '2020-01-11 00:00:00', '2020-01-11 00:00:00'),
(6, 'MIligramos', 'ml', '2020-02-29 13:02:51', '2020-02-29 13:02:51');

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
-- Indexes for table `package_supplies`
--
ALTER TABLE `package_supplies`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entrances`
--
ALTER TABLE `entrances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `entrance_comments`
--
ALTER TABLE `entrance_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entrance_items`
--
ALTER TABLE `entrance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entrance_supplies`
--
ALTER TABLE `entrance_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Logbooks`
--
ALTER TABLE `Logbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `logbook_types`
--
ALTER TABLE `logbook_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `molds`
--
ALTER TABLE `molds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_supplies`
--
ALTER TABLE `package_supplies`
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
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
