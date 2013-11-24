<?php
/* @var $this ClasificacionController */
/* @var $model Clasificacion */

$this->breadcrumbs=array(
	'Clasificacions'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Clasificación', 'url'=>array('index')),
	array('label'=>'Administrar Clasificación', 'url'=>array('admin')),
);
?>

<h1>Crear Clasificación</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>