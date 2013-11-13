<?php
/* @var $this TableroController */
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/css/jquery-ui.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/sDashboard/sDashboard.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/jquery/jquery-ui.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/flotr2/flotr2.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/touchpunch/jquery.ui.touch-punch.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/jquery-sDashboard.js');

$this->breadcrumbs=array(
	'Tablero',
);
?>

<h2> Pantalla de inicio principal </h2>

<div id="opcionesTablero">

    <div class="btn-toolbar" style="margin: 0;">
        <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="icon-signal"></i> Indicadores <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="menuIndicadores">
                <li><a href="#">Indicador 1</a></li>
                <li><a href="#">Indicador 2</a></li>
                <li><a href="#">Indicador 3</a></li>
                <li><a href="#">Indicador 4</a></li>
            </ul>
        </div>
        
        <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="icon-th-large"></i> Tablero  <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="menuTableros">
                <li><a href="#">Guardar</a></li>
                <li class="divider"></li>
                <li><a href="#">Tablero 1</a></li>
                <li><a href="#">Tablero 2</a></li>
                <li><a href="#">Tablero 3</a></li>
            </ul>
        </div>
    </div>

</div>

<ul id="tableroPrincipal">
    
</ul>

<script type="text/javascript">
var widgetDefinitions = [
    {
        widgetId: "Widget1", //unique id for the widget
        widgetContent: "Some Random Content" //content for the widget
    },
    {
        widgetId: "Widget2", //unique id for the widget
        widgetContent: "Some Random Content" //content for the widget
    }
];

$("#tableroPrincipal").sDashboard({
    dashboardData : widgetDefinitions
});


function agregarIndicador(indicador) {
    $("#tableroPrincipal").sDashboard("addWidget", {
                    widgetId : "ind_"+indicador,
                    widgetContent : "Some Content"
                });
}

$('#menuIndicadores > li').click(function(){
    agregarIndicador(Math.random());
});
</script>