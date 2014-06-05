<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_sin, 'url'=>array('index')),
	array('label'=>'Administrar '.$this->title_sin, 'url'=>array('admin')),
);
?>

<h1>Crear nuevo <?php echo $this->title_sin;?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>