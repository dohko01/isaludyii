<script type="text/javascript">
    $(document).ready(function(){
        $('#configurar-campos-form').submit(function(){
            resultado = true

            $(this).find('select').each(function(){
                if( $(this).val() == '') {
                    alert('ERROR: Debe configurar el tipo y significado para todos los campos');
                    resultado = false;
                    return resultado;
                }
            });
            
            return resultado;
        });
    });
</script>

<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Configurar campos',
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
	array('label'=>'Ver '.$this->title_sin, 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Configurar campos de la <?php echo $this->title_sin.' '.$model->nombre; ?></h1>

<?php
    if(!empty($msgResult))
        echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>'.$msgResult.'</strong>
            </div>';

    if(!empty($msjError))
        echo '<div class="errorSummary">'.$msjError.'</div>';

    echo CHtml::beginForm($model->id, 'POST', array('id'=>'configurar-campos-form'));
?>

<table border="1" cellpadding="8" cellspacing="1">
    <thead>
        <tr>
            <th>Campo</th>
            <th>Tipo</th>
            <th>Significado</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($campos as $campo) {
                echo '<tr>
                    <td>'.$campo->nombre.'</td>
                    <td>'.CHtml::dropDownList('Campo['.$campo->id.'][tipo]', $campo->id_tipo_campo, $tipoCampo, array('empty'=>'Seleccionar..')).'</td>
                    <td>'.CHtml::dropDownList('Campo['.$campo->id.'][significado]', $campo->id_significado_campo, $significadoCampo, array('empty'=>'Seleccionar..')).'</td>
                </tr>';
            }
        ?>
    </tbody>
</table><br />

<?php
    $this->widget('zii.widgets.jui.CJuiButton',array(
        'buttonType'=>'submit',
        'name'=>'btnGuardar',
        'value'=>'1',
        'caption'=>'Guardar configuraciones',
        )
    );
    echo CHtml::endForm($model->id);
?>