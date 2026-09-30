<?php
// profiles.php - perfiles del panel de ejemplo
// secciones son las partes del menu a las que puede entrar cada perfil
return [
  ['id'=>1,'nombre'=>'Administrador','activo'=>true,
   'secciones'=>['home','productos','categorias','marcas','comentarios','usuarios','perfiles']],
  ['id'=>2,'nombre'=>'Editor de catálogo','activo'=>true,
   'secciones'=>['home','productos','categorias','marcas']],
  ['id'=>3,'nombre'=>'Moderador','activo'=>true,
   'secciones'=>['home','comentarios']],
  ['id'=>4,'nombre'=>'Solo lectura','activo'=>false,
   'secciones'=>['home']],
];
