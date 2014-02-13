// Las variables prefixTblIndicador, baseUrl y graficos se establecen en la accion index el controlador tablero 
zingchart.ASYNC = true;
outputZingChart = "svg";
urlLogo = baseUrl+'/images/logo.png';
FusionCharts.setCurrentRenderer('javascript');

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
    
    
    /******************** INICIO eficiencia *******************************/
    indicador = { 
        id: 'vacunacion',
        alto: 350,
        ancho: 650,
        grafica: {
            "graphset":[
                {
                    "type":"hbar3d",
                    "3d-aspect":{
                        "true3d":false,
                        "y-angle":10,
                        "depth":10
                    },
                    "stacked":true,
                    "title" : {
                        "text" : "Ejercicio del Presupuesto a Junio de 2014",
                        "background-color" : "none",
                        "font-color" : "black",
                        "border-width" : 1,
                        "border-color" : "#CCCCCC",
                        "bold" : true,
                    },
                    "plotarea" : {
                        "margin-left" : "120px"
                    },
                    "legend": {},
                    "border-width" : 1,
                    "border-color" : "#CCCCCC",
                    "background-color" : "#fff #eee",
                    "scaleY" : {
                        "format":"%v %",
                    },
                    "scaleX" : {
                        "values" : ["Oficina Central",
                                    "JS I Tuxtla Gutiérrez", 
                                    "JS II San Cristobal", 
                                    "JS III Comitán", 
                                    "JS IV Villa Flores",
                                    "JS V Pichucalco", 
                                    "JS VI Palenque", 
                                    "JS VII Tapachula",  
                                    "JS VIII Tonalá",
                                    "JS IX Ocosingo",  
                                    "JS X Motozintla",
                                    "Total Estatal"],
                    },
                    "series":[
                        {
                            "values":[40,55,50,30,60,70,40,50,60,30,70,60],
                            "text" : "Autorizado",
                            "background-color":"#04536C #00B4E8",
                        },
                        {
                            "values":[60,45,50,70,40,30,60,50,40,70,30,40],
                            "text" : "Ejercido",
                            "background-color":"#D03806 #F87245",
                        }
                    ]
                }
            ]
        }
    };
    
    generaGrafica(indicador);
        
    /*********************** FIN eficiencia ****************************/
    
    
    /******************** INICIO eficacia *******************************/
    
    indicador = { 
        id: 'presupuesto',
        ancho: 400,
        alto: 280,
        grafica: {
            "type" : "gauge",
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
            "plot":{
                "background-color":"#000"
            },
            "plotarea" : {
                "position": "0% 0%",
                "margin-top": 0,
                "margin-right": 0,
                "margin-left": 0,
                "margin-bottom": 0,
            },
            "scale" : {
                "size-factor" : 1,
                "offset-y" : 50,
            },
            "scale-r" : {
                "values" : "0:100:10",
                "background-color" : "#eeeeee,#b3b3b3",
                "ring" : {
                    "size" : 10,
                    "background-color" : "#eeeeee,#bbbbbb",
                    "rules" : [{
                            "rule" : "%v >= 81 && %v <= 100",
                            "background-color" : "green",
                            "line-color" : "green"
                        }, {
                            "rule" : "%v >= 61 && %v <= 80",
                            "background-color" : "yellow",
                            "line-color" : "yellow"
                        }, {
                            "rule" : "%v >= 41 && %v <= 60",
                            "background-color" : "red",
                            "line-color" : "red"
                        }, {
                            "rule" : "%v >= 0 && %v <= 40",
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
                    "text" : "Presupuesto Asignado",
                    "values" : [60.5],
                    "animation" : {
                        "method" : 5,
                        "effect" : 2,
                        "speed" : 2500
                    }
                }
            ]
        }
    };
    
    generaGrafica(indicador);
    
    /*********************** FIN eficacia ****************************/
    
    
    /******************** INICIO economia *******************************/
    
    indicador = { 
        id: 'avance_indicadores',
        alto: 350,
        ancho: 650,
        grafica: {
            "type": "radar",
            "border-width": 1,
            "border-color": "#CCCCCC",
            "background-color": "#fff #eee",
            "title": { 
                "text": 'Avance de indicadores a Junio del 2014',
                "background-color": "none",
                "font-color": "black",
                "border-width": 1,
                "border-color": "#CCCCCC",
                "bold": true,
            },
            "series": [ {
                "values": [15, 20, 30, 60, 80, 70],
                "animate": true,
                "effect": 2,
            } ],
            "scale-k":{
                "values": [ "Cobertura de tratamiento <br>a casos cáncer cérvico<br>uterino y mamario<br><br>",
                            "Porcentaje de población con<br>resultados de cáncer cervico<br>uterino y mamario",
                            "Entrega oportuna de resultados de<br>citología cervical y exploración<br>clínica de mama",
                            "Porcentaje de exploraciones<br>clínicas mamarias",
                            "porcentaje de toma de muestras<br>de citología cervical",
                            "Realizar cursos de capacitacción<br>al personal operativo"]
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

    /*********************** FIN economia ****************************/
    
});