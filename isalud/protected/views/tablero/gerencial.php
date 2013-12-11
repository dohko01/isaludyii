<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.base.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.ui-redmond.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxcore.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxdocking.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxwindow.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/tableroGerencial.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/zingchart-html5-min.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/license.js');

$this->breadcrumbs=array(
	'Tablero','Gerencial'
);
?>

<style type="text/css">
    #tableroPrincipal {
        min-height: 600px;
        min-width: 800px;
    }
</style>

<div id="tableroPrincipal">
    <div id="docking">
        <div style="width: 39%">
            <div id="window1" class="grupoIndicador">
                <div><strong>Indicadores de Salud</strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="morbilidad_mortalidad"></div>
                
            </div>
        </div>
        <div style="width: 59%">
            <div id="window2" class="grupoIndicador">
                <div><strong>Indicadores de Programas Especiales</strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="programas_especiales"></div>
            </div>
        </div>
    </div>

    <div id="docking2">
        <div style="width: 39%">
            <div id="window3" class="grupoIndicador">
                <div><strong>Indicadores de Recursos</strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="recursos"></div>
            </div>
        </div>
        <div style="width: 59%">
            <div id="window4" class="grupoIndicador">
                <div><strong>Indicadores de Servicios</strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="servicios"></div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
<input type="hidden" name="dimension" id="dimension" value="id_estado" />
<input type="hidden" name="filtro" id="filtro" value='{"id_estado":7, "anio":2013}' />