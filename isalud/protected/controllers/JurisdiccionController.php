<?php

class JurisdiccionController extends Controller
{
	public function actionGetJurisdicciones()
	{
		$data = Jurisdiccion::model()->findAll('"id_estado"=:id_estado',
												array(':id_estado'=>(int)$_POST['Usuario']['id_cat_estado'])
												);
		$data = CHtml::listData($data,'id_jurisdiccion','nombre');
		
		echo CHtml::tag('option', array('value'=>'empty'),CHtml::encode('Seleccionar'),true);
		foreach($data as $value => $name)
		{
			echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}