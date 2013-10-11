<?php
/* @var $this NivelController */
/* @var $model Nivel */

$this->breadcrumbs=array(
	'Nivels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Nivel', 'url'=>array('index')),
	array('label'=>'Create Nivel', 'url'=>array('create')),
	array('label'=>'Update Nivel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Nivel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nivel', 'url'=>array('admin')),
);
?>

<h1>View Nivel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
)); ?>
