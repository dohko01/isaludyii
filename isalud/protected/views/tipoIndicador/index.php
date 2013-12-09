<?php
/* @var $this TipoIndicadorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo de Indicadores',
);

$this->menu=array(
	array('label'=>'Crear Tipo de Indicador', 'url'=>array('create')),
	array('label'=>'Administrar Tipo de Indicador', 'url'=>array('admin')),
);
?>

<h1>Tipo de Indicadores</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
