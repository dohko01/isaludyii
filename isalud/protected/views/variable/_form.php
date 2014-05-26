<script type="text/javascript">
    $(document).ready(function(){
        $('#Variable_id_fuente_datos').change(function(){
            id = $(this).val() ? $(this).val() : 0;
            $.ajax({
                url: '<?php echo Yii::app()->createURL('fuentedatos/obtenercampos/'); ?>/'+id,
                type: 'POST',
                dataType: 'json',
                data: 'YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            }).done(function(response) {
                if(!response || response.length == 0) {
                    $('#Variable_id_campo > :not(option[value=""])').remove();
                    
                    showAdvertencia('No se encontraron campos configurados con el significado "Campo para formula", esto quiere decir que no estan bien configurados o todos los disponibles ya están asociados a una variable, revise la lista de variables creadas con origen en la fuente de datos seleccionada.');
                    
                    return false;
                }
                if(response.error) {
                    showError('ERROR: '+response.msjerror);
                } else {
                    $('#Variable_id_campo > :not(option[value=""])').remove();

                    $.each(response, function(id, nombre) {
                        option = $('<option />');
                        option.val(id);
                        option.text(nombre);
                        $('#Variable_id_campo').append(option);
                    });
                }
            }).fail(function() {
                showError('ERROR: No se pudo realizar la consulta de los campos de la fuente de datos, intentelo nuevamente o notifiquelo con el administrador del sistema.');
            });
        });
    });
</script>

<?php
/* @var $this VariableController */
/* @var $model Variable */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'variable-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_fuente_datos'); ?>
        <?php echo $form->dropDownList($model, 'id_fuente_datos',
                                    CHtml::listData(FuenteDatos::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_fuente_datos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_campo'); ?>
		<?php
        $campos = array();
        if($model->id_campo)
             $campos = CHtml::listData($model->FuenteDatos->Campos, 'id', 'nombre');

        echo $form->dropDownList($model, 'id_campo',
                                    $campos,
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_campo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('maxlength'=>100, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ini_formula'); ?>
		<?php echo $form->textField($model,'ini_formula',array('maxlength'=>45, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'ini_formula'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row buttons">
		<?php 
        $this->widget('zii.widgets.jui.CJuiButton',array(
            'buttonType'=>'submit',
            'name'=>'btnEnviarForm',
            'value'=>'1',
            'caption'=>($model->isNewRecord ? 'Guardar' : 'Actualizar'),
            )
        );
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->