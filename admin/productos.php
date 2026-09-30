<?php
// admin/productos.php - listado y alta/edicion de productos
require __DIR__ . '/../config.php';
$titulo = 'Productos';
$tituloPagina = 'Productos';
$activo = 'productos';

$productos = datos('products');
$categorias = datos('categories');
$marcas = datos('brands');

// armo dos listas para mostrar el nombre de la categoria y la subcategoria por su id
$nombreCat = array();
$nombreSub = array();
foreach($categorias as $c){
    $nombreCat[$c['id']] = $c['nombre'];
    foreach($c['subcategorias'] as $s){
        $nombreSub[$s['id']] = $s['nombre'];
    }
}

require __DIR__ . '/../partials/admin/head.php';
require __DIR__ . '/../partials/admin/panel_open.php';
?>

<div id="aviso"></div>

<div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
    <div class="form-inline">
        <label class="mr-2 mb-2 mb-sm-0 small font-weight-bold" for="filtroCat">Categoría</label>
        <select id="filtroCat" class="form-control form-control-sm mr-3 mb-2 mb-sm-0">
            <option value="">Todas</option>
            <?php foreach($categorias as $c){ ?>
                <option value="<?php echo $c['id'] ?>"><?php echo $c['nombre'] ?></option>
            <?php } ?>
        </select>
        <label class="mr-2 mb-2 mb-sm-0 small font-weight-bold" for="filtroSub">Subcategoría</label>
        <select id="filtroSub" class="form-control form-control-sm mb-2 mb-sm-0">
            <option value="">Todas</option>
            <?php foreach($categorias as $c){ ?>
                <?php foreach($c['subcategorias'] as $s){ ?>
                    <option value="<?php echo $s['id'] ?>" data-cat="<?php echo $c['id'] ?>"><?php echo $s['nombre'] ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
    <button class="btn btn-cf btn-sm" data-toggle="modal" data-target="#modalProd" onclick="nuevoProducto()">
        <i class="fas fa-plus"></i> Nuevo producto
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered" id="listaProd" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Producto</th><th>Categoría</th><th>Subcategoría</th><th>Marca</th>
                    <th>Precio</th><th>Ranking</th><th>Destacado</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $p){ ?>
                <tr data-cat="<?php echo $p['categoria_id'] ?>" data-sub="<?php echo $p['subcategoria_id'] ?>">
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?php echo url($p['imagen']) ?>" alt="<?php echo $p['nombre'] ?>" width="46" height="35" class="rounded mr-2" style="object-fit:cover">
                            <div><?php echo $p['nombre'] ?><br><small class="text-muted"><?php echo $p['modelo'] ?></small></div>
                        </div>
                    </td>
                    <td><?php echo $nombreCat[$p['categoria_id']] ?></td>
                    <td><?php echo $nombreSub[$p['subcategoria_id']] ?></td>
                    <td><?php echo nombreMarca($p['marca_id']) ?></td>
                    <td><?php echo precio($p['precio']) ?></td>
                    <td><?php echo estrellas($p['ranking']) ?> <small class="text-muted"><?php echo $p['ranking'] ?></small></td>
                    <td class="text-center">
                        <?php if($p['destacado']){ ?><i class="fas fa-star text-warning"></i><?php }else{ ?><span class="text-muted">-</span><?php } ?>
                    </td>
                    <td>
                        <?php if($p['activo']){ ?>
                            <span class="status-pill status-on">Activo</span>
                        <?php }else{ ?>
                            <span class="status-pill status-off">Inactivo</span>
                        <?php } ?>
                    </td>
                    <td style="white-space:nowrap">
                        <button class="btn btn-sm btn-outline-primary" title="Modificar" data-toggle="modal" data-target="#modalProd" onclick="editarProducto('<?php echo $p['nombre'] ?>')"><i class="fas fa-edit"></i></button>
                        <?php if($p['activo']){ ?>
                            <button class="btn btn-sm btn-outline-secondary" title="Inactivar"><i class="fas fa-toggle-off"></i></button>
                        <?php }else{ ?>
                            <button class="btn btn-sm btn-outline-success" title="Activar"><i class="fas fa-toggle-on"></i></button>
                        <?php } ?>
                        <a class="btn btn-sm btn-outline-info" title="Ver comentarios" href="<?php echo url('admin/comentarios.php?producto=' . $p['id']) ?>"><i class="fas fa-comments"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- modal para dar de alta o editar un producto -->
<div class="modal fade" id="modalProd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form-sim" data-msg="Producto guardado (simulado, todavía sin base de datos)." novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="pNombre">Nombre</label>
                            <input type="text" class="form-control" id="pNombre" required maxlength="80">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pPrecio">Precio</label>
                            <input type="number" class="form-control" id="pPrecio" min="0" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pDesc">Descripción</label>
                        <textarea class="form-control" id="pDesc" rows="2" maxlength="400"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="pCat">Categoría</label>
                            <select class="form-control" id="pCat" required>
                                <option value="">Elegir...</option>
                                <?php foreach($categorias as $c){ ?>
                                    <option value="<?php echo $c['id'] ?>"><?php echo $c['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pSub">Subcategoría</label>
                            <select class="form-control" id="pSub">
                                <option value="">Elegir...</option>
                                <?php foreach($categorias as $c){ ?>
                                    <?php foreach($c['subcategorias'] as $s){ ?>
                                        <option value="<?php echo $s['id'] ?>" data-cat="<?php echo $c['id'] ?>"><?php echo $s['nombre'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pMarca">Marca</label>
                            <select class="form-control" id="pMarca" required>
                                <option value="">Elegir...</option>
                                <?php foreach($marcas as $m){ ?>
                                    <option value="<?php echo $m['id'] ?>"><?php echo $m['nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pModelo">Modelo / presentación</label>
                            <input type="text" class="form-control" id="pModelo" placeholder="Ej: x20 comp.">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pImg">Imagen</label>
                            <input type="file" class="form-control-file" id="pImg" accept="image/*">
                        </div>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="pDest">
                        <label class="custom-control-label" for="pDest">Marcar como destacado (aparece en la home)</label>
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
// filtro de la tabla por categoria y subcategoria (todavia sin base de datos, lo hago con jQuery)
function filtrarTabla(){
    var cat = $('#filtroCat').val();
    var sub = $('#filtroSub').val();
    $('#listaProd tbody tr').each(function(){
        var ok = true;
        if(cat != '' && $(this).data('cat') != cat){ ok = false; }
        if(sub != '' && $(this).data('sub') != sub){ ok = false; }
        if(ok){ $(this).show(); }else{ $(this).hide(); }
    });
}
$('#filtroCat, #filtroSub').on('change', filtrarTabla);

// cuando elijo una categoria en el formulario, dejo solo sus subcategorias
$('#pCat').on('change', function(){
    var cat = $(this).val();
    $('#pSub').val('');
    $('#pSub option').each(function(){
        if($(this).val() != ''){
            if(cat != '' && $(this).data('cat') != cat){ $(this).hide(); }else{ $(this).show(); }
        }
    });
});

function nuevoProducto(){
    $('#tituloModal').text('Nuevo producto');
}
function editarProducto(nombre){
    $('#tituloModal').text('Editar: ' + nombre);
    $('#pNombre').val(nombre);
}
</script>

<?php require __DIR__ . '/../partials/admin/panel_close.php'; ?>
