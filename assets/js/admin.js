// admin.js

$(document).ready(function(){

    // DataTables arma la busqueda, el orden y la paginacion de las tablas del panel
    $('.tabla').DataTable({
        language: {
            search: 'Buscar:',
            zeroRecords: 'No se encontraron resultados',
            paginate: { next: 'Siguiente', previous: 'Anterior' }
        }
    });

    // los formularios del panel no guardan nada todavia, muestro un aviso simulado
    $('form.form-sim').on('submit', function(e){
        e.preventDefault();
        var form = this;
        if(form.checkValidity() == false){
            $(form).addClass('was-validated');
            return;
        }
        var msg = $(form).data('msg');
        if(!msg){ msg = 'Guardado (simulado).'; }
        $('#aviso').html('<div class="alert cf-alert cf-alert-success"><i class="fas fa-check-circle"></i> ' + msg + '</div>');
        $(form).removeClass('was-validated');
    });

});
