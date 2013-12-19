// La variable baseUrl en la accion del controlador tablero 
zingchart.ASYNC = true;
outputZingChart = "svg";
urlLogo = baseUrl+'/images/logo.png';

/**
 * Crea la grafica dentro del contenedor con el ID especificado
 * 
 * @param {json} parametros = {id, grafica, ancho, alto}
 */
function generaGrafica(parametros) {
    zW = parametros.ancho || $('#'+parametros.id).width();
    zH = parametros.alto  || $('#'+parametros.id).height();
    
    zingchart.render({
        id: parametros.id,
        locale: "es_mx",
        customprogresslogo: urlLogo,
        output: outputZingChart,
        height: zH,
        width: zW,
        data: parametros.grafica
    });
    
    // Elimina el mensaje de powered by ZingChart
    $('#'+parametros.id+"-license").remove();
}

$(document).ready(function () {
    heightWin = 400;//($(document).height() - $('.navbar-fixed-top').height() - $('.breadcrumb').height() - $('.navbar-fixed-bottom').height() - 80) / 2;
    $('.grupoIndicador').css('height', heightWin+'px');
    $('#docking, #docking2').jqxDocking({ theme: 'ui-redmond', orientation: 'horizontal', width: '100%', mode: 'docked' });
    $('#docking, #docking2').jqxDocking('hideAllCloseButtons');
    // Se establece keyboardCloseKey a 1000, para evitar cerrar en el esc
    $('#window1, #window2, #window3, #window4').jqxWindow({ draggable: false, keyboardCloseKey: 1000 }); 
       
    indicador = { 
        id: 'grafica1',
        grafica: {
            "type": "radar",
            "border-width": 1,
            "border-color": "#CCCCCC",
            "background-color": "#fff #eee",
            "title": { 
                "text": 'Programa de vacunación universal',
                "background-color": "none",
                "font-color": "black",
                "border-width": 1,
                "border-color": "#CCCCCC",
                "bold": true,
                "border-bottom": "none"
            },
            "series": [ {
                "values": [10, 15, 20, 30, 60, 80, 70, 50],
                "animate": true,
                "effect": 2,
            } ],
            "scale-k":{
                "values": [ "Cobertura esquema completo<br>niños menores de un año<br>",
                            "<br><br><br><br>Cobertura esquema completo<br>niños de un año",
                            "Cobertura esquema completo<br>niños de uno a cuatro años",
                            "Concordancia niños<br>menores de un año de edad",
                            "Concordancia niños<br>de un año de edad",
                            "Concordancia niños<br>de uno a cuatro años de edad",
                            "Semanas Nacionales<br>de Salud (SNS)",
                            "Consejos<br>Estatales<br>de Vacunación (COEVAS)"]
            },
            "plot" : {
                "rules" : [{
                        "rule" : "%v >= 71 && %v <= 100",
                        "background-color" : "green",
                        "line-color" : "green"
                    }, {
                        "rule" : "%v >= 51 && %v <= 70",
                        "background-color" : "yellow",
                        "line-color" : "yellow"
                    }, {
                        "rule" : "%v >= 26 && %v <= 50",
                        "background-color" : "red",
                        "line-color" : "red"
                    }, {
                        "rule" : "%v >= 0 && %v <= 25",
                        "background-color" : "black",
                        "line-color" : "black"
                    }
                ]
            },
        }
    };
    
    generaGrafica(indicador);
    /***************************************************/
    indicador = { 
        id: 'grafica2',
        grafica: {
            "type": "radar",
            "border-width": 1,
            "border-color": "#CCCCCC",
            "background-color": "#fff #eee",
            "title": { 
                "text": 'Prevención de la mortalidad infantil',
                "background-color": "none",
                "font-color": "black",
                "border-width": 1,
                "border-color": "#CCCCCC",
                "bold": true,
                "border-bottom": "none"
            },
            "series": [ {
                "values": [15, 20, 30, 60, 80, 70],
                "animate": true,
                "effect": 2,
            } ],
            "scale-k":{
                "values": [ "Tasa de Mortalidad (TMI)",
                            "TMI en menores de 5 años",
                            "TMI por EDA en menores de 5 años",
                            "TMI por IRA en menores de 5 años",
                            "Personal capacitado en <br>temas relacionados a <br>Mortalidad Infantil",
                            "Autopsias verbales<br>dictaminadas por causa de <br>IRAs y EDAs"]
            },
            "plot" : {
                "rules" : [{
                        "rule" : "%v >= 71 && %v <= 100",
                        "background-color" : "green",
                        "line-color" : "green"
                    }, {
                        "rule" : "%v >= 51 && %v <= 70",
                        "background-color" : "yellow",
                        "line-color" : "yellow"
                    }, {
                        "rule" : "%v >= 26 && %v <= 50",
                        "background-color" : "red",
                        "line-color" : "red"
                    }, {
                        "rule" : "%v >= 0 && %v <= 25",
                        "background-color" : "black",
                        "line-color" : "black"
                    }
                ]
            },
        }
    };
    
    generaGrafica(indicador);
    /***************************************************/
    indicador = { 
        id: 'grafica3',
        grafica: {
            "type": "radar",
            "border-width": 1,
            "border-color": "#CCCCCC",
            "background-color": "#fff #eee",
            "title": { 
                "text": 'Programa de prevención y tratamiento del cáncer en la infancia y adolescencia',
                "background-color": "none",
                "font-color": "black",
                "border-width": 1,
                "border-color": "#CCCCCC",
                "bold": true,
                "border-bottom": "none"
            },
            "series": [ {
                "values": [15, 20, 30, 60, 80, 70],
                "animate": true,
                "effect": 2,
            } ],
            "scale-k":{
                "values": [ "Supervivencia a 2 años <br>en pacientes <18 años con <br>cáncer atendidos en UMA<br><br>",
                            "TM por cáncer en <br><18 años en la SSE",
                            "Sesiones Ordinarias COECIA",
                            "Capacitación en la <br>detección oportuna del <br>cáncer en <18 años",
                            "Capacitación en síntomas <br>y signos de alarma de <br>cáncer en <18 años",
                            "Casos nuevos de cáncer"]
            },
            "plot" : {
                "rules" : [{
                        "rule" : "%v >= 71 && %v <= 100",
                        "background-color" : "green",
                        "line-color" : "green"
                    }, {
                        "rule" : "%v >= 51 && %v <= 70",
                        "background-color" : "yellow",
                        "line-color" : "yellow"
                    }, {
                        "rule" : "%v >= 26 && %v <= 50",
                        "background-color" : "red",
                        "line-color" : "red"
                    }, {
                        "rule" : "%v >= 0 && %v <= 25",
                        "background-color" : "black",
                        "line-color" : "black"
                    }
                ]
            },
        }
    };
    
    generaGrafica(indicador);
    /***************************************************/
    indicador = { 
        id: 'grafica4',
        grafica: {
            "type": "radar",
            "border-width": 1,
            "border-color": "#CCCCCC",
            "background-color": "#fff #eee",
            "title": { 
                "text": 'Programa de prevención y tratamiento del cáncer en la infancia y adolescencia',
                "background-color": "none",
                "font-color": "black",
                "border-width": 1,
                "border-color": "#CCCCCC",
                "bold": true,
                "border-bottom": "none"
            },
            "series": [ {
                "values": [60, 15, 30, 60, 70, 20],
                "animate": true,
                "effect": 2,
            } ],
            "scale-k":{
                "values": [ "Grupos de Adolescentes<br>Promotores de la Salud",
                            "Reuniones Grupos Estatales de<br>Atención Integral para la<br>Salud de la Adolescencia (GAIA)",
                            "Capacitación en Atención<br>Integral a la Salud<br>de la Adolescencia",
                            "Semanas Nacionales de<br>Salud de la Adolescencia",
                            "Envío de Plan de Trabajo<br>según lineamientos en tiempo y forma",
                            "Inauguración y/o Clausura<br>por Jurisdicción Sanitaria 2013"]
            },
            "plot" : {
                "rules" : [{
                        "rule" : "%v >= 71 && %v <= 100",
                        "background-color" : "green",
                        "line-color" : "green"
                    }, {
                        "rule" : "%v >= 51 && %v <= 70",
                        "background-color" : "yellow",
                        "line-color" : "yellow"
                    }, {
                        "rule" : "%v >= 26 && %v <= 50",
                        "background-color" : "red",
                        "line-color" : "red"
                    }, {
                        "rule" : "%v >= 0 && %v <= 25",
                        "background-color" : "black",
                        "line-color" : "black"
                    }
                ]
            },
        }
    };
    
    generaGrafica(indicador);
});

zingchart.click = function(node){
    if(node.id == 'grafica1') {
        $("#datosIndicador").submit();
    } 
};