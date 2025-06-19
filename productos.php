<?php
$pageTitle = 'Productos';
include_once 'includes/header.php';

$db = Database::getInstance();

// Obtener categorías para el filtro
$categorias = $db->select("SELECT * FROM categorias ORDER BY nombre");

// Manejar búsqueda por categoría
$categoriaSlug = isset($_GET['categoria']) ? sanitize($_GET['categoria']) : null;
$categoriaCondicion = $categoriaSlug ? "c.slug = ?" : "";
$categoriaParams = $categoriaSlug ? [$categoriaSlug] : [];

// Manejar visualización de detalles de un producto
if (isset($_GET['id'])) {
    $productoId = (int)$_GET['id'];
    $producto = $db->selectOne(
        "SELECT p.*, c.nombre as categoria_nombre 
        FROM productos p 
        JOIN categorias c ON p.categoria_id = c.id 
        WHERE p.id = ?", 
        [$productoId]
    );
    
    if ($producto) {
        // Mostrar detalle individual del producto
        ?>
        <div class="container py-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/productos.php">Productos</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/productos.php?categoria=<?php echo crearSlug($producto['categoria_nombre']); ?>"><?php echo sanitize($producto['categoria_nombre']); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo sanitize($producto['nombre']); ?></li>
                </ol>
            </nav>
            
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm">
                        <img src="<?php echo UPLOADS_URL; ?>/productos/<?php echo sanitize($producto['imagen']); ?>" 
                             alt="<?php echo sanitize($producto['nombre']); ?>" 
                             class="img-fluid rounded"
                             onerror="this.src='<?php echo SITE_URL; ?>/assets/img/producto-placeholder.jpg';this.onerror='';">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-3"><?php echo sanitize($producto['nombre']); ?></h1>
                    <p class="badge bg-secondary mb-3"><?php echo sanitize($producto['categoria_nombre']); ?></p>
                    <h3 class="text-primary-custom mb-4">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></h3>
                    <div class="mb-4">
                        <?php echo nl2br(sanitize($producto['descripcion'])); ?>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/<?php echo getConfiguracion('redes', 'whatsapp'); ?>?text=Hola, estoy interesado en el producto '<?php echo sanitize($producto['nombre']); ?>'. ¿Podrían darme más información?" 
                           class="btn btn-primary-custom btn-lg" target="_blank">
                            <i class="fab fa-whatsapp me-2"></i> Consultar disponibilidad
                        </a>
                        <a href="<?php echo SITE_URL; ?>/contacto.php?producto=<?php echo $producto['id']; ?>" 
                           class="btn btn-outline-dark btn-lg">
                            <i class="fas fa-envelope me-2"></i> Enviar consulta
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Productos relacionados -->
            <?php
            $relacionados = $db->select(
                "SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p 
                JOIN categorias c ON p.categoria_id = c.id 
                WHERE p.categoria_id = ? AND p.id != ? 
                ORDER BY RAND() 
                LIMIT 3", 
                [$producto['categoria_id'], $producto['id']]
            );
            
            if (count($relacionados) > 0): ?>
            <div class="mt-5">
                <h3 class="mb-4">Productos relacionados</h3>
                <div class="row">
                    <?php foreach ($relacionados as $relacionado): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <img src="<?php echo UPLOADS_URL; ?>/productos/<?php echo sanitize($relacionado['imagen']); ?>" 
                                 alt="<?php echo sanitize($relacionado['nombre']); ?>" 
                                 class="product-image card-img-top"
                                 onerror="this.src='<?php echo SITE_URL; ?>/assets/img/producto-placeholder.jpg';this.onerror='';">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo sanitize($relacionado['nombre']); ?></h5>
                                <p class="card-text text-muted mb-1"><?php echo sanitize($relacionado['categoria_nombre']); ?></p>
                                <p class="card-text">$<?php echo number_format($relacionado['precio'], 0, ',', '.'); ?></p>
                                <a href="<?php echo SITE_URL; ?>/productos.php?id=<?php echo $relacionado['id']; ?>" class="btn btn-primary-custom">Ver detalle</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
    } else {
        // Producto no encontrado
        echo '<div class="container py-5"><div class="alert alert-danger">El producto solicitado no existe.</div></div>';
    }
} else {
    // Calcular página actual para paginación
    $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $porPagina = 9;
    
    // Si hay filtro de categoría, aplicarlo
    $whereClause = $categoriaCondicion ? "WHERE $categoriaCondicion" : "";
    
    // Contar todos los productos
    $totalQuery = "SELECT COUNT(*) as total FROM productos p JOIN categorias c ON p.categoria_id = c.id $whereClause";
    $totalResult = $db->selectOne($totalQuery, $categoriaParams);
    $totalProductos = $totalResult['total'];
    
    // Calcular offset y total de páginas
    $offset = ($paginaActual - 1) * $porPagina;
    $totalPaginas = ceil($totalProductos / $porPagina);
    
    // Obtener productos paginados - VERSIÓN CORREGIDA SIN MARCADORES DE POSICIÓN EN LIMIT
    $query = "SELECT p.*, c.nombre as categoria_nombre, c.slug as categoria_slug 
              FROM productos p 
              JOIN categorias c ON p.categoria_id = c.id 
              $whereClause 
              ORDER BY p.created_at DESC 
              LIMIT $offset, $porPagina";
              
    $productos = $db->select($query, $categoriaParams);
    ?>
    
    <div class="container py-5">
        <h1 class="mb-5 text-center">Nuestros Productos</h1>
        
        <!-- Filtro de categorías -->
        <div class="mb-4 text-center">
            <div class="category-pill <?php echo !$categoriaSlug ? 'active' : ''; ?>" data-category="all">
                <a href="<?php echo SITE_URL; ?>/productos.php" class="text-decoration-none <?php echo !$categoriaSlug ? 'text-white' : 'text-dark'; ?>">
                    Todos
                </a>
            </div>
            <?php foreach ($categorias as $categoria): ?>
            <div class="category-pill <?php echo $categoriaSlug === $categoria['slug'] ? 'active' : ''; ?>">
                <a href="<?php echo SITE_URL; ?>/productos.php?categoria=<?php echo $categoria['slug']; ?>" 
                   class="text-decoration-none <?php echo $categoriaSlug === $categoria['slug'] ? 'text-white' : 'text-dark'; ?>">
                    <?php echo sanitize($categoria['nombre']); ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Listado de productos -->
        <div class="row" id="productContainer">
            <?php if (count($productos) > 0): ?>
                <?php foreach ($productos as $producto): ?>
                <div class="col-md-6 col-lg-4 mb-4 product-item" data-category="<?php echo sanitize($producto['categoria_slug']); ?>">
                    <div class="card product-card h-100">
                        <img src="<?php echo UPLOADS_URL; ?>/productos/<?php echo sanitize($producto['imagen']); ?>" 
                             alt="<?php echo sanitize($producto['nombre']); ?>" 
                             class="product-image card-img-top lazy-load" 
                             data-src="<?php echo UPLOADS_URL; ?>/productos/<?php echo sanitize($producto['imagen']); ?>"
                             onerror="this.src='<?php echo SITE_URL; ?>/assets/img/producto-placeholder.jpg';this.onerror='';">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo sanitize($producto['nombre']); ?></h5>
                            <p class="card-text text-muted mb-1"><?php echo sanitize($producto['categoria_nombre']); ?></p>
                            <p class="card-text">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>
                            <a href="<?php echo SITE_URL; ?>/productos.php?id=<?php echo $producto['id']; ?>" class="btn btn-primary-custom">Ver detalle</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No hay productos disponibles en esta categoría actualmente.
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Botón "Cargar más" para paginación -->
        <?php if ($paginaActual < $totalPaginas): ?>
        <div class="text-center mt-4">
            <button id="loadMoreBtn" class="btn btn-lg btn-outline-primary-custom">
                Cargar más productos
            </button>
        </div>
        <?php endif; ?>
    </div>
    <?php
}

include_once 'includes/footer.php';
?>
