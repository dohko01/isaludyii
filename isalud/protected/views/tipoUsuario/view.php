<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Tipo de Usuario', 'url'=>array('index')),
	array('label'=>'Crear Tipo de Usuario', 'url'=>array('create')),
	array('label'=>'Actualizar Tipo de Usuario', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Tipo de Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Está seguro que desea eliminar este registro?')),
	array('label'=>'Administrar Tipo de Usuario', 'url'=>array('admin')),
);
?>

<h1>View Tipo de Usuario #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nombre',
		'activo',
	),
)); ?>
