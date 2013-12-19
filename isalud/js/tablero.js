// Las variables prefixTblIndicador, baseUrl y graficos se establecen en la accion index el controlador tablero 

heightToolbar = 65;
heidhtZingChart = 400;
widthZingChart = 700;
zingchart.ASYNC = true;
outputZingChart = "svg";
urlLogo = baseUrl+'/images/logo.png';

/**
 * 
 * Cambia dimensiones en la grafica
 */
function cambiaDimension(idIndicador, dimension, idIndicadorActualizar,idFiltro)
{
    var idIndicador = idIndicador;
    var dimension = dimension;
    var filtro = JSON.parse($('#filtro').val());
    
    $.ajax({
        url: baseUrl+'/fichaTecnica/getNextDimension/'+idIndicador,
        data: 'id='+idIndicador+'&dimension='+dimension+'&YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val()+'&cambiaNivel=1',
        type: "POST",
        //dataType : "json",
        success: function(respuesta) {
            if(respuesta != null)
            {
                filtro[''+dimension+''] = idFiltro;
                parametros = {
                    id: idIndicador,
                    dimension: respuesta,
                    filtro: filtro,
                    tipo_grafico: '',
                    configuracion: ''
                };
                $('#actualizarGrafica').val(idIndicadorActualizar);
                obtieneIndicador(parametros);
                //alert(respuesta);
            }
        },
        error: function( xhr, status ) {
            showError( "Error al obtener los datos. "+status+" "+xhr.status );
        }
    });
}

/**
 * 
 * Regresa niveles de las graficas
 */

function regresaNivel(id, id_actualizar)
{
    var id_nuevo = id_actualizar.split("_");
    var indicadorActual = $('#indicadorActual_'+id).html();
    var jDatos = $.parseJSON($("#json_"+id).html());
    var id = id;
    $('#actualizarGrafica').val(id_actualizar);
    $('#indicadorActual_'+id_nuevo[1]).html(id);
    //alert(id_actualizar);
    cambiaNivel(id);
    //$('#q li:last').remove();
    $('#listadoGrafica_'+id_nuevo[1]+' a.grafico_'+id).nextAll().remove();
    //$( "li.third-item" ).nextAll().css( "background-color", "red" )
}

function cargaIndicadoresPost(id,filtroString,dimension)
{
    var filtro = JSON.parse(filtroString);
    parametros = {
                id: id,
                dimension: dimension,
                filtro: filtro,
                tipo_grafico: '',
                configuracion: ''
            };
    obtieneIndicador(parametros);
}

function cambiaNivel(id)
{
    parametros = {
                id: id,
                dimension: $('#dimension').val(),
                filtro: JSON.parse($('#filtro').val()),
                tipo_grafico: '',
                configuracion: ''
            };
    obtieneIndicador(parametros);
}

function redimensionaGraficaMaximizar(event, object) {
    idGrafica = $('#winMaximizarGrafica').data("idGrafica");
    
    /* Otras alternativas para obtener altura y anchura del dialog
    console.log("Width: " + $('#winMaximizarGrafica').closest('.ui-dialog').width() + ", height: " + $('#winMaximizarGrafica').closest('.ui-dialog').height());
    console.log("Width: " + Math.round(object.size.width) + ", height: " + Math.round(object.size.height));*/
    
    newWidth = Math.round($(this).outerWidth())-30;
    newHeight = Math.round($(this).outerHeight())-heightToolbar; // Le restamos la altura del toolbar
    
    zingchart.exec("maxGraficoIndicador_"+idGrafica, 'resize', {
        width : newWidth,
        height : newHeight
    });
}

function destroyGraficaMaximizar(event, object) {
    idGrafica = $('#winMaximizarGrafica').data("idGrafica");
    $('#ind_'+idGrafica+' .contenedorIndicador').fadeIn("slow");
    $('#indicadorActual_'+idGrafica).html(idGrafica);
    
    // Elimina el grafico maximizado del indicador
    zingchart.exec("maxGraficoIndicador_"+idGrafica, 'destroy');
    
    // Elimina el contenido dentro del dialog
    $('#winMaximizarGrafica .contenedorIndicador').html('');
    
    $('#isMaximized').val('');
}

