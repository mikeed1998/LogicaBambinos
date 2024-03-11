-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2024 a las 23:39:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_bambinos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_persistentes`
--

CREATE TABLE `carrito_persistentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED DEFAULT NULL,
  `carrito` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carrito_persistentes`
--

INSERT INTO `carrito_persistentes` (`id`, `usuario`, `carrito`, `created_at`, `updated_at`) VALUES
(1, 2, '{\"1\":{\"product_name\":\"PRODUCTO 1\",\"photo\":\"20231229160623.png\",\"price\":\"146.50\",\"quantity\":1},\"2\":{\"product_name\":\"PRODUCTO 2\",\"photo\":\"20231229160623.png\",\"price\":\"240.00\",\"quantity\":1},\"3\":{\"product_name\":\"dssssss\",\"photo\":\"v3Fc5VzAtmqhP8FKBoGN1AlKjYqFqz.jpg\",\"price\":\"150.50\",\"quantity\":1}}', '2024-03-07 23:32:19', '2024-03-12 03:36:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `icono`, `created_at`, `updated_at`) VALUES
(1, 'CATEGORIA 1', NULL, NULL, NULL),
(2, 'CATEGORIA 2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `destinatario` varchar(255) DEFAULT NULL,
  `destinatario2` varchar(255) DEFAULT NULL,
  `remitente` varchar(255) DEFAULT NULL,
  `remitentepass` varchar(255) DEFAULT NULL,
  `remitentehost` varchar(255) DEFAULT NULL,
  `remitenteport` varchar(255) DEFAULT NULL,
  `remitenteseguridad` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `whatsapp2` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `envio` varchar(255) DEFAULT NULL,
  `envioglobal` varchar(255) DEFAULT NULL,
  `iva` varchar(255) DEFAULT NULL,
  `incremento` varchar(255) DEFAULT NULL,
  `mapa` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuracions`
--

