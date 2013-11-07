<?php
/* @var $this NivelController */
/* @var $model Nivel */

$this->breadcrumbs=array(
	'Nivels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Nivel', 'url'=>array('index')),
	array('label'=>'Crear Nivel', 'url'=>array('create')),
	array('label'=>'Actualizar Nivel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Nivel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Está seguro de que desea eliminar este Nivel?')),
	array('label'=>'Administrar Nivel', 'url'=>array('admin')),
);
?>

<h1>Ver Nivel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nombre',
	),
)); ?>
