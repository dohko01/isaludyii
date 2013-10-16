<?php
/* @var $this ModuloController */
/* @var $data Modulo */
?>

<div class="view">

	<!--b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br /-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tipo Usuario')); ?>:</b>
	<?php echo CHtml::encode(($data->idCatTipoUsuario!=null) ? $data->idCatTipoUsuario->nombre : null); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php $activo = "No"; if($data->activo) $activo = "Si"; ?>
	<?php echo CHtml::encode($activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php $record = Modulo::model()->findByAttributes(array("id"=>$data->parent_id));?>
	<?php if(count($record) > 0) $nombre = $record->nombre; else $nombre = NULL;?>
	<?php echo CHtml::encode($nombre); ?>
	<br />


</div>