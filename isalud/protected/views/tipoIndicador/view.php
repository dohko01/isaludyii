<?php
/* @var $this TipoIndicadorController */
/* @var $model TipoIndicador */

$this->breadcrumbs=array(
	'Tipo Indicadores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Tipo de Indicador', 'url'=>array('index')),
	array('label'=>'Crear Tipo de Indicador', 'url'=>array('create')),
	array('label'=>'Actualizar Tipo de Indicador', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Tipo de Indicador', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar éste elemento?')),
	array('label'=>'Administrar Tipo de Indicador', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo de Indicador #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nombre',
		'comentario',
	),
)); ?>
