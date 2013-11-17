<?php $baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseScriptUrl; ?>/detailview/styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tablestyler.css" />

<div id="contenedorFichaTecnica">
<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */

echo '<h1>Datos de la '. $this->title_sin.'</h1>';

$tableReglasEvaluacion = '<div class="datagrid">
    <table>
        <thead>
            <tr align="center">
                <th>Criterio de evaluación</th>
                <th>Color</th>
                <th>Limite Inferior</th>
                <th>Limite Superior</th>
            </tr>
        </thead>
        <tbody>';
        $escalaEvaluacion = $model->EscalaEvaluacion;
        
        foreach ($escalaEvaluacion->CriteriosEscalaEvaluacion as $regla) {
            $tableReglasEvaluacion .= '<tr>
                <td>'.$regla->CriterioEvaluacion->nombre.'</td>
                <td><span style="color:'.$regla->CriterioEvaluacion->color.';"><strong>'.$regla->CriterioEvaluacion->color.'</strong></span></td>
                <td align="center">'.$regla->limite_inf.'</td>
                <td align="center">'.$regla->limite_sup.'</td>
            </tr>';
        }
$tableReglasEvaluacion .= '</tbody></table></div>';

$this->widget('zii.widgets.CDetailView', array(
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
            'label'=>'Reglas de evaluación',
            'value'=>$tableReglasEvaluacion,
            'type'=>'html',
        ),
        array(
            'name'=>'id_cat_periodicidad',
            'value' => $model->Periodicidad->nombre,
        ),
        array(
            'name'=>'id_ficha_tecnica_padre',
            'value' => $model->FichaTecnicaPadre ? $model->FichaTecnicaPadre->nombre : '',
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
</div>