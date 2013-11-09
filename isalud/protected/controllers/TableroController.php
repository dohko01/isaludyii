<?php

class TableroController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionView($id)
	{
        $respuesta = null;
        $modelFicha = null;
        try {
            $modelFicha = FichaTecnica::model()->findByPk($id);

            $respuesta = $modelFicha->crearIndicador();
            if($respuesta['error']) throw new Exception($respuesta['msjerror']);

            $dimension = 'id_jurisdiccion';
            $filtro = array('id_estado'=>7, 'anio'=>2013);
            $orden = 'id_jurisdiccion';

            $respuesta = $modelFicha->calcularIndicador($dimension, $filtro, $orden);
            if($respuesta['error']) throw new Exception($respuesta['msjerror']);
        } catch (Exception $e) {
            $respuesta['error'] = true;
            $respuesta['msjerror'] = $e->getMessage();
        }

		$this->render('view',array(
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