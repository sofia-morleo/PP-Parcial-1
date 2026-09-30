<?php
// admin/comentarios.php
require __DIR__ . '/../config.php';
$titulo = 'Comentarios';
$tituloPagina = 'Comentarios';
$activo = 'comentarios';

$comentarios = datos('comments');
$productos = datos('products');

// filtros que llegan por GET
$productoId = 0;
if(isset($_GET['producto'])){
    $productoId = (int)$_GET['producto'];
}
$estado = 'todos';
if(isset($_GET['estado'])){
    $estado = $_GET['estado'];
}

// armo una lista con el nombre de cada producto por su id
$nombreProd = array();
foreach($productos as $p){
    $nombreProd[$p['id']] = $p['nombre'];
}

// me quedo solo con los comentarios que cumplen los filtros
$lista = array();
foreach($comentarios as $c){
    $mostrar = true;
    if($productoId != 0 && $c['producto_id'] != $productoId){ $mostrar = false; }
    if($estado == 'aprobados' && !$c['aprobado']){ $mostrar = false; }
    if($estado == 'pendientes' && $c['aprobado']){ $mostrar = false; }
    if($mostrar){
        $lista[] = $c;
    }
}

// parte del link de los filtros para no perder el producto
$extra = '';
if($productoId != 0){
    $extra = '&producto=' . $productoId;
}

require __DIR__ . '/../partials/admin/head.php';
require __DIR__ . '/../partials/admin/panel_open.php';
?>

<div id="aviso"></div>

<?php if($productoId != 0){ ?>
    <div class="alert alert-info d-flex justify-content-between align-items-center flex-wrap">
        <span>Comentarios de: <strong><?php if(isset($nombreProd[$productoId])){ echo $nombreProd[$productoId]; }else{ echo 'Producto ' . $productoId; } ?></strong></span>
        <a class="btn btn-sm btn-outline-secondary" href="<?php echo url('admin/comentarios.php?estado=' . $estado) ?>">Ver todos</a>
    </div>
<?php } ?>

<div class="btn-group mb-3">
    <a class="btn btn-sm <?php if($estado == 'todos'){ echo 'btn-cf'; }else{ echo 'btn-outline-secondary'; } ?>" href="<?php echo url('admin/comentarios.php?estado=todos' . $extra) ?>">Todos</a>
    <a class="btn btn-sm <?php if($estado == 'aprobados'){ echo 'btn-cf'; }else{ echo 'btn-outline-secondary'; } ?>" href="<?php echo url('admin/comentarios.php?estado=aprobados' . $extra) ?>">Aprobados</a>
    <a class="btn btn-sm <?php if($estado == 'pendientes'){ echo 'btn-cf'; }else{ echo 'btn-outline-secondary'; } ?>" href="<?php echo url('admin/comentarios.php?estado=pendientes' . $extra) ?>">Pendientes</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered tabla" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Comentario</th><th>Ranking</th><th>Fecha</th><th>Producto</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista as $c){ ?>
                <tr>
                    <td><?php echo $c['comentario'] ?><br><small class="text-muted"><?php echo $c['email'] ?></small></td>
                    <td><?php echo estrellas($c['ranking']) ?></td>
                    <td><?php echo $c['fecha'] ?></td>
                    <td>
                        <?php if(isset($nombreProd[$c['producto_id']])){ echo $nombreProd[$c['producto_id']]; }else{ echo '-'; } ?>
                    </td>
                    <td>
                        <?php if($c['aprobado']){ ?>
                            <span class="status-pill status-on">Aprobado</span>
                        <?php }else{ ?>
                            <span class="status-pill status-off">Pendiente</span>
                        <?php } ?>
                    </td>
                    <td style="white-space:nowrap">
                        <?php if($c['aprobado']){ ?>
                            <button class="btn btn-sm btn-outline-secondary" title="Desaprobar"><i class="fas fa-times"></i></button>
                        <?php }else{ ?>
                            <button class="btn btn-sm btn-outline-success" title="Aprobar"><i class="fas fa-check"></i></button>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../partials/admin/panel_close.php'; ?>
