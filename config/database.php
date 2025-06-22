<?php
// config/database.php - Configuración de la base de datos

// Configuración para XAMPP con MySQL en puerto 3307
define('DB_HOST', 'localhost:3307');
define('DB_USER', 'root');
define('DB_PASS', ''); // Cambia esto si tienes contraseña en MySQL
define('DB_NAME', 'casa_taller_cachagua');

// Crear conexión
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer charset para evitar problemas con caracteres especiales
$conexion->set_charset("utf8");

// Opcional: Configurar zona horaria
date_default_timezone_set('America/Santiago');
?>