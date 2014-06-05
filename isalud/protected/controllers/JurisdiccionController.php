<?php

class JurisdiccionController extends Controller
{
	public function actionGetJurisdicciones()
	{
		$datosPost = array();
		foreach($_POST as $key => $value)
		{
			$datosPost[] = $value;
		}
		
		$data = Jurisdiccion::model()->findAll('"id_estado"=:id_estado',
												array(':id_estado'=>(int)$datosPost[1]['id_cat_estado'])
												);
		$data = CHtml::listData($data,'id_jurisdiccion','numNombre');
		
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