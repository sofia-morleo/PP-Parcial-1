<?php
// head.php - cabecera del panel de administracion (comun a todas las vistas del admin)
require_once __DIR__ . '/../../config.php';
if(!isset($titulo)){ $titulo = 'Panel'; }
if(!isset($claseBody)){ $claseBody = 'bg-gradient-primary'; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo ?> - Admin City Farmac</title>
    <link rel="stylesheet" href="<?php echo url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendor/sb-admin-2/sb-admin-2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/admin.css') ?>">
</head>
<body class="<?php echo $claseBody ?>">
