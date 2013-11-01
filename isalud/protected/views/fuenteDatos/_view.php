<?php
/* @var $this FuenteDatosController */
/* @var $data FuenteDatos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_periodicidad')); ?>:</b>
	<?php echo CHtml::encode($data->Periodicidad->nombre); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('es_actualizacion_incremental')); ?>:</b>
	<?php echo CHtml::encode($data->es_actualizacion_incremental ? 'Si' : 'No'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable')); ?>:</b>
	<?php echo CHtml::encode($data->responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_conexion_bdatos')); ?>:</b>
	<?php if($data->ConexionBDatos) echo CHtml::link(CHtml::encode($data->ConexionBDatos->nombre), array('conexionbdatos/view', 'id'=>$data->ConexionBDatos->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archivo')); ?>:</b>
	<?php echo CHtml::encode($data->archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ultima_lectura')); ?>:</b>
	<?php echo CHtml::encode($data->ultima_lectura); ?>
	<br />

</div>