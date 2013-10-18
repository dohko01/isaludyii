<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */

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
		'nombre',
        array(
            'name'=>'id_cat_tipo_indicador',
            'value' => $model->TipoIndicador->nombre,
        ),
        array(
            'name'=>'id_cat_clasificacion',
            'value' => $model->Clasificacion->nombre,
        ),
        array(
            'name'=>'id_escala_evaluacion',
            'value'=>CHtml::link(CHtml::encode($model->EscalaEvaluacion->nombre), array('escalaevaluacion/view', 'id'=>$model->EscalaEvaluacion->id)),
            'type'=>'html',
        ),
        array(
            'name'=>'id_cat_periodicidad',
            'value' => $model->Periodicidad->nombre,
        ),
		'id_ficha_tecnica_padre',
        array(
            'name'=>'id_cat_direccion',
            'value' => $model->Direccion->nombre,
        ),
		'id_cat_subdireccion',
		'id_cat_coordinacion',
		'id_cat_programa_accion',
        array(
            'name'=>'id_cat_nivel',
            'value' => $model->Nivel->nombre,
        ),
		'codigo',
		'formula',
		'ponderacion',
		'unidad_medida',
		'meta',
		'definicion',
		'fundamento',
		'utilidad',
	),
)); ?>