# City Farmac - Instancia 1

Trabajo práctico de PP: Producción Web (Da Vinci).
Maquetado del sitio de la farmacia City Farmac y su panel de administración.
Es todo estático: no hay base de datos todavía, los datos son de ejemplo (arrays en la carpeta `data`).

## Tecnologías

- PHP 8 (lo probé con el que trae XAMPP)
- HTML, CSS y JavaScript
- Bootstrap 4 y FontAwesome (vienen en `assets/vendor`)

## Cómo levantarlo

Con XAMPP:
1. Copiar la carpeta `Parcial1` dentro de `xampp/htdocs`.
2. Prender Apache desde el panel de XAMPP.
3. Entrar a http://localhost/Parcial1

O con el servidor que trae PHP, parado en la carpeta del proyecto:

    php -S localhost:8000

y entrar a http://localhost:8000

## Ruta base

La ruta base se calcula sola en `config.php` (usa la carpeta donde está el proyecto),
así que los links andan aunque lo copie en otra carpeta. Si hiciera falta, se puede
cambiar a mano en ese archivo (constante `BASE_URL`).

## Vistas

Sitio público:

- index.php - inicio
- productos.php - listado de productos
- producto.php?id=1 - detalle de un producto
- contacto.php - formulario de contacto
- 404.php - página de error

Panel de administración (carpeta admin):

- admin/login.php - login
- admin/registro.php - registro
- admin/index.php - inicio del panel
- admin/productos.php - productos
- admin/categorias.php - categorías (y subcategorías)
- admin/marcas.php - marcas
- admin/comentarios.php - comentarios
- admin/usuarios.php - usuarios
- admin/perfiles.php - perfiles
