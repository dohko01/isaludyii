<?php
/* @var $this VariableController */
/* @var $model Variable */

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
	$('#variable-grid').yiiGridView('update', {
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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'variable-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nombre',
        array(
            'name' =>'id_fuente_datos',
            'value'=>'CHtml::link(CHtml::encode($data->FuenteDatos->nombre), array(\'fuentedatos/view\', \'id\'=>$data->FuenteDatos->id))',
            'type'=>'html',
            'filter'=>CHtml::listData(FuenteDatos::model()->findAll(), 'id', 'nombre')
        ),
        array(
            'name' => 'id_campo',
            'value'=>'$data->Campo->nombre',
        ),
		'ini_formula',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
