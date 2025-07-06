<?php

// Iniciar sesión de forma silenciosa
session_start();

// Incluir base de datos de forma silenciosa
require_once '../config/database.php';

// Si ya está logueado, redirigir al dashboard
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validaciones
    if (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres';
    } elseif ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden';
    } else {
        // Verificar si el email ya existe
        $check_query = "SELECT id FROM admins WHERE email = '$email'";
        $check_result = mysqli_query($conexion, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error = 'Este email ya está registrado';
        } else {
            // Encriptar contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertar nuevo administrador
            $insert_query = "INSERT INTO admins (nombre, email, password) VALUES ('$nombre', '$email', '$hashed_password')";
            
            if (mysqli_query($conexion, $insert_query)) {
                $success = 'Registro exitoso. Redirigiendo al login...';
                header('refresh:2;url=login.php');
            } else {
                $error = 'Error al registrar. Por favor intenta nuevamente.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<!-- Actualizar la sección <head> en admin/login.php y admin/register.php -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Casa Taller Cachagua Admin</title>
    
    <!-- Meta tags -->
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Panel de administración Casa Taller Cachagua">
    
    <!-- Google Fonts - Nueva Tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Actualizar las variables CSS del login con la nueva paleta */
        :root {
            --primary-gradient: linear-gradient(135deg, #4567B7 0%, #1976D2 100%);
            --secondary-gradient: linear-gradient(135deg, #8BC34A 0%, #4CAF50 100%);
            --accent-gradient: linear-gradient(135deg, #4567B7 0%, #7A288A 100%);
            --background-color: #F0F4F8;
            --text-color: #222222;
            --white: #ffffff;
            --light-blue: #E3F2FD;
            --shadow: 0 15px 35px rgba(69, 103, 183, 0.1);
            --shadow-hover: 0 25px 50px rgba(69, 103, 183, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            overflow-x: hidden;
            position: relative;
            padding: 20px;
        }

        /* Fondo animado actualizado con colores fríos */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(69, 103, 183, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 195, 74, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(122, 40, 138, 0.3) 0%, transparent 50%);
            animation: backgroundMove 20s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes backgroundMove {
            0%, 100% { transform: translateX(0) translateY(0); }
            33% { transform: translateX(-30px) translateY(-50px); }
            66% { transform: translateX(20px) translateY(20px); }
        }

        .login-container, .register-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
        }

        .login-card, .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-card:hover, .register-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }

        .login-header, .register-header {
            background: var(--primary-gradient);
            padding: 3rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header {
            background: var(--accent-gradient);
        }

        .login-header::before, .register-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .login-icon, .register-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 5;
        }

        .login-icon i, .register-icon i {
            font-size: 2.5rem;
            color: white;
            animation: iconPulse 2s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .login-title, .register-title {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 5;
            font-family: 'Open Sans', sans-serif;
        }

        .login-subtitle, .register-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            margin-bottom: 0;
            position: relative;
            z-index: 5;
        }

        .login-body, .register-body {
            padding: 2.5rem 2rem;
        }

        .tab-container {
            display: flex;
            background: var(--light-blue);
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 2rem;
            position: relative;
        }

        .tab-button {
            flex: 1;
            padding: 12px;
            background: none;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #6c757d;
            position: relative;
            z-index: 2;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Open Sans', sans-serif;
        }

        .tab-button.active {
            background: white;
            color: #495057;
            box-shadow: 0 2px 8px rgba(69, 103, 183, 0.1);
        }

        .tab-button:hover {
            color: #495057;
            text-decoration: none;
        }

        .form-floating {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            background: var(--light-blue);
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-family: 'Roboto', sans-serif;
        }

        .form-control:focus {
            background: white;
            border-color: #4567B7;
            box-shadow: 0 0 0 0.2rem rgba(69, 103, 183, 0.15);
            transform: translateY(-2px);
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
            font-family: 'Open Sans', sans-serif;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #495057;
        }

        .btn-login, .btn-register {
            width: 100%;
            padding: 1rem;
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-family: 'Open Sans', sans-serif;
        }

        .btn-register {
            background: var(--accent-gradient);
        }

        .btn-login::before, .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before, .btn-register:hover::before {
            left: 100%;
        }

        .btn-login:hover, .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(69, 103, 183, 0.3);
        }

        .login-footer, .register-footer {
            padding: 1.5rem 2rem 2rem;
            text-align: center;
            background: var(--light-blue);
        }

        .login-footer a, .register-footer a {
            color: #4567B7;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-footer a:hover, .register-footer a:hover {
            color: #7A288A;
            text-decoration: underline;
        }

        .checkbox-custom {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .checkbox-custom input[type="checkbox"] {
            display: none;
        }

        .checkbox-custom .checkmark {
            width: 20px;
            height: 20px;
            background: var(--light-blue);
            border: 2px solid #dee2e6;
            border-radius: 4px;
            margin-right: 12px;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .checkbox-custom input[type="checkbox"]:checked + .checkmark {
            background: var(--primary-gradient);
            border-color: #4567B7;
        }

        .checkbox-custom input[type="checkbox"]:checked + .checkmark::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 12px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            font-family: 'Roboto', sans-serif;
        }

        .alert-danger {
            background: rgba(244, 67, 54, 0.1);
            color: #721c24;
            border-left: 4px solid #F44336;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            color: #155724;
            border-left: 4px solid #4CAF50;
        }

        .form-text {
            color: #6c757d;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-family: 'Roboto', sans-serif;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .login-header, .register-header {
                padding: 2rem 1.5rem 1.5rem;
            }
            
            .login-body, .register-body {
                padding: 2rem 1.5rem;
            }
            
            .login-icon, .register-icon {
                width: 60px;
                height: 60px;
            }
            
            .login-icon i, .register-icon i {
                font-size: 2rem;
            }
            
            .login-title, .register-title {
                font-size: 1.5rem;
            }
        }

        /* Animación de entrada */
        .fade-in {
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Validación visual mejorada */
        .form-control.is-valid {
            border-color: #4CAF50;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%234CAF50' d='m2.3 6.73 0.13-.02 1.92-2.23L5.8 3 4.38 4.51 2.12 6.64z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .form-control.is-invalid {
            border-color: #F44336;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23F44336'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 5.8 0.4-0.4 0.4 0.4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            display: block;
            color: #F44336;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-family: 'Roboto', sans-serif;
        }

        .valid-feedback {
            display: block;
            color: #4CAF50;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-family: 'Roboto', sans-serif;
        }

        /* Focus visible mejorado */
        .btn:focus-visible,
        .form-control:focus-visible {
            outline: 2px solid #4567B7;
            outline-offset: 2px;
        }

        /* Selección de texto */
        ::selection {
            background: #4567B7;
            color: white;
        }

        ::-moz-selection {
            background: #4567B7;
            color: white;
        }

        /* Modo de alto contraste */
        @media (prefers-contrast: high) {
            :root {
                --primary-gradient: linear-gradient(135deg, #003d82 0%, #001f5c 100%);
                --text-color: #000000;
                --background-color: #ffffff;
            }
        }

        /* Preferencia de movimiento reducido */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card fade-in">
            <!-- Header con gradiente -->
            <div class="register-header">
                <div class="register-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2 class="register-title">Registro de Administrador</h2>
                <p class="register-subtitle">Casa Taller Cachagua</p>
            </div>
            
            <!-- Cuerpo del formulario -->
            <div class="register-body">
                <!-- Pestañas Login/Registro -->
                <div class="tab-container">
                    <a href="login.php" class="tab-button">Login</a>
                    <div class="tab-button active">Registrar</div>
                </div>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulario de Registro -->
                <form method="POST" action="" id="registerForm" novalidate>
                    <div class="form-floating">
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               placeholder="Nombre completo"
                               required 
                               maxlength="100"
                               value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                        <label for="nombre"><i class="fas fa-user me-2"></i>Nombre completo</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               placeholder="correo@ejemplo.com"
                               required 
                               maxlength="100"
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                    </div>
                    
                    <div class="form-floating position-relative">
                        <input type="password" 
                               class="form-control" 
                               id="password" 
                               name="password" 
                               placeholder="••••••••"
                               required 
                               minlength="6">
                        <label for="password"><i class="fas fa-lock me-2"></i>Contraseña</label>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="form-text">Mínimo 6 caracteres</div>
                    
                    <div class="form-floating position-relative">
                        <input type="password" 
                               class="form-control" 
                               id="confirm_password" 
                               name="confirm_password" 
                               placeholder="••••••••"
                               required 
                               minlength="6">
                        <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirmar contraseña</label>
                        <button type="button" class="password-toggle" id="toggleConfirmPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    
                    <button type="submit" class="btn btn-register mb-3" id="registerBtn">
                        <i class="fas fa-user-plus me-2"></i>
                        <span id="registerText">Registrarse</span>
                    </button>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="register-footer">
                <p class="mb-2">¿Ya tienes cuenta? 
                    <a href="login.php">Inicia sesión aquí</a>
                </p>
                <a href="../index.php">
                    <i class="fas fa-home me-1"></i>Volver al sitio
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Campos del formulario
            const nombreField = document.getElementById('nombre');
            const emailField = document.getElementById('email');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirm_password');
            const registerForm = document.getElementById('registerForm');
            
            // Funcionalidad de mostrar/ocultar contraseña
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            
            function setupPasswordToggle(toggleBtn, passwordInput) {
                if (toggleBtn) {
                    toggleBtn.addEventListener('click', function() {
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        
                        const icon = toggleBtn.querySelector('i');
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    });
                }
            }
            
            setupPasswordToggle(togglePassword, passwordField);
            setupPasswordToggle(toggleConfirmPassword, confirmPasswordField);
            
            // Funciones de validación
            function validateName(name) {
                return name.trim().length >= 2 && name.trim().length <= 100;
            }
            
            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email.trim());
            }
            
            function validatePassword(password) {
                return password.length >= 6;
            }
            
            function validatePasswordMatch(password, confirmPassword) {
                return password === confirmPassword;
            }
            
            // Mostrar/ocultar mensajes de validación
            function showFieldError(field, message) {
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
                
                let errorDiv = field.parentNode.querySelector('.invalid-feedback');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.classList.add('invalid-feedback');
                    field.parentNode.appendChild(errorDiv);
                }
                errorDiv.textContent = message;
            }
            
            function showFieldSuccess(field) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                
                const errorDiv = field.parentNode.querySelector('.invalid-feedback');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
            
            // Validación en tiempo real
            nombreField.addEventListener('blur', function() {
                if (!validateName(this.value)) {
                    showFieldError(this, 'El nombre debe tener entre 2 y 100 caracteres');
                } else {
                    showFieldSuccess(this);
                }
            });
            
            emailField.addEventListener('blur', function() {
                if (!validateEmail(this.value)) {
                    showFieldError(this, 'Ingrese un email válido');
                } else {
                    showFieldSuccess(this);
                }
            });
            
            passwordField.addEventListener('blur', function() {
                if (!validatePassword(this.value)) {
                    showFieldError(this, 'La contraseña debe tener al menos 6 caracteres');
                } else {
                    showFieldSuccess(this);
                }
                
                // Revalidar confirmación si ya tiene valor
                if (confirmPasswordField.value) {
                    validateConfirmPasswordField();
                }
            });
            
            function validateConfirmPasswordField() {
                if (!validatePasswordMatch(passwordField.value, confirmPasswordField.value)) {
                    showFieldError(confirmPasswordField, 'Las contraseñas no coinciden');
                } else {
                    showFieldSuccess(confirmPasswordField);
                }
            }
            
            confirmPasswordField.addEventListener('blur', validateConfirmPasswordField);
            
            // Auto-focus en el primer campo
            if (nombreField) {
                nombreField.focus();
            }
            
            // Validación del formulario
            registerForm.addEventListener('submit', function(e) {
                let isValid = true;
                
                // Validar nombre
                if (!validateName(nombreField.value)) {
                    showFieldError(nombreField, 'El nombre debe tener entre 2 y 100 caracteres');
                    isValid = false;
                } else {
                    showFieldSuccess(nombreField);
                }
                
                // Validar email
                if (!validateEmail(emailField.value)) {
                    showFieldError(emailField, 'Ingrese un email válido');
                    isValid = false;
                } else {
                    showFieldSuccess(emailField);
                }
                
                // Validar contraseña
                if (!validatePassword(passwordField.value)) {
                    showFieldError(passwordField, 'La contraseña debe tener al menos 6 caracteres');
                    isValid = false;
                } else {
                    showFieldSuccess(passwordField);
                }
                
                // Validar confirmación de contraseña
                if (!validatePasswordMatch(passwordField.value, confirmPasswordField.value)) {
                    showFieldError(confirmPasswordField, 'Las contraseñas no coinciden');
                    isValid = false;
                } else {
                    showFieldSuccess(confirmPasswordField);
                }
                
                if (!isValid) {
                    e.preventDefault();
                    // Scroll al primer campo con error
                    const firstError = registerForm.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                    return;
                }
                
                // Mostrar loading en el botón
                const registerBtn = document.getElementById('registerBtn');
                const registerText = document.getElementById('registerText');
                
                registerBtn.disabled = true;
                registerText.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Registrando...';
            });
        });
    </script>
</body>
</html>