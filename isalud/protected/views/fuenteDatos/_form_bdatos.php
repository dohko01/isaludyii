<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */
/* @var $form CActiveForm */
?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_conexion_bdatos'); ?>
		<?php echo $form->dropDownList($model, 'id_conexion_bdatos',
                                    CHtml::listData(ConexionBDatos::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_conexion_bdatos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sentencia_sql'); ?>
		<?php echo $form->textArea($model,'sentencia_sql',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sentencia_sql'); ?>
	</div>
