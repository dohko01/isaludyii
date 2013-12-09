<?php
/* @var $this TipoIndicadorController */
/* @var $model TipoIndicador */

$this->breadcrumbs=array(
	'Tipo de Indicadores'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Tipo de Indicador', 'url'=>array('index')),
	array('label'=>'Administrar Tipo de Indicador', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo de Indicador</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>