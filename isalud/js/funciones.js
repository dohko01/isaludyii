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