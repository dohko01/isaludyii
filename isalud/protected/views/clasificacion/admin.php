<?php
/* @var $this ClasificacionController */
/* @var $model Clasificacion */

$this->breadcrumbs=array(
	'Clasificacions'=>array('index'),
	'Administración',
);

$this->menu=array(
	array('label'=>'Listar Clasificación', 'url'=>array('index')),
	array('label'=>'Crear Clasificación', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#clasificacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administraci&oacute;n de las Clasificaciones</h1>

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
	'id'=>'clasificacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'nombre',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
