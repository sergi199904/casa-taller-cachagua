<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Taller Cachagua - Arte & Artesanía</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Casa Taller Cachagua - Arte y artesanía única en cerámica, pinturas, grabados y esculturas. Visítanos en Cachagua, Valparaíso.">
    <meta name="keywords" content="arte, artesanía, cerámica, cachagua, taller, pinturas, grabados">
    <meta property="og:title" content="Casa Taller Cachagua">
    <meta property="og:description" content="Arte y artesanía con amor desde Cachagua">
    <meta property="og:image" content="img/general/og-image.jpg">
    <meta property="og:url" content="https://casatallercachagua.cl">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">Casa Taller Cachagua</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#productos">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ubicacion">Ubicación</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carrusel Promocional -->
    <section id="home" class="pt-5">
        <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/banners/banner1.jpg" class="d-block w-100" alt="Nueva Colección">
                    <div class="carousel-caption">
                        <h2>Nueva Colección</h2>
                        <p>Descubre nuestras últimas creaciones artesanales</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/banners/banner2.jpg" class="d-block w-100" alt="Ofertas Especiales">
                    <div class="carousel-caption">
                        <h2>Ofertas Especiales</h2>
                        <p>Hasta 30% de descuento en piezas seleccionadas</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/banners/banner3.jpg" class="d-block w-100" alt="Arte Único">
                    <div class="carousel-caption">
                        <h2>Arte Único</h2>
                        <p>Cada pieza cuenta una historia</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanners" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBanners" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Sección Nosotros -->
    <section id="nosotros" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div id="carouselNosotros" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="3"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="4"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="5"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/general/pareja-ceramica.jpg" class="d-block w-100" alt="Casa Taller Cachagua">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/taller2.jpg" class="d-block w-100" alt="Taller">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/taller3.jpg" class="d-block w-100" alt="Creaciones">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/taller4.jpg" class="d-block w-100" alt="Arte">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/taller5.jpg" class="d-block w-100" alt="Proceso">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/taller6.jpg" class="d-block w-100" alt="Artesanía">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselNosotros" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselNosotros" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-7 ps-lg-5">
                    <h2>¿Quienes somos?</h2>
                    <div class="nosotros-text">
                        <p>Somos una pareja que vive en el tranquilo y hermoso pueblo de Cachagua, un lugar que inspira cada rincón de nuestro día a día. Aquí, entre la calma del paisaje y la rica tradición cultural, hemos encontrado un espacio para crear y compartir nuestra pasión por el arte.</p>
                        <p>Nos encantaría abrir las puertas de nuestro hogar para recibirte, mostrarte el arte que nace aquí y compartir momentos únicos contigo. Ya sea que vengas por curiosidad, para explorar nuevas ideas o simplemente para disfrutar del arte, siempre serás bienvenido en este espacio lleno de creatividad y amor.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería de Productos -->
    <section id="productos" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Nuestros Productos</h2>
            
            <!-- Filtros de categoría -->
            <div class="text-center mb-4">
                <button class="btn btn-outline-primary mx-1 filter-btn active" data-filter="all">Todos</button>
                <button class="btn btn-outline-primary mx-1 filter-btn" data-filter="pinturas">Pinturas</button>
                <button class="btn btn-outline-primary mx-1 filter-btn" data-filter="ceramica">Cerámica</button>
                <button class="btn btn-outline-primary mx-1 filter-btn" data-filter="grabados">Grabados</button>
                <button class="btn btn-outline-primary mx-1 filter-btn" data-filter="esculturas">Esculturas</button>
            </div>

            <div class="row g-4" id="productos-container">
                <?php
                $query = "SELECT * FROM productos ORDER BY created_at DESC";
                $result = $conexion->query($query);
                
                if ($result && $result->num_rows > 0) {
                    while ($producto = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-4 col-sm-6 producto-item" data-categoria="<?php echo htmlspecialchars($producto['categoria']); ?>">
                            <div class="card h-100 shadow-sm producto-card">
                                <div class="producto-img-wrapper">
                                    <img src="img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" 
                                         class="card-img-top producto-img" 
                                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                    <?php if ($producto['instagram_link']) { ?>
                                        <a href="<?php echo htmlspecialchars($producto['instagram_link']); ?>" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fab fa-instagram"></i> Ver en Instagram
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12 text-center"><p>No hay productos disponibles en este momento.</p></div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="py-5 testimonios-section">
        <div class="container">
            <h2 class="text-center mb-5">Lo que dicen nuestros clientes</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"Excelente!!!"</p>
                            <h6 class="card-subtitle text-muted">@piaojedav</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"Me encantó!! Compré un macetero para mi lavanda y se ve muy lindo. Francisca es muy simpática!"</p>
                            <h6 class="card-subtitle text-muted">@mauraaa.fd</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"Compré una xilografía para mi living hace unos meses y la pintura aún dura, muy lindos colores."</p>
                            <h6 class="card-subtitle text-muted">@karmcita_2511</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ubicación -->
    <section id="ubicacion" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Encuéntranos</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3344.8977693686!2d-71.44918642346!3d-32.51125897377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9689d45e7c75c7d5%3A0x9f4e2c8f0c3e5a5e!2sCachagua%2C%20Zapallar%2C%20Valpara%C3%ADso!5e0!3m2!1ses!2scl!4v1234567890" 
                            width="100%" 
                            height="300" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                    <div class="text-center mt-4">
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> Cachagua, Zapallar, Región de Valparaíso</p>
                        <p><i class="fas fa-phone"></i> +56 9 XXXX XXXX</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Contacto -->
    <section id="contacto" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Contáctanos</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form id="contactForm" action="mail/send_contact.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-12">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="col-12">
                                <label for="mensaje" class="form-label">Mensaje *</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane"></i> Enviar Mensaje
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="formMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <h5>Casa Taller Cachagua</h5>
                    <p class="mb-0">Arte y artesanía con amor</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="social-links">
                        <a href="https://instagram.com/casatallercachagua" target="_blank" class="text-white me-3">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://wa.me/56912345678" target="_blank" class="text-white">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                    <p class="mt-2 mb-0">&copy; 2025 Casa Taller Cachagua. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>