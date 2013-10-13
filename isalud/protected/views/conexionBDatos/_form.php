<script type="text/javascript">
    $(document).ready(function(){
        $('#probar_conexion').click(function(){
            $.ajax({
                url: '<?php echo Yii::app()->createURL('conexionbdatos/probarconexion'); ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#conexion-bdatos-form').serialize(),
            }).done(function(response) {
                if(response.error) {
                    alert('ERROR: La conexión con la base de datos no fue exitosa, revise el mensaje de error. \n\n'+response.msjerror);
                } else {
                    alert('La prueba de conexión con la base de datos fue exitosa');
                }
            }).fail(function() {
                alert('ERROR: No se pudo realizar la prueba de conexión a la base de datos, intentelo nuevamente o notifiquelo con el administrador del sistema.')
            });
        });
    });
</script>

<?php
/* @var $this ConexionBDatosController */
/* @var $model ConexionBDatos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'conexion-bdatos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'id_motor_bdatos'); ?>
        <?php echo $form->dropDownList($model, 'id_motor_bdatos',
                                    CHtml::listData(MotorBDatos::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_motor_bdatos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'puerto'); ?>
		<?php echo $form->textField($model,'puerto'); ?>
		<?php echo $form->error($model,'puerto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instancia'); ?>
		<?php echo $form->textField($model,'instancia',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'instancia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo $form->textField($model,'usuario',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'base_datos'); ?>
		<?php echo $form->textField($model,'base_datos',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'base_datos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentarios'); ?>
		<?php echo $form->textArea($model,'comentarios',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comentarios'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar'); ?>
		<?php echo CHtml::Button('Probar conexión', array('id'=>'probar_conexion')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->