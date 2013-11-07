<?php
/* @var $this ProgramaAccionController */
/* @var $model ProgramaAccion */

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
	$('#programa-accion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
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
<?php $list = CHtml::listData(Coordinacion::model()->findAll(), 'nombre', 'nombre'); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'programa-accion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_cat_coordinacion',
		array(
			'header'=>'Coordinación',
			'value'=>'($data->idCatCoordinacion!=null) ? $data->idCatCoordinacion->nombre : null',
			'filter'=>CHtml::activeDropDownList($model,'coordinacion_search',$list)
		),
		'nombre',
		'responsable',
		'comentario',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
