<?php
/* @var $this ModuloController */
/* @var $model Modulo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
        <?php $list = CHtml::listData(TipoUsuario::model()->findAll(), 'id', 'nombre'); ?>
        <?php echo $form->label($model,'id_cat_tipo_usuario'); ?>
		<?php echo $form->dropDownList($model,'id_cat_tipo_usuario', $list, array('empty'=>'Seleccionar...') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->checkBox($model,'activo'); ?>
	</div>

	<div class="row">
        <?php $list = CHtml::listData(Modulo::model()->findAll(), 'id', 'nombre'); ?>
		<?php echo $form->label($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id', $list, array('empty'=>'Seleccionar..')); ?>
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