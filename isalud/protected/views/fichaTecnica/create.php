<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Crear nuevo <?php echo $this->title_sin; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>