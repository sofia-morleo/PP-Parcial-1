<?php
// contacto.php - formulario de contacto
require __DIR__ . '/config.php';
$titulo = 'Contáctenos';
$activo = 'contacto';

$areas = datos('areas');

require __DIR__ . '/partials/public/header.php';
?>

<section class="section">
    <div class="container container-narrow">
        <h1 class="section-title">Contáctenos</h1>
        <p class="section-sub">¿Tenés una consulta? Escribinos y te respondemos a la brevedad.</p>

        <div class="row">
            <div class="col-lg-7 mb-4">
                <div id="aviso"></div>
                <form class="form-card form-sim" data-msg="¡Gracias! Te vamos a responder a la brevedad." novalidate>
                    <div class="form-group">
                        <label for="nombre">Nombre y apellido</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="area">Área de la empresa</label>
                        <select class="form-control" id="area" name="area" required>
                            <option value="">Elegir...</option>
                            <?php foreach($areas as $a){ ?>
                                <option value="<?php echo $a ?>"><?php echo $a ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-cf">Enviar</button>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="filter-card">
                    <h2 class="h6 font-weight-bold mb-3">Nuestros datos</h2>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-map-marker-alt mr-2 text-success"></i>Av. Siempre Viva 1234, CABA</li>
                        <li class="mb-2"><i class="fas fa-phone mr-2 text-success"></i>0800-CITY-FARMAC</li>
                        <li class="mb-2"><i class="fas fa-envelope mr-2 text-success"></i>hola@cityfarmac.com.ar</li>
                        <li><i class="fas fa-clock mr-2 text-success"></i>Lun. a vie. de 9 a 19 hs.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/public/footer.php'; ?>
