ip = location.hostname;

$(document).on('ready', function() {

    $('.ui.dropdown')
            .dropdown()
            ;

    $('.ui.accordion')
            .accordion()
            ;

    botonesEventos();

    function botonesEventos() {

        $('#imprimir').unbind('click');
        $('#imprimir').on('click', function() {

            ajax();

        });

    }


    function ajax() {

        var codigo = $('#codigo2').val();
        //deshabilitar boton
        $('#mensaje').prop('hidden', true);
        $('#imprimir').prop('disabled', true);
        //activar spinner
        $('#spinner').addClass('active');

        $.ajax({
            'dataType': "json",
            'url': 'http://'+ip+'/user/impresion',
            'type': 'POST', 
            'data': {'codigo': codigo},
            'success': function(data) { 

                if (data) {
                  //  console.log(data);
                    //apagar spinner
                    $('#imprimir').prop('disabled', false);
                    $('#spinner').removeClass('active');
                    //mostrar mensaje de completado
                    $('#mensaje').prop('hidden', false);
                }
            },
            error: function(e) {

                console.log(e);
            }
        });





    }
});