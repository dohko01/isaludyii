<?php
/* @var $this ClasificacionController */
/* @var $model Clasificacion */

$this->breadcrumbs=array(
	'Clasificaciones'=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Clasificación', 'url'=>array('index')),
	array('label'=>'Crear Clasificación', 'url'=>array('create')),
	array('label'=>'Ver Clasificación', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Clasificación', 'url'=>array('admin')),
);
?>

<h1>Actualizar la Clasificacion <?php echo $model->nombre; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>