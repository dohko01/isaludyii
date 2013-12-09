<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_cat_estado'); ?>
		<?php echo $form->textField($model,'id_cat_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_jurisdiccion'); ?>
		<?php echo $form->textField($model,'id_cat_jurisdiccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_direccion'); ?>
		<?php echo $form->textField($model,'id_cat_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_subdireccion'); ?>
		<?php echo $form->textField($model,'id_cat_subdireccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_coordinacion'); ?>
		<?php echo $form->textField($model,'id_cat_coordinacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_tipo_usuario'); ?>
		<?php echo $form->textField($model,'id_cat_tipo_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_institucion'); ?>
		<?php echo $form->textField($model,'id_cat_institucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->checkBox($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->