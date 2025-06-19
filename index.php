<?php
$pageTitle = 'Inicio';
include_once 'includes/header.php';

// Obtener productos destacados
$db = Database::getInstance();
$productosDestacados = $db->select(
    "SELECT p.*, c.nombre as categoria_nombre 
    FROM productos p 
    JOIN categorias c ON p.categoria_id = c.id 
    WHERE p.destacado = 1 
    ORDER BY p.created_at DESC 
    LIMIT 6"
);

// Obtener testimonios
$testimonios = $db->select(
    "SELECT * FROM testimonios WHERE activo = 1 ORDER BY created_at DESC LIMIT 6"
);

// Obtener categorías
$categorias = $db->select("SELECT * FROM categorias ORDER BY nombre");
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('<?php echo SITE_URL; ?>/assets/img/hero-bg.jpg');">
    <div class="container h-100 d-flex flex-column justify-content-center">
        <div class="hero-content text-center">
            <h1 class="display-4 fw-bold mb-4">Arte y creatividad en el corazón de Cachagua</h1>
            <p class="lead mb-4">Descubre nuestras creaciones artísticas únicas: pinturas, grabados, cerámica y esculturas</p>
            <div class="d-flex justify-content-center">
                <a href="<?php echo SITE_URL; ?>/productos.php" class="btn btn-light btn-lg me-3">Ver productos</a>
                <a href="<?php echo SITE_URL; ?>/contacto.php" class="btn btn-outline-light btn-lg">Contáctanos</a>
            </div>
        </div>
    </div>
</section>

<!-- Categorías -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Nuestras categorías</h2>
        <div class="row justify-content-center">
            <?php foreach ($categorias as $categoria): ?>
            <div class="col-6 col-md-3 mb-4">
                <a href="<?php echo SITE_URL; ?>/productos.php?categoria=<?php echo $categoria['slug']; ?>" class="text-decoration-none">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <i class="<?php 
                                switch($categoria['slug']) {
                                    case 'pinturas': echo 'fas fa-paint-brush'; break;
                                    case 'grabados': echo 'fas fa-print'; break;
                                    case 'ceramica': echo 'fas fa-palette'; break;
                                    case 'esculturas': echo 'fas fa-monument'; break;
                                    default: echo 'fas fa-star';
                                }
                            ?> fa-3x mb-3 text-primary-custom"></i>
                            <h5 class="card-title"><?php echo sanitize($categoria['nombre']); ?></h5>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Productos destacados -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Productos destacados</h2>
        <div class="row">
            <?php if (count($productosDestacados) > 0): ?>
                <?php foreach ($productosDestacados as $producto): ?>
                <div class="col-md-6 col-lg-4 mb-4">
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
                    <div class="alert alert-info">
                        No hay productos destacados disponibles en este momento.
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/productos.php" class="btn btn-lg btn-outline-primary-custom">Ver todos los productos</a>
        </div>
    </div>
</section>

<!-- Quiénes somos -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="mb-4"><?php echo getConfiguracion('quienes_somos', 'titulo'); ?></h2>
                <div>
                    <?php echo getConfiguracion('quienes_somos', 'contenido'); ?>
                </div>
                <a href="<?php echo SITE_URL; ?>/quienes-somos.php" class="btn btn-primary-custom mt-3">Leer más</a>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="<?php echo SITE_URL; ?>/assets/img/taller.jpg" alt="Nuestro taller" class="img-fluid rounded shadow" onerror="this.src='<?php echo SITE_URL; ?>/assets/img/taller-placeholder.jpg';this.onerror='';">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonios -->
<?php if (count($testimonios) > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Lo que dicen nuestros clientes</h2>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($testimonios as $index => $testimonio): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="testimonial-card mx-auto" style="max-width: 700px;">
                        <div class="text-center mb-4">
                            <?php if (!empty($testimonio['imagen'])): ?>
                            <img src="<?php echo UPLOADS_URL; ?>/testimonios/<?php echo sanitize($testimonio['imagen']); ?>" 
                                 alt="<?php echo sanitize($testimonio['nombre']); ?>" 
                                 class="testimonial-image mb-3"
                                 onerror="this.src='<?php echo SITE_URL; ?>/assets/img/avatar-placeholder.jpg';this.onerror='';">
                            <?php endif; ?>
                            <h5><?php echo sanitize($testimonio['nombre']); ?></h5>
                        </div>
                        <p class="lead text-center">
                            <i class="fas fa-quote-left me-2 opacity-50"></i>
                            <?php echo sanitize($testimonio['comentario']); ?>
                            <i class="fas fa-quote-right ms-2 opacity-50"></i>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contacto rápido -->
<section class="py-5 bg-primary-custom text-white">
    <div class="container text-center">
        <h2 class="mb-4">¿Interesado en nuestros productos?</h2>
        <p class="lead mb-4">Contáctanos para consultas sobre disponibilidad, precios o visitas al taller</p>
        <a href="<?php echo SITE_URL; ?>/contacto.php" class="btn btn-light btn-lg">Contactar ahora</a>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>