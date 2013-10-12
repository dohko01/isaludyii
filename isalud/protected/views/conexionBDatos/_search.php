<?php
/* @var $this ConexionBDatosController */
/* @var $model ConexionBDatos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_motor_bdatos'); ?>
        <?php echo $form->dropDownList($model, 'id_motor_bdatos',
                                    CHtml::listData(MotorBDatos::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'puerto'); ?>
		<?php echo $form->textField($model,'puerto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'instancia'); ?>
		<?php echo $form->textField($model,'instancia',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario'); ?>
		<?php echo $form->textField($model,'usuario',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'base_datos'); ?>
		<?php echo $form->textField($model,'base_datos',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comentarios'); ?>
		<?php echo $form->textArea($model,'comentarios',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->