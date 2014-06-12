<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */
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
		<?php echo $form->label($model,'id_cat_periodicidad'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_periodicidad',
                                    CHtml::listData(Periodicidad::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsable'); ?>
		<?php echo $form->textField($model,'responsable',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_conexion_bdatos'); ?>
		<?php echo $form->dropDownList($model, 'id_conexion_bdatos',
                                    CHtml::listData(ConexionBDatos::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ultima_lectura'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name'=>'ultima_lectura',
                            'model'=>$model,
                            'language' => 'es',
                            'options'=>array(
                                'dateFormat'=>'yy-mm-dd',
                            ),
                        )); ?>
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