// Las variables prefixTblIndicador, baseUrl y graficos se establecen en la accion index el controlador tablero 

/**
 * Obtiene el JSON de configuracion para el objeto ZingChart
 */
function getJSONGrafica(parametros) {
    var rules = [];
    var markers = [];
    var jsonGrafica = null;
	
	for(i=0; i<parametros.escalaEvaluacion.length; i++) {
		rule = {
			"rule": "%v >= "+parametros.escalaEvaluacion[i].limite_inf+" && %v <= "+parametros.escalaEvaluacion[i].limite_sup,
			"size": 6,
			"background-color": parametros.escalaEvaluacion[i].color,
            "line-color": parametros.escalaEvaluacion[i].color,
		};
        
        market = {
    	    "type": "area",
			"range": [ parametros.escalaEvaluacion[i].limite_inf, parametros.escalaEvaluacion[i].limite_sup ],
			"background-color": parametros.escalaEvaluacion[i].color,
			"alpha": 0.3,
            "placement": "top",
            "label": {
                    "text": parametros.escalaEvaluacion[i].nombre,
                    "bold": true
                }
		};
        
		rules.push(rule);
        markers.push(market);
	}
    
    switch(parametros.tipo_grafico) {
        case 'area':
        case 'area3d':
        case 'bar':
        case 'bar3d':
        case 'bubble':
        case 'hbar':
        case 'hbar3d':
        case 'line':
        case 'line3d':
            jsonGrafica = {
                "graphset": [ {
                    "type": parametros.tipo_grafico,
                    "title": { 
                        "text": parametros.titulo,
                        "background-color":"none",
                        "font-color":"black"
                    },
                    "subtitle": { 
                        "text": parametros.subtitulo,
                        "background-color":"none",
                        "font-color":"black"
                    },
                    "source": { "text": "Fuentes: "+parametros.fuentes+", Última actualización: "+parametros.fecha },
                    "scaleX": {
                        "label": { "text": parametros.etiquetaX },
                        "values": parametros.etiquetas,
                        "item": { "font-size":"9px" }
                    },
                    "scaleY": { 
                        "label": { "text": parametros.etiquetaY },
                        "values": "0:100:10", 
                        "markers": markers 
                    },
                    "border-width": 1,
                    "border-color": "black",
                    "background-color": "white",
                    "plot": {
                        "rules": rules,
                        "valueBox": { 
                            "type": "all", 
                            "placement": "top", 
                            "color": "#1F307C" 
                        }
                    },
                    "series": [ {
                        "values": parametros.valores,
                        "text": parametros.titulo,
                        "animate": true,
                        "effect": 2,
                        "marker": { "rules": rules }
                    } ] 
                } ]
            };
        break;
        
        case 'pie':
        case 'pie3d':
            jsonGrafica = {
                "graphset": [ {
                    "source": { text : "Source: Farnsworth Delivery Tracking Gizmo"},
                    "type": parametros.tipo_grafico,
                    "background-color":"#eee",
                    "title":{
                        "text":"Top Used Mobile Apps",
                        "background-color":"none",
                        "font-color":"gray"
                    },
                    "subtitle":{
                        "text":"Number of Users at Acme Company",
                        "font-color":"gray"
                    },
                    "plotarea":{
                        "margin-top":"10px",
                        "margin-bottom":"30px",

                    },
                    "plot":{
                        "value-box":{
                            "color":"gray",
                            "line-width":"10px",
                            "bold":true
                        }
                    },
                    "scale-r":{
                        "ref-angle":130
                    },
                    "tooltip":{
                        "text":"%t <br>Number of Users %v"
                    },
                    "series":[
                        {
                            "text":"Video App",
                            "values":[15],
                            "background-color":"#7dbdff",
                        },
                        {
                            "text":"Note App",
                            "values":[18],
                            "background-color":"#88c79d"
                        },
                        {
                            "text":"Social App",
                            "values":[20],
                            "background-color":"#fda9c7"
                        },
                        {
                            "text":"Billing App",
                            "values":[16],
                            "background-color":"#fdd86f"
                        },
                        {
                            "text":"Email App",
                            "values":[21],
                            "background-color":"#f76966",

                        }
                    ]
                } ]
            };
        break;
        
        case 'radar':
            jsonGrafica = {
                "graphset": [{
                    "source": { text : "Source: Farnsworth Delivery Tracking Gizmo" },
                    "border-width":1,
                    "border-color":"black",
                    "legend":{
                        "border-color":"#CCCCCC",
                        "background-color":"#FFFFFF",
                        "margin-top":40,
                        "shadow":false,
                        "alpha":1
                    },
                    "scale":{
                        "size-factor":0.75
                    },
                    "tooltip":{
                        "background-color":"#333333",
                        "font-size":11,
                        "font-color":"#FFFFFF",
                        "bold":true,
                        "font-family":"Helvetica",
                        "padding":5
                    },
                    "series":[
                        {
                            "text":"Zeus Effort Estimate (in days)",
                            "values":[11,39,25,12,17.5,25.5,25],
                            "marker":{
                                "background-color-2":"#699EBF",
                                "background-color":"#F0F1F2"
                            },
                            "line-color":"#699EBF",
                            "background-color-2":"#699EBF",
                            "background-color":"#F0F1F2"
                        }
                    ],
                    "scale-v":{
                        "tick":{
                            "line-gap-size":0,
                            "line-color":"#cccccc",
                            "line-width":1,
                            "size":10
                        },
                        "font-size":16,
                        "line-color":"#cccccc",
                        "bold":true,
                        "format":"%v",
                        "item":{
                            "font-size":11,
                            "font-family":"Helvetica",
                            "color":"#333333"
                        },
                        "label":{
                            "color":"#333333"
                        },
                        "line-width":2,
                        "font-family":"Helvetica",
                        "color":"#333333"
                    },
                    "scale-y":{
                        "label":{
                            "text":"Effort ( in days )"
                        }
                    },
                    "scale-x":{
                        "label":{
                            "text":"Feature"
                        }
                    },
                    "background-color":"white",
                    "scale-k":{
                        "tick":{
                            "line-gap-size":0,
                            "line-color":"#cccccc",
                            "line-width":1,
                            "size":10
                        },
                        "font-size":16,
                        "line-color":"#cccccc",
                        "bold":true,
                        "item":{
                            "font-size":11,
                            "font-family":"Helvetica",
                            "color":"#333333"
                        },
                        "guide":{
                            "line-width":0
                        },
                        "label":{
                            "color":"#333333"
                        },
                        "line-width":2,
                        "font-family":"Helvetica",
                        "color":"#333333",
                        "values":[ "Closure Test Plan",
                                   "Language Enhancements",
                                   "Scheduled Tasks",
                                   "Security Enhancements 1 Test Plan",
                                   "Security HotFix test plan","testplan schedule",
                                   "Tomcat Integration - II"
                               ]
                    },
                    "plot":{
                        "fill-type":"radial",
                        "hover-marker":{
                            "background-color":"#888888",
                            "size":3
                        },
                        "marker":{
                            "background-color":"#cccccc",
                            "size":3
                        },
                        "aspect":"line",
                        "preview":true,
                        "tooltip-text":"%v"
                    },
                    "type":"radar",
                    "title":{
                        "border-width":1,
                        "border-color":"#cccccc",
                        "background-color":"white",
                        "font-size":18,
                        "bold":true,
                        "text":"ColdFusion Effort Estimates",
                        "font-family":"Helvetica",
                        "color":"#333333"
                    }
                } ]
            };
        break;
        
        case 'gauge':
            jsonGrafica = {
                "graphset": [ {
                    "source": { text : "Source: Farnsworth Delivery Tracking Gizmo" },
                    "type":"gauge",
                    "background-color":"#fff #eee",
                    "plot":{
                        "background-color":"#666"
                    },
                    "plotarea":{
                        "margin":"0 0 0 0"
                    },
                    "scale":{
                        "size-factor":0.8,
                        "offset-y":100
                    },
                    "scale-r":{
                        "values":"0:100:10",
                        "border-color":"#b3b3b3",
                        "border-width":"2",
                        "background-color":"#eeeeee,#b3b3b3",
                        "ring":{
                            "size":10,
                            "offset-r":"130px",
                            "background-color":"#eeeeee,#bbbbbb",
                            "rules":[
                                {
                                    "rule":"%v >=0 && %v < 20",
                                    "background-color":"#348D00"
                                },
                                {
                                    "rule":"%v >= 20 && %v < 40",
                                    "background-color":"#B1AD00"
                                },
                                {
                                    "rule":"%v >= 40 && %v < 60",
                                    "background-color":"#FAC100"
                                },
                                {
                                    "rule":"%v >= 60 && %v < 80",
                                    "background-color":"#EC7928"
                                },
                                {
                                    "rule":"%v >= 80",
                                    "background-color":"#FB0A02"
                                }
                            ]
                        }
                    },
                    "labels":[
                        {
                            "id":"lbl1",
                            "x":"50%",
                            "y":"90%",
                            "width":80,
                            "offsetX":160,
                            "textAlign":"center",
                            "padding":10,
                            "anchor":"c",
                            "text":"Very High",
                            "backgroundColor":"#FB0A02",
                            "tooltip":{
                                "padding":10,
                                "backgroundColor":"#ea0901",
                                "text":"Some Text"
                            }
                        },
                        {
                            "id":"lbl2",
                            "x":"50%",
                            "y":"90%",
                            "width":80,
                            "offsetX":80,
                            "textAlign":"center",
                            "padding":10,
                            "anchor":"c",
                            "text":"High",
                            "backgroundColor":"#EC7928",
                            "tooltip":{
                                "padding":10,
                                "backgroundColor":"#da6817",
                                "text":"Some Text"
                            }
                        },
                        {
                            "id":"lbl3",
                            "x":"50%",
                            "y":"90%",
                            "width":80,
                            "offsetX":0,
                            "textAlign":"center",
                            "padding":10,
                            "anchor":"c",
                            "text":"Medium",
                            "backgroundColor":"#FAC100",
                            "tooltip":{
                                "padding":10,
                                "backgroundColor":"#e9b000",
                                "text":"Some Text"
                            }
                        },
                        {
                            "id":"lbl4",
                            "x":"50%",
                            "y":"90%",
                            "width":80,
                            "offsetX":-80,
                            "textAlign":"center",
                            "padding":10,
                            "anchor":"c",
                            "text":"Low",
                            "backgroundColor":"#B1AD00",
                            "tooltip":{
                                "padding":10,
                                "backgroundColor":"#a09c00",
                                "text":"Some Text"
                            }
                        },
                        {
                            "id":"lbl5",
                            "x":"50%",
                            "y":"90%",
                            "width":80,
                            "offsetX":-160,
                            "textAlign":"center",
                            "padding":10,
                            "anchor":"c",
                            "text":"Very Low",
                            "backgroundColor":"#348D00",
                            "tooltip":{
                                "padding":10,
                                "backgroundColor":"#237b00",
                                "text":"Some Text"
                            }
                        }
                    ],
                    "series":[
                        {
                            "values":[90],
                            "animation":{
                                "method":5,
                                "effect":2,
                                "speed":2500
                            }
                        },
                         {
                            "values":[50],
                            "animation":{
                                "method":5,
                                "effect":2,
                                "speed":2500
                            }
                        }
                    ],
                    "alpha":1
                } ]
            };
        break;
        
        default:
            showError('El tipo de grafico '+parametros.tipo_grafico+' no esta definido.');
            return null;
    }
    
    return jsonGrafica;
}

