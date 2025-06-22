<?php
session_start();
require_once '../config/database.php';

// Verificar si está logueado
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Obtener estadísticas
$stats = array();

// Total de productos
$query = "SELECT COUNT(*) as total FROM productos";
$result = mysqli_query($conexion, $query);
$stats['productos'] = mysqli_fetch_assoc($result)['total'];

// Total de mensajes
$query = "SELECT COUNT(*) as total FROM contactos";
$result = mysqli_query($conexion, $query);
$stats['mensajes'] = mysqli_fetch_assoc($result)['total'];

// Mensajes recientes
$query = "SELECT * FROM contactos ORDER BY fecha DESC LIMIT 5";
$mensajes_recientes = mysqli_query($conexion, $query);
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
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">
                <i class="fas fa-palette"></i> Casa Taller Admin
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
                        <i class="fas fa-user"></i> <?php echo $_SESSION['admin_nombre']; ?>
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
                                <h2 class="mb-0"><?php echo $stats['productos']; ?></h2>
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
                                <h2 class="mb-0"><?php echo $stats['mensajes']; ?></h2>
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

        <!-- Mensajes Recientes -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-envelope"></i> Mensajes Recientes</h5>
                    </div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($mensajes_recientes) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Mensaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($mensaje = mysqli_fetch_assoc($mensajes_recientes)): ?>
                                            <tr>
                                                <td><?php echo date('d/m/Y H:i', strtotime($mensaje['fecha'])); ?></td>
                                                <td><?php echo htmlspecialchars($mensaje['nombre']); ?></td>
                                                <td><?php echo htmlspecialchars($mensaje['email']); ?></td>
                                                <td><?php echo substr(htmlspecialchars($mensaje['mensaje']), 0, 100) . '...'; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted text-center">No hay mensajes recientes</p>
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
</body>
</html>