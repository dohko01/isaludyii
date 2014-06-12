<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#fuente-datos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/cargarDatos.js');
?>

<h1>Administraci&oacute;n de <?php echo $this->title_plu; ?></h1>

<p>
Operadores de comparaci&oacute;n soportados por el campo busqueda: <b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>
</p>

<?php echo CHtml::link('Busqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fuente-datos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate'=>"function(){jQuery('#datepicker_ultima_lectura').datepicker({'dateFormat': 'yy-mm-dd', 'language': 'es'})}",
	'columns'=>array(
		'nombre',
		'responsable',
        array(
            'name' => 'id_cat_periodicidad',
            'value'=>'$data->Periodicidad->nombre',
            'filter'=>CHtml::listData(Periodicidad::model()->findAll(), 'id', 'nombre')
        ),
        array(
            'name' => 'id_conexion_bdatos',
            // Si existe una relacion entre la fuente de base de datos y una conexion a base de datos
            // debemos mostrar el nombre de la base de datos
            'value'=>'$data->ConexionBDatos ? CHtml::link(CHtml::encode($data->ConexionBDatos->nombre), array(\'conexionbdatos/view\', \'id\'=>$data->ConexionBDatos->id)) : ""',
            'type'=>'html',
            'filter'=>CHtml::listData(ConexionBDatos::model()->findAll(), 'id', 'nombre')
        ),
		/*'descripcion',
		'sentencia_sql',*/
		'archivo',
        array(
            'name' => 'ultima_lectura',
            'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'ultima_lectura', 
                'language' => 'es',
                'i18nScriptFile' => 'jquery.ui.datepicker-es.js',
                'htmlOptions' => array(
                    'id' => 'datepicker_ultima_lectura',
                    'size' => '10',
                ),
                'defaultOptions' => array(
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy/mm/dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                ),
            ), 
            true),
        ),
        array(
            // Utilizamos la nueva clase extendida para poder evaluar el id en el array options
			'class'=>'ButtonColumn',
            'template' => '{configCampos} &nbsp; {cargarDatos} &nbsp; {verDatos} &nbsp; {recargarDatos}',
            'evaluateID'=>true, // Variable que define si será evaluado el id en el array options
            'buttons' => array(
                'configCampos' => array(
                    'label'=>'Configurar Campos',
                    'caption'=>'Configurar Campos',
                    'url'=>'Yii::app()->createUrl("/fuentedatos/configurarcampo", array("id" => $data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/config.png',
                ),
                'cargarDatos' => array(
                    'label'=>'Cargar Datos',
                    'caption'=>'Cargar Datos',
                    'url'=>'$data->id',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/load.png',
                    'click'=>new CJavaScriptExpression('fnCargarDatos'),
                    'options'=>array('id'=>'$data->id'),
                ),
                'verDatos' => array(
                    'label'=>'Ver datos cargados',
                    'caption'=>'Ver datos cargados',
                    'url'=>'Yii::app()->createUrl("/fuentedatos/verdatos", array("id" => $data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
                ),
                'recargarDatos' => array(
                    'label'=>'Limpiar y volver a cargar datos',
                    'caption'=>'Limpiar y volver a cargar datos',
                    'url'=>'Yii::app()->createUrl("/fuentedatos/recargardatos", array("id" => $data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/refresh.png',
                    'options'=>array('id'=>'$data->id'),
                    'click'=>new CJavaScriptExpression('fnRecargarDatos'),
                ),
            ),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
));

// Para la validacion CSRF
echo CHtml::hiddenField('YII_CSRF_TOKEN',Yii::app()->request->csrfToken);
?>
