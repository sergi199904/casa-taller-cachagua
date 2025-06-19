<?php
$pageTitle = 'Quiénes Somos';
include_once 'includes/header.php';

// Obtener contenido de "Quiénes somos" de la base de datos
$titulo = getConfiguracion('quienes_somos', 'titulo');
$contenido = getConfiguracion('quienes_somos', 'contenido');
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4 text-center"><?php echo sanitize($titulo); ?></h1>
            
            <div class="mb-5 text-center">
                <img src="<?php echo SITE_URL; ?>/assets/img/taller-grande.jpg" alt="Nuestro taller" class="img-fluid rounded shadow" onerror="this.src='<?php echo SITE_URL; ?>/assets/img/taller-placeholder.jpg';this.onerror='';">
            </div>
            
            <div class="content">
                <?php echo $contenido; ?>
            </div>
            
            <div class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-palette fa-3x text-primary-custom mb-3"></i>
                            <h3 class="card-title h4">Nuestra Misión</h3>
                            <p class="card-text">Crear un espacio para la expresión artística y cultural en Cachagua, promoviendo el trabajo de artistas locales y generando un punto de encuentro para la comunidad.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-eye fa-3x text-primary-custom mb-3"></i>
                            <h3 class="card-title h4">Nuestra Visión</h3>
                            <p class="card-text">Ser un referente cultural en la región, manteniendo vivas las tradiciones artísticas mientras innovamos con nuevas técnicas y expresiones que reflejen la identidad local.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-5">
                <h2 class="mb-4 text-center">Nuestro Equipo</h2>
                
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 text-center">
                            <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width: 150px; height: 150px;">
                                <img src="<?php echo SITE_URL; ?>/assets/img/persona1.jpg" alt="María Lagos" class="img-fluid" onerror="this.src='<?php echo SITE_URL; ?>/assets/img/avatar-placeholder.jpg';this.onerror='';">
                            </div>
                            <h4 class="card-title">María Lagos</h4>
                            <p class="text-muted">Fundadora y Directora</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 text-center">
                            <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width: 150px; height: 150px;">
                                <img src="<?php echo SITE_URL; ?>/assets/img/persona2.jpg" alt="Carlos Mendoza" class="img-fluid" onerror="this.src='<?php echo SITE_URL; ?>/assets/img/avatar-placeholder.jpg';this.onerror='';">
                            </div>
                            <h4 class="card-title">Carlos Mendoza</h4>
                            <p class="text-muted">Maestro Ceramista</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 text-center">
                            <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width: 150px; height: 150px;">
                                <img src="<?php echo SITE_URL; ?>/assets/img/persona3.jpg" alt="Laura Soto" class="img-fluid" onerror="this.src='<?php echo SITE_URL; ?>/assets/img/avatar-placeholder.jpg';this.onerror='';">
                            </div>
                            <h4 class="card-title">Laura Soto</h4>
                            <p class="text-muted">Pintora y Grabadora</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="<?php echo SITE_URL; ?>/contacto.php" class="btn btn-lg btn-primary-custom">Contáctanos</a>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>