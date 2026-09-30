<?php
// productos.php - listado con filtros
require __DIR__ . '/config.php';
$titulo = 'Productos';
$activo = 'productos';

$productos = datos('products');
$categorias = datos('categories');
$marcas = datos('brands');

// filtros que llegan por GET (0 = sin filtro)
$cat = 0;
$sub = 0;
$marca = 0;
$orden = 'destacados';
if(isset($_GET['cat'])){
    $cat = (int)$_GET['cat'];
}
if(isset($_GET['sub'])){
    $sub = (int)$_GET['sub'];
}
if(isset($_GET['marca'])){
    $marca = (int)$_GET['marca'];
}
if(isset($_GET['orden'])){
    if($_GET['orden'] == 'ranking' || $_GET['orden'] == 'az' || $_GET['orden'] == 'za'){
        $orden = $_GET['orden'];
    }
}

// productos activos que cumplen los filtros
$lista = array();
foreach($productos as $p){
    if($p['activo'] == false){
        continue;
    }
    if($cat != 0 && $p['categoria_id'] != $cat){
        continue;
    }
    if($sub != 0 && $p['subcategoria_id'] != $sub){
        continue;
    }
    if($marca != 0 && $p['marca_id'] != $marca){
        continue;
    }
    $lista[] = $p;
}

// funciones para ordenar
function porRanking($a, $b){
    if($a['ranking'] == $b['ranking']){
        return 0;
    }
    if($a['ranking'] < $b['ranking']){
        return 1;
    }
    return -1;
}
function porNombreAZ($a, $b){
    return strcasecmp($a['nombre'], $b['nombre']);
}
function porNombreZA($a, $b){
    return strcasecmp($b['nombre'], $a['nombre']);
}

if($orden == 'ranking'){
    usort($lista, 'porRanking');
}
if($orden == 'az'){
    usort($lista, 'porNombreAZ');
}
if($orden == 'za'){
    usort($lista, 'porNombreZA');
}
if($orden == 'destacados'){
    // primero los destacados y despues el resto
    $ordenados = array();
    foreach($lista as $p){
        if($p['destacado'] == true){
            $ordenados[] = $p;
        }
    }
    foreach($lista as $p){
        if($p['destacado'] == false){
            $ordenados[] = $p;
        }
    }
    $lista = $ordenados;
}

require __DIR__ . '/partials/public/header.php';
?>

<section class="section">
    <div class="container container-narrow">
        <h1 class="section-title">Productos</h1>
        <p class="section-sub">Encontrá lo que necesitás en nuestro catálogo.</p>

        <div class="row">
            <!-- filtros -->
            <div class="col-lg-3 mb-4">
                <form method="get" action="<?php echo url('productos.php') ?>" class="filter-card">
                    <h6 class="font-weight-bold mb-2">Categorías</h6>
                    <ul class="cat-tree mb-3">
                        <?php foreach($categorias as $c){ ?>
                            <?php if($c['activo'] == true){ ?>
                                <li>
                                    <a href="<?php echo url('productos.php?cat=' . $c['id']) ?>"><?php echo $c['nombre'] ?></a>
                                    <ul>
                                        <?php foreach($c['subcategorias'] as $s){ ?>
                                            <?php if($s['activo'] == true){ ?>
                                                <li><a href="<?php echo url('productos.php?sub=' . $s['id']) ?>"><?php echo $s['nombre'] ?></a></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>

                    <!-- mantengo la categoria elegida al aplicar -->
                    <input type="hidden" name="cat" value="<?php echo $cat ?>">
                    <input type="hidden" name="sub" value="<?php echo $sub ?>">

                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <select name="marca" id="marca" class="form-control form-control-sm">
                            <option value="0">Todas</option>
                            <?php foreach($marcas as $m){ ?>
                                <?php if($m['activo'] == true){ ?>
                                    <option value="<?php echo $m['id'] ?>" <?php if($marca == $m['id']){ echo 'selected'; } ?>><?php echo $m['nombre'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="orden">Ordenar por</label>
                        <select name="orden" id="orden" class="form-control form-control-sm">
                            <option value="destacados" <?php if($orden == 'destacados'){ echo 'selected'; } ?>>Destacados</option>
                            <option value="ranking" <?php if($orden == 'ranking'){ echo 'selected'; } ?>>Ranqueados (mayor a menor)</option>
                            <option value="az" <?php if($orden == 'az'){ echo 'selected'; } ?>>A-Z</option>
                            <option value="za" <?php if($orden == 'za'){ echo 'selected'; } ?>>Z-A</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-cf btn-sm btn-block">Aplicar</button>
                    <a href="<?php echo url('productos.php') ?>" class="d-block text-center mt-2 small">Limpiar</a>
                </form>
            </div>

            <!-- grilla -->
            <div class="col-lg-9">
                <?php if(count($lista) == 0){ ?>
                    <div class="empty-state">
                        <p class="mb-0">No hay productos para mostrar</p>
                    </div>
                <?php }else{ ?>
                    <div class="row">
                        <?php foreach($lista as $p){ ?>
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
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/public/footer.php'; ?>
