<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */
/* @var $form CActiveForm */
?>

	<div class="row">
		<?php echo $form->labelEx($model,'definicion'); ?>
		<?php echo $form->textArea($model,'definicion',array('rows'=>6, 'cols'=>50, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'definicion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fundamento'); ?>
		<?php echo $form->textArea($model,'fundamento',array('rows'=>6, 'cols'=>50, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'fundamento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'utilidad'); ?>
		<?php echo $form->textArea($model,'utilidad',array('rows'=>6, 'cols'=>50, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'utilidad'); ?>
	</div>