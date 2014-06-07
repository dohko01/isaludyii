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
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.fileDownload.js');

Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/jsapi');
Yii::app()->getClientScript()->registerScriptFile('http://canvg.googlecode.com/svn/trunk/rgbcolor.js');
Yii::app()->getClientScript()->registerScriptFile('https://canvg.googlecode.com/svn-history/r157/trunk/canvg.js');

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
    
        <?php
        if(isset($_POST['indicador'])) {
            echo '<div class="btn-group">\n\
                    <button class="btn" id="exportarExcel"> <i class="fa fa-table fa-lg"></i> Exportar tabla a Excel</button>\n\
                </div>
                <div class="btn-group">\n\
                    <button class="btn" id="descargarImagen"> <i class="fa fa-picture-o fa-lg"></i> Descargar imagen</button>\n\
                </div>';
        }
        ?>
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
    // Fuente: http://stackoverflow.com/questions/6660498/can-google-visualization-pie-chart-output-to-a-png-image/16137983#16137983
    function getImgData(chartContainer) {
        var chartArea = chartContainer.getElementsByTagName('svg')[0].parentNode;
        var svg = chartArea.innerHTML;
        var doc = chartContainer.ownerDocument;
        var canvas = doc.createElement('canvas');
        
        canvas.setAttribute('width', chartArea.offsetWidth);
        canvas.setAttribute('height', chartArea.offsetHeight);
        canvas.setAttribute(
            'style',
            'position: absolute; ' +
            'top: ' + (-chartArea.offsetHeight * 2) + 'px;' +
            'left: ' + (-chartArea.offsetWidth * 2) + 'px;');
        
        doc.body.appendChild(canvas);
        canvg(canvas, svg);
        
        return canvas.toDataURL("image/png");
        /*var imgData = canvas.toDataURL("image/png");
        canvas.parentNode.removeChild(canvas);
        return imgData;*/
    }
    
    <?php echo $jsCalculaIndicador; ?>
    
    google.load("visualization", "1", { packages:["corechart", "charteditor"] } );

    $(document).ready(function(){
        
        $('#menuIndicadores > li').on('click touchend',function(event){
            event.preventDefault();
            event.stopPropagation();
            
            $('#indicador').val($(this).attr('id'));
            $('#enviaIndicador').submit();
        });
        
        $('#exportarExcel').click(function(event){
            if($('.pvtRenderer').val() != 'Tabla') {
                showError('Debe tener habilitada la vista de Tabla para poder exportar los datos');
            } else {
                $.fileDownload('<?php echo Yii::app()->createUrl("/pivotTable/exportXLS"); ?>', {
                    'prepareCallback': function(url){ $('body').prepend('<div class="loading"></div>'); },
                    'successCallback': function(url){ $('body').children('.loading').remove(); },
                    'failCallback': function(responseHtml, url){ showError('Error al intentar descargar el archivo. '+responseHtml) },
                    httpMethod: "POST",
                    data: {'YII_CSRF_TOKEN': $('#YII_CSRF_TOKEN').val(),
                           'archivo': "<?php echo $nombreIndicador; ?>",
                           'tabla': $('<div>').append($('.pvtTable').clone()).html().replace(/"/g, '\'')}
                });
            }
        });
        
        $('#descargarImagen').click(function(event){
            if( $('.pvtRenderer').val().search(/Gráfica/i) == -1) {
                showError('Debe tener habilitada una vista de Gráfica para poder descargar la imagen');
            } else {
                $.fileDownload('<?php echo Yii::app()->createUrl("/pivotTable/exportIMG"); ?>', {
                    'prepareCallback': function(url){ $('body').prepend('<div class="loading"></div>'); },
                    'successCallback': function(url){ $('body').children('.loading').remove(); },
                    'failCallback': function(responseHtml, url){ showError('Error al intentar descargar el archivo. '+responseHtml) },
                    httpMethod: "POST",
                    data: {'YII_CSRF_TOKEN': $('#YII_CSRF_TOKEN').val(),
                           'archivo': "<?php echo $nombreIndicador; ?>",
                           'imagen': getImgData(document.getElementsByClassName('pvtRendererArea')[0])
                    }
                });
                //pvtRendererArea
            }
        });
        
        

        <?php echo $jsPivotTable; ?> 
    });
    
    
</script>