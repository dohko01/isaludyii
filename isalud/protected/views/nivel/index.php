<?php
/* @var $this NivelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Nivels',
);

$this->menu=array(
	array('label'=>'Create Nivel', 'url'=>array('create')),
	array('label'=>'Manage Nivel', 'url'=>array('admin')),
);
?>

<h1>Nivels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