function addGraficaMaximizar(event, object) {
    idGrafica = $('#winMaximizarGrafica').data("idGrafica");
    var idGraficaActual = $('#indicadorActual_'+idGrafica).html();
    
    $('#isMaximized').val('1');
    
    wgIndicador = '<div class="opcionesIndicador">\n\
            <div class="btn-toolbar">\n\\n\
                <div class="btn-group">\n\
                    <button class="btn verFichaTecnica" data-id="'+idGrafica+'"> <i class="fa fa-list-alt fa-lg"></i> Ficha Tecnica</button>\n\
                </div>\n\
                <div class="btn-group">\n\
                    <button class="btn verTablaDatos" data-id="'+idGrafica+'"> <i class="fa fa-table fa-lg"></i> Tabla de Datos</button>\n\
                </div>\n\
                <div class="btn-group">\n\
                    <button class="btn dropdown-toggle" data-id="'+idGrafica+'" data-toggle="dropdown"> \n\
                        <i class="fa fa-picture-o fa-lg"></i> Tipo de Grafico <span class="caret"></span></button>\n\
                    <ul class="dropdown-menu">';
    
    // Agrega la lista de tipos de graficos al menu del indicador
    $.each(graficos, function(codigo, grafico) {
         wgIndicador += '<li style="float:none" data-id="'+idGrafica+'" data-tipo="'+codigo+'" class="verTipoGrafico maximizado"><a href="#">'+grafico+'</a></li>';
    });
    
    wgIndicador += '</ul>\n\
                </div>\n\
            </div>\n\
        </div>\n\
        <div id="maxGraficoIndicador_'+idGrafica+'" class="graficoIndicador"></div>\n\
     ';
    
    $('#winMaximizarGrafica .contenedorIndicador').html(wgIndicador);
    
    $('#winMaximizarGrafica .verTipoGrafico').click(cambiarTipoGrafico);
    $('#winMaximizarGrafica .verFichaTecnica').click(getFichaTecnica);
    $('#winMaximizarGrafica .verTablaDatos').click(getTablaDatos); 
    
    // Obtiene el objeto JSON que contiene los datos devueltos al obtener el indicador
    parametros = JSON.parse($('#json_'+idGraficaActual).text());;
    
    // Obtiene el objeto JSON para el zingchart
    jsonGrafico = getJSONGrafica(parametros);
    
    // Vuelve a renderizar el grafico
    // la altura y anchula la toma del dialog
    zingchart.render({
        id : "maxGraficoIndicador_"+idGrafica,
        height : Math.round($('#winMaximizarGrafica').outerHeight()-heightToolbar),  // Le restamos la altura del toolbar
        width : Math.round($('#winMaximizarGrafica').outerWidth())-30,
        locale : "es",
        setLocale : "es",
        customprogresslogo : urlLogo,
        output : outputZingChart,
        data : jsonGrafico
    });
    
    // Elimina el mensaje de powered by ZingChart
    $("#graficoIndicador_"+idGrafica+"-license").remove();
}

/**
 * Obtiene el JSON de configuracion para el objeto ZingChart
 */
