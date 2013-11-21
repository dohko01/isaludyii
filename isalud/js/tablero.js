// La variable prefixTblIndicador se establece en el controlador tablero 
// a partir de la configuracion en params

function generaGrafica(respuesta, indicadorId)
{
	var arr1 = [];
	var rules = [];
	
	for(var ii=0; ii< respuesta.escalaEvaluacion.length; ii++)
	{
		arr1 = {
			"rule":"%v > "+respuesta.escalaEvaluacion[ii].limite_inf+" && %v <= "+respuesta.escalaEvaluacion[ii].limite_sup+"",
			"size":6,
			"background-color":""+respuesta.escalaEvaluacion[ii].color+""
		}
		rules.push(arr1);
	}
	
	var myChart = {
		type   : "line",
		title  : {text: respuesta.subtitulo},
		"scale-x":{
			values	: respuesta.etiquetas,
			"item"  : {
				"font-size":"9px"
			}
		},
        scaleY  : { label : { text : "Porcentaje" }, values: "0:100:10"},
		legend : {},
		series : [
			{
				values:		respuesta.valores,
				text:		respuesta.titulo,
				animate:	true,
				effect:		2,
				"marker":{
					"rules":rules,
				}
			}
		]
		};
		
		zingchart.render({
			id : "graficoIndicador_"+indicadorId,
			height : 400,
			width : 700,
			data : myChart
		});	
}

/**
 * Agrega el contenido del indicador al tablero
 * */
function agregarIndicador(indicador, contenido) {
    // Construir el widget del indicador
    wgIndicador = '<div class="contenedorIndicador">\n\
        <div class="tituloIndicador">'+contenido.titulo+'</div>\n\
        <div class="subtituloIndicador">'+contenido.subtitulo+'</div>\n\
        <div class="opcionesIndicador">\n\
                            <div class="btn-group">\n\
                                <button class="btn verFichaTecnica" data-id="'+indicador+'">Ficha Tecnica</button>\n\
                                <button class="btn verTablaDatos"  data-id="'+indicador+'">Tabla de Datos</button>\n\
                            </div>\n\
                        </div>\n\
        <div id="graficoIndicador_'+indicador+'" class="graficoIndicador"></div>\n\
        <div class="pieIndicador">Fuente: '+contenido.fuentes+'<br />Última actualización: '+contenido.fecha+'</div>\n\
    </div>';
                    
    $("#tableroPrincipal").sDashboard("addWidget", {
                    widgetId : prefixTblIndicador+indicador,
                    widgetContent : wgIndicador
                });
}

/**
 * Obtiene los datos del indicador desde el controlador
 * 
 * Recibe como parametro un JSON 
 * */