/**
 * Cambia el tipo de grafico del indicador
 */
function cambiarTipoGrafico(event) {
    event.preventDefault();
    event.stopPropagation();
    
    idGrafica = $(this).data('id');
    
    // Obtiene el objeto JSON que contiene los datos devueltos al obtener el indicador
    parametros = JSON.parse($('#json_'+idGrafica).text());
    
    // Modifica el tipo de grafica a mostrar
    parametros.tipo_grafico = $(this).data('tipo');
    
    // Actualiza los datos guardados, para modificar el tipo de grafico
    $('#json_'+idGrafica).text(JSON.stringify(parametros));
    
    // Obtiene el objeto JSON para el zingchart
    jsonGrafico = getJSONGrafica(parametros);
    
    // Elimina el grafico
    zingchart.exec("graficoIndicador_"+idGrafica, 'destroy');
    
    // Vuelve a renderizar el grafico
    zingchart.render({
        id : "graficoIndicador_"+idGrafica,
        height : 400,
        width : 700,
        data : jsonGrafico
    });
}

/**
 * Renderiza la grafica en el contenedor
 */
function generaGrafica(parametros, indicadorId)
{
	var objGrafica = getJSONGrafica(parametros);

    zingchart.render({
        id : "graficoIndicador_"+indicadorId,
        height : 400,
        width : 700,
        data : objGrafica
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
            <div class="btn-toolbar">\n\
                <button class="btn verFichaTecnica" data-id="'+indicador+'"> <i class="fa fa-list-alt fa-lg"></i> Ficha Tecnica</button>\n\
                <button class="btn verTablaDatos" data-id="'+indicador+'"> <i class="fa fa-table fa-lg"></i> Tabla de Datos</button>\n\
                <div class="btn-group">\n\
                    <button class="btn dropdown-toggle" data-id="'+indicador+'" data-toggle="dropdown"> \n\
                        <i class="fa fa-picture-o fa-lg"></i> Tipo de Grafico <span class="caret"></span></button>\n\
                    <ul class="dropdown-menu">';
    
    // Agrega la lista de tipos de graficos al menu del indicador
    $.each(graficos, function(codigo, grafico) {
         wgIndicador += '<li style="float:none" data-id="'+indicador+'" data-tipo="'+codigo+'" class="verTipoGrafico"><a href="#">'+grafico+'</a></li>';
    });
    
    wgIndicador += '</ul>\n\
                </div>\n\
            </div>\n\
        </div>\n\
        <div id="graficoIndicador_'+indicador+'" class="graficoIndicador"></div>\n\
        <div class="pieIndicador">Fuente: '+contenido.fuentes+'<br />Última actualización: '+contenido.fecha+'</div>\n\
    </div>';
                    
    $("#tableroPrincipal").sDashboard("addWidget", {
                    widgetId : prefixTblIndicador+indicador,
                    widgetContent : wgIndicador
                });
    
    $('#'+prefixTblIndicador+indicador+' .verTipoGrafico').click(cambiarTipoGrafico);
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
                    // si el indicadore se esta obteniendo desde un tablero guardado
                    // parametros contendra las siguientes variables
                    // dimension, filtro y tipo_grafico
                    // estos deben ser asignados a los datos obtenidos del indicador
                    //$.extend(respuesta, parametros);
                    if(parametros.dimension)    respuesta.dimension    = parametros.dimension;
                    if(parametros.filtro)       respuesta.filtro       = parametros.filtro;
                    if(parametros.tipo_grafico) respuesta.tipo_grafico = parametros.tipo_grafico;
                    
                    agregarIndicador(parametros.id, respuesta);
                    
                    // Convierte el json donde estan los datos en una tabla html
                    tblDatos = ConvertJsonToTable(respuesta.datos);
                    $('#datosIndicadores').append('<li id="datos_'+parametros.id+'">'+tblDatos+'</li>');
                    
                    // Guarda todo el objeto JSON para posteriormente utilizarlo al cambiar el tipo de grafico
                    $('#datosIndicadores').append('<li id="json_'+parametros.id+'">'+JSON.stringify(respuesta)+'</li>'); // $.param(jsonObj)
                    
                    $('#'+prefixTblIndicador+parametros.id+' .verFichaTecnica').click(getFichaTecnica);
                    $('#'+prefixTblIndicador+parametros.id+' .verTablaDatos').click(getTablaDatos);
                    
                    generaGrafica(respuesta, parametros.id);
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

/**
 * Obtiene y muestra los datos de la ficha tecnica del indicador
 * */
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

/**
 * Muestra la tabla de datos del indicador
 * */
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

/**
 * Guarda todos los indicadores que estan en el tablero
 * */
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

                    // Obtiene todos los indicadores que se encuentran en el tablero
                    $.each(objTablero, function(posicion, indicador) {
                        idInd = indicador.widgetId.replace(prefixTblIndicador,''), // elimina la parte 'ind_'
                        
                        // Obtiene el objeto JSON que contiene los datos devueltos al obtener el indicador
                        indicador = JSON.parse($('#json_'+idInd).text());

                        // Datos a enviar de cada indicador
                        jsonIndicador = {
                            id: idInd,
                            dimension: indicador.dimension,
                            filtro: JSON.stringify(indicador.filtro),
                            posicion: posicion+1,
                            tipo_grafico: indicador.tipo_grafico,
                            configuracion: '' 
                        };

                        datosTablero["datos"].push(jsonIndicador);
                    });

                    // Envia todos los datos a guardar
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
    
    // Elimina todos los indicadores colocados en el Tablero
    $("#tableroPrincipal").sDashboard("clean");
    
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
    var widgetDefinitions = [];

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