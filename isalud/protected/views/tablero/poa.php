<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.base.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.ui-redmond.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxcore.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxdocking.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxwindow.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/FusionWidgetsXT/FusionCharts.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/tableroPoa.js', CClientScript::POS_END);

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
                    <!--<h4>Cobertura de vacunación de niños</h4>-->
                    <div id="vacunacion" align="center"></div>
                </div>
            </div>
        </div>
        <div style="width: 39%" align="center">
            <div id="window2" class="grupoIndicador" align="center">
                <div><strong> &nbsp; </strong></div>
                <div style="overflow: hidden;" class="graficoIndicador" id="eficacia" align="center">
                    <h5 align="center">Presupuesto total ejercido</h5>
                    <div id="presupuesto" align="center"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="docking2">
        <div style="width: 39%">
            <div id="window3" class="grupoIndicador">
                <div><strong> &nbsp; </strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="recursos">
                    <br>
                    <h4>Jurisdicci&oacute;n II, Municipios Cruzada contra el hambre</h4>
                    <br>
                    <p>
                    Se incrementó la cobertura de los municipios de la jurisdicci&oacute;n
                    </p>
                    <ul style="margin-left:40px;">
                        <li>< 1 a&ntilde;o paso de 0.9% a 28.2%</li>
                        <li>1 a&ntilde;o paso de 4.1% a 41.4%</li>
                        <li>1 a 4 a&ntilde;os paso de 34.3% a 69.0%</li>
                    </ul>
                    <p>
                        A partir del mes Diciembre se incrementan los municipios objeto de intervenci&oacute;n de la cruzada contra el hambre de 12 a 50
                    </p>
                </div>
            </div>
        </div>
        <div style="width: 59%">
            <div id="window4" class="grupoIndicador">
                <div><strong> &nbsp; </strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="economia">
                    <div id="avance_indicadores" align="center"></div>
                </div>
            </div>
        </div>
    </div>
</div>