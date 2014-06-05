<?php
/* @var $this ProgramaAccionController */
/* @var $data ProgramaAccion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_coordinacion')); ?>:</b>
	<?php echo CHtml::encode(($data->idCatCoordinacion!=null) ? $data->idCatCoordinacion->nombre : null); ?>
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