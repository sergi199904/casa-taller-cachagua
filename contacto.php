<?php
$pageTitle = 'Contacto';
include_once 'includes/header.php';

// Inicializar variables
$nombre = '';
$email = '';
$telefono = '';
$asunto = '';
$mensaje = '';
$producto_id = isset($_GET['producto']) ? (int)$_GET['producto'] : '';
$enviado = false;
$error = false;
$honeypot = '';

// Si viene un ID de producto, cargar información
if ($producto_id) {
    $db = Database::getInstance();
    $producto = $db->selectOne("SELECT nombre FROM productos WHERE id = ?", [$producto_id]);
    if ($producto) {
        $asunto = "Consulta sobre: " . $producto['nombre'];
    }
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar honeypot (anti-spam)
    $honeypot = isset($_POST['website']) ? $_POST['website'] : '';
    if (!empty($honeypot)) {
        // Es probable que sea un bot, pero simulamos éxito
        $enviado = true;
    } else {
        // Obtener y sanitizar datos del formulario
        $nombre = sanitize($_POST['nombre'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $telefono = sanitize($_POST['telefono'] ?? '');
        $asunto = sanitize($_POST['asunto'] ?? '');
        $mensaje = sanitize($_POST['mensaje'] ?? '');
        
        // Validar campos obligatorios
        if (empty($nombre) || empty($email) || empty($mensaje)) {
            $error = 'Por favor, completa todos los campos obligatorios.';
        } elseif (!validarEmail($email)) {
            $error = 'Por favor, ingresa un correo electrónico válido.';
        } else {
            // Simulamos envío exitoso (en producción conectaríamos con mailer)
            $enviado = true;
            
            // Limpiar campos del formulario
            $nombre = '';
            $email = '';
            $telefono = '';
            $asunto = '';
            $mensaje = '';
        }
    }
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4 text-center">Contacto</h1>
            
            <?php if ($enviado): ?>
                <div class="alert alert-success">
                    <h4 class="alert-heading">¡Mensaje enviado correctamente!</h4>
                    <p>Gracias por ponerte en contacto con nosotros. Te responderemos a la brevedad.</p>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <div class="row mb-5">
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <div class="p-4">
                        <i class="fas fa-map-marker-alt fa-2x text-primary-custom mb-3"></i>
                        <h5>Dirección</h5>
                        <p class="mb-0"><?php echo getConfiguracion('contacto', 'direccion'); ?></p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <div class="p-4">
                        <i class="fas fa-phone fa-2x text-primary-custom mb-3"></i>
                        <h5>Teléfono</h5>
                        <p class="mb-0"><?php echo getConfiguracion('contacto', 'telefono'); ?></p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-4">
                        <i class="fas fa-envelope fa-2x text-primary-custom mb-3"></i>
                        <h5>Email</h5>
                        <p class="mb-0"><?php echo getConfiguracion('contacto', 'email'); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <form id="contactForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <!-- Honeypot anti-spam -->
                    <div class="d-none">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo $asunto; ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje *</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required><?php echo $mensaje; ?></textarea>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary-custom btn-lg">Enviar mensaje</button>
                    </div>
                </form>
            </div>
            
            <div class="mt-5">
                <h3 class="mb-4 text-center">Visítanos</h3>
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3332.9222540383257!2d-71.4427887845815!3d-32.57660438104276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9684caf93b171cc7%3A0x9e5c45f4a1f8e9de!2sCachagua%2C%20Zapallar%2C%20Valpara%C3%ADso!5e0!3m2!1ses-419!2scl!4v1654612345678!5m2!1ses-419!2scl" 
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>