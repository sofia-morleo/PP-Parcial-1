<?php
// admin/marcas.php
require __DIR__ . '/../config.php';
$titulo = 'Marcas';
$tituloPagina = 'Marcas';
$activo = 'marcas';

$marcas = datos('brands');

require __DIR__ . '/../partials/admin/head.php';
require __DIR__ . '/../partials/admin/panel_open.php';
?>

<div id="aviso"></div>

<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-cf btn-sm" data-toggle="modal" data-target="#modalMarca" onclick="nuevaMarca()">
        <i class="fas fa-plus"></i> Nueva marca
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered tabla" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($marcas as $m){ ?>
                <tr>
                    <td><?php echo $m['nombre'] ?></td>
                    <td>
                        <?php if($m['activo']){ ?>
                            <span class="status-pill status-on">Activo</span>
                        <?php }else{ ?>
                            <span class="status-pill status-off">Inactivo</span>
                        <?php } ?>
                    </td>
                    <td style="white-space:nowrap">
                        <button class="btn btn-sm btn-outline-primary" title="Modificar" data-toggle="modal" data-target="#modalMarca" onclick="editarMarca('<?php echo $m['nombre'] ?>')"><i class="fas fa-edit"></i></button>
                        <?php if($m['activo']){ ?>
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

<!-- modal para dar de alta o editar una marca -->
<div class="modal fade" id="modalMarca" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="form-sim" data-msg="Marca guardada (simulado, todavía sin base de datos)." novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Nueva marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mNombre">Nombre</label>
                        <input type="text" class="form-control" id="mNombre" required maxlength="60">
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
function nuevaMarca(){
    $('#tituloModal').text('Nueva marca');
    $('#mNombre').val('');
}
function editarMarca(nombre){
    $('#tituloModal').text('Editar: ' + nombre);
    $('#mNombre').val(nombre);
}
</script>

<?php require __DIR__ . '/../partials/admin/panel_close.php'; ?>
