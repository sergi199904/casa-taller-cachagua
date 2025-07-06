// main.js - JavaScript Principal con validaciones mejoradas y logo optimizado

document.addEventListener('DOMContentLoaded', function() {
    
    // ================================================
    // GESTIÓN DEL LOGO DEL NAVBAR MEJORADA
    // ================================================
    
    function initializeLogo() {
        const logo = document.querySelector('.navbar-logo');
        
        if (logo) {
            // Función para manejar la carga del logo
            function handleLogoLoad() {
                logo.classList.add('loaded');
                logo.style.opacity = '1';
                console.log('✅ Logo cargado exitosamente');
            }
            
            // Función para manejar errores de carga
            function handleLogoError() {
                console.warn('⚠️ Logo no se pudo cargar:', logo.src);
                // Crear texto alternativo
                const textFallback = document.createElement('span');
                textFallback.textContent = 'Casa Taller Cachagua';
                textFallback.style.cssText = `
                    color: white;
                    font-size: 1.5rem;
                    font-weight: 700;
                    font-family: 'Open Sans', sans-serif;
                    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                `;
                logo.parentNode.replaceChild(textFallback, logo);
            }
            
            // Event listeners para el logo
            logo.addEventListener('load', handleLogoLoad);
            logo.addEventListener('error', handleLogoError);
            
            // Si el logo ya está cargado
            if (logo.complete && logo.naturalHeight !== 0) {
                handleLogoLoad();
            }
            
            // Ajustar logo según dispositivo
            adjustLogoForDevice();
        }
    }
    
    // Función para ajustar el logo según el dispositivo
    function adjustLogoForDevice() {
        const logo = document.querySelector('.navbar-logo');
        if (!logo) return;
        
        const isDesktop = window.innerWidth > 991;
        const isTablet = window.innerWidth > 768 && window.innerWidth <= 991;
        const isMobile = window.innerWidth <= 768;
        
        // Remover clases previas
        logo.classList.remove('logo-desktop', 'logo-tablet', 'logo-mobile');
        
        // Agregar clase según dispositivo
        if (isDesktop) {
            logo.classList.add('logo-desktop');
        } else if (isTablet) {
            logo.classList.add('logo-tablet');
        } else {
            logo.classList.add('logo-mobile');
        }
        
        console.log(`📱 Logo ajustado para: ${isDesktop ? 'Desktop' : isTablet ? 'Tablet' : 'Mobile'}`);
    }
    
    // ================================================
    // NAVBAR CON SCROLL DINÁMICO MEJORADO
    // ================================================
    
    const navbar = document.querySelector('.navbar');
    let isScrolled = false;
    
    function handleNavbarScroll() {
        const scrollPosition = window.scrollY;
        
        if (scrollPosition > 50 && !isScrolled) {
            // Al hacer scroll hacia abajo
            navbar.classList.add('shadow-lg', 'scrolled');
            isScrolled = true;
        } else if (scrollPosition <= 50 && isScrolled) {
            // Al volver arriba
            navbar.classList.remove('shadow-lg', 'scrolled');
            isScrolled = false;
        }
    }
    
    // Optimizar con requestAnimationFrame para mejor performance
    let ticking = false;
    
    function optimizedScrollHandler() {
        if (!ticking) {
            requestAnimationFrame(() => {
                handleNavbarScroll();
                animateOnScroll(); // Combinar con animaciones
                ticking = false;
            });
            ticking = true;
        }
    }
    
    // ================================================
    // SMOOTH SCROLLING PARA MENÚ
    // ================================================
    
    const navLinks = document.querySelectorAll('.navbar-nav a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 100; // Ajustado para navbar más grande
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ================================================
    // FILTRO DE PRODUCTOS MEJORADO
    // ================================================
    
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.producto-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remover clase active de todos los botones
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Agregar clase active al botón clickeado
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            // Animación de filtrado
            productItems.forEach((item, index) => {
                setTimeout(() => {
                    if (filterValue === 'all') {
                        item.classList.remove('hidden');
                        item.style.display = 'block';
                        item.style.animation = 'fadeIn 0.5s ease';
                    } else {
                        if (item.getAttribute('data-categoria') === filterValue) {
                            item.classList.remove('hidden');
                            item.style.display = 'block';
                            item.style.animation = 'fadeIn 0.5s ease';
                        } else {
                            item.classList.add('hidden');
                            item.style.display = 'none';
                        }
                    }
                }, index * 50); // Animación escalonada
            });
        });
    });

    // ================================================
    // VALIDACIÓN DE FORMULARIO AVANZADA
    // ================================================
    
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');
    
    // Campos del formulario
    const nombreField = document.getElementById('nombre');
    const emailField = document.getElementById('email');
    const telefonoField = document.getElementById('telefono');
    const mensajeField = document.getElementById('mensaje');

    // Funciones de validación mejoradas
    function validateName(name) {
        const nameRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/;
        return nameRegex.test(name.trim());
    }

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email.trim());
    }

    function validatePhone(phone) {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,15}$/;
        return phone === '' || phoneRegex.test(phone.trim());
    }

    function validateMessage(message) {
        return message.trim().length >= 10 && message.trim().length <= 1000;
    }

    // Mostrar/ocultar mensajes de error
    function showFieldError(field, message) {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        
        let errorDiv = field.nextElementSibling;
        if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
            errorDiv = document.createElement('div');
            errorDiv.classList.add('invalid-feedback');
            field.parentNode.insertBefore(errorDiv, field.nextSibling);
        }
        errorDiv.textContent = message;
    }

    function showFieldSuccess(field) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        
        const errorDiv = field.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
            errorDiv.remove();
        }
    }

    // Validación en tiempo real
    if (nombreField) {
        nombreField.addEventListener('blur', function() {
            if (!validateName(this.value)) {
                showFieldError(this, 'El nombre debe contener solo letras y tener entre 2 y 50 caracteres');
            } else {
                showFieldSuccess(this);
            }
        });

        nombreField.addEventListener('input', function() {
            // Remover números y caracteres especiales mientras escribe
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
        });
    }

    if (emailField) {
        emailField.addEventListener('blur', function() {
            if (!validateEmail(this.value)) {
                showFieldError(this, 'Ingrese un email válido (ejemplo: nombre@email.com)');
            } else {
                showFieldSuccess(this);
            }
        });
    }

    if (telefonoField) {
        telefonoField.addEventListener('blur', function() {
            if (!validatePhone(this.value)) {
                showFieldError(this, 'Ingrese un teléfono válido (8-15 dígitos)');
            } else {
                showFieldSuccess(this);
            }
        });

        telefonoField.addEventListener('input', function() {
            // Permitir solo números, espacios, guiones y paréntesis
            this.value = this.value.replace(/[^0-9\s\-\(\)\+]/g, '');
        });
    }

    if (mensajeField) {
        mensajeField.addEventListener('blur', function() {
            if (!validateMessage(this.value)) {
                showFieldError(this, 'El mensaje debe tener entre 10 y 1000 caracteres');
            } else {
                showFieldSuccess(this);
            }
        });

        // Contador de caracteres mejorado
        mensajeField.addEventListener('input', function() {
            const charCount = this.value.length;
            const maxChars = 1000;
            
            // Buscar o crear el contador
            let counter = document.getElementById('charCounter');
            if (!counter) {
                counter = document.createElement('small');
                counter.id = 'charCounter';
                counter.classList.add('form-text');
                this.parentNode.appendChild(counter);
            }
            
            counter.textContent = `${charCount}/${maxChars} caracteres`;
            
            if (charCount < 10) {
                counter.className = 'form-text text-danger';
            } else if (charCount > 900) {
                counter.className = 'form-text text-warning';
            } else {
                counter.className = 'form-text text-muted';
            }
        });
    }

    // ================================================
    // MODAL MEJORADO PARA MENSAJES
    // ================================================
    
    function showModal(title, message, type = 'info') {
        // Crear modal si no existe
        let modal = document.getElementById('customModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.innerHTML = `
                <div class="modal fade" id="customModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <i id="modalIcon" class="mb-3" style="font-size: 3rem;"></i>
                                    <p id="modalMessage"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }

        // Configurar contenido del modal
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalIcon = document.getElementById('modalIcon');

        modalTitle.textContent = title;
        modalMessage.textContent = message;

        // Configurar icono según tipo
        modalIcon.className = 'mb-3';
        if (type === 'success') {
            modalIcon.classList.add('fas', 'fa-check-circle', 'text-success');
        } else if (type === 'error') {
            modalIcon.classList.add('fas', 'fa-exclamation-circle', 'text-danger');
        } else {
            modalIcon.classList.add('fas', 'fa-info-circle', 'text-info');
        }

        // Mostrar modal
        const modalInstance = new bootstrap.Modal(document.getElementById('customModal'));
        modalInstance.show();
    }

    // ================================================
    // ENVÍO DE FORMULARIO MEJORADO
    // ================================================
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validar todos los campos
            let isValid = true;
            const nombre = nombreField.value;
            const email = emailField.value;
            const telefono = telefonoField.value;
            const mensaje = mensajeField.value;

            // Validar nombre
            if (!validateName(nombre)) {
                showFieldError(nombreField, 'El nombre debe contener solo letras y tener entre 2 y 50 caracteres');
                isValid = false;
            } else {
                showFieldSuccess(nombreField);
            }

            // Validar email
            if (!validateEmail(email)) {
                showFieldError(emailField, 'Ingrese un email válido');
                isValid = false;
            } else {
                showFieldSuccess(emailField);
            }

            // Validar teléfono (opcional)
            if (!validatePhone(telefono)) {
                showFieldError(telefonoField, 'Ingrese un teléfono válido');
                isValid = false;
            } else {
                showFieldSuccess(telefonoField);
            }

            // Validar mensaje
            if (!validateMessage(mensaje)) {
                showFieldError(mensajeField, 'El mensaje debe tener entre 10 y 1000 caracteres');
                isValid = false;
            } else {
                showFieldSuccess(mensajeField);
            }

            if (!isValid) {
                showModal(
                    'Error de Validación',
                    'Por favor corrija los errores en el formulario antes de enviarlo.',
                    'error'
                );
                
                // Scroll al primer campo con error
                const firstError = contactForm.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
                return;
            }

            // Mostrar loader en el botón
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            submitBtn.disabled = true;

            const formData = new FormData(this);

            fetch('mail/send_contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showModal(
                        '¡Mensaje Enviado!',
                        'Tu mensaje ha sido enviado correctamente. Te contactaremos pronto.',
                        'success'
                    );
                    contactForm.reset();
                    
                    // Limpiar clases de validación
                    contactForm.querySelectorAll('.form-control').forEach(field => {
                        field.classList.remove('is-valid', 'is-invalid');
                    });
                    contactForm.querySelectorAll('.invalid-feedback').forEach(feedback => {
                        feedback.remove();
                    });
                    
                    // Limpiar contador de caracteres
                    const counter = document.getElementById('charCounter');
                    if (counter) {
                        counter.textContent = '0/1000 caracteres';
                        counter.className = 'form-text text-muted';
                    }
                } else {
                    showModal(
                        'Error al Enviar',
                        data.message || 'Hubo un error al enviar tu mensaje. Por favor intenta nuevamente.',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal(
                    'Error de Conexión',
                    'No se pudo enviar el mensaje. Verifica tu conexión a internet e intenta nuevamente.',
                    'error'
                );
            })
            .finally(() => {
                // Restaurar botón
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    // ================================================
    // ANIMACIONES AL HACER SCROLL
    // ================================================
    
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.fade-in');
        
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            
            if (elementTop < window.innerHeight && elementBottom > 0) {
                element.classList.add('visible');
            }
        });
    };

    // ================================================
    // GESTIÓN DE CARRUSELES MEJORADA
    // ================================================
    
    function initializeCarousels() {
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
        
        // Carrusel de nosotros
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
    }

    // ================================================
    // OPTIMIZACIONES DE IMÁGENES
    // ================================================
    
    function optimizeImages() {
        // Mejorar visualización de imágenes del carrusel
        const carouselImages = document.querySelectorAll('.carousel-item img');
        carouselImages.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });
            
            // Si la imagen ya está cargada
            if (img.complete) {
                img.style.opacity = '1';
            }
        });

        // Lazy loading para imágenes de productos
        const productImages = document.querySelectorAll('.producto-img');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.style.opacity = '0';
                    img.addEventListener('load', function() {
                        this.style.transition = 'opacity 0.3s ease';
                        this.style.opacity = '1';
                    });
                    observer.unobserve(img);
                }
            });
        });

        productImages.forEach(img => {
            imageObserver.observe(img);
        });
    }

    // ================================================
    // FUNCIONES DE UTILIDAD
    // ================================================
    
    // Función debounce para optimizar eventos
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Función para mostrar notificaciones toast
    function showToast(message, type = 'info') {
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        const toastElement = document.createElement('div');
        toastElement.className = `toast align-items-center text-white bg-${type} border-0`;
        toastElement.setAttribute('role', 'alert');
        toastElement.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        toastContainer.appendChild(toastElement);

        const toast = new bootstrap.Toast(toastElement);
        toast.show();

        toastElement.addEventListener('hidden.bs.toast', function() {
            this.remove();
        });
    }

    // ================================================
    // CERRAR MENÚ MÓVIL AL HACER CLIC
    // ================================================
    
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });

    // ================================================
    // BOTÓN DE ADMINISTRACIÓN MEJORADO
    // ================================================
    
    const adminBtn = document.querySelector('.admin-access-btn');
    if (adminBtn) {
        adminBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(180deg)';
        });
        
        adminBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    }

    // ================================================
    // OPTIMIZACIONES PARA MÓVIL
    // ================================================
    
    const isMobile = window.innerWidth <= 768;
    
    if (isMobile) {
        // Reducir intervalo del carrusel en móvil
        const carousel = document.getElementById('carouselBanners');
        if (carousel) {
            carousel.setAttribute('data-bs-interval', '6000');
        }
        
        // Mejorar performance en móvil
        document.body.classList.add('mobile-device');
    }

    // ================================================
    // PRECARGAR IMÁGENES CRÍTICAS
    // ================================================
    
    function preloadCriticalImages() {
        const criticalImages = [
            'img/banners/1.jpeg',
            'img/banners/3.jpeg',
            'img/banners/7.jpeg',
            'img/Logoo.png'
        ];
        
        criticalImages.forEach(path => {
            const img = new Image();
            img.src = path;
        });
    }

    // ================================================
    // EVENTOS Y INICIALIZACIÓN
    // ================================================
    
    // Event listeners
    window.addEventListener('scroll', optimizedScrollHandler);
    window.addEventListener('resize', debounce(() => {
        adjustLogoForDevice();
        animateOnScroll();
    }, 250));

    // Ejecutar al cargar
    handleNavbarScroll();
    animateOnScroll();

    // Inicializar componentes
    initializeLogo();
    initializeCarousels();
    optimizeImages();
    preloadCriticalImages();

    // ================================================
    // MANEJO DE ERRORES GLOBALES
    // ================================================
    
    window.addEventListener('error', function(e) {
        console.error('Error detectado:', e.error);
        if (window.location.hostname === 'localhost') {
            console.log('Error en:', e.filename, 'línea:', e.lineno);
        }
    });

    // ================================================
    // LOGS DE DESARROLLO
    // ================================================
    
    console.log('🎨 Casa Taller Cachagua - Sistema inicializado correctamente');
    console.log('%c🖼️ Logo del navbar mejorado', 'color: #4567B7; font-size: 14px; font-weight: bold;');
    console.log('%c📱 Optimizaciones móvil activadas', 'color: #8BC34A; font-size: 12px;');
    
    // Mostrar información del logo en desarrollo
    if (window.location.hostname === 'localhost') {
        const logo = document.querySelector('.navbar-logo');
        if (logo) {
            console.group('🖼️ Información del Logo');
            console.log('Altura:', logo.style.height || 'CSS definida');
            console.log('Ancho máximo:', logo.style.maxWidth || 'CSS definido');
            console.log('Fuente:', logo.src);
            console.log('Estado:', logo.complete ? 'Cargado' : 'Cargando...');
            console.groupEnd();
        }
    }

    // ================================================
    // FUNCIONES ADICIONALES PARA DEBUGGING
    // ================================================
    
    // Función para cambiar el tamaño del logo dinámicamente (solo desarrollo)
    if (window.location.hostname === 'localhost') {
        window.adjustLogoSize = function(size) {
            const logo = document.querySelector('.navbar-logo');
            if (logo) {
                logo.classList.remove('size-small', 'size-medium', 'size-large', 'size-extra-large');
                logo.classList.add(`size-${size}`);
                console.log(`Logo ajustado a tamaño: ${size}`);
            }
        };
        
        console.log('%cPara ajustar el logo usa: adjustLogoSize("small/medium/large/extra-large")', 'color: #7A288A; font-style: italic;');
    }
});