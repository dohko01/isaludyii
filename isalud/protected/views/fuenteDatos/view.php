<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Actualizar '.$this->title_sin, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar '.$this->title_sin, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Esta seguro que desea eliminar el registro?','csrf'=>true)),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/cargarDatos.js');
?>

<h1>Datos de la <?php echo $this->title_sin; ?></h1>

<?php
if(Yii::app()->user->hasFlash('errorUploadFile'))
    echo '<div class="errorSummary">'.Yii::app()->user->getFlash('errorUploadFile').'</div>';

if(Yii::app()->user->hasFlash('error'))
    echo '<div class="errorSummary">'.Yii::app()->user->getFlash('error').'</div>';

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
        array(
            'label'=>'Periodicidad de actualización',
            'value' => $model->Periodicidad->nombre,
        ),
        array(
            'name'=>'es_actualizacion_incremental',
            'value' => $model->es_actualizacion_incremental ? 'Si' : 'No',
        ),
        'responsable',
		'descripcion',
        array(
            'label'=>'Conexión a base de datos',
            'value'=>$model->ConexionBDatos ? CHtml::link(CHtml::encode($model->ConexionBDatos->nombre), array('conexionbdatos/view', 'id'=>$model->ConexionBDatos->id)) : "",
            'type'=>'html',
        ),
		'sentencia_sql',
		'archivo',
		'ultima_lectura',
	),
));

echo '<br /><p>';

$this->widget('zii.widgets.jui.CJuiButton',array(
    'buttonType'=>'button',
    'name'=>'configCampos',
    'caption'=>'Configurar Campos',
    'onclick'=>new CJavaScriptExpression('function(){ location.href="'.Yii::app()->createUrl("/fuentedatos/configurarcampo", array("id" => $model->id)).'"} '),
));

$this->widget('zii.widgets.jui.CJuiButton',array(
    'buttonType'=>'button',
    'name'=>'cargarDatos',
    'caption'=>'Cargar Datos',
    'onclick'=>'fnCargarDatos',
    'htmlOptions'=>array('id'=>$model->id)
));

echo '</p>';

// Para la validacion CSRF
echo CHtml::hiddenField('YII_CSRF_TOKEN',Yii::app()->request->csrfToken);
?>
