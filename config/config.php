<?php
// config/config.php - Configuración general del sitio

// Suprimir TODOS los errores y warnings de forma silenciosa
error_reporting(0);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '0');

// Configuración del entorno
define('ENVIRONMENT', 'development'); // Cambiar a 'production' en servidor

// NO usar ini_set para configuraciones de sesión si ya hay una sesión activa
// En su lugar, configurar estas opciones en php.ini o .htaccess

// Zona horaria
date_default_timezone_set('America/Santiago');

// Constantes del sitio
define('SITE_NAME', 'Casa Taller Cachagua');
define('SITE_URL', 'http://localhost/casa-taller-cachagua/');
define('ADMIN_EMAIL', 'francisca@casatallercachagua.cl');

// Límites de upload
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif']);

// Rutas
define('ROOT_PATH', dirname(__DIR__));
define('UPLOAD_PATH', ROOT_PATH . '/img/productos/');
?>