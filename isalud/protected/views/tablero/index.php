<?php
/* @var $this TableroController */
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/css/jquery-ui.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/sDashboard/sDashboard.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/jquery/jquery-ui.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/flotr2/flotr2.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/touchpunch/jquery.ui.touch-punch.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/jquery-sDashboard.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/tablero.js', CClientScript::POS_END);

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
                <?php 
                foreach ($indicadores as $id => $nombre) {
                    echo '<li id='.$id.'><a href="'.Yii::app()->createURL('tablero/getindicador').'">'.$nombre.'</a></li>';
                }
                ?>
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

<!--<div class="contenedorIndicador" style="display: none">
    
    <div class="tituloIndicador">
        Titulo del indicador
    </div>
    
    <div class="subtituloIndicador">
        filtros y dimensi&oacute;n
    </div>
    
    <div class="opcionesIndicador">
        Barra de opciones
    </div>
    
    <div class="graficoIndicador">
        Grafico del indicador
    </div>
    
    <div class="pieIndicador">
        Fuentes del indicador
    </div>
    
</div>-->

<input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
