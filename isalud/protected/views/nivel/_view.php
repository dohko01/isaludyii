<?php
/* @var $this NivelController */
/* @var $data Nivel */
?>

<div class="view">
<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
*/?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />


</div>