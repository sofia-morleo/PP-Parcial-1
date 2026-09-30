<?php
// admin/categorias.php
require __DIR__ . '/../config.php';
$titulo = 'Categorías';
$tituloPagina = 'Categorías';
$activo = 'categorias';

$categorias = datos('categories');

// si viene ?padre=ID busco esa categoria para mostrar sus subcategorias
$padre = null;
if(isset($_GET['padre'])){
    foreach($categorias as $c){
        if($c['id'] == $_GET['padre']){
            $padre = $c;
        }
    }
}

require __DIR__ . '/../partials/admin/head.php';
require __DIR__ . '/../partials/admin/panel_open.php';
?>

<div id="aviso"></div>

<?php if($padre){ ?>

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
        <h5 class="mb-2 mb-sm-0">Subcategorías de: <strong><?php echo $padre['nombre'] ?></strong></h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?php echo url('admin/categorias.php') ?>">
            <i class="fas fa-arrow-left"></i> Volver a todas las categorías
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered tabla" width="100%">
                <thead class="thead-light">
                    <tr><th>Nombre</th><th>Estado</th><th>Acciones</th></tr>
                </thead>
                <tbody>
                    <?php foreach($padre['subcategorias'] as $s){ ?>
                    <tr>
                        <td><?php echo $s['nombre'] ?></td>
                        <td>
                            <?php if($s['activo']){ ?>
                                <span class="status-pill status-on">Activo</span>
                            <?php }else{ ?>
                                <span class="status-pill status-off">Inactivo</span>
                            <?php } ?>
                        </td>
                        <td style="white-space:nowrap">
                            <button class="btn btn-sm btn-outline-primary" title="Modificar" data-toggle="modal" data-target="#modalCat" onclick="editarCategoria('<?php echo $s['nombre'] ?>')"><i class="fas fa-edit"></i></button>
                            <?php if($s['activo']){ ?>
                                <button class="btn btn-sm btn-outline-secondary" title="Inactivar"><i class="fas fa-toggle-off"></i></button>
                            <?php }else{ ?>
                                <button class="btn btn-sm btn-outline-success" title="Activar"><i class="fas fa-toggle-on"></i></button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php }else{ ?>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-cf btn-sm" data-toggle="modal" data-target="#modalCat" onclick="nuevaCategoria()">
            <i class="fas fa-plus"></i> Nueva categoría
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered tabla" width="100%">
                <thead class="thead-light">
                    <tr><th>Nombre</th><th>Subcategorías</th><th>Estado</th><th>Acciones</th></tr>
                </thead>
                <tbody>
                    <?php foreach($categorias as $c){ ?>
                    <tr>
                        <td><?php echo $c['nombre'] ?></td>
                        <td><?php echo count($c['subcategorias']) ?></td>
                        <td>
                            <?php if($c['activo']){ ?>
                                <span class="status-pill status-on">Activo</span>
                            <?php }else{ ?>
                                <span class="status-pill status-off">Inactivo</span>
                            <?php } ?>
                        </td>
                        <td style="white-space:nowrap">
                            <button class="btn btn-sm btn-outline-primary" title="Modificar" data-toggle="modal" data-target="#modalCat" onclick="editarCategoria('<?php echo $c['nombre'] ?>')"><i class="fas fa-edit"></i></button>
                            <?php if($c['activo']){ ?>
                                <button class="btn btn-sm btn-outline-secondary" title="Inactivar"><i class="fas fa-toggle-off"></i></button>
                            <?php }else{ ?>
                                <button class="btn btn-sm btn-outline-success" title="Activar"><i class="fas fa-toggle-on"></i></button>
                            <?php } ?>
                            <a class="btn btn-sm btn-outline-info" title="Ver subcategorías" href="<?php echo url('admin/categorias.php?padre=' . $c['id']) ?>"><i class="fas fa-sitemap"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php } ?>

<!-- modal para dar de alta o editar una categoria -->
<div class="modal fade" id="modalCat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="form-sim" data-msg="Categoría guardada (simulado, todavía sin base de datos)." novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Nueva categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cNombre">Nombre</label>
                        <input type="text" class="form-control" id="cNombre" required maxlength="60">
                    </div>
                    <div class="form-group">
                        <label for="cPadre">Categoría padre (opcional)</label>
                        <select class="form-control" id="cPadre">
                            <option value="">Ninguna (es una categoría principal)</option>
                            <?php foreach($categorias as $c){ ?>
                                <option value="<?php echo $c['id'] ?>"><?php echo $c['nombre'] ?></option>
                            <?php } ?>
                        </select>
                        <small class="form-text text-muted">Elegí una categoría padre para crear una subcategoría.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-cf">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function nuevaCategoria(){
    $('#tituloModal').text('Nueva categoría');
    $('#cNombre').val('');
    $('#cPadre').val('');
}
function editarCategoria(nombre){
    $('#tituloModal').text('Editar: ' + nombre);
    $('#cNombre').val(nombre);
}
</script>

<?php require __DIR__ . '/../partials/admin/panel_close.php'; ?>
