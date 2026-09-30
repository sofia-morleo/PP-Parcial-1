<?php
// admin/index.php
require __DIR__ . '/../config.php';
$titulo = 'Inicio';
$tituloPagina = 'Inicio';
$activo = 'home';

$productos = datos('products');
$categorias = datos('categories');
$comentarios = datos('comments');

// cuento los comentarios que todavia no estan aprobados
$pendientes = 0;
foreach($comentarios as $c){
    if(!$c['aprobado']){
        $pendientes = $pendientes + 1;
    }
}

// secciones del panel: archivo, icono, nombre y descripcion
$secciones = array(
    array('productos.php',   'fa-pills',       'Productos',   'Alta, edición y estado de los productos del catálogo.'),
    array('categorias.php',  'fa-sitemap',     'Categorías',  'Categorías principales y sus subcategorías.'),
    array('marcas.php',      'fa-tags',        'Marcas',      'Marcas asociadas a los productos.'),
    array('comentarios.php', 'fa-comments',    'Comentarios', 'Moderación de comentarios de clientes.'),
    array('usuarios.php',    'fa-users',       'Usuarios',    'Cuentas de usuarios del sistema.'),
    array('perfiles.php',    'fa-user-shield', 'Perfiles',    'Perfiles y permisos de acceso.')
);

require __DIR__ . '/../partials/admin/head.php';
require __DIR__ . '/../partials/admin/panel_open.php';
?>

<div id="aviso"></div>

<p class="mb-4">Bienvenido/a al panel de <strong>City Farmac</strong>. Elegí una sección para empezar a gestionar el catálogo.</p>

<!-- tarjetas de resumen -->
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Productos cargados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($productos) ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-pills fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Categorías principales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($categorias) ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-sitemap fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Comentarios pendientes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pendientes ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- accesos a cada seccion -->
<div class="row">
    <?php foreach($secciones as $s){ ?>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center mb-2">
                    <div class="col-auto mr-3"><i class="fas <?php echo $s[1] ?> fa-2x text-gray-300"></i></div>
                    <div class="col">
                        <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $s[2] ?></div>
                    </div>
                </div>
                <p class="text-muted small mb-3"><?php echo $s[3] ?></p>
                <a class="btn btn-cf btn-sm" href="<?php echo url('admin/' . $s[0]) ?>">Ir a la sección <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php require __DIR__ . '/../partials/admin/panel_close.php'; ?>
