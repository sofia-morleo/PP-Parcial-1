<?php
// alert.php - aviso reutilizable de exito o error
// Uso: $tipo = 'exito' o 'error'; $mensaje = 'texto'; include de este archivo.
if(!isset($mensaje)){ $mensaje = ''; }
if(!isset($tipo)){ $tipo = 'exito'; }
if($mensaje != ''){
    $clase = 'cf-alert-success';
    $icono = 'fa-check-circle';
    if($tipo == 'error'){
        $clase = 'cf-alert-error';
        $icono = 'fa-exclamation-circle';
    }
?>
<div class="alert cf-alert <?php echo $clase ?>">
    <i class="fas <?php echo $icono ?>"></i> <?php echo $mensaje ?>
</div>
<?php } ?>
