<?php
/* @var $this TipoIndicadorController */
/* @var $model TipoIndicador */

$this->breadcrumbs=array(
	'Tipo Indicadors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoIndicador', 'url'=>array('index')),
	array('label'=>'Create TipoIndicador', 'url'=>array('create')),
	array('label'=>'Update TipoIndicador', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoIndicador', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoIndicador', 'url'=>array('admin')),
);
?>

<h1>View TipoIndicador #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'comentario',
	),
)); ?>
