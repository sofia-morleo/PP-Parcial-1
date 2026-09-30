<?php
// categories.php - categorias y sus subcategorias de ejemplo
return [
  ['id' => 1, 'nombre' => 'Medicamentos', 'activo' => true, 'subcategorias' => [
    ['id' => 11, 'nombre' => 'Analgésicos',  'activo' => true],
    ['id' => 12, 'nombre' => 'Antigripales', 'activo' => true],
    ['id' => 13, 'nombre' => 'Digestivos',   'activo' => true],
  ]],
  ['id' => 2, 'nombre' => 'Cuidado personal', 'activo' => true, 'subcategorias' => [
    ['id' => 21, 'nombre' => 'Higiene bucal',   'activo' => true],
    ['id' => 22, 'nombre' => 'Cuidado capilar', 'activo' => true],
    ['id' => 23, 'nombre' => 'Desodorantes',    'activo' => true],
  ]],
  ['id' => 3, 'nombre' => 'Perfumería', 'activo' => true, 'subcategorias' => [
    ['id' => 31, 'nombre' => 'Fragancias femeninas', 'activo' => true],
    ['id' => 32, 'nombre' => 'Fragancias masculinas', 'activo' => true],
  ]],
  ['id' => 4, 'nombre' => 'Dermocosmética', 'activo' => true, 'subcategorias' => [
    ['id' => 41, 'nombre' => 'Protección solar', 'activo' => true],
    ['id' => 42, 'nombre' => 'Cremas faciales',  'activo' => true],
  ]],
  ['id' => 5, 'nombre' => 'Bebés', 'activo' => false, 'subcategorias' => [
    ['id' => 51, 'nombre' => 'Pañales',      'activo' => true],
    ['id' => 52, 'nombre' => 'Higiene bebé', 'activo' => true],
  ]],
];
