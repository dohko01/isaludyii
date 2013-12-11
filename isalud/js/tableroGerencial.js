// Las variables prefixTblIndicador, baseUrl y graficos se establecen en la accion index el controlador tablero 
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
    heightWin = 600;//($(document).height() - $('.navbar-fixed-top').height() - $('.breadcrumb').height() - $('.navbar-fixed-bottom').height() - 80) / 2;
    $('.grupoIndicador').css('height', heightWin+'px');
    $('#docking, #docking2').jqxDocking({ theme: 'ui-redmond', orientation: 'horizontal', width: '100%', mode: 'docked' });
    $('#docking, #docking2').jqxDocking('hideAllCloseButtons');
    $('#window1, #window2, #window3, #window4').jqxWindow({ draggable: false }); 
    
    
    /******************** INICIO Indicadores de Salud *******************************/
    indicador = { 
        id: 'morbilidad_mortalidad',
        grafica: {
            "graphset": [{
                "type": "bar",
                "title": { 
                    "text": 'Morbilidad',
                    "background-color": "none",
                    "font-color": "black",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "bold": true,
                    "border-bottom": "none"
                },
                "subtitle": { 
                    "text": 'Para el estado de Chiapas durante el 2013',
                    "background-color": "none",
                    "font-color": "black",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "bold": true,
                    "border-top": "none",
                },
                "legend": {},
                "border-width": 1,
                "border-color": "#CCCCCC",
                "background-color": "#fff #eee",
                "tooltip": { text : "%v casos de %t en %k" },
                "scaleX": { values: ["Septiembre", "Octubre", "Noviembre", "Diciembre"] },
                "scaleY": { label: { text: "No. de Casos" } },
                "source": { text: "Fuente de datos" },
                "series": [
                    {
                        text: "Enfermedad 1", "values": [26,13,32,12], "animate": true, "effect": 1, "highlight": true
                    },{
                        text: "Enfermedad 2", "values": [33,26,23,20], "animate": true, "effect": 1, "highlight": true
                    },{
                        text: "Enfermedad 3", "values": [28,19,30,35], "animate": true, "effect": 1, "highlight": true
                    },{
                        text: "Otros", "values": [30,46,36,33], "animate": true, "effect": 1, "highlight": true
                    }
                ]
            },
            {
                "type": "bar",
                "title": { 
                    "text": 'Mortalidad',
                    "background-color": "none",
                    "font-color": "black",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "bold": true,
                    "border-bottom": "none"
                },
                "subtitle": { 
                    "text": 'Para el estado de Chiapas durante el 2013',
                    "background-color": "none",
                    "font-color": "black",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "bold": true,
                    "border-top": "none",
                },
                "legend": {},
                "border-width": 1,
                "border-color": "#CCCCCC",
                "background-color": "#fff #eee",
                "tooltip": { text : "%v casos de %t en %k" },
                "scaleX": { values: ["Septiembre", "Octubre", "Noviembre", "Diciembre"] },
                "scaleY": { label: { text: "No. de Casos" } },
                "source": { text: "Fuente de datos" },
                "series": [
                    {
                        text: "Enfermedad 1", "values": [28,19,30,35], "animate": true, "effect": 1, "highlight": true, "background-color": "#03AEE0"
                    },{
                        text: "Enfermedad 2", "values": [30,46,36,33], "animate": true, "effect": 1, "highlight": true, "background-color": "#003D51"
                    },{
                        text: "Enfermedad 3", "values": [26,13,32,12], "animate": true, "effect": 1, "highlight": true, "background-color": "#CCC"
                    },{
                        text: "Otros", "values": [33,26,23,20], "animate": true, "effect": 1, "highlight": true, "background-color": "#ff0000"
                    }
                ]
            }
        ]
        }
    };
    
    generaGrafica(indicador);
    /*********************** FIN Indicadores de Salud ****************************/
    
    
    /******************** INICIO Indicadores de Programas Especiales *******************************/
    indicador = { 
        id: 'programas_especiales',
        grafica: {
            "layout": "2x2",
            "graphset": [
                {
                    "type": "pie",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "background-color": "#fff #eee",
                    "title": { 
                        "text": 'Casos de Enfermedades Epidémicas',
                        "background-color": "none",
                        "font-color": "black",
                        "border-width": 1,
                        "border-color": "#CCCCCC",
                        "bold": true,
                        "border-bottom": "none"
                    },
                    "tooltip": { "text": "%v casos de %t en la Jurisdicción II San Cristobal" },
                    "series": [ { "text": "Dengue", "values": [5], "animate": true, "effect": 1, "animate": true, "effect": 1, "background-color": "#ff0000" } ]
                },{
                    "type": "pie",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "background-color": "#fff #eee",
                    "title": { 
                        "text": 'Fenómenos Naturales Perturbadores',
                        "background-color": "none",
                        "font-color": "black",
                        "border-width": 1,
                        "border-color": "#CCCCCC",
                        "bold": true,
                        "border-bottom": "none"
                    },
                    "plot":{ "value-box":{ "visible": false } },
                    "tooltip": { "text": "Ningun Fenómeno Natural Perturbador" },
                    "series": [ { "text": "Frente Frio No. 20", "values": [10], "animate": true, "effect": 1, "background-color": "#005900" } ]
                },{
                    "type": "radar",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "background-color": "#fff #eee",
                    "title": { 
                        "text": 'Semanas Nacionales de Salud',
                        "background-color": "none",
                        "font-color": "black",
                        "border-width": 1,
                        "border-color": "#CCCCCC",
                        "bold": true,
                        "border-bottom": "none"
                    },
                    "series": [ {
                        "values": [80, 90, 100],
                        "animate": true,
                        "effect": 2,
                    } ],
                    "scale-k":{
                        "values": ['1a. Semana Nacional', '2a. Semana Nacional', '3a. Semana Nacional']
                    }
                },{
                    "type": "radar",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "background-color": "#fff #eee",
                    "title": { 
                        "text": 'Iniciativa Salud Mesoamérica 2015',
                        "background-color": "none",
                        "font-color": "black",
                        "border-width": 1,
                        "border-color": "#CCCCCC",
                        "bold": true,
                        "border-bottom": "none"
                    },
                    "series": [ {
                        "values": [80, 40, 60, 90],
                        "animate": true,
                        "effect": 2,
                    } ],
                    "scale-k":{
                        "values": ['Componente 1', 'Componente 2', 'Componente 3', 'Componente 4']
                    },
                }
            ]
        }
    };
    
    generaGrafica(indicador);
    /*********************** FIN Indicadores de Programas Especiales ****************************/
    
    
    /******************** INICIO Indicadores de Servicios *******************************/
    indicador = { 
        id: 'servicios',
        grafica: {
            "layout": "2x2",
            "graphset": [{
                "type" : "gauge",
                "title" : {
                    "text" : "Primer Nivel de Atención",
                    "background-color" : "none",
                    "font-color" : "black",
                    "border-width" : 1,
                    "border-color" : "#CCCCCC",
                    "bold" : true,
                    "border-bottom" : "none"
                },
                "border-width" : 1,
                "border-color" : "#CCCCCC",
                "background-color" : "#fff #eee",
                "plot" : {
                    "tooltip-text" : "%t"
                },
                "tooltip" : {
                    "background-color" : "#000000",
                    "border-radius" : 5,
                    "font-color" : "#FFFFFF",
                    "bold" : true,
                    "padding" : 5
                },
                "plotarea" : {
                    "margin" : "0 0 0 0"
                },
                "scale" : {
                    "size-factor" : 1,
                    "offset-y" : 80,
                    "offset-x" : 0
                },
                "scale-r" : {
                    "values" : "0:105.94500000000001:10",
                    "background-color" : "#eeeeee,#b3b3b3",
                    "ring" : {
                        "size" : 10,
                        "background-color" : "#eeeeee,#bbbbbb",
                        "rules" : [{
                                "rule" : "%v >= 98 && %v <= 100",
                                "background-color" : "green",
                                "line-color" : "green"
                            }, {
                                "rule" : "%v >= 95 && %v <= 97.9",
                                "background-color" : "yellow",
                                "line-color" : "yellow"
                            }, {
                                "rule" : "%v >= 90 && %v <= 94.9",
                                "background-color" : "red",
                                "line-color" : "red"
                            }, {
                                "rule" : "%v >= 0 && %v <= 89.9",
                                "background-color" : "black",
                                "line-color" : "black"
                            }
                        ]
                    }
                },
                "labels" : [{
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Sobresaliente",
                        "backgroundColor" : "green",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Satisfactorio",
                        "backgroundColor" : "yellow",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Mínimo",
                        "backgroundColor" : "red",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Precario",
                        "backgroundColor" : "black",
                        "font-color" : "#FFF",
                        "bold" : true
                    }
                ],
                "series" : [{
                        "text" : "Indicador 1.4 (91.5)",
                        "values" : [60.5],
                        "animation" : {
                            "method" : 5,
                            "effect" : 2,
                            "speed" : 2500
                        }
                    }
                ]
            },{
                "type" : "gauge",
                "title" : {
                    "text" : "Segundo Nivel de Atención",
                    "background-color" : "none",
                    "font-color" : "black",
                    "border-width" : 1,
                    "border-color" : "#CCCCCC",
                    "bold" : true,
                    "border-bottom" : "none"
                },
                "border-width" : 1,
                "border-color" : "#CCCCCC",
                "background-color" : "#fff #eee",
                "plot" : {
                    "tooltip-text" : "%t"
                },
                "tooltip" : {
                    "background-color" : "#000000",
                    "border-radius" : 5,
                    "font-color" : "#FFFFFF",
                    "bold" : true,
                    "padding" : 5
                },
                "plotarea" : {
                    "margin" : "0 0 0 0"
                },
                "scale" : {
                    "size-factor" : 1,
                    "offset-y" : 80,
                    "offset-x" : 0
                },
                "scale-r" : {
                    "values" : "0:105.94500000000001:10",
                    "background-color" : "#eeeeee,#b3b3b3",
                    "ring" : {
                        "size" : 10,
                        "background-color" : "#eeeeee,#bbbbbb",
                        "rules" : [{
                                "rule" : "%v >= 98 && %v <= 100",
                                "background-color" : "green",
                                "line-color" : "green"
                            }, {
                                "rule" : "%v >= 95 && %v <= 97.9",
                                "background-color" : "yellow",
                                "line-color" : "yellow"
                            }, {
                                "rule" : "%v >= 90 && %v <= 94.9",
                                "background-color" : "red",
                                "line-color" : "red"
                            }, {
                                "rule" : "%v >= 0 && %v <= 89.9",
                                "background-color" : "black",
                                "line-color" : "black"
                            }
                        ]
                    }
                },
                "labels" : [{
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Sobresaliente",
                        "backgroundColor" : "green",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Satisfactorio",
                        "backgroundColor" : "yellow",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Mínimo",
                        "backgroundColor" : "red",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Precario",
                        "backgroundColor" : "black",
                        "font-color" : "#FFF",
                        "bold" : true
                    }
                ],
                "series" : [{
                        "text" : "Indicador 1.4 (91.5)",
                        "values" : [90],
                        "animation" : {
                            "method" : 5,
                            "effect" : 2,
                            "speed" : 2500
                        }
                    }
                ]
            },{
                "type" : "gauge",
                "title" : {
                    "text" : "Tercer Nivel de Atención",
                    "background-color" : "none",
                    "font-color" : "black",
                    "border-width" : 1,
                    "border-color" : "#CCCCCC",
                    "bold" : true,
                    "border-bottom" : "none"
                },
                "border-width" : 1,
                "border-color" : "#CCCCCC",
                "background-color" : "#fff #eee",
                "plot" : {
                    "tooltip-text" : "%t"
                },
                "tooltip" : {
                    "background-color" : "#000000",
                    "border-radius" : 5,
                    "font-color" : "#FFFFFF",
                    "bold" : true,
                    "padding" : 5
                },
                "plotarea" : {
                    "margin" : "0 0 0 0"
                },
                "scale" : {
                    "size-factor" : 1,
                    "offset-y" : 80,
                    "offset-x" : 0
                },
                "scale-r" : {
                    "values" : "0:105.94500000000001:10",
                    "background-color" : "#eeeeee,#b3b3b3",
                    "ring" : {
                        "size" : 10,
                        "background-color" : "#eeeeee,#bbbbbb",
                        "rules" : [{
                                "rule" : "%v >= 98 && %v <= 100",
                                "background-color" : "green",
                                "line-color" : "green"
                            }, {
                                "rule" : "%v >= 95 && %v <= 97.9",
                                "background-color" : "yellow",
                                "line-color" : "yellow"
                            }, {
                                "rule" : "%v >= 90 && %v <= 94.9",
                                "background-color" : "red",
                                "line-color" : "red"
                            }, {
                                "rule" : "%v >= 0 && %v <= 89.9",
                                "background-color" : "black",
                                "line-color" : "black"
                            }
                        ]
                    }
                },
                "labels" : [{
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Sobresaliente",
                        "backgroundColor" : "green",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Satisfactorio",
                        "backgroundColor" : "yellow",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Mínimo",
                        "backgroundColor" : "red",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Precario",
                        "backgroundColor" : "black",
                        "font-color" : "#FFF",
                        "bold" : true
                    }
                ],
                "series" : [{
                        "text" : "Indicador 1.4 (91.5)",
                        "values" : [80],
                        "animation" : {
                            "method" : 5,
                            "effect" : 2,
                            "speed" : 2500
                        }
                    }
                ]
            },{
                "type" : "gauge",
                "title" : {
                    "text" : "Redes de servicios",
                    "background-color" : "none",
                    "font-color" : "black",
                    "border-width" : 1,
                    "border-color" : "#CCCCCC",
                    "bold" : true,
                    "border-bottom" : "none"
                },
                "border-width" : 1,
                "border-color" : "#CCCCCC",
                "background-color" : "#fff #eee",
                "plot" : {
                    "tooltip-text" : "%t"
                },
                "tooltip" : {
                    "background-color" : "#000000",
                    "border-radius" : 5,
                    "font-color" : "#FFFFFF",
                    "bold" : true,
                    "padding" : 5
                },
                "plotarea" : {
                    "margin" : "0 0 0 0"
                },
                "scale" : {
                    "size-factor" : 1,
                    "offset-y" : 80,
                    "offset-x" : 0
                },
                "scale-r" : {
                    "values" : "0:105.94500000000001:10",
                    "background-color" : "#eeeeee,#b3b3b3",
                    "ring" : {
                        "size" : 10,
                        "background-color" : "#eeeeee,#bbbbbb",
                        "rules" : [{
                                "rule" : "%v >= 98 && %v <= 100",
                                "background-color" : "green",
                                "line-color" : "green"
                            }, {
                                "rule" : "%v >= 95 && %v <= 97.9",
                                "background-color" : "yellow",
                                "line-color" : "yellow"
                            }, {
                                "rule" : "%v >= 90 && %v <= 94.9",
                                "background-color" : "red",
                                "line-color" : "red"
                            }, {
                                "rule" : "%v >= 0 && %v <= 89.9",
                                "background-color" : "black",
                                "line-color" : "black"
                            }
                        ]
                    }
                },
                "labels" : [{
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Sobresaliente",
                        "backgroundColor" : "green",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : -50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Satisfactorio",
                        "backgroundColor" : "yellow",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 50,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Mínimo",
                        "backgroundColor" : "red",
                        "font-color" : "#FFF",
                        "bold" : true
                    }, {
                        "x" : "50%",
                        "y" : "90%",
                        "width" : 100,
                        "offsetX" : 150,
                        "textAlign" : "center",
                        "padding" : 10,
                        "anchor" : "c",
                        "text" : "Precario",
                        "backgroundColor" : "black",
                        "font-color" : "#FFF",
                        "bold" : true
                    }
                ],
                "series" : [{
                        "text" : "Indicador 1.4 (91.5)",
                        "values" : [70],
                        "animation" : {
                            "method" : 5,
                            "effect" : 2,
                            "speed" : 2500
                        }
                    }
                ]
            }
        ]}
    };
    
    generaGrafica(indicador);
    /*********************** FIN Indicadores de Servicios ****************************/
    
    
    /******************** INICIO Indicadores de Recursos *******************************/
    indicador = { 
        id: 'recursos',
        grafica: {
            "graphset": [{
                "type": "bar",
                "title": { 
                    "text": 'Plan de infraestructura 2013',
                    "background-color": "none",
                    "font-color": "black",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "bold": true,
                    "border-bottom": "none"
                },
                "legend": {},
                "border-width": 1,
                "border-color": "#CCCCCC",
                "background-color": "#fff #eee",
                "scaleX": { values: ["Septiembre", "Octubre", "Noviembre", "Diciembre"] },
                "scaleY": { label: { text: "$" } },
                "source": { text: "Fuente de datos" },
                "series": [
                    {
                        text: "Presupuesto asignado", "values": [26,13,32,12], "animate": true, "effect": 1, "highlight": true
                    },{
                        text: "Presupuesto ejercido", "values": [33,26,23,20], "animate": true, "effect": 1, "highlight": true
                    }
                ]
            }
        ]
        }
    };
    
    generaGrafica(indicador);
    /*********************** FIN Indicadores de Recursos ****************************/
    
});