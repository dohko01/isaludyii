<?php
/* @var $this EscalaEvaluacionController */
/* @var $model EscalaEvaluacion */

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

Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/tablestyler.css');
?>

<h1>Datos de la <?php echo $this->title_sin; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'comentario',
	),
));
?>
<br />
<h5>Reglas de evaluación</h5>
<div class="datagrid">
    <table id="tableReglasEvaluacion">
        <thead>
            <tr align="center">
                <th>Criterio de evaluación</th>
                <th>Color</th>
                <th>Limite Inferior</th>
                <th>Limite Superior</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                foreach ($model->CriteriosEscalaEvaluacion as $regla) {
                    $rowClass = '';
                    if($i%2 == 0)
                        $rowClass = 'alt';

                    echo '<tr class="'.$rowClass.'">
                        <td>'.$regla->CriterioEvaluacion->nombre.'</td>
                        <td><span style="color:'.$regla->CriterioEvaluacion->color.';"><strong>'.$regla->CriterioEvaluacion->color.'</strong></span></td>
                        <td align="center">'.$regla->limite_inf.'</td>
                        <td align="center">'.$regla->limite_sup.'</td>
                    </tr>';
                    $i++;
                }
            ?>
        </tbody>
    </table>
</div>