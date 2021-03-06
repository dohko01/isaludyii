<?php
/* @var $this ModuloController */
/* @var $model Modulo */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Actualizar '.$this->title_sin, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar '.$this->title_sin, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Esta seguro que desea eliminar el registro?','csrf'=>true)),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Datos del <?php echo $this->title_sin; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
			'name'=>'id_cat_tipo_usuario',
			'value'=>($model->idCatTipoUsuario != NULL) ? $model->idCatTipoUsuario->nombre : "",
		),
		'nombre',
		'url',
		array(
			'name'=>'activo',
			'value'=>($model->activo) ? "Si":"No",
		),
		array(
			'name'=>'parent_id',
			'value'=>($model->parent_id != NULL) ? $model->parent->nombre : "",
		),
	),
)); ?>
