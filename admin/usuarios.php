<?php
// admin/usuarios.php
require __DIR__ . '/../config.php';
$titulo = 'Usuarios';
$tituloPagina = 'Usuarios';
$activo = 'usuarios';

$usuarios = datos('users');
$perfiles = datos('profiles');

// armo una lista con el nombre de cada perfil por su id
$nombrePerfil = array();
foreach($perfiles as $p){
    $nombrePerfil[$p['id']] = $p['nombre'];
}

require __DIR__ . '/../partials/admin/head.php';
require __DIR__ . '/../partials/admin/panel_open.php';
?>

<div id="aviso"></div>

<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-cf btn-sm" data-toggle="modal" data-target="#modalUsuario" onclick="nuevoUsuario()">
        <i class="fas fa-plus"></i> Nuevo usuario
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered tabla" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th><th>Email</th><th>Perfil</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $u){ ?>
                <tr>
                    <td><?php echo $u['nombre'] ?></td>
                    <td><?php echo $u['email'] ?></td>
                    <td>
                        <?php if(isset($nombrePerfil[$u['perfil_id']])){ echo $nombrePerfil[$u['perfil_id']]; }else{ echo '-'; } ?>
                    </td>
                    <td>
                        <?php if($u['activo']){ ?>
                            <span class="status-pill status-on">Activo</span>
                        <?php }else{ ?>
                            <span class="status-pill status-off">Inactivo</span>
                        <?php } ?>
                    </td>
                    <td style="white-space:nowrap">
                        <button class="btn btn-sm btn-outline-primary" title="Modificar" data-toggle="modal" data-target="#modalUsuario" onclick="editarUsuario('<?php echo $u['nombre'] ?>', '<?php echo $u['email'] ?>', '<?php echo $u['perfil_id'] ?>')"><i class="fas fa-edit"></i></button>
                        <?php if($u['activo']){ ?>
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

<!-- modal para dar de alta o editar un usuario -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="form-sim" data-msg="Usuario guardado (simulado, todavía sin base de datos)." novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uNombre">Nombre</label>
                        <input type="text" class="form-control" id="uNombre" required maxlength="80">
                    </div>
                    <div class="form-group">
                        <label for="uEmail">Email</label>
                        <input type="email" class="form-control" id="uEmail" required maxlength="120">
                    </div>
                    <div class="form-group">
                        <label for="uPass">Contraseña</label>
                        <input type="password" class="form-control" id="uPass" required minlength="6">
                    </div>
                    <div class="form-group">
                        <label for="uPerfil">Perfil</label>
                        <select class="form-control" id="uPerfil" required>
                            <option value="">Elegir...</option>
                            <?php foreach($perfiles as $p){ ?>
                                <option value="<?php echo $p['id'] ?>"><?php echo $p['nombre'] ?></option>
                            <?php } ?>
                        </select>
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
function nuevoUsuario(){
    $('#tituloModal').text('Nuevo usuario');
    $('#uNombre').val('');
    $('#uEmail').val('');
    $('#uPass').val('');
    $('#uPerfil').val('');
}
function editarUsuario(nombre, email, perfil){
    $('#tituloModal').text('Editar: ' + nombre);
    $('#uNombre').val(nombre);
    $('#uEmail').val(email);
    $('#uPass').val('');
    $('#uPerfil').val(perfil);
}
</script>

<?php require __DIR__ . '/../partials/admin/panel_close.php'; ?>
