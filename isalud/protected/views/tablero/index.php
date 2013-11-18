<?php
/* @var $this TableroController */

Yii::app()->getClientScript()->registerScriptFile(
      Yii::app()->clientScript->getCoreScriptUrl().
      '/jui/js/jquery-ui.min.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerCssFile(
      Yii::app()->clientScript->getCoreScriptUrl().
      '/jui/css/base/jquery-ui.css');

Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/sDashboard/sDashboard.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/tablero.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/flotr2/flotr2.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/touchpunch/jquery.ui.touch-punch.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/jquery-sDashboard.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/json-to-table.js');

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
                <li><a href="#" id="btnGuardarTablero">Guardar</a></li>
                <li class="divider"></li>
                <li><a href="#" class="listaTablero">Tablero 1</a></li>
                <li><a href="#" class="listaTablero">Tablero 2</a></li>
                <li><a href="#" class="listaTablero">Tablero 3</a></li>
            </ul>
        </div>
    </div>

</div>

<input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />

<ul id="tableroPrincipal"> </ul>
<ul id="datosIndicadores" style="display: none;"> </ul>