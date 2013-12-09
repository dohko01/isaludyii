<?php
/* @var $this ConexionBDatosController */
/* @var $data ConexionBDatos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_motor_bdatos')); ?>:</b>
	<?php echo CHtml::encode($data->MotorBDatos->nombre); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('puerto')); ?>:</b>
	<?php echo CHtml::encode($data->puerto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('instancia')); ?>:</b>
	<?php echo CHtml::encode($data->instancia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario')); ?>:</b>
	<?php echo CHtml::encode($data->usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pass')); ?>:</b>
	<?php echo '********';//CHtml::encode($data->pass); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('base_datos')); ?>:</b>
	<?php echo CHtml::encode($data->base_datos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentarios')); ?>:</b>
	<?php echo CHtml::encode($data->comentarios); ?>
	<br />

</div>