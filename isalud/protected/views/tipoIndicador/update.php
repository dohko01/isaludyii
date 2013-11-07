<?php
/* @var $this TipoIndicadorController */
/* @var $model TipoIndicador */

$this->breadcrumbs=array(
	'Tipo de Indicadores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Tipo de Indicador', 'url'=>array('index')),
	array('label'=>'Crear Tipo de Indicador', 'url'=>array('create')),
	array('label'=>'Ver Tipo de Indicador', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Tipo de Indicador', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tipo de Indicador #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>