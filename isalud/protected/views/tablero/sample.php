<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/zingchart-html5-min.js');
?>
<script src="license.js"></script> <!—once you have purchased a license—>
<div id="myChartDiv" style="width:100%; height:100%; border:2px solid;"></div>

<script>
	var myChart = {
		type   : "radar",
		title  : {text: "Hello ZingChart World!"},
		"scale-k":{
			values	: ["Enero","Febrero","Marzo","Abril","Mayo","Junio"]
		},
		legend : {},
		series : [
			{
				values:		[5, 10, 15, 5, 10, 5],
				text:		"HOLA",
				animate:	true,
				effect:		2,
				"tooltip-text" : "%t\n%k:%v",
			},
			{
				values:		[2, 4, 6, 8, 10, 12],
				text:		"NO",
				animate:	true,
				effect:		2,
				"tooltip-text" : "%t\n%k:%v",
			}
		]
		};
		
		zingchart.render({
			id : "myChartDiv",
			height : 400,
			width : 600,
			data : myChart
		});

		zingchart.node_click = function(node){
				console.log(node);
				alert("Node Clicked - Key: " + node["key"] + 
			   " Value: " + node["scaletext"]);
		}	
</script>