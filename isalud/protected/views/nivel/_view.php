<?php
/* @var $this NivelController */
/* @var $data Nivel */
?>

<div class="view">
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
	<br />


</div>