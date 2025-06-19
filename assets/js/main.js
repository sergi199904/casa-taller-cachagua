document.addEventListener('DOMContentLoaded', function() {
    // Lazy loading de imágenes
    const lazyImages = document.querySelectorAll('.lazy-load');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });

        lazyImages.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback para navegadores que no soportan IntersectionObserver
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
            img.classList.add('loaded');
        });
    }

    // Carrusel de testimonios
    const testimonialCarousel = document.getElementById('testimonialCarousel');
    if (testimonialCarousel) {
        new bootstrap.Carousel(testimonialCarousel, {
            interval: 5000,
            pause: 'hover'
        });
    }

    // Filtro de categorías
    const categoryFilters = document.querySelectorAll('.category-pill');
    if (categoryFilters.length > 0) {
        categoryFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Quitar la clase active de todos los filtros
                categoryFilters.forEach(item => item.classList.remove('active'));
                
                // Agregar la clase active al filtro seleccionado
                this.classList.add('active');
                
                const category = this.dataset.category;
                const productItems = document.querySelectorAll('.product-item');
                
                productItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }

    // Validación de formulario de contacto
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            // La validación básica se deja al navegador con los atributos required
            // Aquí podemos agregar validaciones más complejas si es necesario
            console.log('Formulario enviado');
        });
    }

    // Botón "Cargar más" para paginación
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // En una implementación real, aquí cargaríamos más productos vía AJAX
            alert('En una implementación real, aquí se cargarían más productos.');
        });
    }
});