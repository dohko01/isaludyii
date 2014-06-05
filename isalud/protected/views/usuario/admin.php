<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administraci&oacute;n de <?php echo $this->title_plu; ?></h1>

<p>
Operadores de comparaci&oacute;n soportados por el campo busqueda: <b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>
</p>

<?php echo CHtml::link('Busqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $listTipoUsuarios = CHtml::listData(TipoUsuario::model()->findAll(), 'nombre', 'nombre'); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*'id_cat_estado',
		'id_cat_jurisdiccion',
		'id_cat_direccion',
		'id_cat_subdireccion',
		'id_cat_coordinacion',
		'id_cat_tipo_usuario',*/
		
		//'id_cat_institucion',
		'nombre',
		'email',
		'telefono',
		'username',
		array(
			'name'=>'id_cat_tipo_usuario',
			'value'=>'($data->idCatTipoUsuario!=null) ? $data->idCatTipoUsuario->nombre : null',
            'filter'=>CHtml::activeDropDownList($model,'tipousuario_search',$listTipoUsuarios, array('empty'=>'Seleccionar...'))
		),
		//'pass',
		array(
			'name'=>'activo',
			'value'=>'($data->activo) ? "Si" : "No"',
            'filter'=>CHtml::activeDropDownList($model,'activo_search', array(1=>'Si', 0=>'No'), array('empty'=>'Seleccionar...'))
		),
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
