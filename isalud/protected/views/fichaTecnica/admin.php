<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */

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
	$('#ficha-tecnica-grid').yiiGridView('update', {
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
	'id'=>'ficha-tecnica-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nombre',
        array(
            'name' => 'id_cat_tipo_indicador',
            'value'=>'$data->TipoIndicador->nombre',
            'filter'=>CHtml::listData(TipoIndicador::model()->findAll(), 'id', 'nombre')
        ),
        array(
            'name' => 'id_cat_clasificacion',
            'value'=>'$data->Clasificacion->nombre',
            'filter'=>CHtml::listData(Clasificacion::model()->findAll(), 'id', 'nombre')
        ),
        array(
            'name' => 'id_cat_periodicidad',
            'value'=>'$data->Periodicidad->nombre',
            'filter'=>CHtml::listData(Periodicidad::model()->findAll(), 'id', 'nombre')
        ),
        array(
            'name' => 'id_ficha_tecnica_padre',
            'value'=>'$data->FichaTecnicaPadre ? $data->FichaTecnicaPadre->nombre : ""',
            'filter'=>CHtml::listData(FichaTecnica::model()->findAll(), 'id', 'nombre')
        ),
        array(
            'name' => 'id_cat_direccion',
            'value'=>'$data->Direccion->nombre',
            'filter'=>CHtml::listData(Direccion::model()->findAll(), 'id', 'nombre')
        ),
		array(
            'name' => 'id_cat_nivel',
            'value'=>'$data->Nivel->nombre',
            'filter'=>CHtml::listData(Nivel::model()->findAll(), 'id', 'nombre')
        ),
		/*
		'id_escala_evaluacion',
		'id_cat_subdireccion',
		'id_cat_coordinacion',
		'id_cat_programa_accion',
		'codigo',
		'formula',
		'ponderacion',
		'unidad_medida',
		'meta',
		'definicion',
		'fundamento',
		'utilidad',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