function obtieneIndicador(parametros) {
    // Validar que el indicador no este ya agregado al tablero
    existeIndicador = $('#tableroPrincipal').children('#'+prefixTblIndicador+parametros.id);
    
    // Si no existe agregarlo al tablero
    if(existeIndicador.length == 0) {
        $.extend( parametros, {"YII_CSRF_TOKEN": $('[name=YII_CSRF_TOKEN]').val()} );
         
        $.ajax({
            url: baseUrl+'/tablero/getindicador',
            data: parametros,
            type: "POST",
            dataType : "json",
            success: function( respuesta ) {
                if(respuesta.error) {
                    showError('Error al obtener datos del indicador, revise el mensaje de error: '+respuesta.msjerror);
                } else {
                    agregarIndicador(parametros.id, respuesta);
                    
                    tblDatos = ConvertJsonToTable(respuesta.datos);
                    $('#datosIndicadores').append('<li id="datos_'+parametros.id+'">'+tblDatos+'</li>');
                    
                    // Guarda la dimension y el filtro del indicador
                    // Se utiliza para guardar el tablero
                    $('#datosIndicadores').append('<li id="config_dim_'+parametros.id+'">'+respuesta.dimension+'</li>');
                    $('#datosIndicadores').append('<li id="config_fil_'+parametros.id+'">'+JSON.stringify(respuesta.filtro)+'</li>'); // $.param(jsonObj)
                    
                    $('#'+prefixTblIndicador+parametros.id+' .verFichaTecnica').click(getFichaTecnica);
                    $('#'+prefixTblIndicador+parametros.id+' .verTablaDatos').click(getTablaDatos);
                    //construyeGrafia(ind, datos, etiquetas, tipo);
					generaGrafica(respuesta, parametros.id);
					//alert(respuesta.subtitulo);
                }
            },
            error: function( xhr, status ) {
                showError( "Error al obtener los datos. "+status+" "+xhr.status );
            }
        }); 
    } else {
        // Si el indicador existe, dar el efecto de mover
        $("li#"+prefixTblIndicador+parametros.id).effect("shake", { times : 3 }, 800);
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
    
    objTablero = $("#tableroPrincipal").sDashboard("option","dashboardData");
    
    if(objTablero.length == 0) {
        showError('No hay indicadores cargados en el tablero.');
        return false;
    }
    
    $.prompt('<i class="fa fa-pencil-square-o fa-lg"></i> Proporcione un nombre para guardar el grupo de indicadores del tablero', {
        icon:'',
        title:'Guardar grupo de indicadores',
        buttons:[
            { title:'Guardar', callback:function() {
                    $(this).dialog("close"); 
                    nombreTablero = $(this).find('#result').val();
                    
                    // Define un array JSON con los datos a enviar
                    datosTablero = {
                            "nombre": nombreTablero,
                            "YII_CSRF_TOKEN": $('[name=YII_CSRF_TOKEN]').val(),
                            "datos": [] // arreglo con los datos de los indicadores dentro del tablero
                        };

                    $.each(objTablero, function(posicion, indicador) {
                        idInd = indicador.widgetId.replace(prefixTblIndicador,''), // elimina la parte 'ind_'

                        jsonIndicador = {
                            id: idInd,
                            dimension: $('#config_dim_'+idInd).text(),
                            filtro: $('#config_fil_'+idInd).text(),//JSON.parse($('#config_fil_'+idInd).text()),
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

/**
 * Obtiene la lista de indicadores guardados en un tablero
 * */
function obtieneTablero(event, idTab) {
    event.preventDefault();
    event.stopPropagation();
    
    $.ajax({
        url: baseUrl+'/tablero/gettablero',
        data: 'id='+idTab+'&YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val(),
        type: "POST",
        dataType : "json",
        success: function( respuesta ) {
            if(respuesta.error) {
                showError('Error al obtener datos del tablero, revise el mensaje de error: '+respuesta.msjerror);
            } else {
                $.each(respuesta.datos, function(posicion, indicador) {
                    obtieneIndicador(indicador);
                });
            }
        },
        error: function( xhr, status ) {
            showError( "Error al obtener los datos. "+status+" "+xhr.status );
        }
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
    ];*/

    $("#tableroPrincipal").sDashboard({
        dashboardData : widgetDefinitions
    });

    $('#menuIndicadores > li').click(function(event){
        event.preventDefault();
        event.stopPropagation();
        
        parametros = {
                    id: $(this).attr('id'),
                    dimension: $('#dimension').val(),
                    filtro: JSON.parse($('#filtro').val()),
                    tipo_grafico: '',
                    configuracion: '' 
                };
        
        obtieneIndicador(parametros);
    });
    
    $('#menuTableros > li').click(function(event){
        event.preventDefault();
        event.stopPropagation();
        
        obtieneTablero(event, $(this).data('id'));
    });
    
    $('#tableroPrincipal .verFichaTecnica').click(getFichaTecnica);
    $('#tableroPrincipal .verTablaDatos').click(getTablaDatos);
    
    $('#btnGuardarTablero').click(guardarTablero);
});