<?php
/* @var $this TipoCampoController */
/* @var $model TipoCampo */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->descripcion=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Ver '.$this->title_sin, 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Actualizar <?php echo $this->title_sin; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>