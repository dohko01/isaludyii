<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.base.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/styles/jqx.ui-redmond.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxcore.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxdocking.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jQWidgets/jqwidgets/jqxwindow.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/FusionWidgetsXT/FusionCharts.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/tableroGerencial.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/zingchart-html5-min.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/license.js');

$this->breadcrumbs=array(
	'Tablero','Gerencial'
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
                <div><strong>Indicadores de Eficiencia</strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="eficiencia">
<!--                    <h4>Cobertura de vacunación de niños</h4>-->
                    <table align="center"><tr><td>
                        <div id="vacunacion" align="center"></div></td>
                            <td valign="top" align="center"><p><strong>Grupos etareos</strong></p>
                                <p><button class="btn btnVacunacion" data-id="menor_1"> <i class="fa fa-male fa-lg"></i> < 1 año</button></p>
                                <p><button class="btn btnVacunacion" data-id="_1"> <i class="fa fa-male fa-lg"></i> 1 año</button></p>
                                <p><button class="btn btnVacunacion" data-id="1_4"> <i class="fa fa-male fa-lg"></i> 1 - 4 años</button></p>
                            </td>
                    </tr></table>
                    
                    <!--<table align="center">
                        <tr align="center">
                            <td>
                                <div id="graficaCobMenorUno" style="cursor: pointer"></div>
                                <h4>menores de un año</h4>
                            </td>
                            <td>
                                <div id="graficaCobUno" style="cursor: pointer"></div>
                                <h4>de un año</h4>
                            </td>
                            <td>
                                <div id="graficaCobUnoCuatro" style="cursor: pointer"></div>
                                <h4>de uno a cuatro años</h4>
                            </td>
                        </tr>
                    </table>-->
                </div>
            </div>
        </div>
        <div style="width: 39%">
            <div id="window2" class="grupoIndicador">
                <div><strong>Indicadores de Eficacia</strong></div>
                <div style="overflow: hidden;" class="graficoIndicador" id="eficacia">
                    <h4>Logros de vacunación durante las Semanas Nacionales de Salud 2013</h4>
                    <table align="center">
                        <tr><td align="center">
                            <strong>Antipoliomielitica tipo Sabin en población de 6 a 59 meses de edad</strong>
                            <div id="graficoSNSSabin"></div>
                        </td></tr>
                        <tr><td align="center"><br>
                            <strong>SR en población de 12 años de edad</strong>
                            <div id="graficoSNSSR"></div>
                        </td></tr>
                        <tr><td align="center"><br>
                            <strong>TD en población de 12 años de edad</strong>
                            <div id="graficoSNSTD"></div>
                        </td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="docking2">
        <div style="width: 39%">
            <div id="window3" class="grupoIndicador">
                <div><strong>An&aacute;lisis de la informaci&oacute;n</strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="recursos"></div>
            </div>
        </div>
        <div style="width: 59%">
            <div id="window4" class="grupoIndicador">
                <div><strong>Indicadores de Econom&iacute;a</strong></div>
                <div style="overflow: auto;" class="graficoIndicador" id="economia">
                    <table align="center" width="90%">
                        <tr align="center" valign="top">
                            <td>
                                <h5>Presupuesto</h5>
                                <div id="presupuesto"></div>
                            </td>
                            <td>
                                <div id="biologico"><br>
                                    <img src="../images/semaforo-rojo.png">
                                    <h5>Existencia de biológicos de <br>acuerdo a lo planeado</h5>
                                </div>
                            </td>
                            <td>
                                <div id="red_frio"><br>
                                    <img src="../images/semaforo-rojo.png">
                                    <h5>Situación actual de <br>la red de fríos</h5>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form name="datosIndicador" id="datosIndicador" method="POST" action="<?php echo Yii::app()->createURL('tablero'); ?>" target="_blank">
    <input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
    <input type="hidden" name="dimension" id="dimension" value="id_jurisdiccion" />
    <input type="hidden" name="filtro" id="filtro" value='{"id_estado":7, "anio":2013}' />
    <input type="hidden" name="indicador" id="indicador" value='' />
</form>