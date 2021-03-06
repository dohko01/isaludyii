<?php
/* @var $this SubdireccionController */
/* @var $data Subdireccion */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_direccion')); ?>:</b>
	<?php echo CHtml::encode(($data->idCatDireccion!=null) ? $data->idCatDireccion->nombre : null); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable')); ?>:</b>
	<?php echo CHtml::encode($data->responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />


</div>