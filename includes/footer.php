    </main>
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Casa Taller Cachagua</h5>
                    <p class="mt-3">Un espacio dedicado a las artes visuales ubicado en el corazón de Cachagua, donde artistas locales comparten su pasión y creatividad.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> <?php echo getConfiguracion('contacto', 'direccion'); ?></li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> <?php echo getConfiguracion('contacto', 'telefono'); ?></li>
                        <li><i class="fas fa-envelope me-2"></i> <?php echo getConfiguracion('contacto', 'email'); ?></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <div class="mt-3">
                        <a href="https://instagram.com/<?php echo getConfiguracion('redes', 'instagram'); ?>" class="text-white me-3" target="_blank">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://wa.me/<?php echo getConfiguracion('redes', 'whatsapp'); ?>" class="text-white" target="_blank">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo SITE_URL; ?>/contacto.php" class="btn btn-outline-light">Contáctanos</a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> Casa Taller Cachagua. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none">Política de privacidad</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>
    <?php if (isset($extraJS)): ?>
        <?php echo $extraJS; ?>
    <?php endif; ?>
</body>
</html>