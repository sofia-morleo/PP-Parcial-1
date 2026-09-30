<?php
// panel_open.php - menu lateral y barra superior del panel
// Antes de incluir este archivo se puede definir $activo (seccion actual) y $tituloPagina.
if(!isset($activo)){ $activo = ''; }
if(!isset($tituloPagina)){ $tituloPagina = 'Panel'; }

// secciones del menu: clave, archivo, icono y texto
$secciones = array(
    array('home',        'index.php',       'fa-home',        'Inicio'),
    array('productos',   'productos.php',   'fa-pills',       'Productos'),
    array('categorias',  'categorias.php',  'fa-sitemap',     'Categorías'),
    array('marcas',      'marcas.php',      'fa-tags',        'Marcas'),
    array('comentarios', 'comentarios.php', 'fa-comments',    'Comentarios'),
    array('usuarios',    'usuarios.php',    'fa-users',       'Usuarios'),
    array('perfiles',    'perfiles.php',    'fa-user-shield', 'Perfiles')
);
?>
<div id="wrapper">

    <!-- Menu lateral -->
    <ul class="navbar-nav sidebar sidebar-dark accordion bg-cf" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo url('admin/index.php') ?>">
            <span class="cross">+</span>
            <div class="sidebar-brand-text mx-1">City Farmac</div>
        </a>
        <hr class="sidebar-divider my-0">
        <?php foreach($secciones as $s){ ?>
            <?php if($s[0] == 'productos'){ ?><hr class="sidebar-divider"><div class="sidebar-heading">Gestión</div><?php } ?>
            <li class="nav-item <?php if($activo == $s[0]){ echo 'active'; } ?>">
                <a class="nav-link" href="<?php echo url('admin/' . $s[1]) ?>"><i class="fas fa-fw <?php echo $s[2] ?>"></i> <span><?php echo $s[3] ?></span></a>
            </li>
        <?php } ?>
        <hr class="sidebar-divider d-none d-md-block">
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- Barra superior -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" aria-label="Menu">
                    <i class="fa fa-bars"></i>
                </button>
                <span class="d-none d-sm-inline-block text-muted small">Panel de administración</span>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-toggle="dropdown">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin Farmac</span>
                            <i class="fas fa-user-circle fa-lg text-gray-500"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userMenu">
                            <a class="dropdown-item" href="<?php echo url('index.php') ?>"><i class="fas fa-globe fa-sm fa-fw mr-2 text-gray-400"></i> Ver sitio</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo url('admin/login.php') ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid">
                <h1 class="h3 mb-4 page-title"><?php echo $tituloPagina ?></h1>
