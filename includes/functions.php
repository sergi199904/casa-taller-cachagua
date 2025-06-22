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
 * Subir imagen
 */
function upload_image($file, $directory = 'img/productos/') {
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (!in_array($file_extension, $allowed_types)) {
        return array('success' => false, 'message' => 'Tipo de archivo no permitido');
    }
    
    $new_filename = uniqid() . '.' . $file_extension;
    $upload_path = $directory . $new_filename;
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return array('success' => true, 'filename' => $new_filename);
    } else {
        return array('success' => false, 'message' => 'Error al subir el archivo');
    }
}

/**
 * Eliminar imagen
 */
function delete_image($filename, $directory = 'img/productos/') {
    $file_path = $directory . $filename;
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
 * Validar email
 */
function validate_email($email) {
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
 * Crear miniatura de imagen
 */
function create_thumbnail($source_path, $dest_path, $thumb_width = 300) {
    $image_info = getimagesize($source_path);
    $image_type = $image_info[2];
    
    switch($image_type) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($source_path);
            break;
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($source_path);
            break;
        case IMAGETYPE_GIF:
            $source = imagecreatefromgif($source_path);
            break;
        default:
            return false;
    }
    
    $width = imagesx($source);
    $height = imagesy($source);
    
    $thumb_height = floor($height * ($thumb_width / $width));
    
    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
    
    imagecopyresampled($thumb, $source, 0, 0, 0, 0, 
                       $thumb_width, $thumb_height, $width, $height);
    
    switch($image_type) {
        case IMAGETYPE_JPEG:
            imagejpeg($thumb, $dest_path, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($thumb, $dest_path);
            break;
        case IMAGETYPE_GIF:
            imagegif($thumb, $dest_path);
            break;
    }
    
    imagedestroy($source);
    imagedestroy($thumb);
    
    return true;
}
?>