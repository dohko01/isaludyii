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

	<?php
        echo $form->errorSummary($model);
        
        if(!empty($msjError)) echo '<div class="errorSummary">'.$msjError.'</div>';

        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                'Datos Generales'=>array(
                    'content'=>$this->renderPartial('_form_datosgenerales', array('form'=>$form,'model'=>$model), true),
                    'id'=>'DatosGenerales'
                ),
                'Asignaciones'=>array(
                    'content'=>$this->renderPartial('_form_asignaciones', array('form'=>$form,'model'=>$model), true),
                    'id'=>'Asignaciones'
                ),
                'Descripciones'=>array(
                    'content'=>$this->renderPartial('_form_descripciones', array('form'=>$form,'model'=>$model), true),
                    'id'=>'Descripciones'
                ),
            ),
        ));
    ?>

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