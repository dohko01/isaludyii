<?php
/* @var $this MotorBDatosController */
/* @var $model MotorBDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Ver '.$this->title_sin, 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1><?php echo 'Actualizar '.$this->title_sin;//echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>