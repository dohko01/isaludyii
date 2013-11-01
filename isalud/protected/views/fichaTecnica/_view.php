<?php
/* @var $this FichaTecnicaController */
/* @var $data FichaTecnica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_tipo_indicador')); ?>:</b>
	<?php echo CHtml::encode($data->TipoIndicador->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_clasificacion')); ?>:</b>
	<?php echo CHtml::encode($data->Clasificacion->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_periodicidad')); ?>:</b>
	<?php echo CHtml::encode($data->Periodicidad->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ficha_tecnica_padre')); ?>:</b>
	<?php echo $data->FichaTecnicaPadre ? CHtml::link(CHtml::encode($data->FichaTecnicaPadre->nombre), array('fichatecnica/view', 'id'=>$data->FichaTecnicaPadre->id)) : ''; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->Direccion->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_nivel')); ?>:</b>
	<?php echo CHtml::encode($data->Nivel->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formula')); ?>:</b>
	<?php echo CHtml::encode($data->formula); ?>
	<br />

	<?php /*


    <b><?php echo CHtml::encode($data->getAttributeLabel('id_escala_evaluacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_escala_evaluacion); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_subdireccion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_subdireccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_coordinacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_coordinacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat_programa_accion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cat_programa_accion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ponderacion')); ?>:</b>
	<?php echo CHtml::encode($data->ponderacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidad_medida')); ?>:</b>
	<?php echo CHtml::encode($data->unidad_medida); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta')); ?>:</b>
	<?php echo CHtml::encode($data->meta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('definicion')); ?>:</b>
	<?php echo CHtml::encode($data->definicion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fundamento')); ?>:</b>
	<?php echo CHtml::encode($data->fundamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utilidad')); ?>:</b>
	<?php echo CHtml::encode($data->utilidad); ?>
	<br />

	*/ ?>

</div>