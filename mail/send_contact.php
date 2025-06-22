<?php
require_once '../config/database.php';

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y validar datos
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $mensaje = mysqli_real_escape_string($conexion, $_POST['mensaje']);
    
    if (!$email) {
        $response['success'] = false;
        $response['message'] = 'Email inválido';
        echo json_encode($response);
        exit();
    }
    
    // Guardar en base de datos
    $query = "INSERT INTO contactos (nombre, email, telefono, mensaje) VALUES ('$nombre', '$email', '$telefono', '$mensaje')";
    
    if (mysqli_query($conexion, $query)) {
        // Configurar el correo
        $to = "francisca@casatallercachagua.cl"; // Cambiar por el email real
        $subject = "Nuevo mensaje de contacto - Casa Taller Cachagua";
        
        $email_content = "Has recibido un nuevo mensaje desde el formulario de contacto:\n\n";
        $email_content .= "Nombre: $nombre\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Teléfono: $telefono\n\n";
        $email_content .= "Mensaje:\n$mensaje\n";
        
        $headers = "From: noreply@casatallercachagua.cl\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Intentar enviar el correo
        if (@mail($to, $subject, $email_content, $headers)) {
            $response['success'] = true;
            $response['message'] = 'Mensaje enviado correctamente. Te contactaremos pronto.';
        } else {
            // Si falla el envío de email, pero se guardó en BD
            $response['success'] = true;
            $response['message'] = 'Mensaje recibido. Te contactaremos pronto.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al procesar el mensaje. Por favor intenta nuevamente.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Método no permitido';
}

echo json_encode($response);
?>

<!-- 
NOTA: Para usar PHPMailer (recomendado para producción):

1. Instalar PHPMailer via Composer:
   composer require phpmailer/phpmailer

2. Reemplazar el código de envío con:

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // O tu servidor SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu-email@gmail.com';
    $mail->Password   = 'tu-contraseña';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Destinatarios
    $mail->setFrom('noreply@casatallercachagua.cl', 'Casa Taller Cachagua');
    $mail->addAddress('francisca@casatallercachagua.cl');
    $mail->addReplyTo($email, $nombre);

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = 'Nuevo mensaje de contacto - Casa Taller Cachagua';
    $mail->Body    = nl2br($email_content);
    $mail->AltBody = $email_content;

    $mail->send();
    $response['success'] = true;
    $response['message'] = 'Mensaje enviado correctamente';
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Error al enviar el mensaje: ' . $mail->ErrorInfo;
}
-->