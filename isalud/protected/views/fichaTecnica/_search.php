<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_tipo_indicador'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_tipo_indicador',
                                    CHtml::listData(TipoIndicador::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_clasificacion'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_clasificacion',
                                    CHtml::listData(Clasificacion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_periodicidad'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_periodicidad',
                                    CHtml::listData(Periodicidad::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_ficha_tecnica_padre'); ?>
		<?php echo $form->dropDownList($model, 'id_ficha_tecnica_padre',
                                    CHtml::listData(FichaTecnica::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_direccion'); ?>
		 <?php echo $form->dropDownList($model, 'id_cat_direccion',
                                    CHtml::listData(Direccion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cat_nivel'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_nivel',
                                    CHtml::listData(Nivel::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
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