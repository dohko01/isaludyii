<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.base.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.ui-redmond.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxcore.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxdocking.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxwindow.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/tableroPrincipal.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/zingchart-html5-min.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/license.js');

$this->breadcrumbs=array(
	'Tablero','Gerencial'=>'gerencial'
);
?>

<style type="text/css">
    #tableroPrincipal {
        /*min-height: 600px;*/
        min-width: 800px;
    }
    svg { cursor: pointer; }
    .graficoIndicador {
        display: block;
        width: 100%;
        height: 100%;
    }
</style>

<div id="tableroPrincipal">
    <div id="docking">
        <div style="width: 49%">
            <div id="window1" class="grupoIndicador">
                <div><strong></strong></div>
                <div style="overflow: auto;">
                    <!-- <h4></h4> -->
                    <div id="grafica1" class="graficoIndicador"></div>
                </div>
            </div>
        </div>
        <div style="width: 49%">
            <div id="window2" class="grupoIndicador">
                <div><strong></strong></div>
                <div style="overflow: auto;">
                    <!-- <h4></h4> -->
                    <div id="grafica2" class="graficoIndicador"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="docking2">
        <div style="width: 49%">
            <div id="window3" class="grupoIndicador">
                <div><strong></strong></div>
                <div style="overflow: auto;">
                    <!-- <h4></h4> -->
                    <div id="grafica3" class="graficoIndicador"></div>
                </div>
            </div>
        </div>
        <div style="width: 49%">
            <div id="window4" class="grupoIndicador">
                <div><strong></strong></div>
                <div style="overflow: auto;">
                    <!-- <h4></h4> -->
                    <div id="grafica4" class="graficoIndicador"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<form name="datosIndicador" id="datosIndicador" method="POST" action="<?php echo Yii::app()->createURL('tablero/gerencial'); ?>">
    <input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
    <input type="hidden" name="dimension" id="dimension" value="id_jurisdiccion" />
    <input type="hidden" name="filtro" id="filtro" value='{"id_estado":7, "anio":2013}' />
    <input type="hidden" name="indicador" id="indicador" value='' />
</form>