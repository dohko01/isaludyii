// Las variables prefixTblIndicador, baseUrl y graficos se establecen en la accion index el controlador tablero 
zingchart.ASYNC = true;
outputZingChart = "svg";
urlLogo = baseUrl+'/images/logo.png';

$(document).ready(function () {
    heightWin = ($(document).height() - $('.navbar-fixed-top').height() - $('.breadcrumb').height() - $('.navbar-fixed-bottom').height() - 80) / 2;
    $('.grupoIndicador').css('height', heightWin+'px');
    $('#docking, #docking2').jqxDocking({ theme: 'Web', orientation: 'horizontal', width: '100%', mode: 'docked' });
    $('#docking, #docking2').jqxDocking('hideAllCloseButtons');
    $('#window1, #window2, #window3, #window4').jqxWindow({ draggable: false }); 
    
    /******************** INICIO *******************************/
    indicador = 'indicador_1';
    zW = $('#'+indicador).width();
    zH = $('#'+indicador).height();
    
    zingchart.ASYNC = false;
    
    zingchart.render({
        id: indicador,
        locale: "es_mx",
        customprogresslogo : urlLogo,
        output: outputZingChart,
        height : zH,
        width : zW,
        data :  {
            "type":"bar",
            "stacked":true,
            "stack-type":"normal", //Also accepts "100%"
            "series":[
                    {
                        "values":[11,16,7,14,11,24,42,26,13,32,12],
                        "stack":1
                    },
                    {
                        "values":[28,35,22,35,30,46,36,33,26,23,27],
                        "stack":1
                    },
                    {
                        "values":[14,21,29,19,31,26,35,22,14,18,40],
                        "stack":2
                    }
                ]
        }
    });
    
    // Elimina el mensaje de powered by ZingChart
    $('#'+indicador+"-license").remove();
    /*********************** FIN ****************************/
    
    
    /******************** INICIO *******************************/
    indicador = 'indicador_2';
    zW = $('#'+indicador).width();
    zH = $('#'+indicador).height();
    
    zingchart.render({
        id: indicador,
        locale: "es_mx",
        customprogresslogo : urlLogo,
        output: outputZingChart,
        height : zH,
        width : zW,
        data :  {
    "layout" : "1x2",
    "graphset" : [
        {
            "type" : "bar3d",
            "title" : {
                "text" : "Graph 1"
            },
            "series" : [
			{
			    "values" : [11,26,7,44,11,28]
			},
			{
			    "values" : [42,13,21,15,33,10]
			},
			{
			    "values" : [23,24,13,4,18,6]
			}]
        }
        ,
        {
            "type" : "bar3d",
            "title" : {
                "text" : "Graph 2"
            },
            "series" : [
			{
			    "values" : [33,75,23,12,54,33 ]
			},
			{
			    "values" : [45,22,64,23,55,67]
			},
			{
			    "values" : [34,67,21,26,19,43]
			}]
        }
    ]
}
    });
    
    // Elimina el mensaje de powered by ZingChart
    $('#'+indicador+"-license").remove();
    /*********************** FIN ****************************/
    
    
    /******************** INICIO *******************************/
    indicador = 'indicador_3';
    zW = $('#'+indicador).width();
    zH = $('#'+indicador).height();
    
    zingchart.render({
        id: indicador,
        locale: "es_mx",
        customprogresslogo : urlLogo,
        output: outputZingChart,
        height : zH,
        width : zW,
        data :  {
            "graphset":[
    {
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
                "size":5,
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
            }
        ],
        "alpha":1
    }
]
        }
    });
    
    // Elimina el mensaje de powered by ZingChart
    $('#'+indicador+"-license").remove();
    /*********************** FIN ****************************/
    
    
    /******************** INICIO *******************************/
    indicador = 'indicador_4';
    zW = $('#'+indicador).width();
    zH = $('#'+indicador).height();
    
    zingchart.render({
        id: indicador,
        locale: "es_mx",
        customprogresslogo : urlLogo,
        output: outputZingChart,
        height : zH,
        width : zW,
        data :   {
    "layout" : "1x2",
    "graphset" : [
        {
            "type" : "pie",
            "title" : {
                "text" : "Fruits"
            },
            "series" : [
		     {
		         "text": "Apples",
		         "values" : [5]
		     },
		     {
		         "text": "Oranges",
		     	 "values": [8]
		     },
		     {
		         "text": "Bananas",
		     	 "values": [22]
		     },
		     {
		         "text": "Grapes",
		     	 "values": [16]
		     }] 
        }
        ,
        {
            "type" : "pie",
            "title" : {
                "text" : "Vegetables"
            },
            "series" : [
		     {
		         "text": "Carrots",
		         "values" : [10]
		     },
		     {
		         "text": "Spinach",
		     	 "values": [12]
		     },
		     {
		         "text": "Green Beans",
		     	 "values": [18]
		     },
		     {
		         "text": "Asparagus",
		     	 "values": [25]
		     }] 
        }
    ]
}
    });
    
    // Elimina el mensaje de powered by ZingChart
    $('#'+indicador+"-license").remove();
    /*********************** FIN ****************************/
    
    $(window).resize(function(){
        
    });
    
});