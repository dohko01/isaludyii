<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">
<?php
/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_estado')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_jurisdiccion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_jurisdiccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_subdireccion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_subdireccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_coordinacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_coordinacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_tipo_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_tipo_usuario); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_institucion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_institucion); ?>
	<br />
*/?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />
<?php
/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pass')); ?>:</b>
	<?php echo CHtml::encode($data->pass); ?>
	<br />
*/?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode(($data->activo) ? "Si":"No"); ?>
	<br />

</div>