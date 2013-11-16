function agregarIndicador(indicador, contenido) {
    $("#tableroPrincipal").sDashboard("addWidget", {
                    widgetId : "ind_"+indicador,
                    widgetContent : contenido
                });
}

function obtieneIndicador(url, ind) {
    $.ajax({
        url: url,
        data: 'id='+ind+'&YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val(),
        type: "POST",
        dataType : "json",
        success: function( respuesta ) {
            if(respuesta.error) {
                alert('Error al obtener datos del indicador, revise el mensaje de error. \n\n'+respuesta.msjerror);
            } else {
                wgIndicador = '<div class="contenedorIndicador">';
                wgIndicador += '<div class="tituloIndicador">'+respuesta.titulo+'</div>';
                wgIndicador += '<div class="subtituloIndicador">'+respuesta.subtitulo+'</div>';
                wgIndicador += '<div class="opcionesIndicador">Barra de opciones</div>';
                wgIndicador += '<div class="graficoIndicador"></div>';
                wgIndicador += '<div class="pieIndicador">Fuente: '+respuesta.fuentes+'<br />Última actualización: '+respuesta.fecha+'</div>';
                wgIndicador += '</div>';

                agregarIndicador(ind, wgIndicador);
                //construyeGrafia(ind, datos, etiquetas, tipo);
            }
        },
        error: function( xhr, status ) {
            alert( "Error al obtener los datos. "+status+" "+xhr.status );
        }
    });
}

$(document).ready(function() {
    var widgetDefinitions = [
        {
            widgetId: "Widget1", //unique id for the widget
            widgetContent: $('.contenedorIndicador').html() //content for the widget
        },
        {
            widgetId: "Widget2", //unique id for the widget
            widgetContent: $('.contenedorIndicador').html() //content for the widget
        }
    ];

    $("#tableroPrincipal").sDashboard({
        dashboardData : widgetDefinitions
    });

    $('#menuIndicadores > li').click(function(){
        url = $(this).find('a').attr('href');
        obtieneIndicador(url, $(this).attr('id'));
        
        return false;
    });
});