INSERT INTO `configuracions` (`id`, `titulo`, `descripcion`, `destinatario`, `destinatario2`, `remitente`, `remitentepass`, `remitentehost`, `remitenteport`, `remitenteseguridad`, `telefono`, `whatsapp`, `whatsapp2`, `facebook`, `instagram`, `youtube`, `linkedin`, `envio`, `envioglobal`, `iva`, `incremento`, `mapa`, `direccion`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'mikeed1998@gmail.com', 'michaelwozial@gmail.com', 'ew', 'ew', 'ew', 'ew', 'ssl', '3243r3dsds', 'asa123', 'dsds', 'fgf', 'yrt', 'yrt', NULL, NULL, NULL, NULL, NULL, 'dsss', 'dsds', NULL, '2024-03-07 01:02:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_envios`
--

CREATE TABLE `datos_envios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `RFC` varchar(255) DEFAULT NULL,
  `calle` text DEFAULT NULL,
  `numero_exterior` text DEFAULT NULL,
  `numero_interior` text DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(255) DEFAULT NULL,
  `aux` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios`
--

CREATE TABLE `domicilios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED DEFAULT NULL,
  `alias` text DEFAULT NULL,
  `calle` text DEFAULT NULL,
  `numero_exterior` text DEFAULT NULL,
  `numero_interior` text DEFAULT NULL,
  `pais` text DEFAULT NULL,
  `estado` text DEFAULT NULL,
  `municipio` text DEFAULT NULL,
  `colonia` text DEFAULT NULL,
  `codigo_postal` text DEFAULT NULL,
  `predeterminado` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `domicilios`
--

INSERT INTO `domicilios` (`id`, `usuario`, `alias`, `calle`, `numero_exterior`, `numero_interior`, `pais`, `estado`, `municipio`, `colonia`, `codigo_postal`, `predeterminado`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-07 03:23:07', '2024-03-07 03:23:07'),
(2, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-07 03:24:23', '2024-03-07 03:24:23'),
(3, 2, 'Frente a un parque', 'Avenida siempre viva2', '3', '4', 'México', 'Jalisco', 'Guadalajara', 'bonita', '32213', NULL, NULL, '2024-03-11 22:32:07'),
(4, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-07 03:53:49', '2024-03-07 03:53:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `elemento` varchar(255) NOT NULL,
  `texto` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `contenido` tinyint(1) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `orden` int(11) NOT NULL DEFAULT 666,
  `seccion` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`id`, `elemento`, `texto`, `imagen`, `url`, `contenido`, `activo`, `orden`, `seccion`, `created_at`, `updated_at`) VALUES
(4, 'aux', NULL, NULL, NULL, 0, 1, 666, 7, NULL, NULL),
(5, 'aux', NULL, NULL, NULL, 0, 1, 666, 8, NULL, NULL),
(6, 'aux', NULL, NULL, NULL, 0, 1, 666, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pregunta` varchar(255) DEFAULT NULL,
  `respuesta` text DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 666,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `faqs`
--

INSERT INTO `faqs` (`id`, `pregunta`, `respuesta`, `orden`, `created_at`, `updated_at`) VALUES
(1, 'fdxs', 'dsfffffff', 666, NULL, NULL),
(2, NULL, NULL, 666, '2024-03-07 00:09:09', '2024-03-07 00:09:09'),
(3, 'dssss', 'dsdsdsdsdsds', 666, '2024-03-07 00:10:02', '2024-03-07 00:10:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_clientes`
--

CREATE TABLE `lista_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED DEFAULT NULL,
  `vendedor` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2024_02_21_000001_create_categorias_table', 1),
(5, '2024_02_21_000002_create_subcategorias_table', 1),
(6, '2024_02_21_000003_create_productos_table', 1),
(7, '2024_02_21_000004_create_producto_caracteristicas_table', 1),
(8, '2024_02_21_000005_create_producto_galerias_table', 1),
(9, '2024_02_21_000006_create_domicilios_table', 1),
(10, '2024_02_21_000007_create_lista_clientes_table', 1),
(11, '2024_02_21_000008_create_datos_envios_table', 1),
(12, '2024_02_21_000009_create_configuracions_table', 1),
(13, '2024_02_21_000010_create_seccions_table', 1),
(14, '2024_02_21_000011_create_elementos_table', 1),
(15, '2024_02_21_000012_create_pedidos_table', 1),
(16, '2024_02_21_000013_create_pedido_detalles_table', 1),
(17, '2024_03_06_155946_create_politicas_table', 2),
(18, '2024_03_06_160504_create_faqs_table', 3),
(19, '2024_03_07_164522_create_carrito_persistentes_table', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domicilio` bigint(20) UNSIGNED DEFAULT NULL,
  `usuario` bigint(20) UNSIGNED DEFAULT NULL,
  `vendedor` bigint(20) UNSIGNED DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 0,
  `guia` varchar(255) DEFAULT NULL,
  `linkguia` text DEFAULT NULL,
  `factura` text DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `importe` decimal(9,2) NOT NULL DEFAULT 0.00,
  `iva` decimal(9,2) NOT NULL DEFAULT 0.00,
  `total` decimal(9,2) NOT NULL DEFAULT 0.00,
  `envio` decimal(9,2) NOT NULL DEFAULT 0.00,
  `comprobante` text DEFAULT NULL,
  `cupon` text DEFAULT NULL,
  `cancelado` int(11) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `envia_resp` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `domicilio`, `usuario`, `vendedor`, `uid`, `estatus`, `guia`, `linkguia`, `factura`, `cantidad`, `importe`, `iva`, `total`, `envio`, `comprobante`, `cupon`, `cancelado`, `data`, `envia_resp`, `created_at`, `updated_at`) VALUES
(8, 3, 2, NULL, 'PED2403110001', 2, '', '', '', NULL, 1220.50, 195.28, 1515.78, 100.00, '', '', 0, '{\"1\":{\"product_name\":\"PRODUCTO 1\",\"photo\":\"20231229160623.png\",\"price\":\"146.50\",\"quantity\":\"3\"},\"2\":{\"product_name\":\"PRODUCTO 2\",\"photo\":\"20231229160623.png\",\"price\":\"240.00\",\"quantity\":\"2\"},\"3\":{\"product_name\":\"dssssss\",\"photo\":\"v3Fc5VzAtmqhP8FKBoGN1AlKjYqFqz.jpg\",\"price\":\"150.50\",\"quantity\":\"2\"}}', NULL, '2024-03-12 03:19:29', '2024-03-12 03:19:29'),
(9, 3, 2, NULL, 'PED2403110002', 2, '', '', '', NULL, 537.00, 85.92, 722.92, 100.00, '', '', 0, '{\"1\":{\"product_name\":\"PRODUCTO 1\",\"photo\":\"20231229160623.png\",\"price\":\"146.50\",\"quantity\":1},\"2\":{\"product_name\":\"PRODUCTO 2\",\"photo\":\"20231229160623.png\",\"price\":\"240.00\",\"quantity\":1},\"3\":{\"product_name\":\"dssssss\",\"photo\":\"v3Fc5VzAtmqhP8FKBoGN1AlKjYqFqz.jpg\",\"price\":\"150.50\",\"quantity\":1}}', NULL, '2024-03-12 03:26:22', '2024-03-12 03:26:22'),
(10, 3, 2, NULL, 'PED2403110003', 2, '', '', '', NULL, 683.50, 109.36, 892.86, 100.00, '', '', 0, '{\"1\":{\"product_name\":\"PRODUCTO 1\",\"photo\":\"20231229160623.png\",\"price\":\"146.50\",\"quantity\":2},\"2\":{\"product_name\":\"PRODUCTO 2\",\"photo\":\"20231229160623.png\",\"price\":\"240.00\",\"quantity\":1},\"3\":{\"product_name\":\"dssssss\",\"photo\":\"v3Fc5VzAtmqhP8FKBoGN1AlKjYqFqz.jpg\",\"price\":\"150.50\",\"quantity\":1}}', NULL, '2024-03-12 03:35:11', '2024-03-12 03:35:11'),
(11, 3, 2, NULL, 'PED2403110004', 2, '', '', '', NULL, 537.00, 85.92, 722.92, 100.00, '', '', 0, '{\"1\":{\"product_name\":\"PRODUCTO 1\",\"photo\":\"20231229160623.png\",\"price\":\"146.50\",\"quantity\":1},\"2\":{\"product_name\":\"PRODUCTO 2\",\"photo\":\"20231229160623.png\",\"price\":\"240.00\",\"quantity\":1},\"3\":{\"product_name\":\"dssssss\",\"photo\":\"v3Fc5VzAtmqhP8FKBoGN1AlKjYqFqz.jpg\",\"price\":\"150.50\",\"quantity\":1}}', NULL, '2024-03-12 03:38:20', '2024-03-12 03:38:20'),
(12, 3, 2, NULL, 'PED2403110005', 2, '', '', '', NULL, 537.00, 85.92, 722.92, 100.00, '', '', 0, '{\"1\":{\"product_name\":\"PRODUCTO 1\",\"photo\":\"20231229160623.png\",\"price\":\"146.50\",\"quantity\":1},\"2\":{\"product_name\":\"PRODUCTO 2\",\"photo\":\"20231229160623.png\",\"price\":\"240.00\",\"quantity\":1},\"3\":{\"product_name\":\"dssssss\",\"photo\":\"v3Fc5VzAtmqhP8FKBoGN1AlKjYqFqz.jpg\",\"price\":\"150.50\",\"quantity\":1}}', NULL, '2024-03-12 03:38:20', '2024-03-12 03:38:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalles`
--

CREATE TABLE `pedido_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politicas`
--

CREATE TABLE `politicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `archivo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `politicas`
--

INSERT INTO `politicas` (`id`, `titulo`, `descripcion`, `archivo`, `created_at`, `updated_at`) VALUES
(1, 'Aviso de Privacidad', '<p>sdssa</p>', NULL, NULL, '2024-03-07 02:45:40'),
(2, 'Métodos de Pago', '<p>saddddsddddddd</p>', NULL, NULL, '2024-03-07 02:48:36'),
(3, 'Devoluciones', 'hg5444444', NULL, NULL, '2024-03-07 01:01:12'),
(4, 'Términos y Condiciones', 'fd', NULL, NULL, '2024-03-07 01:01:06'),
(5, 'Garantías', 'ytttttt', NULL, NULL, '2024-03-07 01:01:20'),
(6, 'Políticas de Envío', 'yttttt', NULL, NULL, '2024-03-07 01:01:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria` bigint(20) UNSIGNED DEFAULT NULL,
  `subcategoria` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `frente` varchar(255) DEFAULT NULL,
  `fondo` varchar(255) DEFAULT NULL,
  `alto` varchar(255) DEFAULT NULL,
  `portada` text DEFAULT NULL,
  `precio` decimal(6,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0,
  `promocion` decimal(6,2) NOT NULL DEFAULT 0.00,
  `anticipo` decimal(6,2) NOT NULL DEFAULT 0.00,
  `activo` int(11) NOT NULL DEFAULT 1,
  `visible` int(11) NOT NULL DEFAULT 1,
  `orden` int(11) DEFAULT NULL,
  `inicio` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria`, `subcategoria`, `nombre`, `descripcion`, `frente`, `fondo`, `alto`, `portada`, `precio`, `stock`, `promocion`, `anticipo`, `activo`, `visible`, `orden`, `inicio`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'PRODUCTO 1', 'A common form of Lorem ipsum reads: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n', '3M', '3M', '3M', '20231229160623.png', 146.50, 2, 0.00, 0.00, 1, 1, NULL, 0, NULL, '2024-03-11 21:40:06'),
(2, 2, NULL, 'PRODUCTO 2', 'A common form of Lorem ipsum reads: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n', '4M', '10M', '5M', '20231229160623.png', 240.00, 0, 0.00, 0.00, 1, 1, NULL, 0, NULL, '2024-03-11 21:39:50'),
(3, 1, NULL, 'dssssss', 'dsssss', 'er', 'er', NULL, 'v3Fc5VzAtmqhP8FKBoGN1AlKjYqFqz.jpg', 150.50, 32, 0.00, 0.00, 1, 1, NULL, 0, '2024-03-09 03:15:28', '2024-03-11 21:39:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_caracteristicas`
--

CREATE TABLE `producto_caracteristicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto` bigint(20) UNSIGNED DEFAULT NULL,
  `caracteristica` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto_caracteristicas`
--

INSERT INTO `producto_caracteristicas` (`id`, `producto`, `caracteristica`, `created_at`, `updated_at`) VALUES
(1, 3, 'dfs', '2024-03-09 03:15:29', '2024-03-09 03:15:29'),
(2, 3, 'dsds', '2024-03-09 03:15:29', '2024-03-09 03:15:29'),
(3, 3, 'gf', '2024-03-09 03:15:29', '2024-03-09 03:15:29'),
(4, 3, 'gf', '2024-03-09 03:15:29', '2024-03-09 03:15:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_galerias`
--

CREATE TABLE `producto_galerias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto` bigint(20) UNSIGNED DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto_galerias`
--

INSERT INTO `producto_galerias` (`id`, `producto`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 1, 'eZDYEDrA6869Xo2tTTv4yd4jxk9Lt4.png', '2024-03-09 04:45:18', '2024-03-09 04:45:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccions`
--

CREATE TABLE `seccions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seccion` varchar(255) NOT NULL,
  `portada` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccions`
--

INSERT INTO `seccions` (`id`, `seccion`, `portada`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'configuracion', 'bi bi-gear-fill', 'configuracion', NULL, NULL),
(5, 'politicas', 'bi bi-shield-fill-exclamation', 'politicas', NULL, NULL),
(6, 'faqs', 'bi bi-question-circle-fill', 'faqs', NULL, NULL),
(7, 'home', 'bi bi-house-door-fill', 'home', NULL, NULL),
(8, 'nosotros', 'bi bi-postcard-fill', 'nosotros', NULL, NULL),
(9, 'contacto', 'bi bi-send-fill', 'contacto', NULL, NULL),
(10, 'catalogo', 'bi bi-shop', 'catalogo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria` bigint(20) UNSIGNED DEFAULT NULL,
  `subcategoria` varchar(255) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `imagen` text DEFAULT 'default.png',
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `RFC` varchar(255) DEFAULT NULL,
  `asesorado` varchar(255) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `email_verified_at`, `password`, `imagen`, `role_as`, `fecha_nacimiento`, `telefono`, `RFC`, `asesorado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador - Brincolines Bambinos', NULL, 'admin@wozial.com', NULL, '$2y$10$eOwa1YG3Ratd/JupboUtGOB44Wxn2BPSNBgdKcZpUrDwTas5e8vT6', 'default.png', 1, NULL, NULL, NULL, '0', NULL, '2024-03-05 22:37:43', '2024-03-05 22:37:43'),
(2, 'Michael Eduardo', 'Sandoval Pérez', 'mich@wozial.com', NULL, '$2y$10$6ro8wMl2ZGT5fJIf3y5JbOKACf.c0OcMqZzpyW8/iGQ4QT5fHDWLW', '8dUvI3geonMigTEXdQM7VKALrg8s0d.png', 0, '1998-07-01', '3322932239', 'SAPM980701JU7', '0', NULL, '2024-03-05 22:39:50', '2024-03-07 04:44:32'),
(3, 'Asesor Marketing', 'apellido', 'asesor@wozial.com', NULL, '$2y$10$BtQvtILrrqndF7v3gHn33.CNh4Up3AW0vkSn5.2Ls6jCsZZo9YFxO', 'iZkuExxNQQGm0DVIsmnmhZYB6rQgwi.png', 2, '2024-03-20', '232323233', '232we', '0', NULL, '2024-03-05 22:40:29', '2024-03-07 20:54:12'),
(4, 'sasasasasasasa', NULL, 'test1@gmail.com', NULL, '$2y$10$UioVQYqqOLemf/XubB3kreRb3bKyRT8W//lvswD4D3OoSdG4/aGHm', 'default.png', 0, NULL, NULL, NULL, '0', NULL, '2024-03-07 03:21:58', '2024-03-07 03:21:58'),
(5, 'sasasasasasasa', NULL, 'testss@fdsd.com', NULL, '$2y$10$iTMxky7bRdcG8IxOZccEL.PAgBEd9NhA9Cmpmc1F.Dmq9xrvRP6mK', 'default.png', 0, NULL, NULL, NULL, '0', NULL, '2024-03-07 03:23:06', '2024-03-07 03:23:06'),
(6, 'sasasasasasasa', NULL, 'correo@dsds.com', NULL, '$2y$10$gwJSPKFKoW4EPt7nWZiUMOWVu6JucwDhaR3AUK5zZHh5qXgYbr3l2', 'default.png', 0, NULL, NULL, NULL, '0', NULL, '2024-03-07 03:24:23', '2024-03-07 03:24:23'),
(7, 'vendee', NULL, 'qwqw@dsd.com', NULL, '$2y$10$jAU9A0.t688mbtR0xdcy2OcJiXorBy38v8wcTeFouy6pYwrdWAMPa', 'default.png', 2, NULL, NULL, NULL, '0', NULL, '2024-03-07 03:47:22', '2024-03-07 03:47:22'),
(8, 'sddddd', NULL, 'airg2@gmail.com', NULL, '$2y$10$h2O0luKbDV06cBxrTd/F4uL71bYNq7IKn4T82SDI/gjXKmdQBgCv.', 'default.png', 0, NULL, NULL, NULL, '0', NULL, '2024-03-07 03:49:32', '2024-03-07 03:49:32'),
(9, 'gfddddddd', NULL, 'franciscovll54@gmail.com', NULL, '$2y$10$yGy6QZjQAhPBgmNtLNQv4O5sV/saATwATcWuI9hfMygEdBqUbpR/e', 'default.png', 0, NULL, NULL, NULL, '0', NULL, '2024-03-07 03:53:49', '2024-03-07 03:53:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_persistentes`
--
ALTER TABLE `carrito_persistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrito_persistentes_usuario_foreign` (`usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_envios`
--
ALTER TABLE `datos_envios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domicilios_usuario_foreign` (`usuario`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elementos_seccion_foreign` (`seccion`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_clientes`
--
ALTER TABLE `lista_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lista_clientes_usuario_foreign` (`usuario`),
  ADD KEY `lista_clientes_vendedor_foreign` (`vendedor`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_domicilio_foreign` (`domicilio`),
  ADD KEY `pedidos_usuario_foreign` (`usuario`),
  ADD KEY `pedidos_vendedor_foreign` (`vendedor`);

--
-- Indices de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `politicas`
--
ALTER TABLE `politicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_categoria_foreign` (`categoria`),
  ADD KEY `productos_subcategoria_foreign` (`subcategoria`);

--
-- Indices de la tabla `producto_caracteristicas`
--
ALTER TABLE `producto_caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_caracteristicas_producto_foreign` (`producto`);

--
-- Indices de la tabla `producto_galerias`
--
ALTER TABLE `producto_galerias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_galerias_producto_foreign` (`producto`);

--
-- Indices de la tabla `seccions`
--
ALTER TABLE `seccions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seccions_slug_unique` (`slug`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategorias_categoria_foreign` (`categoria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_persistentes`
--
ALTER TABLE `carrito_persistentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `datos_envios`
--
ALTER TABLE `datos_envios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lista_clientes`
--
ALTER TABLE `lista_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `politicas`
--
ALTER TABLE `politicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto_caracteristicas`
--
ALTER TABLE `producto_caracteristicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto_galerias`
--
ALTER TABLE `producto_galerias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `seccions`
--
ALTER TABLE `seccions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_persistentes`
--
ALTER TABLE `carrito_persistentes`
  ADD CONSTRAINT `carrito_persistentes_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `domicilios`
--
ALTER TABLE `domicilios`
  ADD CONSTRAINT `domicilios_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_seccion_foreign` FOREIGN KEY (`seccion`) REFERENCES `seccions` (`id`);

--
-- Filtros para la tabla `lista_clientes`
--
ALTER TABLE `lista_clientes`
  ADD CONSTRAINT `lista_clientes_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lista_clientes_vendedor_foreign` FOREIGN KEY (`vendedor`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_domicilio_foreign` FOREIGN KEY (`domicilio`) REFERENCES `domicilios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_vendedor_foreign` FOREIGN KEY (`vendedor`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_categoria_foreign` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_subcategoria_foreign` FOREIGN KEY (`subcategoria`) REFERENCES `subcategorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_caracteristicas`
--
ALTER TABLE `producto_caracteristicas`
  ADD CONSTRAINT `producto_caracteristicas_producto_foreign` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_galerias`
--
ALTER TABLE `producto_galerias`
  ADD CONSTRAINT `producto_galerias_producto_foreign` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_categoria_foreign` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
