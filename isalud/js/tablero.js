// La variable prefixTblIndicador se establece en el controlador tablero 
// a partir de la configuracion en params

/**
 * Agrega el contenido del indicador al tablero
 * */
function agregarIndicador(indicador, contenido) {
    $("#tableroPrincipal").sDashboard("addWidget", {
                    widgetId : prefixTblIndicador+indicador,
                    widgetContent : contenido
                });
}

/**
 * Obtiene los datos del indicador desde el controlador
 * */
function obtieneIndicador(url, ind) {
    // Validar que el indicador no este ya agregado al tablero
    existeIndicador = $('#tableroPrincipal').children('#'+prefixTblIndicador+ind);
    
    // Si no existe agregarlo al tablero
    if(existeIndicador.length == 0) {
        $.ajax({
            url: url,
            data: 'id='+ind+'&YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val(),
            type: "POST",
            dataType : "json",
            success: function( respuesta ) {
                if(respuesta.error) {
                    showError('Error al obtener datos del indicador, revise el mensaje de error: '+respuesta.msjerror);
                } else {
                    // Construir el widget del indicador
                    wgIndicador = '<div class="contenedorIndicador">';
                    wgIndicador += '<div class="tituloIndicador">'+respuesta.titulo+'</div>';
                    wgIndicador += '<div class="subtituloIndicador">'+respuesta.subtitulo+'</div>';
                    wgIndicador += '<div class="opcionesIndicador">\n\
                                        <div class="btn-group">\n\
                                            <button class="btn verFichaTecnica" data-id="'+ind+'">Ficha Tecnica</button>\n\
                                            <button class="btn verTablaDatos"  data-id="'+ind+'">Tabla de Datos</button>\n\
                                        </div>\n\
                                    </div>';
                    wgIndicador += '<div class="graficoIndicador"></div>';
                    wgIndicador += '<div class="pieIndicador">Fuente: '+respuesta.fuentes+'<br />Última actualización: '+respuesta.fecha+'</div>';
                    wgIndicador += '</div>';

                    agregarIndicador(ind, wgIndicador);
                    
                    tblDatos = ConvertJsonToTable(respuesta.datos);
                    $('#datosIndicadores').append('<li id="datos_'+ind+'">'+tblDatos+'</li>');
                    
                    // Guarda la dimension y el filtro del indicador
                    // Se utiliza para guardar el tablero
                    $('#datosIndicadores').append('<li id="config_dim_'+ind+'">'+respuesta.dimension+'</li>');
                    $('#datosIndicadores').append('<li id="config_fil_'+ind+'">'+JSON.stringify(respuesta.filtro)+'</li>'); // $.param(jsonObj)
                    
                    $('#'+prefixTblIndicador+ind+' .verFichaTecnica').click(getFichaTecnica);
                    $('#'+prefixTblIndicador+ind+' .verTablaDatos').click(getTablaDatos);
                    //construyeGrafia(ind, datos, etiquetas, tipo);
                }
            },
            error: function( xhr, status ) {
                showError( "Error al obtener los datos. "+status+" "+xhr.status );
            }
        }); 
    } else {
        // Si el indicador existe, dar el efecto de mover
        $("li#"+prefixTblIndicador+ind).effect("shake", { times : 3 }, 800);
    }
}

function getFichaTecnica(event) {
    event.preventDefault();
    event.stopPropagation()
        
    id = $(this).data('id');
    
    $.ajax({
        url: baseUrl+'/fichatecnica/getfichatecnica/'+id,
        data: 'id='+id+'&YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val(),
        type: "POST",
        //dataType : "json",
        success: function( respuesta ) {
            if(respuesta.error) {
                showError('Error al obtener datos del indicador, revise el mensaje de error: '+respuesta.msjerror);
            } else {
                $.alert(respuesta, {
                    icon: '',
                    title: 'Datos del indicador',
                    allowEscape: true,
                    maxHeight: $(window).height()-100,
                });
            }
        },
        error: function( xhr, status ) {
            showError( "Error al obtener los datos. "+status+" "+xhr.status );
        }
    }); 
}

