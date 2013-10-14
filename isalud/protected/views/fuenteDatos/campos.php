<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Configurar campos',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Ver '.$this->title_sin, 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Configurar campos de la <?php echo $this->title_sin.' '.$model->nombre; ?></h1>
