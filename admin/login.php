<?php
// admin/login.php
require __DIR__ . '/../config.php';
$titulo = 'Ingresar';
$claseBody = 'bg-gradient-primary';
require __DIR__ . '/../partials/admin/head.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex bg-login-image">
                            <span class="cross">+</span>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1>
                                </div>
                                <div id="aviso"></div>
                                <!-- en esta instancia el ingreso solo lleva al panel -->
                                <form action="<?php echo url('admin/index.php') ?>" method="get">
                                    <div class="form-group">
                                        <label for="lEmail">Correo electrónico</label>
                                        <input type="email" class="form-control" id="lEmail" name="email" placeholder="nombre@ejemplo.com" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lPass">Contraseña</label>
                                        <input type="password" class="form-control" id="lPass" name="password" placeholder="Contraseña" required>
                                    </div>
                                    <button type="submit" class="btn btn-cf btn-block">Ingresar</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">¿Olvidaste tu contraseña?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?php echo url('admin/registro.php') ?>">Crear una cuenta</a>
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
