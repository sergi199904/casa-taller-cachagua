<?php
// config/config.php - Configuración general del sitio

// Configuración del entorno
define('ENVIRONMENT', 'development'); // Cambiar a 'production' en servidor

// Configuración de errores según el entorno
if (ENVIRONMENT == 'production') {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Configuración de seguridad
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // Solo si usas HTTPS

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