function getTablaDatos(event) {
    event.preventDefault();
    event.stopPropagation()
        
    id = $(this).data('id');
    
    datos = $('#datos_'+id).html();
    
    $.alert(datos, {
        icon: '',
        title: 'Datos del indicador',
        allowEscape: true
    });
}

function guardarTablero(event) {
    event.preventDefault();
    event.stopPropagation();
    
    $.prompt('<i class="fa fa-pencil-square-o fa-lg"></i> Proporcione un nombre para guardar el grupo de indicadores del tablero', {
        icon:'',
        title:'Guardar grupo de indicadores',
        buttons:[
            { title:'Guardar', callback:function() {
                    $(this).dialog("close"); 
                    nombreTablero = $(this).find('#result').val();
                
                    objTablero = $("#tableroPrincipal").sDashboard("option","dashboardData");
                    // Define un array JSON vacio
                    datosTablero = {
                            "nombre": 'nombre del tablero',
                            "YII_CSRF_TOKEN": $('[name=YII_CSRF_TOKEN]').val(),
                            "datos": []
                        };

                    $.each(objTablero, function(posicion, indicador) {
                        idInd = indicador.widgetId.replace(prefixTblIndicador,''), // elimina la parte 'ind_'

                        jsonIndicador = {
                            id: idInd,
                            dimension: $('#config_dim_'+idInd).text(),
                            filtro: JSON.parse($('#config_fil_'+idInd).text()),
                            posicion: posicion+1,
                            tipo_grafico: '',
                            configuracion: '' 
                        };

                        datosTablero["datos"].push(jsonIndicador);
                    });

                    $.ajax({
                        url: baseUrl+'/tablero/guardartablero/',
                        data: datosTablero,
                        type: "POST",
                        dataType: "json",
                        success: function( respuesta ) {
                            if(respuesta.error) {
                                showError('Error al obtener datos del indicador, revise el mensaje de error: '+respuesta.msjerror);
                            } else {
                                showExito('Tablero guardado exitosamente.');
                            }
                        },
                        error: function( xhr, status ) {
                            showError( "Error al obtener los datos. "+status+" "+xhr.status );
                        }
                    });
                
                } 
            },
            { title:'Cancelar', callback:function() { $(this).dialog("close"); } }
        ]
    });
}

$(document).ready(function() {
    var widgetDefinitions = [];/*[
        {
            widgetId: "Widget1", //unique id for the widget
            widgetContent: '<div class="contenedorIndicador">\n\
                                <div class="tituloIndicador">Titulo</div>\n\
                                <div class="subtituloIndicador">Subtitulo</div>\n\
                                <div class="opcionesIndicador">\n\
                                    <div class="btn-group">\n\
                                        <button class="btn verFichaTecnica" data-id="1">Ficha Tecnica</button>\n\
                                        <button class="btn verTablaDatos" data-id="1">Tabla de Datos</button>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="graficoIndicador"></div>\n\
                                <div class="pieIndicador">Fuentes<br>Fecha de última actualización</div></div>'
        },
        {
            widgetId: "Widget2", //unique id for the widget
            widgetContent: $('.contenedorIndicador').html() //content for the widget
        }
    ];*/

    $("#tableroPrincipal").sDashboard({
        dashboardData : widgetDefinitions
    });

    $('#menuIndicadores > li').click(function(){
        event.preventDefault();
        
        url = $(this).find('a').attr('href');
        obtieneIndicador(url, $(this).attr('id'));
    });
    
    $('#tableroPrincipal .verFichaTecnica').click(getFichaTecnica);
    $('#tableroPrincipal .verTablaDatos').click(getTablaDatos);
    
    $('#btnGuardarTablero').click(guardarTablero);
});