<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */
/* @var $form CActiveForm */
?>

	<div class="row">
    	<?php 
			$list = CHtml::listData(Direccion::model()->findAll('"id_cat_institucion"=:id_institucion',
												array(':id_institucion'=>(int)Yii::app()->user->id_cat_institucion)), 'id', 'nombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_direccion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_direccion',$list,
				array(
					'empty'=>'Seleccionar...',
					'ajax' => array(
							'type' => 'POST',
							'url' => CController::createUrl('Subdireccion/getSubDirecciones'),
							'update' => '#FichaTecnica_id_cat_subdireccion',
							),
					'class'=>'span7',
				)); ?>
		<?php echo $form->error($model,'id_cat_direccion'); ?>
	</div>

	<div class="row">
    	<?php
			$list = array();
			if($model->id_cat_subdireccion)
				 $list = CHtml::listData(Subdireccion::model()->findAll(), 'id', 'nombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_subdireccion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_subdireccion',$list,
				array(
					'empty'=>'Seleccionar...',
					'ajax' => array(
							'type' => 'POST',
							'url' => CController::createUrl('Coordinacion/getCoordinaciones'),
							'update' => '#FichaTecnica_id_cat_coordinacion',
							),
					'class'=>'span7',
				)); ?>
		<?php echo $form->error($model,'id_cat_subdireccion'); ?>
	</div>

	<div class="row">
    	<?php
			$list = array();
			if($model->id_cat_coordinacion)
				 $list = CHtml::listData(Coordinacion::model()->findAll(), 'id', 'nombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_coordinacion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_coordinacion',$list,
				array(
					'empty'=>'Seleccionar...',
					'ajax' => array(
							'type' => 'POST',
							'url' => CController::createUrl('ProgramaAccion/getProgramaAccion'),
							'update' => '#FichaTecnica_id_cat_programa_accion',
							),
                    'class'=>'span7',
				)); ?>
		<?php echo $form->error($model,'id_cat_coordinacion'); ?>
	</div>

	<div class="row">
    	<?php
			$list = array();
			if($model->id_cat_programa_accion)
				 $list = CHtml::listData(ProgramaAccion::model()->findAll(), 'id', 'nombre');
		?>
		<?php echo $form->labelEx($model,'id_cat_programa_accion'); ?>
		<?php echo $form->dropDownList($model,'id_cat_programa_accion',$list,array('empty'=>'Seleccionar...','class'=>'span7',)); ?>
		<?php echo $form->error($model,'id_cat_programa_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>15,'maxlength'=>15, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>
