<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	'Tipo Usuarios'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Tipo de Usuario', 'url'=>array('index')),
	array('label'=>'Administrar Tipo de Usuario', 'url'=>array('admin')),
);
?>

<h1>Crear TipoUsuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>