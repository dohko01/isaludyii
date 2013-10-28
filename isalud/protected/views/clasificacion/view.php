<?php
/* @var $this ClasificacionController */
/* @var $model Clasificacion */

$this->breadcrumbs=array(
	'Clasificacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Clasificacion', 'url'=>array('index')),
	array('label'=>'Crear Clasificacion', 'url'=>array('create')),
	array('label'=>'Actualizar Clasificacion', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Eliminar Clasificacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Clasificacion', 'url'=>array('admin')),
);
?>

<h1>Ver Clasificacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nombre',
	),
)); ?>
