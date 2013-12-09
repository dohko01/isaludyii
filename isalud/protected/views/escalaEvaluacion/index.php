<?php
/* @var $this EscalaEvaluacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->title_sin,
);

$this->menu=array(
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1><?php echo $this->title_plu; ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
