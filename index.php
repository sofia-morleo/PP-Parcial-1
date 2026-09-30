<?php
// index.php - pagina de inicio
require __DIR__ . '/config.php';
$titulo = 'Inicio';
$activo = 'home';

$productos = datos('products');

// me quedo con 6 productos destacados y activos para mostrar en la home
$destacados = array();
foreach($productos as $p){
    if($p['destacado'] == true && $p['activo'] == true){
        $destacados[] = $p;
    }
    if(count($destacados) == 6){
        break;
    }
}

require __DIR__ . '/partials/public/header.php';
?>

<section class="cf-hero">
    <div class="container container-narrow">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-4">Tu farmacia y perfumería de confianza</h1>
                <p class="lead mb-4">Medicamentos, dermocosmética, cuidado personal y las mejores fragancias. Todo en un solo lugar, con la atención de City Farmac.</p>
                <a href="<?php echo url('productos.php') ?>" class="btn btn-light btn-lg font-weight-bold text-success">
                    <i class="fas fa-pills"></i> Ver productos
                </a>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <i class="fas fa-clinic-medical" style="font-size:9rem;opacity:.85"></i>
            </div>
        </div>
    </div>
</section>

<!-- beneficios -->
<section class="section pb-0">
    <div class="container container-narrow">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="filter-card h-100">
                    <i class="fas fa-truck fa-2x text-success mb-2"></i>
                    <h6 class="font-weight-bold mb-1">Envío a domicilio</h6>
                    <p class="text-muted small mb-0">Recibí tu pedido en el día en CABA y GBA.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="filter-card h-100">
                    <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                    <h6 class="font-weight-bold mb-1">Productos originales</h6>
                    <p class="text-muted small mb-0">Trabajamos solo con laboratorios y marcas oficiales.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="filter-card h-100">
                    <i class="fas fa-headset fa-2x text-success mb-2"></i>
                    <h6 class="font-weight-bold mb-1">Asesoramiento</h6>
                    <p class="text-muted small mb-0">Nuestros farmacéuticos te ayudan cuando lo necesites.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- productos destacados -->
<section class="section">
    <div class="container container-narrow">
        <h2 class="section-title">Productos destacados</h2>
        <p class="section-sub">Los favoritos de nuestros clientes esta semana.</p>
        <div class="row">
            <?php foreach($destacados as $p){ ?>
                <div class="col-6 col-md-4 mb-4">
                    <div class="product-card">
                        <a href="<?php echo url('producto.php?id=' . $p['id']) ?>" class="thumb">
                            <img src="<?php echo url($p['imagen']) ?>" alt="<?php echo $p['nombre'] ?>">
                        </a>
                        <div class="body">
                            <span class="brand"><?php echo nombreMarca($p['marca_id']) ?></span>
                            <a class="name text-decoration-none" href="<?php echo url('producto.php?id=' . $p['id']) ?>"><?php echo $p['nombre'] ?></a>
                            <?php echo estrellas($p['ranking']) ?>
                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <span class="price"><?php echo precio($p['precio']) ?></span>
                                <a href="<?php echo url('producto.php?id=' . $p['id']) ?>" class="btn btn-cf btn-sm">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="text-center mt-2">
            <a href="<?php echo url('productos.php') ?>" class="btn btn-cf-outline">Ver todo el catálogo <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/public/footer.php'; ?>
