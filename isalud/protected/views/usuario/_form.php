<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
    	<?php $list = CHtml::listData(Estado::model()->findAll(), 'id_estado', 'nombre'); ?>
		<?php echo $form->labelEx($model,'id_cat_estado'); ?>
		<?php echo $form->dropDownList($model,'id_cat_estado',$list,
				array(
					'empty'=>'Seleccionar...',
					'ajax' => array(
							'type' => 'POST',
							'url' => CController::createUrl('Jurisdiccion/getJurisdicciones'),
							'update' => '#Usuario_id_cat_jurisdiccion',
							)
				)
		); ?>
		<?php echo $form->error($model,'id_cat_estado'); ?>
	</div>

	<div class="row">
    	<?php
			$list = array();
			if($model->id_cat_estado)
				 $list = CHtml::listData(Jurisdiccion::model()->findAll(array('condition'=>'id_estado = '.$model->id_cat_estado)), 'id_jurisdiccion', 'numNombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_jurisdiccion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_jurisdiccion',$list,array('empty'=>'Seleccionar...')); ?>
		<?php echo $form->error($model,'id_cat_jurisdiccion'); ?>
	</div>
    
    <div class="row">
    	<?php $list = CHtml::listData(Institucion::model()->findAll(), 'id_institucion', 'nombre'); ?>
		<?php echo $form->labelEx($model,'id_cat_institucion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_institucion',$list,
				array(
					'empty'=>'Seleccionar...',
					'ajax' => array(
							'type' => 'POST',
							'url' => CController::createUrl('Direccion/getDirecciones'),
							'update' => '#Usuario_id_cat_direccion',
							)
				)); ?>
		<?php echo $form->error($model,'id_cat_institucion'); ?>
	</div>
    
	<div class="row">
    	<?php
			$list = array();
			if($model->id_cat_institucion)
				 $list = CHtml::listData(Direccion::model()->findAll(array('condition'=>'id_cat_institucion = '.$model->id_cat_institucion)), 'id', 'nombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_direccion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_direccion',$list,
				array(
					'empty'=>'Seleccionar...',
					'ajax' => array(
							'type' => 'POST',
							'url' => CController::createUrl('Subdireccion/getSubDirecciones'),
							'update' => '#Usuario_id_cat_subdireccion',
							)
				)); ?>
		<?php echo $form->error($model,'id_cat_direccion'); ?>
	</div>

	<div class="row">
    	<?php
			$list = array();
			if($model->id_cat_direccion)
				 $list = CHtml::listData(Subdireccion::model()->findAll(array('condition'=>'id_cat_direccion = '.$model->id_cat_direccion)), 'id', 'nombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_subdireccion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_subdireccion',$list,
				array(
					'empty'=>'Seleccionar...',
					'ajax' => array(
							'type' => 'POST',
							'url' => CController::createUrl('Coordinacion/getCoordinaciones'),
							'update' => '#Usuario_id_cat_coordinacion',
							)
				)); ?>
		<?php echo $form->error($model,'id_cat_subdireccion'); ?>
	</div>

	<div class="row">
    	<?php
			$list = array();
			if($model->id_cat_subdireccion)
				 $list = CHtml::listData(Coordinacion::model()->findAll(array('condition'=>'id_cat_direccion = '.$model->id_cat_direccion)), 'id', 'nombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_coordinacion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_coordinacion',$list,array('empty'=>'Seleccionar...')); ?>
		<?php echo $form->error($model,'id_cat_coordinacion'); ?>
	</div>

	<div class="row">
		<?php $list = CHtml::listData(TipoUsuario::model()->findAll(), 'id', 'nombre'); ?>
		<?php echo $form->labelEx($model,'id_cat_tipo_usuario'); ?>
		<?php echo $form->dropDownList($model,'id_cat_tipo_usuario', $list, array('empty'=>'Seleccionar...') ); ?>
		<?php echo $form->error($model,'id_cat_tipo_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->checkBox($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
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