<?php
/* @var $this ClasificacionController */
/* @var $model Clasificacion */

$this->breadcrumbs=array(
	'Clasificación'=>array('index'),
	CHtml::encode($model->nombre),
);

$this->menu=array(
	array('label'=>'Listar Clasificación', 'url'=>array('index')),
	array('label'=>'Crear Clasificación', 'url'=>array('create')),
	array('label'=>'Actualizar Clasificación', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Eliminar Clasificacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Clasificación', 'url'=>array('admin')),
);
?>

<h1>Clasificación</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nombre',
	),
)); ?>
