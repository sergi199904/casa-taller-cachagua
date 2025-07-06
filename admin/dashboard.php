<?php
// Suprimir errores y warnings completamente
error_reporting(0);
ini_set('display_errors', '0');

// Iniciar sesión de forma segura
if (session_status() == PHP_SESSION_NONE) {
    @session_start();
}

// Incluir archivos necesarios de forma silenciosa
@require_once '../config/database.php';

// Verificar si está logueado
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Obtener estadísticas de forma silenciosa
$stats = array();

// Total de productos
$query = "SELECT COUNT(*) as total FROM productos";
$result = @mysqli_query($conexion, $query);
$stats['productos'] = $result ? @mysqli_fetch_assoc($result)['total'] : 0;

// Total de mensajes
$query = "SELECT COUNT(*) as total FROM contactos";
$result = @mysqli_query($conexion, $query);
$stats['mensajes'] = $result ? @mysqli_fetch_assoc($result)['total'] : 0;

// Mensajes recientes - Aumentamos el límite y ordenamos por fecha
$query = "SELECT * FROM contactos ORDER BY fecha DESC LIMIT 10";
$mensajes_recientes = @mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Casa Taller Cachagua Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        /* Estilos adicionales para mejorar la visualización de mensajes */
        .mensaje-completo {
            max-width: 400px;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
        
        .mensaje-preview {
            cursor: pointer;
            color: #0066cc;
            text-decoration: underline;
        }
        
        .mensaje-preview:hover {
            color: #004499;
        }
        
        .table-mensajes th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            color: #495057;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .table-mensajes td {
            vertical-align: middle;
            padding: 12px 8px;
        }
        
        .mensaje-card {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .badge-nuevo {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
        }
        
        .email-link {
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
        }
        
        .email-link:hover {
            color: #004499;
            text-decoration: underline;
        }
        
        /* Responsive para tabla de mensajes */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .mensaje-completo {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <span class="admin-brand-text">Admin</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productos.php">
                        <i class="fas fa-box"></i> Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php" target="_blank">
                        <i class="fas fa-eye"></i> Ver Sitio
                    </a>
                </li>
            </ul>
            <div class="navbar-nav">
                <span class="navbar-text me-3">
                    <i class="fas fa-user"></i> <?php echo isset($_SESSION['admin_nombre']) ? htmlspecialchars($_SESSION['admin_nombre']) : 'Admin'; ?>
                </span>
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
</nav>

    <!-- Contenido Principal -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Dashboard</h1>
            </div>
        </div>

        <!-- Tarjetas de Estadísticas -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Total Productos</h6>
                                <h2 class="mb-0"><?php echo isset($stats['productos']) ? $stats['productos'] : '0'; ?></h2>
                            </div>
                            <i class="fas fa-box fa-3x opacity-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="productos.php" class="text-white text-decoration-none">Ver detalles</a>
                        <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Mensajes Recibidos</h6>
                                <h2 class="mb-0"><?php echo isset($stats['mensajes']) ? $stats['mensajes'] : '0'; ?></h2>
                            </div>
                            <i class="fas fa-envelope fa-3x opacity-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class="text-white">Total histórico</span>
                        <i class="fas fa-envelope-open"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Visitantes Hoy</h6>
                                <h2 class="mb-0">---</h2>
                            </div>
                            <i class="fas fa-users fa-3x opacity-50"></i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="text-white">Analytics no configurado</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Estado del Sitio</h6>
                                <h4 class="mb-0">Activo</h4>
                            </div>
                            <i class="fas fa-check-circle fa-3x opacity-50"></i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="text-white">Funcionando correctamente</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensajes Recientes Mejorados -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-envelope"></i> Mensajes Recientes</h5>
                        <span class="badge bg-primary"><?php echo isset($stats['mensajes']) ? $stats['mensajes'] : '0'; ?> total</span>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($mensajes_recientes && @mysqli_num_rows($mensajes_recientes) > 0): ?>
                            <div class="table-responsive mensaje-card">
                                <table class="table table-hover table-mensajes mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 140px;">Fecha</th>
                                            <th style="width: 180px;">Contacto</th>
                                            <th>Mensaje</th>
                                            <th style="width: 80px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $contador = 0;
                                        while($mensaje = @mysqli_fetch_assoc($mensajes_recientes)): 
                                            $contador++;
                                            $es_reciente = strtotime($mensaje['fecha']) > strtotime('-24 hours');
                                            $mensaje_id = 'mensaje_' . $mensaje['id'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <strong><?php echo @date('d/m/Y', strtotime($mensaje['fecha'])); ?></strong>
                                                        <small class="text-muted"><?php echo @date('H:i', strtotime($mensaje['fecha'])); ?></small>
                                                        <?php if ($es_reciente): ?>
                                                            <span class="badge-nuevo mt-1">Nuevo</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <strong><?php echo htmlspecialchars($mensaje['nombre']); ?></strong>
                                                        <a href="mailto:<?php echo htmlspecialchars($mensaje['email']); ?>" 
                                                           class="email-link small">
                                                            <?php echo htmlspecialchars($mensaje['email']); ?>
                                                        </a>
                                                        <?php if (!empty($mensaje['telefono'])): ?>
                                                            <small class="text-muted">
                                                                <i class="fas fa-phone fa-xs"></i> 
                                                                <?php echo htmlspecialchars($mensaje['telefono']); ?>
                                                            </small>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mensaje-completo">
                                                        <?php 
                                                        $mensaje_texto = htmlspecialchars($mensaje['mensaje']);
                                                        if (strlen($mensaje_texto) > 150): 
                                                        ?>
                                                            <span id="preview_<?php echo $mensaje['id']; ?>">
                                                                <?php echo substr($mensaje_texto, 0, 150); ?>...
                                                                <span class="mensaje-preview" onclick="toggleMensaje(<?php echo $mensaje['id']; ?>)">
                                                                    <br><small><i class="fas fa-eye"></i> Ver completo</small>
                                                                </span>
                                                            </span>
                                                            <span id="completo_<?php echo $mensaje['id']; ?>" style="display: none;">
                                                                <?php echo $mensaje_texto; ?>
                                                                <span class="mensaje-preview" onclick="toggleMensaje(<?php echo $mensaje['id']; ?>)">
                                                                    <br><small><i class="fas fa-eye-slash"></i> Ver menos</small>
                                                                </span>
                                                            </span>
                                                        <?php else: ?>
                                                            <?php echo $mensaje_texto; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <a href="mailto:<?php echo htmlspecialchars($mensaje['email']); ?>?subject=Re: Consulta Casa Taller&body=Hola <?php echo htmlspecialchars($mensaje['nombre']); ?>,%0D%0A%0D%0AGracias por contactarnos..." 
                                                           class="btn btn-outline-primary btn-sm" 
                                                           title="Responder">
                                                            <i class="fas fa-reply"></i>
                                                        </a>
                                                        <button type="button" 
                                                                class="btn btn-outline-info btn-sm" 
                                                                onclick="copiarMensaje(<?php echo $mensaje['id']; ?>)"
                                                                title="Copiar mensaje">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <?php if (@mysqli_num_rows($mensajes_recientes) >= 10): ?>
                                <div class="card-footer text-center">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i> 
                                        Mostrando los 10 mensajes más recientes. 
                                        <a href="#" class="text-decoration-none">Ver todos los mensajes</a>
                                    </small>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No hay mensajes recientes</p>
                                <small class="text-muted">Los mensajes de contacto aparecerán aquí</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accesos Rápidos -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-rocket"></i> Accesos Rápidos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="productos.php?action=add" class="btn btn-primary w-100">
                                    <i class="fas fa-plus-circle"></i> Agregar Producto
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="../index.php" target="_blank" class="btn btn-success w-100">
                                    <i class="fas fa-eye"></i> Ver Sitio Web
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="productos.php" class="btn btn-info w-100">
                                    <i class="fas fa-box"></i> Gestionar Productos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Función para mostrar/ocultar mensaje completo
        function toggleMensaje(id) {
            const preview = document.getElementById('preview_' + id);
            const completo = document.getElementById('completo_' + id);
            
            if (preview.style.display === 'none') {
                preview.style.display = 'inline';
                completo.style.display = 'none';
            } else {
                preview.style.display = 'none';
                completo.style.display = 'inline';
            }
        }
        
        // Función para copiar mensaje al portapapeles
        function copiarMensaje(id) {
            const mensajeElement = document.getElementById('completo_' + id) || document.getElementById('preview_' + id);
            const texto = mensajeElement.innerText.replace(/Ver completo|Ver menos/g, '').trim();
            
            navigator.clipboard.writeText(texto).then(function() {
                // Mostrar notificación de éxito
                const btn = event.target.closest('button');
                const iconOriginal = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i>';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-outline-info');
                
                setTimeout(() => {
                    btn.innerHTML = iconOriginal;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-outline-info');
                }, 1500);
            }).catch(function(err) {
                console.error('Error al copiar: ', err);
                alert('No se pudo copiar el mensaje');
            });
        }
        
        // Highlight de mensajes nuevos
        document.addEventListener('DOMContentLoaded', function() {
            const mensajesNuevos = document.querySelectorAll('.badge-nuevo');
            mensajesNuevos.forEach(badge => {
                const row = badge.closest('tr');
                row.style.backgroundColor = 'rgba(40, 167, 69, 0.05)';
                row.style.borderLeft = '3px solid #28a745';
            });
        });
    </script>
</body>
</html>