<?php
/* @var $this ClasificacionController */
/* @var $model Clasificacion */

$this->breadcrumbs=array(
	'Clasificacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Clasificacion', 'url'=>array('index')),
	array('label'=>'Administrar Clasificacion', 'url'=>array('admin')),
);
?>

<h1>Create Clasificacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>