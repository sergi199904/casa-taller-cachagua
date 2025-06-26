// main.js - JavaScript Principal con validaciones mejoradas

document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scrolling para los enlaces del menú
    const navLinks = document.querySelectorAll('.navbar-nav a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Filtro de productos por categoría
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.producto-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remover clase active de todos los botones
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Agregar clase active al botón clickeado
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            productItems.forEach(item => {
                if (filterValue === 'all') {
                    item.classList.remove('hidden');
                    item.style.display = 'block';
                } else {
                    if (item.getAttribute('data-categoria') === filterValue) {
                        item.classList.remove('hidden');
                        item.style.display = 'block';
                    } else {
                        item.classList.add('hidden');
                        item.style.display = 'none';
                    }
                }
            });
        });
    });

    // Validación de formulario mejorada
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');
    
    // Campos del formulario
    const nombreField = document.getElementById('nombre');
    const emailField = document.getElementById('email');
    const telefonoField = document.getElementById('telefono');
    const mensajeField = document.getElementById('mensaje');

    // Funciones de validación
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

        // Contador de caracteres
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

    // Función para mostrar modal
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

    // Formulario de contacto con validación completa
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

    // Navbar cambio de estilo al hacer scroll
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-lg');
        } else {
            navbar.classList.remove('shadow-lg');
        }
    });

    // Animación de elementos al hacer scroll
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

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Ejecutar al cargar la página

    // Cerrar menú móvil al hacer clic en un enlace
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });

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

    // Precargar imágenes del carrusel para mejor rendimiento
    const preloadImages = () => {
        const imagePaths = [
            'img/banners/banner1.jpeg',
            'img/banners/banner2.jpeg',
            'img/banners/banner3.jpeg'
        ];
        
        imagePaths.forEach(path => {
            const img = new Image();
            img.src = path;
        });
    };
    
    preloadImages();

    // Botón de acceso a administración - efecto hover mejorado
    const adminBtn = document.querySelector('.admin-access-btn');
    if (adminBtn) {
        adminBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(180deg)';
        });
        
        adminBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    }

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

    // Detectar si es dispositivo móvil
    const isMobile = window.innerWidth <= 768;
    
    // Optimizaciones para móvil
    if (isMobile) {
        // Reducir intervalo del carrusel en móvil
        const carousel = document.getElementById('carouselBanners');
        if (carousel) {
            carousel.setAttribute('data-bs-interval', '6000');
        }
        
        // Mejorar performance en móvil
        document.body.classList.add('mobile-device');
    }

    // Función para mostrar notificaciones toast (opcional)
    function showToast(message, type = 'info') {
        // Crear container de toasts si no existe
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        // Crear toast
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

        // Mostrar toast
        const toast = new bootstrap.Toast(toastElement);
        toast.show();

        // Remover del DOM después de que se oculte
        toastElement.addEventListener('hidden.bs.toast', function() {
            this.remove();
        });
    }

    // Manejo de errores globales
    window.addEventListener('error', function(e) {
        console.error('Error detectado:', e.error);
        // En desarrollo, mostrar el error. En producción, solo log
        if (window.location.hostname === 'localhost') {
            console.log('Error en:', e.filename, 'línea:', e.lineno);
        }
    });

    // Performance: Debounce para eventos de scroll
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

    // Aplicar debounce al scroll
    const debouncedScroll = debounce(function() {
        animateOnScroll();
        
        // Actualizar navbar
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-lg');
        } else {
            navbar.classList.remove('shadow-lg');
        }
    }, 10);

    window.addEventListener('scroll', debouncedScroll);

    console.log('🎨 Casa Taller Cachagua - Sistema inicializado correctamente');
});