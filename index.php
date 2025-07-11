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
    
    <!-- Google Fonts - Nueva Tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="img/Logoo.png" as="image" type="image/png">
    <link rel="preload" href="img/banners/1.jpeg" as="image" type="image/jpeg">
</head>
<body>
    <!-- Header/Navbar con Logo Mejorado -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Logo mejorado con atributos optimizados -->
            <a class="navbar-brand" href="#home" title="Casa Taller Cachagua - Inicio">
                <img src="img/Logoo.png" 
                     alt="Casa Taller Cachagua - Arte y Artesanía" 
                     class="navbar-logo"
                     loading="eager"
                     fetchpriority="high">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

    <!-- Carrusel Promocional - ACTUALIZADO CON IMÁGENES DE CERÁMICA -->
    <section id="home" class="pt-5">
        <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselBanners" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/banners/1.jpeg" class="d-block w-100" alt="Bowl de Cerámica Artesanal" loading="eager">
                    <div class="carousel-caption">
                        <h2>Bienvenidos a Casa Taller Cachagua</h2>
                        <p>Arte y artesanía con amor desde la costa de Cachagua</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/banners/3.jpeg" class="d-block w-100" alt="Plato Decorativo de Cerámica" loading="lazy">
                    <!-- SIN carousel-caption -->
                </div>
                <div class="carousel-item">
                    <img src="img/banners/7.jpeg" class="d-block w-100" alt="Recipiente de Cerámica Minimalista" loading="lazy">
                    <!-- SIN carousel-caption -->
                </div>
                <div class="carousel-item">
                    <img src="img/banners/9.jpeg" class="d-block w-100" alt="Vasija Multicolor Artesanal" loading="lazy">
                    <!-- SIN carousel-caption -->
                </div>
                <div class="carousel-item">
                    <img src="img/banners/10.jpeg" class="d-block w-100" alt="Vasija Grande Escultórica" loading="lazy">
                    <!-- SIN carousel-caption -->
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

    <!-- Sección Nosotros - CENTRADA -->
    <section id="nosotros" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <h2 class="text-center mb-5">¿Quienes somos?</h2>
                    <div class="nosotros-text text-center">
                        <p class="mb-4">Somos <span class="highlight">Francisca Castillo Carmona</span> y <span class="highlight">Álvaro Pérez Wilson</span>, pareja de artistas que hace años eligió la costa de Cachagua, comuna de Zapallar, para vivir y crear.</p>

                        <p class="mb-4">Álvaro es pintor con más de 30 años de oficio; sus paisajes capturan in situ la luz y la vida de nuestras playas y paseos costeros. También modela piezas en cerámica gres.</p>

                        <p class="mb-4">Francisca es artista autodidacta formada en talleres de México y Chile; se dedica a la xilografía y a la cerámica gres, siempre explorando texturas y colores vibrantes.</p>

                        <p class="mb-4">Nuestra <span class="accent-text">casa-taller</span> es un refugio donde el arte se ve, se respira y se vive cada día. Aquí producimos obras únicas, exhibimos nuestras colecciones y recibimos a quienes buscan piezas originales hechas a mano. Participamos en ferias y exposiciones locales e internacionales, llevando un pedacito de Cachagua a cada rincón.</p>

                        <p class="mb-0"><strong>Casa Taller Cachagua</strong> es nuestro proyecto de vida: un espacio que une hogar y creatividad, y que invita a conectar con la alegría y el valor de lo hecho con pasión y oficio.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sección Procesos - RUTAS CORREGIDAS -->
    <section id="procesos" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="text-center mb-5">Nuestros Procesos</h2>
                    <div class="text-center mb-5">
                        <p class="lead text-muted">Descubre cómo creamos nuestras piezas únicas en cerámica gres</p>
                    </div>
                    
                    <!-- Proceso: Piezas en Cerámica Gres -->
                    <div class="proceso-container mb-5">
                        <h3 class="text-center mb-4 proceso-title">
                            <i class="fas fa-fire-alt text-primary me-2"></i>
                            Piezas en Cerámica Gres
                        </h3>
                        
                        <!-- Pasos del proceso - RUTAS CORREGIDAS -->
                        <div class="row g-4">
                            <!-- Paso 1: Eligiendo el esmalte -->
                            <div class="col-lg-4 col-md-6">
                                <div class="proceso-step text-center">
                                    <div class="step-number">1</div>
                                    <div class="proceso-img-wrapper">
        
                                        <img src="img\Procesos\Paso 1.png" 
                                             alt="Eligiendo el esmalte, pieza recién bizcochada" 
                                             class="proceso-img"
                                             loading="lazy"
                                             style="opacity: 1 !important; visibility: visible !important;">
                                    </div>
                                    <h5 class="proceso-step-title">Eligiendo el esmalte</h5>
                                    <p class="proceso-step-desc">Pieza recién bizcochada lista para seleccionar el esmalte perfecto que le dará color y textura única.</p>
                                </div>
                            </div>
                            
                            <!-- Paso 2: Esmaltando -->
                            <div class="col-lg-4 col-md-6">
                                <div class="proceso-step text-center">
                                    <div class="step-number">2</div>
                                    <div class="proceso-img-wrapper">
                                     
                                        <img src="img\Procesos\Paso 2.png" 
                                             alt="Proceso de esmaltado de cerámica" 
                                             class="proceso-img"
                                             loading="lazy"
                                             style="opacity: 1 !important; visibility: visible !important;">
                                    </div>
                                    <h5 class="proceso-step-title">Esmaltando</h5>
                                    <p class="proceso-step-desc">Aplicación cuidadosa del esmalte sobre la superficie, una técnica que requiere precisión y experiencia.</p>
                                </div>
                            </div>
                            
                            <!-- Paso 3: Esperando a entrar al horno -->
                            <div class="col-lg-4 col-md-6">
                                <div class="proceso-step text-center">
                                    <div class="step-number">3</div>
                                    <div class="proceso-img-wrapper">
                                
                                        <img src="img\Procesos\Paso 3.png" 
                                             alt="Piezas esperando a entrar al horno de esmalte" 
                                             class="proceso-img"
                                             loading="lazy"
                                             style="opacity: 1 !important; visibility: visible !important;">
                                    </div>
                                    <h5 class="proceso-step-title">Esperando a entrar al horno</h5>
                                    <p class="proceso-step-desc">Las piezas esmaltadas aguardan pacientemente su turno para la transformación final en el horno.</p>
                                </div>
                            </div>
                            
                            <!-- Paso 4: Listo horno esmalte -->
                            <div class="col-lg-6 col-md-6">
                                <div class="proceso-step text-center">
                                    <div class="step-number">4</div>
                                    <div class="proceso-img-wrapper">
                                       
                                        <img src="img\Procesos\Paso 4.png" 
                                             alt="Horno de esmalte listo para la cocción" 
                                             class="proceso-img"
                                             loading="lazy"
                                             style="opacity: 1 !important; visibility: visible !important;">
                                    </div>
                                    <h5 class="proceso-step-title">Listo horno esmalte</h5>
                                    <p class="proceso-step-desc">El horno alcanza la temperatura perfecta para fusionar el esmalte con la cerámica en un proceso mágico.</p>
                                </div>
                            </div>
                            
                            <!-- Paso 5: Pieza saliendo del horno final -->
                            <div class="col-lg-6 col-md-6">
                                <div class="proceso-step text-center">
                                    <div class="step-number">5</div>
                                    <div class="proceso-img-wrapper">
                                     
                                        <img src="img\Procesos\Paso 5.png" 
                                             alt="Pieza de cerámica saliendo del horno terminada" 
                                             class="proceso-img"
                                             loading="lazy"
                                             style="opacity: 1 !important; visibility: visible !important;">
                                    </div>
                                    <h5 class="proceso-step-title">Pieza saliendo del horno final</h5>
                                    <p class="proceso-step-desc">El momento culminante: la pieza emerge del horno transformada, revelando colores y texturas únicos.</p>
                                </div>
                            </div>
                        </div>
                        
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
                                    <span class="badge bg-secondary mb-2"><?php echo ucfirst($producto['categoria']); ?></span>
                                    <?php if ($producto['instagram_link']) { ?>
                                        <div class="mt-3">
                                            <a href="<?php echo htmlspecialchars($producto['instagram_link']); ?>" 
                                               target="_blank" 
                                               rel="noopener noreferrer"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fab fa-instagram"></i> Ver en Instagram
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12 text-center"><p class="text-muted">No hay productos disponibles en este momento.</p></div>';
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
                            <p class="card-text">"<em>Excelente!!!</em>"</p>
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
                            <p class="card-text">"<em>Me encantó!! Compré un macetero para mi lavanda y se ve muy lindo. Francisca es muy simpática!</em>"</p>
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
                            <p class="card-text">"<em>Compré una xilografía para mi living hace unos meses y la pintura aún dura, muy lindos colores.</em>"</p>
                            <h6 class="card-subtitle text-muted">@karmcita_2511</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ubicación - MAPA ACTUALIZADO -->
    <section id="ubicacion" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Encuéntranos</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="map-container">
                        <iframe 
                            src="https://maps.google.com/maps?q=32°34'32.8%22S+71°26'56.7%22W&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="300" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="text-center mt-4">
                        <p class="mb-1"><i class="fas fa-map-marker-alt text-primary"></i> <strong>Cachagua, Zapallar, Región de Valparaíso</strong></p>
                        <p class="text-muted"><i class="fas fa-phone text-primary"></i> Contáctanos para coordinar tu visita</p>
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
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
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
                        </div>
                    </div>
                    <div id="formMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <h5 class="mb-3">Casa Taller Cachagua</h5>
                    <p class="mb-2">Arte y artesanía con amor desde Cachagua</p>
                    <p class="text-muted mb-0">
                        <i class="fas fa-map-marker-alt"></i> 
                        Cachagua, Zapallar, Región de Valparaíso
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <h6 class="mb-3">Síguenos</h6>
                    <div class="social-links mb-3">
                        <a href="https://instagram.com/casatallercachagua" target="_blank" rel="noopener noreferrer" class="text-white me-3" title="Instagram">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://wa.me/56912345678" target="_blank" rel="noopener noreferrer" class="text-white" title="WhatsApp">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-muted mb-0">&copy; 2025 Casa Taller Cachagua. Todos los derechos reservados.</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <hr class="border-light opacity-25">
                    <p class="text-muted mb-0 small">
                        Desarrollado con <i class="fas fa-heart text-danger"></i> para el arte y la creatividad
                    </p>
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
    
    <!-- Script adicional para asegurar funcionamiento del carrusel y logo -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración específica para cada carrusel
            
            // Carrusel principal
            const mainCarousel = document.getElementById('carouselBanners');
            if (mainCarousel) {
                new bootstrap.Carousel(mainCarousel, {
                    interval: 4000,
                    wrap: true,
                    keyboard: true,
                    pause: 'hover',
                    ride: 'carousel'
                });
            }
            
            // Carrusel de nosotros - Configuración simple y funcional
            const nosotrosCarousel = document.getElementById('carouselNosotros');
            if (nosotrosCarousel) {
                new bootstrap.Carousel(nosotrosCarousel, {
                    interval: 5000, 
                    wrap: true,
                    keyboard: true,
                    pause: 'hover',
                    ride: 'carousel'
                });
            }

            // Verificación del logo
            const logo = document.querySelector('.navbar-logo');
            if (logo) {
                // Añadir clase loaded cuando el logo se carga
                if (logo.complete) {
                    logo.classList.add('loaded');
                } else {
                    logo.addEventListener('load', function() {
                        this.classList.add('loaded');
                    });
                }
            }

            // Mensaje de bienvenida con nueva paleta
            console.log('%c🎨 Casa Taller Cachagua', 'color: #4567B7; font-size: 20px; font-weight: bold;');
            console.log('%cSección Nosotros centrada correctamente', 'color: #8BC34A; font-size: 14px;');
            console.log('%cMapa actualizado con nueva ubicación', 'color: #7A288A; font-size: 12px;');
        });

        // Función para mostrar la paleta de colores en consola (desarrollo)
        if (window.location.hostname === 'localhost') {
            console.group('🎨 Cambios Implementados');
            console.log('%cSección Nosotros: ✅ Centrada', 'color: #4567B7; font-weight: bold;');
            console.log('%cMapa: ✅ Actualizado con nueva URL', 'color: #8BC34A; font-weight: bold;');
            console.groupEnd();
        }
    </script>
</body>
</html>