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
		<?php echo $form->textArea($model,'sentencia_sql',array('rows'=>10, 'cols'=>50, 'class'=>'span11')); ?>
		<?php echo $form->error($model,'sentencia_sql'); ?>
	</div>

    <div class="row buttons">
        <?php  $this->widget('zii.widgets.jui.CJuiButton',array(
            'buttonType'=>'button',
            'name'=>'probar_sentencia_sql',
            'value'=>'1',
            'caption'=>'Probar sentencia SQL',
            'htmlOptions'=>array('id'=>'probar_sentencia_sql')
            )
        ); ?>
	</div>