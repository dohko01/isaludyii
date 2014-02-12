<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Inicio de Sesión';
$this->breadcrumbs=array(
	'Iniciar Sesión',
);
?>
<!--div class="page-header">
	<h1>Acceso restringido</h1>
</div-->
<div class="row-fluid">
    <table align="center" cellpadding="10px">
        <tr>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl;?>/images/logo.png" width="210"><br>
                <img src="<?php echo Yii::app()->request->baseUrl;?>/images/saludesta.png" width="210">                
            </td>
            <td>
                <div class="span4 offset3">
            <?php
                    $this->beginWidget('zii.widgets.CPortlet', array(
                            'title'=>"Iniciar Sesión",
                    ));

            ?>
                <div class="form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>

                    <div class="row">
                        <?php echo $form->labelEx($model,'username'); ?>
                        <?php echo $form->textField($model,'username', array('autofocus'=>'autofocus')); ?>
                        <?php echo $form->error($model,'username'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model,'password'); ?>
                        <?php echo $form->passwordField($model,'password'); ?>
                        <?php echo $form->error($model,'password'); ?>
                    </div>

                    <div class="row rememberMe">
                        <?php echo $form->checkBox($model,'rememberMe'); ?>
                        <?php echo $form->label($model,'rememberMe'); ?>
                        <?php echo $form->error($model,'rememberMe'); ?>
                    </div>

                    <div class="row buttons">
                        <?php echo CHtml::submitButton('Aceptar',array('class'=>'btn btn btn-primary')); ?>
                    </div>

                <?php $this->endWidget(); ?>
                </div><!-- form -->

            <?php $this->endWidget();?>

                </div>
            </td>
        </tr>
    </table>

</div>