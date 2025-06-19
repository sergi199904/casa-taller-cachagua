-- Versión actualizada con correcciones (19/06/2025)
-- Base de datos: `db_casataller`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `valor` text DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `tipo`, `clave`, `valor`, `titulo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'general', 'titulo_sitio', 'Casa Taller Cachagua', 'Título del sitio', 'Nombre principal del sitio web', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(2, 'general', 'descripcion_sitio', 'Taller de arte y cerámica en Cachagua', 'Descripción del sitio', 'Breve descripción para SEO y redes sociales', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(3, 'contacto', 'email', 'contacto@casatallercachagua.cl', 'Email de contacto', 'Dirección de correo principal', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(4, 'contacto', 'telefono', '+56912345678', 'Teléfono', 'Número de contacto principal', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(5, 'contacto', 'direccion', 'Cachagua, Zapallar, Valparaíso, Chile', 'Dirección', 'Ubicación física del taller', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(6, 'redes', 'instagram', 'casatallercachagua', 'Instagram', 'Usuario de Instagram sin @', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(7, 'redes', 'facebook', 'casatallercachagua', 'Facebook', 'Nombre de usuario de Facebook', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(8, 'redes', 'whatsapp', '56912345678', 'WhatsApp', 'Número con código de país sin +', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(9, 'notificaciones', 'email_notificaciones', 'notificaciones@casatallercachagua.cl', 'Email para notificaciones', 'Correo donde se reciben los formularios', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(10, 'mapa', 'latitud', '-32.5766', 'Latitud', 'Coordenada de latitud para el mapa', '2023-12-12 03:00:00', '2023-12-12 03:00:00'),
(11, 'mapa', 'longitud', '-71.4534', 'Longitud', 'Coordenada de longitud para el mapa', '2023-12-12 03:00:00', '2023-12-12 03:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `asunto` varchar(200) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `estado` enum('nuevo','leido','respondido','archivado') NOT NULL DEFAULT 'nuevo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','editor') NOT NULL DEFAULT 'editor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@casatallercachagua.cl', '$2y$10$XUEkLcLPZw4CyymBVvanvex5kbFSZiybxcK4nhw1hQaBh1T.7o3LO', 'admin', '2023-12-12 03:00:00', '2023-12-12 03:00:00');

-- --------------------------------------------------------

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_clave` (`tipo`,`clave`);

--
-- Indices de la tabla `mens