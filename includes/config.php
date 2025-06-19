<?php
// Configuración general
define('SITE_NAME', 'Casa Taller Cachagua');
define('SITE_URL', 'http://localhost/casatallercachagua');
define('ADMIN_EMAIL', 'admin@casatallercachagua.cl');

// Configuración de base de datos
define('DB_HOST', 'localhost');
define('DB_PORT', '3307'); // Cambiar al puerto correcto si es necesario
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'casataller');

// Configuración de rutas
define('BASE_PATH', dirname(__DIR__));
define('UPLOADS_PATH', BASE_PATH . '/uploads');
define('UPLOADS_URL', SITE_URL . '/uploads');

// Configuración de carga de imágenes
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);

// Configuración de sesión
session_start();

// Zona horaria
date_default_timezone_set('America/Santiago');
?>