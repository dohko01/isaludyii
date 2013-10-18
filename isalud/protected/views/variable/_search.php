<?php
/* @var $this VariableController */
/* @var $model Variable */
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
		<?php echo $form->label($model,'id_fuente_datos'); ?>
		 <?php echo $form->dropDownList($model, 'id_fuente_datos',
                                    CHtml::listData(FuenteDatos::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ini_formula'); ?>
		<?php echo $form->textField($model,'ini_formula',array('size'=>45,'maxlength'=>45)); ?>
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