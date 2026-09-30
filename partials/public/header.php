<?php
// header.php - cabecera del sitio publico (se incluye en todas las vistas)
require_once __DIR__ . '/../../config.php';
if(!isset($titulo)){ $titulo = 'City Farmac'; }
if(!isset($activo)){ $activo = ''; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo ?> - City Farmac</title>
    <link rel="stylesheet" href="<?php echo url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/public.css') ?>">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light cf-navbar sticky-top">
        <div class="container container-narrow">
            <a class="navbar-brand cf-brand" href="<?php echo url('index.php') ?>">
                <span class="cross">+</span> City Farmac
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link <?php if($activo=='home'){ echo 'active'; } ?>" href="<?php echo url('index.php') ?>">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($activo=='productos'){ echo 'active'; } ?>" href="<?php echo url('productos.php') ?>">Productos</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($activo=='contacto'){ echo 'active'; } ?>" href="<?php echo url('contacto.php') ?>">Contáctenos</a></li>
                    <li class="nav-item ml-lg-3"><a class="btn btn-cf-outline btn-sm" href="<?php echo url('admin/login.php') ?>"><i class="fas fa-user-shield"></i> Panel</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
