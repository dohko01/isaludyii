<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'usuario-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    
    <input type="hidden" name="YII_CSRF_TOKEN" id="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />

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
			if($model->id_cat_jurisdiccion)
				 $list = CHtml::listData(Jurisdiccion::model()->findAll(), 'id_jurisdiccion', 'numNombre');
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
			if($model->id_cat_direccion)
				 $list = CHtml::listData(Direccion::model()->findAll(), 'id', 'nombre');
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
							'update' => '#Usuario_id_cat_coordinacion',
							)
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
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->checkBox($model,'activo',array('checked'=>'checked')); ?>
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