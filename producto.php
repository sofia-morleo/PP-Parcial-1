<?php
// producto.php - detalle de un producto
require __DIR__ . '/config.php';

// busco el producto por id
$id = 0;
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
}
$producto = null;
foreach(datos('products') as $p){
    if($p['id'] == $id){
        $producto = $p;
    }
}

// si no existe o esta inactivo va a la 404
if($producto == null || $producto['activo'] == false){
    header('Location: ' . url('404.php'));
    exit;
}

$titulo = $producto['nombre'];
$activo = 'productos';

// comentarios aprobados de este producto
$comentarios = array();
foreach(datos('comments') as $c){
    if($c['producto_id'] == $producto['id'] && $c['aprobado'] == true){
        $comentarios[] = $c;
    }
}

require __DIR__ . '/partials/public/header.php';
?>

<section class="section">
    <div class="container container-narrow">
        <nav>
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item"><a href="<?php echo url('index.php') ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo url('productos.php') ?>">Productos</a></li>
                <li class="breadcrumb-item active"><?php echo $producto['nombre'] ?></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-5 mb-4">
                <img src="<?php echo url($producto['imagen']) ?>" alt="<?php echo $producto['nombre'] ?>" class="img-fluid rounded w-100">
            </div>
            <div class="col-md-7">
                <span class="brand d-block mb-1"><?php echo nombreMarca($producto['marca_id']) ?></span>
                <h1 class="h3 font-weight-bold mb-1"><?php echo $producto['nombre'] ?></h1>
                <p class="text-muted mb-2"><?php echo $producto['modelo'] ?></p>
                <?php echo estrellas($producto['ranking']) ?>
                <p class="price h4 font-weight-bold mt-3 mb-3"><?php echo precio($producto['precio']) ?></p>
                <p><?php echo $producto['descripcion'] ?></p>
            </div>
        </div>

        <!-- comentarios -->
        <h2 class="section-title mt-5" style="font-size:1.4rem">Opiniones</h2>
        <?php if(count($comentarios) == 0){ ?>
            <p class="text-muted">Todavía no hay comentarios.</p>
        <?php }else{ ?>
            <?php foreach($comentarios as $c){ ?>
                <div class="comment">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <span class="who"><?php echo $c['email'] ?></span>
                        <small class="text-muted"><?php echo date('d/m/Y', strtotime($c['fecha'])) ?></small>
                    </div>
                    <?php echo estrellas($c['ranking']) ?>
                    <p class="mb-0 mt-1"><?php echo $c['comentario'] ?></p>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- formulario -->
        <h2 class="section-title mt-5" style="font-size:1.4rem">Dejá tu comentario</h2>
        <div id="aviso"></div>
        <form class="form-card form-sim" data-msg="¡Gracias por tu comentario! Queda pendiente de aprobación." novalidate>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="comentario">Comentario</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <p class="mb-1">Tu valoración</p>
                <!-- van de 5 a 1 porque el CSS las invierte -->
                <div class="rating-input">
                    <input type="radio" id="r5" name="rating" value="5" required>
                    <label for="r5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="r4" name="rating" value="4">
                    <label for="r4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="r3" name="rating" value="3">
                    <label for="r3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="r2" name="rating" value="2">
                    <label for="r2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="r1" name="rating" value="1">
                    <label for="r1"><i class="fas fa-star"></i></label>
                </div>
            </div>
            <button type="submit" class="btn btn-cf">Enviar comentario</button>
        </form>
    </div>
</section>

<?php require __DIR__ . '/partials/public/footer.php'; ?>
