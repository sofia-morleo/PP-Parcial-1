// public.js
// En esta instancia los formularios no se envian a ningun lado.
// Si estan completos muestro un mensaje de exito simulado.

$(document).ready(function(){

    $('form.form-sim').on('submit', function(e){
        e.preventDefault();
        var form = this;
        if(form.checkValidity() == false){
            $(form).addClass('was-validated');
            return;
        }
        var msg = $(form).data('msg');
        if(!msg){ msg = 'Recibimos tu mensaje. ¡Gracias!'; }
        $('#aviso').html('<div class="alert cf-alert cf-alert-success"><i class="fas fa-check-circle"></i> ' + msg + '</div>');
        form.reset();
        $(form).removeClass('was-validated');
    });

});
