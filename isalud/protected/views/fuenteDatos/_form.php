<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fuente-datos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php
        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                'Datos Generales'=>array(
                    'content'=>$this->renderPartial('_form_datosgenerales', array('form'=>$form,'model'=>$model), true)
                ),
                'Base de Datos'=>array(
                    'content'=>$this->renderPartial('_form_bdatos', array('form'=>$form,'model'=>$model), true)
                ),
                'Archivo'=>array(
                    'content'=>$this->renderPartial('_form_archivo', array('form'=>$form,'model'=>$model), true)
                ),
            ),
        ));
    ?>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->