<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */
/* @var $form CActiveForm */
?>

	<div class="row">
		<?php echo $form->labelEx($model,'archivo'); ?>
        <?php echo CHtml::telField('archivoActual', $model->archivo, array('size'=>45, 'readonly'=>'true','title'=>'Archivo asociado a la fuente de datos')); ?>
		<?php echo $form->fileField($model,'archivo',array('size'=>45)); ?>
		<?php echo $form->error($model,'archivo'); ?>
	</div>
