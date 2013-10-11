<?php
/* @var $this TipoIndicadorController */
/* @var $model TipoIndicador */

$this->breadcrumbs=array(
	'Tipo Indicadors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoIndicador', 'url'=>array('index')),
	array('label'=>'Create TipoIndicador', 'url'=>array('create')),
	array('label'=>'View TipoIndicador', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoIndicador', 'url'=>array('admin')),
);
?>

<h1>Update TipoIndicador <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>