<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */
/* @var $form CActiveForm */
?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_direccion'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_direccion',
                                    CHtml::listData(Direccion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7')  ); ?>
		<?php echo $form->error($model,'id_cat_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_subdireccion'); ?>
		<?php echo $form->textField($model,'id_cat_subdireccion'); ?>
		<?php echo $form->error($model,'id_cat_subdireccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_coordinacion'); ?>
		<?php echo $form->textField($model,'id_cat_coordinacion'); ?>
		<?php echo $form->error($model,'id_cat_coordinacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_programa_accion'); ?>
		<?php echo $form->textField($model,'id_cat_programa_accion'); ?>
		<?php echo $form->error($model,'id_cat_programa_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>15,'maxlength'=>15, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>
