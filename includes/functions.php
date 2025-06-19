<?php
require_once 'db.php';

// Función para sanitizar inputs
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Función para validar correo electrónico
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Función para crear slug
function crearSlug($texto) {
    $texto = strtolower($texto);
    $texto = preg_replace('/[^a-z0-9]/', '-', $texto);
    $texto = preg_replace('/-+/', '-', $texto);
    return trim($texto, '-');
}

// Subir imagen
function subirImagen($file, $destination) {
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
        return false;
    }

    // Verificar tamaño
    if ($file['size'] > MAX_FILE_SIZE) {
        return false;
    }

    // Verificar extensión
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        return false;
    }

    // Crear nombre de archivo único
    $newFileName = uniqid() . '.' . $extension;
    $uploadPath = $destination . '/' . $newFileName;

    // Crear directorio si no existe
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }

    // Mover archivo
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return $newFileName;
    }

    return false;
}

// Función para paginar resultados
function paginar($tabla, $pagina = 1, $porPagina = 10, $condicion = "", $params = []) {
    $db = Database::getInstance();
    
    // Calcular offset
    $offset = ($pagina - 1) * $porPagina;
    
    // Consulta para obtener el total
    $where = empty($condicion) ? "" : "WHERE $condicion";
    $totalQuery = "SELECT COUNT(*) as total FROM $tabla $where";
    $totalResult = $db->selectOne($totalQuery, $params);
    $total = $totalResult['total'];
    
    // Consulta para obtener los resultados paginados
    $query = "SELECT * FROM $tabla $where LIMIT $offset, $porPagina";
    $resultados = $db->select($query, $params);
    
    // Calcular páginas totales
    $totalPaginas = ceil($total / $porPagina);
    
    return [
        'total' => $total,
        'pagina_actual' => $pagina,
        'por_pagina' => $porPagina,
        'total_paginas' => $totalPaginas,
        'resultados' => $resultados
    ];
}

// Función para obtener configuración
function getConfiguracion($seccion, $clave) {
    $db = Database::getInstance();
    $config = $db->selectOne(
        "SELECT valor FROM configuracion WHERE seccion = ? AND clave = ?", 
        [$seccion, $clave]
    );
    
    return $config ? $config['valor'] : '';
}

// Función para actualizar configuración
function setConfiguracion($seccion, $clave, $valor) {
    $db = Database::getInstance();
    
    $existente = $db->selectOne(
        "SELECT id FROM configuracion WHERE seccion = ? AND clave = ?", 
        [$seccion, $clave]
    );
    
    if ($existente) {
        $db->update('configuracion', ['valor' => $valor], 'id = ?', [$existente['id']]);
    } else {
        $db->insert('configuracion', [
            'seccion' => $seccion,
            'clave' => $clave,
            'valor' => $valor
        ]);
    }
    
    return true;
}

// Verificar si el usuario está autenticado
function isLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

// Función para redireccionar
function redirect($url) {
    header("Location: $url");
    exit;
}

// Generar token CSRF
function generarCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Validar token CSRF
function validarCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token'];
}
?>