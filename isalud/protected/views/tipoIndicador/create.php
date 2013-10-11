<?php
/* @var $this TipoIndicadorController */
/* @var $model TipoIndicador */

$this->breadcrumbs=array(
	'Tipo Indicadors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoIndicador', 'url'=>array('index')),
	array('label'=>'Manage TipoIndicador', 'url'=>array('admin')),
);
?>

<h1>Create TipoIndicador</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>