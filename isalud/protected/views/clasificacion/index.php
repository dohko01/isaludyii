<?php
/* @var $this ClasificacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clasificacions',
);

$this->menu=array(
	array('label'=>'Crear Clasificacion', 'url'=>array('create')),
	array('label'=>'Administrar Clasificacion', 'url'=>array('admin')),
);
?>

<h1>Clasificacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
