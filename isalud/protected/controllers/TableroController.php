<?php

class TableroController extends Controller
{
	public function actionIndex()
	{
		$this->render('view');
	}

    public function actionView($id)
	{
        $respuesta = null;
        try {
            $modelFicha = FichaTecnica::model()->findByPk($id);

            $respuesta = $modelFicha->crearIndicador();
            if($respuesta['error']) throw new Exception;

            $dimension = 'id_municipio';
            $filtro = array('id_estado'=>7, 'anio'=>2013);
            $orden = 'indicador';

            $respuesta = $modelFicha->calcularIndicador($dimension, $filtro, $orden);
            if($respuesta['error']) throw new Exception;
        } catch (Exception $e) {
            print_r($respuesta);

            die();

        }

		$this->render('index',array(
			'model'=> $modelFicha,
            'respuesta'=> $respuesta,
            )
        );

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