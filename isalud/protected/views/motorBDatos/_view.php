<?php
/* @var $this MotorBDatosController */
/* @var $data MotorBDatos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver')); ?>:</b>
	<?php echo CHtml::encode($data->driver); ?>
	<br />


</div>