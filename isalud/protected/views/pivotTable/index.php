<?php
/* @var $this PivotTableController */

Yii::app()->getClientScript()->registerScriptFile(
      Yii::app()->clientScript->getCoreScriptUrl().
      '/jui/js/jquery-ui.min.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerCssFile(
      Yii::app()->clientScript->getCoreScriptUrl().
      '/jui/css/base/jquery-ui.css');

Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/pivottable/dist/pivot.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/pivottable/ext/d3.v3.min.js');
Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/jsapi');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/pivottable/dist/pivot.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/pivottable/dist/gchart_renderers.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/pivottable/dist/d3_renderers.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/pivottable/ext/jquery.ui.touch-punch.min.js');

$this->breadcrumbs=array(
	'Tabla dinámica',
);
?>

<h2>Tabla dinámica</h2>

<div id="opcionesTablaDinamica">

    <div class="btn-toolbar" style="margin: 0;">
        <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="icon-signal"></i> Indicadores <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="menuIndicadores">
                <?php 
                foreach ($indicadores as $id => $nombre) {
                    echo '<li id='.$id.'><a href="#'.$id.'">'.$nombre.'</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>

</div>

<h3><?php echo CHtml::encode($nombreIndicador); ?></h3>

<?php if($error != false) echo '<div class="errorSummary">'.$error.'</div>'; ?>

<div id="divPivotTable" style="margin: 30px;"></div>

<form name="enviaIndicador" id="enviaIndicador" method="POST" action="<?php echo Yii::app()->createURL('pivotTable'); ?>">
    <input type="hidden" name="indicador" id="indicador" value="" />
    <input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
</form>
<script type="text/javascript">
    <?php echo $jsCalculaIndicador; ?>
    
    google.load("visualization", "1", { packages:["corechart", "charteditor"] } );

    $(document).ready(function(){ 
        
        $('#menuIndicadores > li').on('click touchend',function(event){
            event.preventDefault();
            event.stopPropagation();
            
            $('#indicador').val($(this).attr('id'));
            $('#enviaIndicador').submit();
        });

        <?php echo $jsPivotTable; ?> 
    });
</script>