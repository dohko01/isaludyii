<?php
/* @var $this InstitucionController */
/* @var $model Institucion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion_corta'); ?>
		<?php echo $form->textField($model,'descripcion_corta',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion_clues'); ?>
		<?php echo $form->textField($model,'descripcion_clues',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php 
        $this->widget('zii.widgets.jui.CJuiButton',array(
            'buttonType'=>'submit',
            'name'=>'btnBuscar',
            'value'=>'1',
            'caption'=>'Buscar',
            )
        );
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->