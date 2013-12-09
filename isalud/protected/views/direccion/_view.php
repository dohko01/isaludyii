<?php
/* @var $this DireccionController */
/* @var $data Direccion */
?>

<div class="view">
<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
*/ ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_institucion')); ?>:</b>
	<?php echo CHtml::encode(($data->idCatInstitucion!=null) ? $data->idCatInstitucion->nombre : null); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo  CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); //CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable')); ?>:</b>
	<?php echo CHtml::encode($data->responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />


</div>