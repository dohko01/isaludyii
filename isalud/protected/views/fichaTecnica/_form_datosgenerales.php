<?php
/* @var $this FichaTecnicaController */
/* @var $model FichaTecnica */
/* @var $form CActiveForm */
?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_tipo_indicador'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_tipo_indicador',
                                    CHtml::listData(TipoIndicador::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_cat_tipo_indicador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_clasificacion'); ?>
		<?php echo $form->dropDownList($model, 'id_cat_clasificacion',
                                    CHtml::listData(Clasificacion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_cat_clasificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_escala_evaluacion'); ?>
        <?php echo $form->dropDownList($model, 'id_escala_evaluacion',
                                    CHtml::listData(EscalaEvaluacion::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_escala_evaluacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_periodicidad'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_periodicidad',
                                    CHtml::listData(Periodicidad::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_cat_periodicidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_ficha_tecnica_padre'); ?>
        <?php echo $form->dropDownList($model, 'id_ficha_tecnica_padre',
                                    CHtml::listData(FichaTecnica::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_ficha_tecnica_padre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cat_nivel'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_nivel',
                                    CHtml::listData(Nivel::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_cat_nivel'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'Variables'); ?>
		<?php
        $data = CHtml::listData(Variable::model()->findAll(), 'id', 'FullName');
        $options = array(
            'model' => $model,
            'dropDownAttribute' => 'Variables',
            'data'=>$data,
            'dropDownHtmlOptions'=> array(
                'id'=>'selectVariables',
                'class'=>'span5'
            ),
            'options' => array(
                'header'=> 'Elije las variables a utilizar en la formula',
                //'minWidth'=>550,
                'filter'=>true,
                'noneSelectedText'=>'Seleccionar...',
                'selectedText'=> 'js:function(numChecked, numTotal, checkedItems){
                    variablesFormula = [];

                    $.each(checkedItems, function(index,item){
                        iniFormula = $(this).next().html().split(\' \');
                        // Obtiene solo la parte que esta entre parentesis
                        // variablesFormula.push(iniFormula[iniFormula.length-1].replace(/[(|)]/g, \'\'));
                        variablesFormula.push(iniFormula[iniFormula.length-1]);
                    });
                    // Concatena todas las variables con una coma (,)
                    strVariablesFormula = variablesFormula.join(\', \');
                    // Solo ejecutar en al crear
                    if(\'create\' == \''.Yii::app()->controller->action->id.'\') {
                        $(\'#FichaTecnica_formula\').val(variablesFormula.join(\' \'));
                    }

                    $(\'#variablesSeleccionadas\').val(strVariablesFormula);

                    return strVariablesFormula;
                 }',
            ),
            'filterOptions'=> array(
                'width'=>150,
                'label' => 'Buscar',
                'placeholder'=>'',
            ),
        );

        if(!empty($_POST['FichaTecnica']) && isset($_POST['FichaTecnica']['Variables'])) {
            $options['value'] = $_POST['FichaTecnica']['Variables'];
        }

        $this->widget('ext.EchMultiSelect.EchMultiSelect', $options);
        echo $form->error($model,'Variables');
        echo CHtml::hiddenField('variablesSeleccionadas');
        ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'formula'); ?>
		<?php echo $form->textField($model,'formula',array('size'=>60,'maxlength'=>200, 'class'=>'span7')); ?>
        <?php echo CHtml::tag('div', array(), 'Ejemplo: [numerador] / [denominador] * 100'); ?>
		<?php echo $form->error($model,'formula'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'es_acumulable'); ?>
		<?php echo $form->checkBox($model, 'es_acumulable', array('value'=>1, 'uncheckValue'=>0)); ?>
		<?php echo $form->error($model,'es_acumulable'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'es_publico'); ?>
		<?php echo $form->checkBox($model, 'es_publico', array('value'=>1, 'uncheckValue'=>0)); ?>
		<?php echo $form->error($model,'es_publico'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'id_cat_tipo_grafico'); ?>
        <?php echo $form->dropDownList($model, 'id_cat_tipo_grafico',
                                    CHtml::listData(TipoGrafico::model()->findAll(), 'id', 'nombre'),
                                    array('empty'=>'Seleccionar..', 'class'=>'span7') ); ?>
		<?php echo $form->error($model,'id_cat_tipo_grafico'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ponderacion'); ?>
		<?php echo $form->numberField($model,'ponderacion', array('class'=>'span7', 'min'=>'0', 'max'=>'100')); ?>
		<?php echo $form->error($model,'ponderacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unidad_medida'); ?>
		<?php echo $form->textField($model,'unidad_medida',array('size'=>20,'maxlength'=>20, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'unidad_medida'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta'); ?>
		<?php echo $form->textField($model,'meta',array('size'=>20,'maxlength'=>20, 'class'=>'span7')); ?>
		<?php echo $form->error($model,'meta'); ?>
	</div>
