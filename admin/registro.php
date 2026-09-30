<?php
// admin/registro.php
require __DIR__ . '/../config.php';
$titulo = 'Crear cuenta';
$claseBody = 'bg-gradient-primary';
require __DIR__ . '/../partials/admin/head.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-flex bg-register-image">
                            <span class="cross">+</span>
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">¡Creá tu cuenta!</h1>
                                </div>
                                <div id="aviso"></div>
                                <form class="form-sim" data-msg="Cuenta creada (simulado, todavía sin base de datos)." novalidate>
                                    <div class="form-group">
                                        <label for="rNombre">Nombre</label>
                                        <input type="text" class="form-control" id="rNombre" placeholder="Nombre y apellido" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rEmail">Correo electrónico</label>
                                        <input type="email" class="form-control" id="rEmail" placeholder="nombre@ejemplo.com" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <label for="rPass">Contraseña</label>
                                            <input type="password" class="form-control" id="rPass" placeholder="Contraseña" minlength="6" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="rPass2">Repetir contraseña</label>
                                            <input type="password" class="form-control" id="rPass2" placeholder="Repetir contraseña" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-cf btn-block">Registrarme</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?php echo url('admin/login.php') ?>">¿Ya tenés cuenta? Ingresá</a>
                                </div>
                                <div class="text-center mt-3">
                                    <a class="small text-muted" href="<?php echo url('index.php') ?>"><i class="fas fa-arrow-left mr-1"></i>Volver al sitio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/admin/auth_close.php'; ?>