function getJSONGrafica(parametros) {
    var rules = [];
    var markers = [];
    var jsonGrafica = null;
    var max = 100;
    
    // Obtiene el valor mayor del conjunto de valores del grafico
    maxValor = Math.max.apply(null, parametros.valores.map(function(node) {
            return node;
        }));
        
    if(max<maxValor)
        max = maxValor + (maxValor*0.05); // Se le suma el 10% para que la grafica no quede a tope en el eje de las y
	
	for(i=0; i<parametros.escalaEvaluacion.length; i++) {
		rule = {
			"rule": "%v >= "+parametros.escalaEvaluacion[i].limite_inf+" && %v <= "+parametros.escalaEvaluacion[i].limite_sup,
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
    
    // Parametros comunes para todos los tipos de graficas
    jsonGrafica = {
                "graphset": [ {
                    "type": parametros.tipo_grafico,
                    "title": { 
                        "text": parametros.titulo,
                        "background-color": "none",
                        "font-color": "black",
                        "border-width": 1,
                        "border-color": "#CCCCCC",
                        "bold": true,
                        "border-bottom": "none"
                    },
                    "subtitle": { 
                        "text": parametros.subtitulo,
                        "background-color": "none",
                        "font-color": "black",
                        "border-width": 1,
                        "border-color": "#CCCCCC",
                        "bold": true,
                        "border-top": "none",
                    },
                    "source": { "text": "Fuentes: "+parametros.fuentes+", Última actualización: "+parametros.fecha },
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "background-color": "#fff #eee",
                    "plot": {
                        "rules": rules,
                        "valueBox": { 
                            "type": "all", 
                            "placement": "top", 
                            "font-color": "#FFFFFF",
                            "background-color": "#000000",
                            "border-radius": 5,
                            "bold": true,
                        },
                    },
                    "tooltip":{
                        "background-color": "#000000",
                        "border-radius": 5,
                        "font-color": "#FFFFFF",
                        "bold": true,
                        "padding": 5,
                        "text" : "%k - %v%"
                    },
                } ]
            };
    
    switch(parametros.tipo_grafico) {
        // se coloca primero las barras horizontales
        // porque es necesario agregarle un margen izquierdo
        case 'hbar':
        case 'hbar3d':
            configuraciones = {
                "graphset": [ {
                    "plotarea": {
                        "margin-left": "80px",
                    },
                } ]
            };
            
            // Agrega los nuevos parametros al objeto jsonGrafica
            $.extend(jsonGrafica.graphset[0], configuraciones.graphset[0]);
        case 'area':
        case 'area3d':
        case 'bar':
        case 'bar3d':
        case 'bubble':
        case 'line':
        case 'line3d':
            configuraciones = {
                "graphset": [ {
                    "scaleX": {
                        "label": { "text": parametros.etiquetaX },
                        "values": parametros.etiquetas,
                        "item": { "font-size":"9px" }
                    },
                    "scaleY": { 
                        "label": { "text": parametros.etiquetaY },
                        "values": "0:"+max+":10", 
                        "markers": markers 
                    },
                    "series": [ {
                        "values": parametros.valores,
                        "text": parametros.titulo,
                        "animate": true,
                        "effect": 2,
                        "marker": { 
                            "rules": rules 
                        },
                    } ],
                } ]
            };
            
            // Agrega los nuevos parametros al objeto jsonGrafica
            $.extend(jsonGrafica.graphset[0], configuraciones.graphset[0]);
        break;
        
        case 'radar':
            configuraciones = {
                "graphset": [ {
                    "series": [ {
                        "values": parametros.valores,
                        "text": parametros.titulo,
                        "animate": true,
                        "effect": 2,
                        "marker": { 
                            "rules": rules, 
                        },
                    } ],
                    "scale-k":{
                        "values": parametros.etiquetas
                    },
                    "plot": {
                        "rules": rules,
                        "valueBox": { 
                            "type": "all", 
                            "font-color": "#000",
                        },
                    },
                } ]
            };
            
            // Agrega los nuevos parametros al objeto jsonGrafica
            $.extend(jsonGrafica.graphset[0], configuraciones.graphset[0]);
        break;
        
        case 'pie':
        case 'pie3d':
            series = [];
            
            for(i=0; i<parametros.valores.length; i++) {
                backgroundColor = '';
                for(j=0; j<parametros.escalaEvaluacion.length; j++) {
                    if(parametros.valores[i] >= parametros.escalaEvaluacion[j].limite_inf && parametros.valores[i] <= parametros.escalaEvaluacion[j].limite_sup) {
                        backgroundColor = parametros.escalaEvaluacion[j].color;
                        break;
                    }
                }
                
                serie = {
                        "text": parametros.etiquetas[i],
                        "values": [ parametros.valores[i] ],
                        "animate": true,
                        "effect": 2,
                        "background-color": backgroundColor
                    };
                
                series.push(serie);
            }
            
            configuraciones = {
                "graphset": [ {
                    "plot": {
                        "rules": rules,
                        "valueBox": { 
                            "type": "all", 
                            "text": "%t (%v)",
                            "text-align": "center",
                            "placement": "out", 
                            "font-color": "#000000",
                            "bold": true,
                        },
                        "tooltip-text":"%t (%v%)",
                    },
                    "plotarea": {
                        "margin-top": "30px",
                        "margin-bottom": "20px",
                        "margin-right": "70px",
                    },
                    "series": series,
                } ] 
            };
            
            // Agrega los nuevos parametros al objeto jsonGrafica
            $.extend(jsonGrafica.graphset[0], configuraciones.graphset[0]);
        break;
        
        case 'gauge':
            series = [];
            labels = [];
            
            for(i=0; i<parametros.valores.length; i++) {
                serie = {
                        "text": parametros.etiquetas[i]+" ("+parametros.valores[i]+")",
                        "values": [ parametros.valores[i] ],
                        "animation": {
                                "method": 5,
                                "effect": 2,
                                "speed": 2500
                            }
                    };
                
                series.push(serie);
            }
            
            offsetX = -220;
            widthGauge = 100;
            
            for(j=0; j<parametros.escalaEvaluacion.length; j++) {
                label = {
                        "x": "50%",
                        "y": "90%",
                        "width": widthGauge,
                        "offsetX": offsetX,
                        "textAlign": "center",
                        "padding": 10,
                        "anchor": "c",
                        "text": parametros.escalaEvaluacion[j].nombre,
                        "backgroundColor": parametros.escalaEvaluacion[j].color,
                        "font-color": "#FFF",
                        "bold": true,
                    };
                    
                labels.push(label);
                
                offsetX = offsetX + widthGauge;
            }
            
            configuraciones = {
                "graphset": [ {
                    "plotarea": {
                        "margin": "0 0 0 0"
                    },
                    "scale": {
                        "size-factor": 1,
                        "offset-y": 100,
                        "offset-x": -80
                    },
                    "plot": {
                        "tooltip-text":"%t",
                    },
                    "scale-r": {
                        "values": "0:"+max+":10",
                        "background-color": "#eeeeee,#b3b3b3",
                        "ring": {
                            "size": 10,
                            "background-color": "#eeeeee,#bbbbbb",
                            "rules": rules
                        }
                    },
                    "legend": {
                        "margin-top": "70"
                    },
                    "labels": labels,
                    "series": series,
                } ]
            };
            
            // Agrega los nuevos parametros al objeto jsonGrafica
            $.extend(jsonGrafica.graphset[0], configuraciones.graphset[0]);
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
    
    var idGrafica = $(this).data('id');
    var idZingChart = 'graficoIndicador_';
    var height = heidhtZingChart;
    var width = widthZingChart;
    
    
    // Si la grafia a cambiar esta maximizada
    if($(this).hasClass('maximizado')) {
        idZingChart = 'maxGraficoIndicador_';
        height = Math.round($('#winMaximizarGrafica').outerHeight()-heightToolbar);
        width = Math.round($('#winMaximizarGrafica').outerWidth())-30;
    }
    
    // Obtiene el objeto JSON que contiene los datos devueltos al obtener el indicador
    parametros = JSON.parse($('#json_'+$("#indicadorActual_"+idGrafica).html()).text());
    
    // Modifica el tipo de grafica a mostrar
    parametros.tipo_grafico = $(this).data('tipo');
    
    // Actualiza los datos guardados, para modificar el tipo de grafico
    $('#json_'+idGrafica).text(JSON.stringify(parametros));
    
    // Obtiene el objeto JSON para el zingchart
    jsonGrafico = getJSONGrafica(parametros);
    
    // Elimina el grafico
    zingchart.exec(idZingChart+idGrafica, 'destroy');
    
    // Vuelve a renderizar el grafico
    zingchart.render({
        id : idZingChart+idGrafica,
        height : height,
        width : width,
        locale : "es",
        setLocale : "es",
        customprogresslogo : urlLogo,
        output : outputZingChart,
        data : jsonGrafico
    });
    
    // Cierra el dropdown menu
    $(this).parent().parent().removeClass('open');
}

/**
 * Renderiza la grafica en el contenedor
 */
function generaGrafica(parametros, indicadorId)
{
	var objGrafica = getJSONGrafica(parametros);
        var actualizarGrafica = $('#actualizarGrafica').val();
        
        if($('#isMaximized').val() != '1')
        {
            heidhtZingChart = 400;  // Le restamos la altura del toolbar
            widthZingChart = 700;
            var idGrafica = "graficoIndicador_"+indicadorId;
        }
        else
        {
            heidhtZingChart = Math.round($('#winMaximizarGrafica').outerHeight()-heightToolbar);  // Le restamos la altura del toolbar
            widthZingChart = Math.round($('#winMaximizarGrafica').outerWidth())-30;
            var idGrafica = "maxGraficoIndicador_"+indicadorId;
        }
        
        if(actualizarGrafica != '')
        {
            idGrafica = actualizarGrafica;
            $('#actualizarGrafica').val('');
        }
        
	zingchart.render({
        id : idGrafica,
        height : heidhtZingChart,
        width : widthZingChart,
        locale : "es",
        setLocale : "es",
        customprogresslogo : urlLogo,
        output : outputZingChart,
        data : objGrafica
    });	
}

/**
 * Agrega el contenido del indicador al tablero
 * */
function agregarIndicador(indicador, contenido) {
    // Construir el widget del indicador
    wgIndicador = '<div class="contenedorIndicador">\n\
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
         wgIndicador += '<li style="float:none" data-id="'+indicador+'" data-tipo="'+codigo+'" class="verTipoGrafico tablero"><a href="#">'+grafico+'</a></li>';
    });
    
    wgIndicador += '</ul>\n\
                </div>\n\
            </div>\n\
        </div>\n\
        <div id="listadoGrafica_'+indicador+'"><a href="#" class="grafico_'+indicador+'" onclick="regresaNivel('+indicador+',\'graficoIndicador_'+indicador+'\');">'+contenido.titulo+'</a></div>\n\
        <div id="graficoIndicador_'+indicador+'" class="graficoIndicador"></div>\n\
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
    var actualizarGrafica = $('#actualizarGrafica').val();
    
    // Si no existe agregarlo al tablero
    if(existeIndicador.length == 0 || actualizarGrafica != '') {
        $.extend( parametros, {"YII_CSRF_TOKEN": $('[name=YII_CSRF_TOKEN]').val()} );
         
        $.ajax({
            url: baseUrl+'/tablero/getindicador',
            data: parametros,
            type: "POST",
            dataType : "json",
            success: function( respuesta ) {
                if(respuesta.error == true) {
                    showError('Error al obtener datos del indicador, revise el mensaje de error: '+respuesta.msjerror);
                } else {
                    // si el indicador se esta obteniendo desde un tablero guardado
                    // parametros contendra las siguientes variables
                    // dimension, filtro y tipo_grafico
                    // estos deben ser asignados a los datos obtenidos del indicador
                    //$.extend(respuesta, parametros);
                    if(parametros.dimension)    respuesta.dimension    = parametros.dimension;
                    if(parametros.filtro)       respuesta.filtro       = parametros.filtro;
                    if(parametros.tipo_grafico) respuesta.tipo_grafico = parametros.tipo_grafico;
                    
                    //var actualizarGrafica = $('#actualizarGrafica').val();
                    if(actualizarGrafica == '')
                        agregarIndicador(parametros.id, respuesta);
                    
                    //Almacena el indicador actual para la profundidad de las graficas
                    if($("#indicadorActual_"+parametros.id).length == 0)
                        $('#indicadoresActuales').append('<li id="indicadorActual_'+parametros.id+'">'+parametros.id+'</li>');
                    else
                        $("#indicadorActual_"+parametros.id).html(parametros.id);
                    
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
        
        // Cierra el dropdown menu
        $(this).parent().parent().removeClass('open');
    });
    
    $('#menuTableros > li').click(function(event){
        event.preventDefault();
        event.stopPropagation();
        
        obtieneTablero(event, $(this).data('id'));
        
        // Cierra el dropdown menu
        $(this).parent().parent().removeClass('open');
    });
    
    $('#tableroPrincipal .verFichaTecnica').click(getFichaTecnica);
    $('#tableroPrincipal .verTablaDatos').click(getTablaDatos); 
    
    $('#btnGuardarTablero').click(guardarTablero);
});