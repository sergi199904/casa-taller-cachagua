<?php
// config/database.php - Configuración de la base de datos

// Suprimir errores de forma silenciosa
error_reporting(0);
ini_set('display_errors', '0');

// Incluir configuración general solo si no está ya incluida
if (!defined('ENVIRONMENT')) {
    require_once 'config.php';
}

// Configuración para XAMPP con MySQL en puerto 3307
define('DB_HOST', 'localhost:3307');
define('DB_USER', 'root');
define('DB_PASS', ''); // Cambia esto si tienes contraseña en MySQL
define('DB_NAME', 'casa_taller_cachagua');

// Crear conexión con manejo de errores silencioso
$conexion = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión de forma silenciosa
if ($conexion->connect_error) {
    if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') {
        // Solo mostrar error en desarrollo, sin usar ini_set
        die("Error de conexión: " . $conexion->connect_error);
    } else {
        die("Error de conexión a la base de datos");
    }
}

// Establecer charset para evitar problemas con caracteres especiales
@$conexion->set_charset("utf8mb4");

// Función para escapar strings (prevenir SQL Injection)
function escape($str) {
    global $conexion;
    return @mysqli_real_escape_string($conexion, $str);
}
?>