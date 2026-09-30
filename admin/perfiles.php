<?php
// admin/perfiles.php
require __DIR__ . '/../config.php';
$titulo = 'Perfiles';
$tituloPagina = 'Perfiles';
$activo = 'perfiles';

$perfiles = datos('profiles');

// secciones del panel que se pueden asignar a un perfil (clave => texto)
// (no uso el nombre $secciones porque ya lo usa el menu del panel)
$todasSecciones = array(
    'home' => 'Inicio',
    'productos' => 'Productos',
    'categorias' => 'Categorías',
    'marcas' => 'Marcas',
    'comentarios' => 'Comentarios',
    'usuarios' => 'Usuarios',
    'perfiles' => 'Perfiles'
);

require __DIR__ . '/../partials/admin/head.php';
require __DIR__ . '/../partials/admin/panel_open.php';
?>

<div id="aviso"></div>

<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-cf btn-sm" data-toggle="modal" data-target="#modalPerfil" onclick="nuevoPerfil()">
        <i class="fas fa-plus"></i> Nuevo perfil
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered tabla" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Nombre del perfil</th><th>Secciones</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($perfiles as $p){ ?>
                <tr>
                    <td><?php echo $p['nombre'] ?></td>
                    <td>
                        <?php foreach($p['secciones'] as $s){ ?>
                            <span class="badge badge-pill badge-light border mr-1"><?php echo $todasSecciones[$s] ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($p['activo']){ ?>
                            <span class="status-pill status-on">Activo</span>
                        <?php }else{ ?>
                            <span class="status-pill status-off">Inactivo</span>
                        <?php } ?>
                    </td>
                    <td style="white-space:nowrap">
                        <button class="btn btn-sm btn-outline-primary" title="Modificar" data-toggle="modal" data-target="#modalPerfil" onclick="editarPerfil('<?php echo $p['nombre'] ?>', '<?php echo implode(',', $p['secciones']) ?>')"><i class="fas fa-edit"></i></button>
                        <?php if($p['activo']){ ?>
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

<!-- modal para dar de alta o editar un perfil -->
<div class="modal fade" id="modalPerfil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form-sim" data-msg="Perfil guardado (simulado, todavía sin base de datos)." novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Nuevo perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pNombre">Nombre del perfil</label>
                        <input type="text" class="form-control" id="pNombre" required maxlength="60">
                    </div>
                    <p class="font-weight-bold mb-2">Secciones con acceso</p>
                    <div class="form-row">
                        <?php foreach($todasSecciones as $clave => $texto){ ?>
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input seccion" id="sec_<?php echo $clave ?>" value="<?php echo $clave ?>">
                                    <label class="custom-control-label" for="sec_<?php echo $clave ?>"><?php echo $texto ?></label>
                                </div>
                            </div>
                        <?php } ?>
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
function nuevoPerfil(){
    $('#tituloModal').text('Nuevo perfil');
    $('#pNombre').val('');
    $('.seccion').prop('checked', false);
}
// las secciones llegan separadas por coma, ej: "home,productos"
function editarPerfil(nombre, secciones){
    $('#tituloModal').text('Editar: ' + nombre);
    $('#pNombre').val(nombre);
    $('.seccion').prop('checked', false);
    var lista = secciones.split(',');
    for(var i = 0; i < lista.length; i++){
        $('#sec_' + lista[i]).prop('checked', true);
    }
}
</script>

<?php require __DIR__ . '/../partials/admin/panel_close.php'; ?>
