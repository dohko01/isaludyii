<?php
/* @var $this EscalaEvaluacionController */
/* @var $model EscalaEvaluacion */
/* @var $form CActiveForm */

Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/tablestyler.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.validate.min.js');

function getTemplateReglaNegocio($index='{0}', $class='{1}', $criteriosEvaluacion, $criterio='', $inf='', $sup='') {
    echo '<tr align="center" class="'.$class.'">
        <td>'.CHtml::dropDownList('EscalaEvaluacion[reglas]['.$index.'][criterio]', $criterio, $criteriosEvaluacion, array('empty'=>'Seleccionar...')).'</td>
        <td>'.CHtml::numberField('EscalaEvaluacion[reglas]['.$index.'][limInf]', $inf, array('size'=>5, 'maxlength'=>5, 'step'=>'0.1', 'min'=>'0', 'style'=>'width:60px;', 'pattern'=>'[0-9]+([\.|,][0-9]+)?')).'</td>
        <td>'.CHtml::numberField('EscalaEvaluacion[reglas]['.$index.'][limSup]', $sup, array('size'=>5, 'maxlength'=>5, 'step'=>'0.1', 'min'=>'0', 'style'=>'width:60px;', 'pattern'=>'[0-9]+([\.|,][0-9]+)?')).'</td>        
        <td>'.CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/delete.png'), '', array('id'=>$criterio, 'onclick'=>'eliminarRegla(this)', 'style'=>'cursor: pointer;')).'</td>
    </tr>';
}
?>

<script type="text/javascript">
    var tmplRegla = '';
    var contReglas = 0;

	function addReglaEvaluacion() {
        cssClass = '';
        
        if(contReglas%2 == 0)
            cssClass = 'alt';

		$(tmplRegla(contReglas++, cssClass)).appendTo("#tableReglasEvaluacion tbody");
	}

    function eliminarRegla(delRegla) {
        $del = $(delRegla);
        id = $($del).attr('id');

        // Si el objeto existe en la base de datos
        if(id) {
            // Agregar el ID del objeto al campo oculto
            // para eliminarlo de la base de datos
            $('#ReglasEliminar').val( $('#ReglasEliminar').val()+','+id  );
        }

        // Eliminar el objeto de la vista
        $del.parent().parent().remove();

        return false;
    }

    $(document).ready(function() {
        tmplRegla = jQuery.validator.format($.trim($("#templateReglaNegocio").val()));

        contReglas = parseInt($('#maxIdCriEva').val()) + 1;

        addReglaEvaluacion();
    });
</script>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'escala-evaluacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php 
        echo $form->errorSummary($model);
        if(!empty($msjError)) echo '<div class="errorSummary">'.$msjError.'</div>';
    ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

    <textarea id="templateReglaNegocio" style="display: none">
        <?php getTemplateReglaNegocio('{0}', '{1}', $criteriosEvaluacion); ?>
    </textarea>

    <?php echo CHtml::hiddenField('ReglasEliminar'); ?>

    <h5>Reglas de evaluación</h5>
    <div class="datagrid">
        <table id="tableReglasEvaluacion">
            <thead>
                <tr align="center">
                    <th>Criterio de evaluación</th>
                    <th>Limite Inferior</th>
                    <th>Limite Superior</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $maxIdCriEva = 0;
                    if(isset($model->CriteriosEscalaEvaluacion)) {
                        $i = 0;    
                        foreach ($model->CriteriosEscalaEvaluacion as $id => $regla) {
                            $rowClass = '';
                            if($i%2 == 0)
                                $rowClass = 'alt';

                            getTemplateReglaNegocio(
                                    $regla->id_cat_criterio_evaluacion,
                                    $rowClass,
                                    $criteriosEvaluacion,
                                    $regla->id_cat_criterio_evaluacion,
                                    $regla->limite_inf,
                                    $regla->limite_sup);
                            $i++;
                            $maxIdCriEva = $regla->id_cat_criterio_evaluacion;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <br />

    <?php
    echo CHtml::hiddenField('maxIdCriEva', $maxIdCriEva);

    $this->widget('zii.widgets.jui.CJuiButton',array(
        'buttonType'=>'button',
        'name'=>'btnAgregaRegla',
        'onclick'=>'addReglaEvaluacion',
        'value'=>'1',
        'caption'=>'Agregar nueva regla de evaluación',
        )
    );
    ?>
    <br /><br />
	<div class="row buttons">
		<?php
        $this->widget('zii.widgets.jui.CJuiButton',array(
            'buttonType'=>'submit',
            'name'=>'btnEnviarForm',
            'value'=>'1',
            'caption'=>$model->isNewRecord ? 'Guardar' : 'Actualizar',
            )
        );
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->