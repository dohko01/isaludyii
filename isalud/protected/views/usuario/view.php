<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Actualizar '.$this->title_sin, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar '.$this->title_sin, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Esta seguro que desea eliminar el registro?')),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Datos del <?php echo $this->title_sin; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'id_cat_estado',
			'value'=>($model->idCatEstado != NULL) ? $model->idCatEstado->nombre : "",
		),
		array(
			'name'=>'id_cat_jurisdiccion',
			'value'=>($model->idCatJurisdiccion != NULL) ? $model->idCatJurisdiccion->nombre : "",
		),
		array(
			'name'=>'id_cat_institucion',
			'value'=>($model->idCatInstitucion != NULL) ? $model->idCatInstitucion->nombre : "",
		),
		array(
			'name'=>'id_cat_direccion',
			'value'=>($model->idCatDireccion != NULL) ? $model->idCatDireccion->nombre : "",
		),
		array(
			'name'=>'id_cat_subdireccion',
			'value'=>($model->idCatSubdireccion != NULL) ? $model->idCatSubdireccion->nombre : "",
		),
		array(
			'name'=>'id_cat_coordinacion',
			'value'=>($model->idCatCoordinacion != NULL) ? $model->idCatCoordinacion->nombre : "",
		),
		array(
			'name'=>'id_cat_tipo_usuario',
			'value'=>$model->idCatTipoUsuario->nombre,
		),
		'nombre',
		'email',
		'telefono',
		'username',
		//'pass',
		array(
			'name'=>'activo',
			'value'=>($model->activo) ? "Si":"No",
		),
	),
)); ?>
