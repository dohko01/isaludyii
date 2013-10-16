<?php
/* @var $this InstitucionController */
/* @var $data Institucion */
?>

<div class="view">
<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
*/?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_corta')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_corta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_clues')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_clues); ?>
	<br />


</div>