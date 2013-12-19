<?php
/* @var $this TableroController */

Yii::app()->getClientScript()->registerScriptFile(
      Yii::app()->clientScript->getCoreScriptUrl().
      '/jui/js/jquery-ui.min.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerCssFile(
      Yii::app()->clientScript->getCoreScriptUrl().
      '/jui/css/base/jquery-ui.css');

Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/sDashboard/sDashboard.css');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/flotr2/flotr2.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/files/libs/touchpunch/jquery.ui.touch-punch.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/sDashboard/jquery-sDashboard.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/json-to-table.js');

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/tablero.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/zingchart-html5-min.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/zingChart/license.js');

$this->breadcrumbs=array(
	'Tablero',
);
?>

<h2>Tablero de control</h2>

<div id="opcionesTablero">

    <div class="btn-toolbar" style="margin: 0;">
        <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="icon-signal"></i> Indicadores <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="menuIndicadores">
                <?php 
                foreach ($indicadores as $id => $nombre) {
                    echo '<li id='.$id.'><a href="#">'.$nombre.'</a></li>';
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
                <?php 
                    foreach ($tableros as $id => $nombre) {
                        echo '<li data-id='.$id.'><a href="#">'.$nombre.'</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>

</div>

<input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
<input type="hidden" name="dimension" id="dimension" value="id_jurisdiccion" />
<input type="hidden" name="filtro" id="filtro" value='{"id_estado":7, "anio":2013}' />
<input type="hidden" name="actualizarGrafica" id="actualizarGrafica" />
<input type="hidden" name="isMaximized" id="isMaximized" />

<ul id="tableroPrincipal"> </ul>
<ul id="datosIndicadores" style="display: none;"> </ul>
<ul id="indicadoresActuales" style="display: none"></ul>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'winMaximizarGrafica',
    'options'=>array(
        'autoOpen'=>false,
        'modal'=>false,
        'height'=>'js:$(window).height()-200',
        'width'=>'js:$(window).width()-300',
        'close'=>'js:destroyGraficaMaximizar',
        'resizeStop'=>'js:redimensionaGraficaMaximizar',
        'show'=>'js:{
            effect: "blind",
            duration: 1000,
            complete: addGraficaMaximizar
        }',
        'hide'=>'js:{
            effect: "blind",
            duration: 1000, 
        }'
    ),
));

    echo '<div class="contenedorIndicador"></div>';
        
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<script language="javascript" type="text/javascript">
zingchart.node_click = function(node){
        //console.log(node);
        var id_indicador = node.id.split("_");
        var indicadorActual = $('#indicadorActual_'+id_indicador[1]).html();
        var jDatos = $.parseJSON($("#json_"+indicadorActual).html());
        var id = id_indicador[1];
        console.log(jDatos);
        $.ajax({
            url: baseUrl+'/fichaTecnica/GetFichaTecnica/'+indicadorActual,
            data: 'id='+indicadorActual+'&YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val()+'&cambiaNivel=1',
            type: "POST",
            dataType : "json",
            success: function( respuesta ) {
                if(respuesta.error) {
                    showError('Error al obtener datos del indicador, revise el mensaje de error: '+respuesta.msjerror);
                } else {
                    //alert(respuesta.formula)
                    if(respuesta.formula == null)
                    {
                        $('#actualizarGrafica').val(node.id);
                        $('#indicadorActual_'+id_indicador[1]).html(jDatos.idIndicadores[node.nodeindex]);
                        cambiaNivel(jDatos.idIndicadores[node.nodeindex]);
                        $('#listadoGrafica_'+id_indicador[1]).append('<a class="grafico_'+jDatos.idIndicadores[node.nodeindex]+'" href="#" onclick="regresaNivel('+jDatos.idIndicadores[node.nodeindex]+',\'graficoIndicador_'+id+'\');">&nbsp;>>'+jDatos.etiquetas[node.nodeindex]+'</a>');
                    }else{
                        
                        cambiaDimension(indicadorActual,jDatos.dimension,node.id,jDatos.idDimension[node.nodeindex]);
                    }
                }
            },
            error: function( xhr, status ) {
                showError( "Error al obtener los datos. "+status+" "+xhr.status );
            }
        });
//        if(jDatos.nivel.id == 4)
//        {
//            $('#actualizarGrafica').val(node.id);
//            cambiaNivel(id);
//        }
}
</script>
<?php
if(!empty($datosPost))
{
    $idIndicadores = explode(',',$datosPost['indicador']);//1,21,2,22,17,23
?>
    <script language="javascript" type="text/javascript">
    $(document).ready(function() {
<?php    
    foreach($idIndicadores as $idIndicador)
    {
    ?>
    cargaIndicadoresPost(<?php echo '\''.$idIndicador.'\',\''.$datosPost['filtro'].'\',\''.$datosPost['dimension'].'\'';?>);
<?php
    }
    ?>
    });
    </script>
<?php    
}
?>