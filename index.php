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
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
        <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/banners/banner1.jpeg" class="d-block w-100" alt="Nueva Colección" loading="eager">
                    <div class="carousel-caption">
                        <h2>Nueva Colección</h2>
                        <p>Descubre nuestras últimas creaciones artesanales</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/banners/banner2.jpeg" class="d-block w-100" alt="Ofertas Especiales" loading="lazy">
                    <div class="carousel-caption">
                        <h2>Piezas Exclusivas</h2>
                        <p>Creaciones únicas hechas a mano</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/banners/banner3.jpeg" class="d-block w-100" alt="Arte Único" loading="lazy">
                    <div class="carousel-caption">
                        <h2>Arte Único</h2>
                        <p>Cada pieza cuenta una historia</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanners" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBanners" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    <!-- Sección Nosotros -->
    <section id="nosotros" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div id="carouselNosotros" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="3"></button>
                            <button type="button" data-bs-target="#carouselNosotros" data-bs-slide-to="4"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/general/Parte de Nosotros 1.jpeg" class="d-block w-100" alt="Casa Taller Cachagua" loading="lazy">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/Parte de Nosotros 2.jpg" class="d-block w-100" alt="Taller" loading="lazy">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/Parte de nosotros3.jpeg" class="d-block w-100" alt="Creaciones" loading="lazy">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/Parte de Nosotros 4.jpg" class="d-block w-100" alt="Arte" loading="lazy">
                            </div>
                            <div class="carousel-item">
                                <img src="img/general/Parte de Nosotros 5.jpg" class="d-block w-100" alt="Proceso" loading="lazy">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselNosotros" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselNosotros" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-7 ps-lg-5">
                    <h2>¿Quienes somos?</h2>
                    <div class="nosotros-text">
                        <p>Somos Francisca Castillo Carmona y Álvaro Pérez Wilson, pareja de artistas que hace años eligió la costa de Cachagua, comuna de Zapallar, para vivir y crear.</p>

                        <p>Álvaro es pintor con más de 30 años de oficio; sus paisajes capturan in situ la luz y la vida de nuestras playas y paseos costeros. También modela piezas en cerámica gres.</p>

                        <p>Francisca es artista autodidacta formada en talleres de México y Chile; se dedica a la xilografía y a la cerámica gres, siempre explorando texturas y colores vibrantes.</p>

                        <p>Nuestra casa-taller es un refugio donde el arte se ve, se respira y se vive cada día. Aquí producimos obras únicas, exhibimos nuestras colecciones y recibimos a quienes buscan piezas originales hechas a mano. Participamos en ferias y exposiciones locales e internacionales, llevando un pedacito de Cachagua a cada rincón.</p>

                        <p>Casa Taller Cachagua es nuestro proyecto de vida: un espacio que une hogar y creatividad, y que invita a conectar con la alegría y el valor de lo hecho con pasión y oficio.</p>
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
                                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                         loading="lazy">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                    <?php if ($producto['instagram_link']) { ?>
                                        <a href="<?php echo htmlspecialchars($producto['instagram_link']); ?>" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
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
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
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
                    <form id="contactForm" action="mail/send_contact.php" method="POST" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required maxlength="100">
                            </div>
                            <div class="col-12">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" maxlength="20" placeholder="+56 9 XXXX XXXX">
                            </div>
                            <div class="col-12">
                                <label for="mensaje" class="form-label">Mensaje *</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required minlength="10" maxlength="1000" placeholder="Escribe tu mensaje aquí..."></textarea>
                                <div class="form-text">Mínimo 10 caracteres, máximo 1000.</div>
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
                        <a href="https://instagram.com/casatallercachagua" target="_blank" rel="noopener noreferrer" class="text-white me-3">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://wa.me/56912345678" target="_blank" rel="noopener noreferrer" class="text-white">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                    <p class="mt-2 mb-0">&copy; 2025 Casa Taller Cachagua. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Botón de Acceso a Administración -->
    <a href="admin/login.php" class="btn admin-access-btn" title="Acceso Administrador">
        <i class="fas fa-cog"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>