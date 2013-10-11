<?php
/* @var $this TipoIndicadorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Indicadors',
);

$this->menu=array(
	array('label'=>'Create TipoIndicador', 'url'=>array('create')),
	array('label'=>'Manage TipoIndicador', 'url'=>array('admin')),
);
?>

<h1>Tipo Indicadors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
