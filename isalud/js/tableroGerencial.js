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

function enviarIndicador(parametros) {
    $('#indicador').val(parametros.indicador);
    
    if(parametros.dimension)
        $('#dimension').val(parametros.dimension);
    
    if(parametros.filtro) 
        $('#filtro').val(parametros.filtro);
    
    $('#datosIndicador').submit();
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
    
    indicador = { 
        id: 'vacunacion',
        alto: 300,
        ancho: 650,
        grafica: {
            "graphset": [{
                "type": "area",
                "title": { 
                    "text": 'Vacunación',
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
                "tooltip": { text : "%v% de %t en %k" },
                "scaleX": { values: ["Dic 12","Ene 13","Feb 13","Mar 13","Abr 13","May 13","Jun 13","Jul 13","Ago 13","Sep 13","Oct 13","Nov 13"] },
                "scaleY": { "values": "0:100:10" },
                "source": { text: "Fuente de datos" },
                "series": [
                    {
                        text: "Cobertura", "values": [26,13,32,12,33,26,23,20,40,90,60,70], "animate": true, "effect": 1, "highlight": true
                    },{
                        text: "Concordancia", "values": [33,26,23,20,12,33,26,23,20,60,40,70], "animate": true, "effect": 1, "highlight": true
                    }
                ]
            }
        ]
        }
    };
    
    generaGrafica(indicador);
    
    /*********************** FIN eficiencia ****************************/
    
    
    /******************** INICIO eficacia *******************************/
    var wiLinearGauge = 400, heLinearGauge = 73, metaSNS = 95;
    
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
                    "markercolor": "F1F1F1",
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
                    "markercolor": "F1F1F1",
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
                    "markercolor": "F1F1F1",
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
                "values" : "0:105.94500000000001:10",
                "background-color" : "#eeeeee,#b3b3b3",
                "ring" : {
                    "size" : 10,
                    "background-color" : "#eeeeee,#bbbbbb",
                }
            },
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
        console.log(node.id);
        
        enviarIndicador({
            dimension: '',
            filtro: '',
            indicador: ''
        });
    };

    /*********************** FIN economia ****************************/
    
});