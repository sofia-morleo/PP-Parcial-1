<?php
// 404.php - pagina no encontrada
require __DIR__ . '/config.php';
$titulo = 'Página no encontrada';
$activo = '';

require __DIR__ . '/partials/public/header.php';
?>

<section class="section">
    <div class="container container-narrow">
        <div class="error-hero">
            <div class="code">404</div>
            <h1 class="h3 font-weight-bold mt-2">Página no encontrada</h1>
            <p class="text-muted mb-4">La página que buscás no existe o fue movida.</p>
            <a href="<?php echo url('index.php') ?>" class="btn btn-cf"><i class="fas fa-home"></i> Volver al inicio</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/public/footer.php'; ?>
