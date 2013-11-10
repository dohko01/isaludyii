<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */
/* @var $form CActiveForm */
?>

    <div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'id_cat_periodicidad'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_periodicidad',
                                    CHtml::listData(Periodicidad::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_cat_periodicidad'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'es_actualizacion_incremental'); ?>
		<?php echo $form->checkBox($model, 'es_actualizacion_incremental', array('value'=>1, 'uncheckValue'=>0)); ?>
		<?php echo $form->error($model,'es_actualizacion_incremental'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'tolerancia_actualizacion'); ?>
		<?php echo $form->numberField($model,'tolerancia_actualizacion', array('class'=>'span7', 'min'=>'0', 'max'=>'29')); ?>
		<?php echo $form->error($model,'tolerancia_actualizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'responsable'); ?>
		<?php echo $form->textField($model,'responsable',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'responsable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
