// Las variables prefixTblIndicador, baseUrl y graficos se establecen en la accion index el controlador tablero 
zingchart.ASYNC = true;
outputZingChart = "svg";
urlLogo = baseUrl+'/images/logo.png';
FusionCharts.setCurrentRenderer('javascript');

ar_vac_cob_m1 = null;
ar_vac_cen_m1 = null;
ar_vac_cob_1 = null;
ar_vac_cen_1 = null;
ar_vac_cob_1_4 = null;
ar_vac_cen_1_4 = null;

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

function enviarIndicador(parametros) {
    $('#indicador').val(parametros.indicador);
    
    if(parametros.dimension)
        $('#dimension').val(parametros.dimension);
    
    if(parametros.filtro) 
        $('#filtro').val(parametros.filtro);
    
    $('#datosIndicador').submit();
}

function getMayor(arreglo) {
    var mayor = 0;
    
    for(var i=0; i<=arreglo.length; i++) {
        if(arreglo[i]>mayor){
            mayor=arreglo[i];
        }
    }
    
    if(mayor<100)
        return 100;
    
    return mayor+15;
}

function cambiaGraficaVacunacion() {
    eje_cobertura = null;
    eje_concordancia = null;
    titulo = "";
    tipo = $(this).data('id');
    
    switch (tipo) {
        case 'menor_1':
            titulo = "Vacunación en población menor de un año";
            eje_cobertura = ar_vac_cob_m1;
            eje_concordancia = ar_vac_cen_m1;
            break;
        case '_1':
            titulo = "Vacunación en población de un año";
            eje_cobertura = ar_vac_cob_1;
            eje_concordancia = ar_vac_cen_1;
            break;
        case '1_4':
            titulo = "Vacunación en población de 1 a 4 años";
            eje_cobertura = ar_vac_cob_1_4;
            eje_concordancia = ar_vac_cen_1_4;
            break;
    }
    
    max = getMayor(eje_concordancia);
    
    indicador = { 
        id: 'vacunacion',
        alto: 300,
        ancho: 450,
        grafica: {
            "graphset": [{
                "type": "mixed",
                "title": { 
                    "text": titulo,
                    "background-color": "none",
                    "font-color": "black",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "bold": true,
                    "border-bottom": "none"
                },
                "plot": {
                    "valueBox": { 
                        "type": "all", 
                        "placement": "top",
                    },
                },
                "legend": {},
                "border-width": 1,
                "border-color": "#CCCCCC",
                "background-color": "#fff #eee",
                "tooltip": { text : "%v% de %t en %k" },
                "scaleX": { "label": { "text": "Meses" }, "values": ["Ene 13","Feb 13","Mar 13","Abr 13","May 13","Jun 13","Jul 13","Ago 13","Sep 13","Oct 13","Nov 13"] },
                "scaleY": { "label": { "text": "Porcentajes" }, "values": "0:"+max+":10",
                        "markers" : [
                            {
                                "type" : "line",
                                "range" : [95],
                                "line-color" : "#E00000",
                                "line-width" : 3,
                                "text" : "Meta (95%)"
                            }]
                    },
                "source": { text: "PROVAC, Proyección de población CONAPO" },
                "series": [
                    {
                        "type": "line", text: "Cobertura", "values": eje_cobertura, "animate": true, "effect": 1, 
                        "highlight": true, "line-color": "#ff4e00", 
                        "marker":{
                            "background-color":"#ff4e00",
                            "border-color":"#ff4e00"
                        }
                    },{
                        "type": "area", text: "Concordancia", "values": eje_concordancia, "animate": true, "effect": 1, 
                        "highlight": true
                    }
                ]
            }
        ]
        }
    };
    
    zingchart.exec("vacunacion", 'destroy');
    
    generaGrafica(indicador);
}

