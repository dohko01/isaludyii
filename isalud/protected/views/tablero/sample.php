<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/zingchart-html5-min.js');
?>
<script src="license.js"></script> <!—once you have purchased a license—>
<div id="myChartDiv" style="width:100%; height:100%; border:2px solid;"></div>

<script>
	var myChart = {
		type   : "line",
		title  : {text: "Hello ZingChart World!"},
		"scale-x":{
			values	: ["Enero","Febrero","Marzo","Abril","Mayo","Junio"]
		},
		legend : {},
		series : [
			{
				values:		[5, 10, 15, 5, 10, 5],
				text:		"HOLA",
				animate:	true,
				effect:		2,
			},
			{
				values:		[2, 4, 6, 8, 10, 12],
				text:		"NO",
				animate:	true,
				effect:		2
			}
		]
		};
		
		zingchart.render({
			id : "myChartDiv",
			height : 400,
			width : 600,
			data : myChart
		});	
</script>