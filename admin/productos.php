<?php
session_start();
require_once '../config/database.php';

// Verificar si está logueado
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$mensaje = '';
$tipo_mensaje = '';

// Procesar eliminación
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['delete']);
    
    // Obtener nombre de imagen para eliminar
    $query = "SELECT imagen FROM productos WHERE id = '$id'";
    $result = mysqli_query($conexion, $query);
    $producto = mysqli_fetch_assoc($result);
    
    // Eliminar producto
    $query = "DELETE FROM productos WHERE id = '$id'";
    if (mysqli_query($conexion, $query)) {
        // Eliminar imagen del servidor
        if (file_exists('../img/productos/' . $producto['imagen'])) {
            unlink('../img/productos/' . $producto['imagen']);
        }
        $mensaje = 'Producto eliminado correctamente';
        $tipo_mensaje = 'success';
    } else {
        $mensaje = 'Error al eliminar el producto';
        $tipo_mensaje = 'danger';
    }
}

// Procesar formulario de agregar/editar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $instagram_link = mysqli_real_escape_string($conexion, $_POST['instagram_link']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
    $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : null;
    
    // Procesar imagen
    $imagen_nombre = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $filename = $_FILES['imagen']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($ext), $allowed)) {
            $imagen_nombre = time() . '_' . $filename;
            $upload_path = '../img/productos/' . $imagen_nombre;
            
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_path)) {
                $mensaje = 'Error al subir la imagen';
                $tipo_mensaje = 'danger';
            }
        } else {
            $mensaje = 'Formato de imagen no permitido';
            $tipo_mensaje = 'danger';
        }
    }
    
    if (empty($mensaje)) {
        if ($producto_id) {
            // Actualizar producto existente
            if ($imagen_nombre) {
                // Si hay nueva imagen, eliminar la anterior
                $query = "SELECT imagen FROM productos WHERE id = '$producto_id'";
                $result = mysqli_query($conexion, $query);
                $old_producto = mysqli_fetch_assoc($result);
                if (file_exists('../img/productos/' . $old_producto['imagen'])) {
                    unlink('../img/productos/' . $old_producto['imagen']);
                }
                
                $query = "UPDATE productos SET nombre = '$nombre', imagen = '$imagen_nombre', 
                          instagram_link = '$instagram_link', categoria = '$categoria' 
                          WHERE id = '$producto_id'";
            } else {
                $query = "UPDATE productos SET nombre = '$nombre', 
                          instagram_link = '$instagram_link', categoria = '$categoria' 
                          WHERE id = '$producto_id'";
            }
            
            if (mysqli_query($conexion, $query)) {
                $mensaje = 'Producto actualizado correctamente';
                $tipo_mensaje = 'success';
            } else {
                $mensaje = 'Error al actualizar el producto';
                $tipo_mensaje = 'danger';
            }
        } else {
            // Agregar nuevo producto
            if ($imagen_nombre) {
                $query = "INSERT INTO productos (nombre, imagen, instagram_link, categoria) 
                          VALUES ('$nombre', '$imagen_nombre', '$instagram_link', '$categoria')";
                
                if (mysqli_query($conexion, $query)) {
                    $mensaje = 'Producto agregado correctamente';
                    $tipo_mensaje = 'success';
                } else {
                    $mensaje = 'Error al agregar el producto';
                    $tipo_mensaje = 'danger';
                }
            } else {
                $mensaje = 'Debe seleccionar una imagen';
                $tipo_mensaje = 'danger';
            }
        }
    }
}

// Obtener producto para editar
$producto_editar = null;
if (isset($_GET['edit'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['edit']);
    $query = "SELECT * FROM productos WHERE id = '$id'";
    $result = mysqli_query($conexion, $query);
    $producto_editar = mysqli_fetch_assoc($result);
}

// Obtener todos los productos
$query = "SELECT * FROM productos ORDER BY created_at DESC";
$productos = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Casa Taller Cachagua Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
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
                <h1 class="mb-4">Gestión de Productos</h1>
                
                <?php if ($mensaje): ?>
                    <div class="alert alert-<?php echo $tipo_mensaje; ?> alert-dismissible fade show" role="alert">
                        <i class="fas fa-<?php echo $tipo_mensaje == 'success' ? 'check' : 'exclamation'; ?>-circle"></i> 
                        <?php echo $mensaje; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <!-- Formulario Agregar/Editar -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-<?php echo $producto_editar ? 'edit' : 'plus'; ?>"></i> 
                            <?php echo $producto_editar ? 'Editar' : 'Agregar'; ?> Producto
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <?php if ($producto_editar): ?>
                                <input type="hidden" name="producto_id" value="<?php echo $producto_editar['id']; ?>">
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Producto *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       value="<?php echo $producto_editar ? htmlspecialchars($producto_editar['nombre']) : ''; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría *</label>
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="pinturas" <?php echo ($producto_editar && $producto_editar['categoria'] == 'pinturas') ? 'selected' : ''; ?>>Pinturas</option>
                                    <option value="ceramica" <?php echo ($producto_editar && $producto_editar['categoria'] == 'ceramica') ? 'selected' : ''; ?>>Cerámica</option>
                                    <option value="grabados" <?php echo ($producto_editar && $producto_editar['categoria'] == 'grabados') ? 'selected' : ''; ?>>Grabados</option>
                                    <option value="esculturas" <?php echo ($producto_editar && $producto_editar['categoria'] == 'esculturas') ? 'selected' : ''; ?>>Esculturas</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="instagram_link" class="form-label">Link de Instagram</label>
                                <input type="url" class="form-control" id="instagram_link" name="instagram_link" 
                                       placeholder="https://instagram.com/p/..."
                                       value="<?php echo $producto_editar ? htmlspecialchars($producto_editar['instagram_link']) : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="imagen" class="form-label">
                                    Imagen <?php echo $producto_editar ? '(dejar vacío para mantener actual)' : '*'; ?>
                                </label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*"
                                       <?php echo $producto_editar ? '' : 'required'; ?>>
                                <?php if ($producto_editar && $producto_editar['imagen']): ?>
                                    <div class="mt-2">
                                        <small>Imagen actual:</small><br>
                                        <img src="../img/productos/<?php echo $producto_editar['imagen']; ?>" 
                                             alt="Imagen actual" style="max-width: 100px;">
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save"></i> 
                                <?php echo $producto_editar ? 'Actualizar' : 'Agregar'; ?> Producto
                            </button>
                            
                            <?php if ($producto_editar): ?>
                                <a href="productos.php" class="btn btn-secondary w-100 mt-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Lista de Productos -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-list"></i> Lista de Productos</h5>
                    </div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($productos) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Categoría</th>
                                            <th>Instagram</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($producto = mysqli_fetch_assoc($productos)): ?>
                                            <tr>
                                                <td>
                                                    <img src="../img/productos/<?php echo $producto['imagen']; ?>" 
                                                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        <?php echo ucfirst($producto['categoria']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($producto['instagram_link']): ?>
                                                        <a href="<?php echo $producto['instagram_link']; ?>" target="_blank">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="?edit=<?php echo $producto['id']; ?>" 
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="?delete=<?php echo $producto['id']; ?>" 
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted text-center">No hay productos registrados</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>