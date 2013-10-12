<?php
/* @var $this ConexionBDatosController */
/* @var $model ConexionBDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Crear nueva <?php echo $this->title_sin; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'motoresBDatos'=>$motoresBDatos)); ?>