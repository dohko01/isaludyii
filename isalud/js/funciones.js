/* Fuente
http://jsfiddle.net/justincook/x4C2t/
http://jsfiddle.net/x4C2t/7/
*/
$.fn.loading = function(show){
    if(show){
        this.prepend('<div class="loading"></div>');
    }else{
        this.children('.loading').remove();
    }
};

// Indicador de 'ejecutando' de todas las peticiones ajax
$(document).ready(function(){
    $('body').ajaxStart(function() {
        $(this).loading(true);
    });

    $('body').ajaxStop(function() {
        $(this).loading(false);
    });
});

function showError(mensaje) {
    $.alert('<div class="alert alert-error"><i class="fa fa-frown-o fa-lg"></i> <i class="fa fa-thumbs-down fa-lg"></i> '+mensaje+'</div>', {
        icon: '',
        title: 'ERROR al procesar la petición',
        allowEscape: true
    });
}

function showAdvertencia(mensaje) {
    $.alert('<div class="alert alert-info"><i class="fa fa-meh-o fa-lg"></i> <i class="fa fa-exclamation-triangle fa-lg"></i> '+mensaje+'</div>', {
        icon: '',
        title: 'Advertencia',
        allowEscape: true
    });
}

function showExito(mensaje) {
    $.alert('<div class="alert alert-success"><i class="fa fa-smile-o fa-lg"></i> <i class="fa fa-thumbs-up fa-lg"></i> '+mensaje+'</div>', {
        icon: '',
        title: 'Petición procesada correctamente',
        allowEscape: true
    });
}