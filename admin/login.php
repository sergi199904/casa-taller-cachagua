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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['password'];
    
    $query = "SELECT * FROM admins WHERE email = '$email'";
    $result = mysqli_query($conexion, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nombre'] = $admin['nombre'];
            $_SESSION['admin_email'] = $admin['email'];
            
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Contraseña incorrecta';
        }
    } else {
        $error = 'Email no encontrado';
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
    <div class="login-container">
        <div class="login-card fade-in">
            <!-- Header con gradiente -->
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h2 class="login-title">Panel de Administración</h2>
                <p class="login-subtitle">Casa Taller Cachagua</p>
            </div>
            
            <!-- Cuerpo del formulario -->
            <div class="login-body">
                <!-- Pestañas Login/Registro -->
                <div class="tab-container">
                    <div class="tab-button active">Login</div>
                    <a href="register.php" class="tab-button">Registrar</a>
                </div>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulario de Login -->
                <form method="POST" action="" id="loginForm" novalidate>
                    <div class="form-floating">
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               placeholder="admin@casataller.com"
                               required 
                               autocomplete="username"
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <label for="email"><i class="fas fa-user me-2"></i>Ingresar usuario</label>
                    </div>
                    
                    <div class="form-floating position-relative">
                        <input type="password" 
                               class="form-control" 
                               id="password" 
                               name="password" 
                               placeholder="••••••••"
                               required 
                               autocomplete="current-password">
                        <label for="password"><i class="fas fa-lock me-2"></i>Ingresar password</label>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    
                    <div class="checkbox-custom">
                        <input type="checkbox" id="showPassword" name="showPassword">
                        <label for="showPassword" class="checkmark"></label>
                        <label for="showPassword" style="cursor: pointer;">Mostrar contraseña</label>
                    </div>
                    
                    <button type="submit" class="btn btn-login mb-3" id="loginBtn">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <span id="loginText">Iniciar Sesión</span>
                    </button>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="login-footer">
                <p class="mb-2">¿No tienes cuenta? 
                    <a href="register.php">Regístrate aquí</a>
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
            // Funcionalidad de mostrar/ocultar contraseña
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const showPasswordCheck = document.getElementById('showPassword');
            
            function togglePasswordVisibility() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                const icon = togglePassword.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                
                showPasswordCheck.checked = type === 'text';
            }
            
            if (togglePassword) {
                togglePassword.addEventListener('click', togglePasswordVisibility);
            }
            
            if (showPasswordCheck) {
                showPasswordCheck.addEventListener('change', togglePasswordVisibility);
            }
            
            // Auto-focus en el primer campo
            const emailField = document.getElementById('email');
            if (emailField && !emailField.value) {
                emailField.focus();
            }
            
            // Validación básica del formulario
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const email = document.getElementById('email').value.trim();
                    const passwordValue = document.getElementById('password').value;
                    
                    if (!email || !passwordValue) {
                        e.preventDefault();
                        showAlert('Por favor completa todos los campos', 'danger');
                        return;
                    }
                    
                    // Mostrar loading en el botón
                    const loginBtn = document.getElementById('loginBtn');
                    const loginText = document.getElementById('loginText');
                    
                    loginBtn.disabled = true;
                    loginText.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verificando...';
                });
            }
            
            function showAlert(message, type = 'info') {
                const existingAlert = document.querySelector('.alert');
                if (existingAlert) {
                    existingAlert.remove();
                }
                
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type}`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                    ${message}
                `;
                
                const form = document.getElementById('loginForm');
                form.parentNode.insertBefore(alertDiv, form);
                
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }
        });
    </script>
</body>
</html>