-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2024 a las 00:09:54
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
-- Base de datos: `app_ahorros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociaciones_tarjetas`
--

CREATE TABLE `asociaciones_tarjetas` (
  `id` int(11) NOT NULL,
  `asociacion` varchar(45) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `asociaciones_tarjetas`
--

INSERT INTO `asociaciones_tarjetas` (`id`, `asociacion`, `updated_at`, `created_at`) VALUES
(1, 'VISA', NULL, NULL),
(2, 'MASTERCARD', NULL, NULL),
(3, 'AMERICAN EXPRESS', NULL, NULL),
(4, 'DISCOVER NETWORK', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`, `updated_at`, `created_at`) VALUES
(1, 'ACTIVO', NULL, NULL),
(2, 'INACTIVO', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_y_ingresos`
--

CREATE TABLE `gastos_y_ingresos` (
  `id` int(11) NOT NULL,
  `detalle` varchar(45) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` varchar(45) NOT NULL,
  `id_tipo_periodo` int(11) NOT NULL,
  `id_tipo_dinero` int(11) NOT NULL,
  `id_tarjeta` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `gastos_y_ingresos`
--

INSERT INTO `gastos_y_ingresos` (`id`, `detalle`, `valor`, `fecha`, `id_tipo_periodo`, `id_tipo_dinero`, `id_tarjeta`, `id_estado`, `updated_at`, `created_at`) VALUES
(1, 'COMPRA DE SALCHIPAPA', 7000, '2024-05-15', 1, 2, 3, 1, '2024-05-16 08:10:37', '2024-05-16 08:10:37'),
(2, 'SUELTO', 2000000, '2024-05-17', 2, 1, 3, 2, '2024-05-17 23:57:16', '2024-05-17 21:21:02'),
(3, 'COMPRA DE LOCION', 10000, '2024-05-16', 1, 2, 3, 1, '2024-05-17 21:21:24', '2024-05-17 21:21:24'),
(4, 'VIAJE', 5000000, '2024-05-18', 1, 2, 3, 1, '2024-05-17 22:25:06', '2024-05-17 22:25:06'),
(5, 'ALMUERZO ULTIMO DIA', 12000, '2024-05-17', 1, 2, 3, 1, '2024-05-17 23:50:54', '2024-05-17 23:50:54'),
(6, 'CHANCE', 10000000, '2024-05-17', 1, 1, 6, 1, '2024-05-17 23:52:30', '2024-05-17 23:52:30'),
(7, 'SUELDO', 1350000, '2024-05-30', 2, 1, 8, 1, '2024-05-18 00:01:42', '2024-05-18 00:01:42'),
(8, 'SUELDO', 1300000, '2024-05-30', 2, 1, 9, 1, '2024-05-18 00:05:05', '2024-05-18 00:05:05'),
(9, 'GASOLINA', 40000, '2024-05-30', 2, 2, 9, 1, '2024-05-18 00:07:48', '2024-05-18 00:07:48'),
(10, 'DEUDA', 300000, '2024-05-17', 1, 2, 9, 1, '2024-05-18 00:08:24', '2024-05-18 00:08:24'),
(11, 'PAGO DESARROLLO', 100000, '2024-05-17', 1, 2, 9, 1, '2024-05-18 00:09:24', '2024-05-18 00:09:24'),
(12, 'DATOS CELULAR', 40000, '2024-05-16', 2, 2, 9, 1, '2024-05-18 00:10:01', '2024-05-18 00:10:01'),
(13, 'GASTO', 40000, '2024-05-23', 1, 2, 9, 1, '2024-05-18 00:10:41', '2024-05-18 00:10:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metas_ahorros`
--

CREATE TABLE `metas_ahorros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `fecha_inicio` varchar(45) NOT NULL,
  `fecha_final` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `metas_ahorros`
--

INSERT INTO `metas_ahorros` (`id`, `nombre`, `descripcion`, `valor`, `fecha_inicio`, `fecha_final`, `id_usuario`, `id_estado`, `updated_at`, `created_at`) VALUES
(1, 'MOTO', 'MOTO PARA DOMICILIOS', 2000000, '2024-05-02', '2024-05-22', 1, 2, '2024-05-16 09:06:18', '2024-05-16 08:45:18'),
(2, 'CARTAGENA', 'VIEAJE ALL INCLUSIVE', 2000000, '2024-05-16', '2024-08-02', 1, 2, '2024-05-17 18:34:16', '2024-05-16 09:07:36'),
(3, 'VIAJE CARTAGENA', 'ALL INCLUSIVE', 5000000, '2024-05-15', '2025-03-14', 1, 2, '2024-05-18 00:11:26', '2024-05-17 23:54:19'),
(4, 'UNIVERSIDAD', 'SEMESTRE', 2000000, '2024-02-01', '2024-05-17', 1, 1, '2024-05-18 00:12:32', '2024-05-18 00:12:32');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('mcC6wxxa0Qtvcevmx7jTGtPxsdFCr2qTXQ9iapmW', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidktzR1lSbUhNWEZIdGFrdlhnNnEyM2NFbXVEemgzejNrSGtXMDRKbCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MzoiaHR0cDovL2xvY2FsaG9zdC9wcm95ZWN0b19sZW9uYXJkby9hcHBfYWhvcnJvcy9pbmljaW8iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL2xvY2FsaG9zdC9wcm95ZWN0b19sZW9uYXJkby9hcHBfYWhvcnJvcy9pbmljaW8vdGFyamV0YXMvY3JlYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1715982576);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id` int(11) NOT NULL,
  `numero` varchar(18) NOT NULL,
  `id_tipo_tarjeta` int(11) NOT NULL,
  `id_asociacion_tarjeta` int(11) NOT NULL,
  `cuota_manejo` int(11) DEFAULT NULL,
  `fecha_cuota_manejo` varchar(45) DEFAULT NULL,
  `nombre_banco` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`id`, `numero`, `id_tipo_tarjeta`, `id_asociacion_tarjeta`, `cuota_manejo`, `fecha_cuota_manejo`, `nombre_banco`, `id_usuario`, `id_estado`, `updated_at`, `created_at`) VALUES
(3, '1421421412', 2, 1, 40000, '2024-05-07', 'BANCOLOMBIA', 1, 2, '2024-05-18 00:00:27', '2024-05-16 06:42:31'),
(4, '24214123123', 1, 3, NULL, NULL, 'DAVIVIENDA', 1, 2, '2024-05-16 07:31:58', '2024-05-16 07:24:47'),
(5, '421421412', 2, 1, NULL, NULL, 'BANCOLOMBIA', 1, 2, '2024-05-16 07:31:56', '2024-05-16 07:30:29'),
(6, '1412412414', 1, 2, 20000, '2024-05-18', 'DAVIVIENDA', 1, 2, '2024-05-18 00:00:25', '2024-05-17 21:31:15'),
(7, '96894659', 1, 1, 20000, '2024-05-17', 'BANCO BOGOTA', 1, 2, '2024-05-17 23:49:39', '2024-05-17 23:48:14'),
(8, '665954916', 2, 2, NULL, NULL, 'BANCOLOMBIA', 1, 2, '2024-05-18 00:03:23', '2024-05-18 00:01:18'),
(9, '54253532', 2, 1, NULL, NULL, 'BANCOLOMBIA', 1, 1, '2024-05-18 00:04:22', '2024-05-18 00:04:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_dineros`
--

CREATE TABLE `tipos_dineros` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipos_dineros`
--

INSERT INTO `tipos_dineros` (`id`, `tipo`, `updated_at`, `created_at`) VALUES
(1, 'INGRESO', NULL, NULL),
(2, 'GASTO', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_periodos`
--

CREATE TABLE `tipos_periodos` (
  `id` int(11) NOT NULL,
  `periodo` varchar(45) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipos_periodos`
--

INSERT INTO `tipos_periodos` (`id`, `periodo`, `updated_at`, `created_at`) VALUES
(1, 'UNA VEZ', NULL, NULL),
(2, 'MENSUALMENTE', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_tarjetas`
--

CREATE TABLE `tipos_tarjetas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipos_tarjetas`
--

INSERT INTO `tipos_tarjetas` (`id`, `tipo`, `updated_at`, `created_at`) VALUES
(1, 'TARJETA DE CREDITO', NULL, NULL),
(2, 'TARJETA DEBITO', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `numero_de_identificacion` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombres`, `apellidos`, `numero_de_identificacion`, `email`, `password`, `updated_at`, `created_at`) VALUES
(1, 'Jhan Carlos', 'Cordoba Quiñonez', '1111663045', 'jccq12@gmail.com', '$2y$12$DKRiKSmuuyHOGG0HsvIPCuHA3tfRw9HBSVwsT86qrNFS.pnLU3eR2', '2024-05-15 08:38:55', '2024-05-15 08:38:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asociaciones_tarjetas`
--
ALTER TABLE `asociaciones_tarjetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gastos_y_ingresos`
--
ALTER TABLE `gastos_y_ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metas_ahorros`
--
ALTER TABLE `metas_ahorros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_dineros`
--
ALTER TABLE `tipos_dineros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_periodos`
--
ALTER TABLE `tipos_periodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_tarjetas`
--
ALTER TABLE `tipos_tarjetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asociaciones_tarjetas`
--
ALTER TABLE `asociaciones_tarjetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos_y_ingresos`
--
ALTER TABLE `gastos_y_ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metas_ahorros`
--
ALTER TABLE `metas_ahorros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipos_dineros`
--
ALTER TABLE `tipos_dineros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_periodos`
--
ALTER TABLE `tipos_periodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_tarjetas`
--
ALTER TABLE `tipos_tarjetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
