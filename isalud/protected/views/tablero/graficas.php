<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.base.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.ui-redmond.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxcore.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxdocking.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxwindow.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/FusionWidgetsXT/FusionCharts.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/tableroGraficas.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/zingchart-html5-min.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/license.js');

$this->breadcrumbs=array(
	'Tablero'=>'principal','POA'
);
?>

<style type="text/css">
    #tableroPrincipal {
        /*min-height: 600px;*/
        min-width: 800px;
    }
    svg { cursor: pointer; }
</style>

<div id="tableroPrincipal">
    <div id="docking">
        <div style="width: 59%">
            <div id="window1" class="grupoIndicador">
                <div><strong> &nbsp; </strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="eficiencia">
                    <table><tr><td>
                        <img id="red_frios" src="../images/poa_2.PNG" height="300">
                    </td><td>
                        <img id="red_frios" src="../images/poa_5.PNG" height="300">
                    </td></tr></table>
                </div>
            </div>
        </div>
        <div style="width: 39%" align="center">
            <div id="window2" class="grupoIndicador" align="center">
                <div><strong> &nbsp; </strong></div>
                <div style="overflow: hidden;" class="graficoIndicador" id="eficacia">
                    <div id="presupuesto" align="center">
                        <img id="red_frios" src="../images/poa_1.PNG">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="docking2">
        <div style="width: 39%">
            <div id="window3" class="grupoIndicador">
                <div><strong> &nbsp; </strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="recursos">
                    <div id="avance_indicadores" align="center">
                        <img id="red_frios" src="../images/poa_3.PNG">
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 59%">
            <div id="window4" class="grupoIndicador">
                <div><strong> &nbsp; </strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="economia">
                    <div id="avance_indicadores" align="center">
                        <img id="red_frios" src="../images/poa_4.PNG">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>