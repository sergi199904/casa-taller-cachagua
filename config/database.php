<?php
// config/database.php - Configuración de la base de datos

// Incluir configuración general
require_once 'config.php';

// Configuración para XAMPP con MySQL en puerto 3307
define('DB_HOST', 'localhost:3307');
define('DB_USER', 'root');
define('DB_PASS', ''); // Cambia esto si tienes contraseña en MySQL
define('DB_NAME', 'casa_taller_cachagua');

// Crear conexión
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conexion->connect_error) {
    if (ENVIRONMENT == 'development') {
        die("Error de conexión: " . $conexion->connect_error);
    } else {
        die("Error de conexión a la base de datos");
    }
}

// Establecer charset para evitar problemas con caracteres especiales
$conexion->set_charset("utf8mb4");

// Función para escapar strings (prevenir SQL Injection)
function escape($str) {
    global $conexion;
    return mysqli_real_escape_string($conexion, $str);
}
?>