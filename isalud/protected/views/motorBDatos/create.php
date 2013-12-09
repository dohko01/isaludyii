<?php
/* @var $this MotorBDatosController */
/* @var $model MotorBDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_sin, 'url'=>array('index')),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1><?php echo 'Crear nuevo '.$this->title_sin; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>