$(document).ready(function () {
    heightWin = 400;//($(document).height() - $('.navbar-fixed-top').height() - $('.breadcrumb').height() - $('.navbar-fixed-bottom').height() - 80) / 2;
    $('.grupoIndicador').css('height', heightWin+'px');
    $('#docking, #docking2').jqxDocking({ theme: 'ui-redmond', orientation: 'horizontal', width: '100%', mode: 'docked' });
    $('#docking, #docking2').jqxDocking('hideAllCloseButtons');
    // Se establece keyboardCloseKey a 1000, para evitar cerrar en el esc
    $('#window1, #window2, #window3, #window4').jqxWindow({ draggable: false, keyboardCloseKey: 1000 }); 
    
    
    /******************** INICIO eficiencia *******************************/
    /*var wTermometro=100, hTermometro=270;
    
    var graficaCobMenorUno = new FusionCharts("Thermometer", "CobMenorUno", wTermometro, hTermometro);
    
    graficaCobMenorUno.setJSONData({
            "chart": {
                "upperlimit": "100",
                "lowerlimit": "0",
                "numbersuffix": "%",
                "palette": "3"
            },
            "value": 80,
        });
    
    
    graficaCobMenorUno.render("graficaCobMenorUno");
    
    $("#graficaCobMenorUno").click(function(){
        console.log($(this).attr("id"));
        
        enviarIndicador({
            dimension: '',
            filtro: '',
            indicador: ''
        });
    });
    
    
    var graficaCobUno = new FusionCharts("Thermometer", "CobUno", wTermometro, hTermometro);
    
    graficaCobUno.setJSONData({
            "chart": {
                "upperlimit": "100",
                "lowerlimit": "0",
                "numbersuffix": "%",
                "palette": "3"
            },
            "value": 80,
        });
    
    graficaCobUno.render("graficaCobUno");
    
    $("#graficaCobUno").click(function(){
        console.log($(this).attr("id"));
        
        enviarIndicador({
            dimension: '',
            filtro: '',
            indicador: ''
        });
    });
    
    var graficaCobUnoCuatro = new FusionCharts("Thermometer", "CobUnoCuatro", wTermometro, hTermometro);
    
    graficaCobUnoCuatro.setJSONData({
            "chart": {
                "upperlimit": "100",
                "lowerlimit": "0",
                "numbersuffix": "%",
                "palette": "3"
            },
            "value": 80,
        });
    
    graficaCobUnoCuatro.render("graficaCobUnoCuatro");
    
    $("#graficaCobUnoCuatro").click(function(){
        console.log($(this).attr("id"));
        
        enviarIndicador({
            dimension: '',
            filtro: '',
            indicador: ''
        });
    });*/
    /****************************************/
    ar_vac_cob_m1 = $.map(vac_cob_m1, function(value, index) {
        return parseFloat(value);
    });
    ar_vac_cen_m1 = $.map(vac_cen_m1, function(value, index) {
        return parseFloat(value);
    });
    /****************************************/
    ar_vac_cob_1 = $.map(vac_cob_1, function(value, index) {
        return parseFloat(value);
    });
    ar_vac_cen_1 = $.map(vac_cen_1, function(value, index) {
        return parseFloat(value);
    });
    /****************************************/
    ar_vac_cob_1_4 = $.map(vac_cob_1_4, function(value, index) {
        return parseFloat(value);
    });
    ar_vac_cen_1_4 = $.map(vac_cen_1_4, function(value, index) {
        return parseFloat(value);
    });
    
    max = getMayor(ar_vac_cen_m1);
    
    indicador = { 
        id: 'vacunacion',
        alto: 300,
        ancho: 450,
        grafica: {
            "graphset": [{
                "type": "mixed",
                "title": { 
                    "text": 'Vacunación en población menor de un año',
                    "background-color": "none",
                    "font-color": "black",
                    "border-width": 1,
                    "border-color": "#CCCCCC",
                    "bold": true,
                    "border-bottom": "none"
                },
                "plot": {
                    "valueBox": { 
                        "type": "all", 
                        "placement": "top",
                    },
                },
                "legend": {},
                "border-width": 1,
                "border-color": "#CCCCCC",
                "background-color": "#fff #eee",
                "tooltip": { text : "%v% de %t en %k" },
                "scaleX": { "label": { "text": "Meses" }, "values": ["Ene 13","Feb 13","Mar 13","Abr 13","May 13","Jun 13","Jul 13","Ago 13","Sep 13","Oct 13","Nov 13"] },
                "scaleY": { "label": { "text": "Porcentajes" }, "values": "0:"+max+":10",
                        "markers" : [
                            {
                                "type" : "line",
                                "range" : [95],
                                "line-color" : "#E00000",
                                "line-width" : 3,
                                "text" : "Meta (95%)"
                            }]
                    },
                "source": { text: "PROVAC, Proyección de población CONAPO" },
                "series": [
                    {
                        "type": "line", text: "Cobertura", "values": ar_vac_cob_m1, "animate": true, "effect": 2, 
                        "highlight": true, "line-color": "#ff4e00", 
                        "marker":{
                            "background-color":"#ff4e00",
                            "border-color":"#ff4e00"
                        }
                    },{
                        "type": "area", text: "Concordancia", "values": ar_vac_cen_m1, "animate": true, "effect": 2, 
                        "highlight": true
                    }
                ]
            }
        ]
        }
    };
    
    generaGrafica(indicador);
    
    $(".btnVacunacion").click(cambiaGraficaVacunacion);
    
    /*********************** FIN eficiencia ****************************/
    
    
    /******************** INICIO eficacia *******************************/
    var wiLinearGauge = 320, heLinearGauge = 73, metaSNS = 95;
    
    var graficoSNSSabin = new FusionCharts("HLInearGauge", "SNSSabin", wiLinearGauge, heLinearGauge);
    
    graficoSNSSabin.setJSONData({
            "chart": {
                "manageresize": "1",
                "showvalue": "1",
                "upperlimit": "100",
                "lowerlimit": "0",
                "gaugeroundradius": "6",
                "pointerradius": "10",
                "numbersuffix": "%"
            },
            "pointers": {
                "pointer": [ {
                        "value": sabin_sns
                    } ]
            },
            "trendpoints": {
                "point": [ {
                    "startvalue": metaSNS,
                    "displayvalue": "Meta",
                    "color": "FFF",
                    "thickness": "2",
                    "alpha": "100",
                    "dashed": "1", 
                    "dashLen": "1", 
                    "dashGap": "3",
                    "usemarker": "1", 
                    "markercolor": "6F6",
                    "markerbordercolor": "666666", 
                    "markerradius": "7"
                } ]
            },
            "annotations": {
                "groups": [ {
                    "items": [
                        {
                            "type": "rectangle",
                            "x": "$gaugeStartX",
                            "y": "$gaugeStartY",
                            "tox": "$gaugeEndX",
                            "toy": "$gaugeEndY",
                            "fillcolor": "E00000,FCEF27,678000"
                        }
                    ]
                } ]
            }
        });
    
    graficoSNSSabin.render("graficoSNSSabin");
    
    $("#graficoSNSSabin").click(function(){
        enviarIndicador({ indicador: 18 });
    });
    
    var graficoSNSSR = new FusionCharts("HLInearGauge", "SNSSR", wiLinearGauge, heLinearGauge);
    
    graficoSNSSR.setJSONData({
            "chart": {
                "manageresize": "1",
                "showvalue": "1",
                "upperlimit": "100",
                "lowerlimit": "0",
                "gaugeroundradius": "6",
                "pointerradius": "10",
                "numbersuffix": "%"
            },
            
            "pointers": {
                "pointer": [ {
                        "value": sr_sns
                    } ]
            },
            "trendpoints": {
                "point": [ {
                    "startvalue": metaSNS,
                    "displayvalue": "Meta",
                    "color": "FFF",
                    "thickness": "2",
                    "alpha": "100",
                    "dashed": "1", 
                    "dashLen": "1", 
                    "dashGap": "3",
                    "usemarker": "1", 
                    "markercolor": "6F6",
                    "markerbordercolor": "666666", 
                    "markerradius": "7"
                } ]
            },
            "annotations": {
                "groups": [ {
                    "items": [
                        {
                            "type": "rectangle",
                            "x": "$gaugeStartX",
                            "y": "$gaugeStartY",
                            "tox": "$gaugeEndX",
                            "toy": "$gaugeEndY",
                            "fillcolor": "E00000,FCEF27,678000"
                        }
                    ]
                } ]
            }
        });
    
    graficoSNSSR.render("graficoSNSSR");
    
    $("#graficoSNSSR").click(function(){
        enviarIndicador({ indicador: 19 });
    });
    
    var graficoSNSTD = new FusionCharts("HLInearGauge", "SNSTD", wiLinearGauge, heLinearGauge);
    
    graficoSNSTD.setJSONData({
            "chart": {
                "manageresize": "1",
                "showvalue": "1",
                "upperlimit": "100",
                "lowerlimit": "0",
                "gaugeroundradius": "6",
                "pointerradius": "10",
                "numbersuffix": "%"
            },
            "pointers": {
                "pointer": [ {
                        "value": td_sns
                    } ]
            },
            "trendpoints": {
                "point": [ {
                    "startvalue": metaSNS,
                    "displayvalue": "Meta",
                    "color": "FFF",
                    "thickness": "2",
                    "alpha": "100",
                    "dashed": "1", 
                    "dashLen": "1", 
                    "dashGap": "3",
                    "usemarker": "1", 
                    "markercolor": "6F6",
                    "markerbordercolor": "666666", 
                    "markerradius": "7"
                } ]
            },
            "annotations": {
                "groups": [ {
                    "items": [
                        {
                            "type": "rectangle",
                            "x": "$gaugeStartX",
                            "y": "$gaugeStartY",
                            "tox": "$gaugeEndX",
                            "toy": "$gaugeEndY",
                            "fillcolor": "E00000,FCEF27,678000"
                        }
                    ]
                } ]
            }
        });
    
    graficoSNSTD.render("graficoSNSTD");
    
    $("#graficoSNSTD").click(function(){
        enviarIndicador({ indicador: 20 });
    });
    
    /*********************** FIN eficacia ****************************/
    
    
    /******************** INICIO economia *******************************/
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
    
    zingchart.node_click = function(node){
        if(node.id == 'vacunacion') {
            enviarIndicador({ indicador: '1,21,2,22,17,23' });
        } else if (node.id == 'presupuesto'){
            //enviarIndicador({ indicador:  });
        }
    };

    /*********************** FIN economia ****************************/
    
     $("#biologicos").qtip({
        content: {
            title: 'Falta de biológico',
            text: 'Falta de biológico BCG en la Jurisdicción II San Cristobal'
        },
        position: {
			my: 'bottom center',
			at: 'top center'
		},
		style: {
			classes: "qtip-tipped"
		}
    });
    
    $("#red_frios").qtip({
        content: {
            title: 'Funcionamiento ineficiente general de la red',
            text: 'Algunas unidades de refrigeración se encuentran sin funcionar y otras con deficiencia'
        },
        position: {
			my: 'bottom center',
			at: 'top center'
		},
		style: {
			classes: "qtip-tipped"
		}
    });
    
});