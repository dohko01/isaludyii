<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ficha-tecnica-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_tipo_indicador'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_tipo_indicador',
                                    CHtml::listData(TipoIndicador::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_cat_tipo_indicador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_clasificacion'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_clasificacion',
                                    CHtml::listData(Clasificacion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_cat_clasificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_escala_evaluacion'); ?>
        <?php echo $form->dropDownList($model, 'id_escala_evaluacion',
                                    CHtml::listData(EscalaEvaluacion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_escala_evaluacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_periodicidad'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_periodicidad',
                                    CHtml::listData(Periodicidad::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_cat_periodicidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_ficha_tecnica_padre'); ?>
        <?php echo $form->dropDownList($model, 'id_ficha_tecnica_padre',
                                    CHtml::listData(FichaTecnica::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_ficha_tecnica_padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_direccion'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_direccion',
                                    CHtml::listData(Direccion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_cat_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_subdireccion'); ?>
		<?php echo $form->textField($model,'id_cat_subdireccion'); ?>
		<?php echo $form->error($model,'id_cat_subdireccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_coordinacion'); ?>
		<?php echo $form->textField($model,'id_cat_coordinacion'); ?>
		<?php echo $form->error($model,'id_cat_coordinacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_programa_accion'); ?>
		<?php echo $form->textField($model,'id_cat_programa_accion'); ?>
		<?php echo $form->error($model,'id_cat_programa_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_nivel'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_nivel',
                                    CHtml::listData(Nivel::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..') ); ?>
		<?php echo $form->error($model,'id_cat_nivel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'formula'); ?>
		<?php echo $form->textField($model,'formula',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'formula'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ponderacion'); ?>
		<?php echo $form->textField($model,'ponderacion'); ?>
		<?php echo $form->error($model,'ponderacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unidad_medida'); ?>
		<?php echo $form->textField($model,'unidad_medida',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'unidad_medida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta'); ?>
		<?php echo $form->textField($model,'meta',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'meta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'definicion'); ?>
		<?php echo $form->textArea($model,'definicion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'definicion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fundamento'); ?>
		<?php echo $form->textArea($model,'fundamento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fundamento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'utilidad'); ?>
		<?php echo $form->textArea($model,'utilidad',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'utilidad'); ?>
	</div>

	<div class="row buttons">
		<?php 
        $this->widget('zii.widgets.jui.CJuiButton',array(
            'buttonType'=>'submit',
            'name'=>'btnEnviarForm',
            'value'=>'1',
            'caption'=>($model->isNewRecord ? 'Guardar' : 'Actualizar'),
            )
        );
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->