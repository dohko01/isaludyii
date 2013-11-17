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
        array(
            'name'=>'id_ficha_tecnica_padre',
            'value' => $model->FichaTecnicaPadre ? CHtml::link(CHtml::encode($model->FichaTecnicaPadre->nombre), array('fichatecnica/view', 'id'=>$model->FichaTecnicaPadre->id)) : '',
            'type'=>'html',
        ),
        array(
            'name'=>'id_cat_direccion',
            'value' => $model->Direccion->nombre,
        ),
        array(
            'name'=>'id_cat_subdireccion',
            'value' => $model->Subdireccion ? $model->Subdireccion->nombre : '',
        ),
        array(
            'name'=>'id_cat_coordinacion',
            'value' => $model->Coordinacion ? $model->Coordinacion->nombre : '',
        ),
        array(
            'name'=>'id_cat_programa_accion',
            'value' => $model->ProgramaAccion ? $model->ProgramaAccion->nombre : '',
        ),
        array(
            'name'=>'id_cat_nivel',
            'value' => $model->Nivel->nombre,
        ),
		'codigo',
        array(
            'name'=>'formula',
            'value' => $model->formula ? $model->formula : $model->creaFormulaIndicador(),
        ),
        array(
            'name'=>'es_acumulable',
            'value' => $model->es_acumulable ? 'Si' : 'No',
        ),
        array(
            'name'=>'es_publico',
            'value' => $model->es_publico ? 'Si' : 'No',
        ),
		'ponderacion',
		'unidad_medida',
		'meta',
		'definicion',
		'fundamento',
		'utilidad',
	),
)); ?>
