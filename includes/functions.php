<?php
// functions.php - Funciones auxiliares

/**
 * Sanitizar entrada de datos
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Verificar si el usuario está logueado
 */
function is_logged_in() {
    return isset($_SESSION['admin_id']);
}

/**
 * Redirigir a una URL
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Generar token CSRF
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verificar token CSRF
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Formatear fecha
 */
function format_date($date, $format = 'd/m/Y') {
    return date($format, strtotime($date));
}

/**
 * Validar imagen mejorada
 */
function validateImage($file) {
    $allowed = ['image/jpeg', 'image/png', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    return in_array($mime, $allowed);
}

/**
 * Subir imagen mejorada
 */
function upload_image($file, $directory = 'img/productos/') {
    // Validar tipo MIME real
    if (!validateImage($file)) {
        return array('success' => false, 'message' => 'Tipo de archivo no permitido');
    }
    
    // Validar tamaño
    if ($file['size'] > MAX_FILE_SIZE) {
        return array('success' => false, 'message' => 'El archivo es demasiado grande');
    }
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '_' . time() . '.' . $file_extension;
    $upload_path = '../' . $directory . $new_filename;
    
    // Crear directorio si no existe
    if (!is_dir('../' . $directory)) {
        mkdir('../' . $directory, 0777, true);
    }
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        // Optimizar imagen si es necesario
        optimizeImage($upload_path, $file_extension);
        return array('success' => true, 'filename' => $new_filename);
    } else {
        return array('success' => false, 'message' => 'Error al subir el archivo');
    }
}

/**
 * Optimizar imagen
 */
function optimizeImage($path, $extension) {
    list($width, $height) = getimagesize($path);
    
    // Si la imagen es muy grande, redimensionar
    if ($width > 1200 || $height > 1200) {
        $maxDim = 1200;
        $ratio = min($maxDim/$width, $maxDim/$height);
        $newWidth = $width * $ratio;
        $newHeight = $height * $ratio;
        
        switch($extension) {
            case 'jpg':
            case 'jpeg':
                $src = imagecreatefromjpeg($path);
                break;
            case 'png':
                $src = imagecreatefrompng($path);
                break;
            case 'gif':
                $src = imagecreatefromgif($path);
                break;
            default:
                return;
        }
        
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preservar transparencia para PNG
        if ($extension == 'png') {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        }
        
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        switch($extension) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($dst, $path, 85);
                break;
            case 'png':
                imagepng($dst, $path, 8);
                break;
            case 'gif':
                imagegif($dst, $path);
                break;
        }
        
        imagedestroy($src);
        imagedestroy($dst);
    }
}

/**
 * Eliminar imagen
 */
function delete_image($filename, $directory = 'img/productos/') {
    $file_path = '../' . $directory . $filename;
    if (file_exists($file_path)) {
        return unlink($file_path);
    }
    return false;
}

/**
 * Obtener URL base del sitio
 */
function get_base_url() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $path = str_replace(basename($script), '', $script);
    return $protocol . "://" . $host . $path;
}

/**
 * Generar slug desde un texto
 */
function create_slug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text;
}

/**
 * Limitar texto
 */
function limit_text($text, $limit = 100) {
    if (strlen($text) > $limit) {
        $text = substr($text, 0, $limit) . '...';
    }
    return $text;
}

/**
 * Validar email mejorado
 */
function validate_email($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Obtener IP del cliente
 */
function get_client_ip() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, 
                    FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
}

/**
 * Log de actividad
 */
function log_activity($action, $details = '') {
    global $conexion;
    
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 0;
    $ip = get_client_ip();
    $action = escape($action);
    $details = escape($details);
    
    $query = "INSERT INTO activity_log (user_id, action, details, ip_address) 
              VALUES ('$user_id', '$action', '$details', '$ip')";
    
    return mysqli_query($conexion, $query);
}
?>