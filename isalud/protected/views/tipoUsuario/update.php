<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Tipo de Usuario', 'url'=>array('index')),
	array('label'=>'Crear Tipo de Usuario', 'url'=>array('create')),
	array('label'=>'Ver Tipo de Usuario', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Tipo de Usuario', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tipo de Usuario <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>