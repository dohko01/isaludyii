<?php
/* @var $this VariableController */
/* @var $data Variable */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_fuente_datos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FuenteDatos->nombre), array('fuentedatos/view', 'id'=>$data->FuenteDatos->id));?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_campo')); ?>:</b>
	<?php echo CHtml::encode($data->Campo->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ini_formula')); ?>:</b>
	<?php echo CHtml::encode($data->ini_formula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />

</div>