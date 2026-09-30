<?php
// config.php

// Detecto la carpeta donde esta el proyecto asi los links, css, js e imagenes
// andan aunque copie el proyecto en otra carpeta del htdocs.
// Si por algun motivo no funciona, se puede poner la ruta a mano aca abajo.
$raiz = str_replace('\\', '/', __DIR__);
$docroot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
define('BASE_URL', rtrim(str_replace($docroot, '', $raiz), '/'));

// arma una ruta desde la raiz del proyecto
function url($ruta){
    return BASE_URL . '/' . $ruta;
}

// trae uno de los archivos de datos de ejemplo (carpeta data)
function datos($nombre){
    return require __DIR__ . '/data/' . $nombre . '.php';
}

// muestra el ranking con estrellitas (1 a 5)
function estrellas($valor){
    $html = '';
    for($i = 1; $i <= 5; $i++){
        if($i <= round($valor)){
            $html = $html . '<i class="fas fa-star"></i>';
        }else{
            $html = $html . '<i class="fas fa-star empty"></i>';
        }
    }
    return '<span class="stars">' . $html . '</span>';
}

// formatea un precio en pesos
function precio($n){
    return '$' . number_format($n, 0, ',', '.');
}

// busca el nombre de una marca por su id
function nombreMarca($id){
    $marcas = datos('brands');
    foreach($marcas as $m){
        if($m['id'] == $id){
            return $m['nombre'];
        }
    }
    return '-';
}
?>
