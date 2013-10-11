<?php
/* @var $this SignificadoCampoController */
/* @var $data SignificadoCampo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->descripcion), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catalogo')); ?>:</b>
	<?php echo CHtml::encode($data->catalogo); ?>
	<br />


</div>