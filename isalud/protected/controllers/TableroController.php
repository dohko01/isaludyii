<?php

class TableroController extends Controller
{
	public function actionIndex()
	{
		$this->render('index', array(
            'indicadores' => CHtml::listData(FichaTecnica::model()->findAll(), 'id', 'nombre')
        ));
	}

    public function actionView($id)
	{
        $respuesta = null;
        $modelFicha = null;
        try {
            $modelFicha = FichaTecnica::model()->findByPk($id);

            if($modelFicha) {
                $respuesta = $modelFicha->crearIndicador();
                if($respuesta['error']) throw new Exception($respuesta['msjerror']);

                $dimension = 'id_jurisdiccion';
                $filtro = array('id_estado'=>7, 'anio'=>2013);
                $orden = 'id_jurisdiccion';

                $respuesta = $modelFicha->calcularIndicador($dimension, $filtro, $orden);
								
                if(isset($respuesta['error']))
					if($respuesta['error']) throw new Exception($respuesta['msjerror']);

            } else {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = 'No se encuentra el indicador especificado';
            }
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
    
    public function actionGetIndicador() {
        $respuesta = null;
        $modelFicha = null;
        try {
            $modelFicha = FichaTecnica::model()->findByPk($_POST['id']);

            if($modelFicha) {
                $respuesta = $modelFicha->crearIndicador();
                if($respuesta['error']) throw new Exception($respuesta['msjerror']);

                $dimension = 'id_jurisdiccion';
                $filtro = array('id_estado'=>7, 'anio'=>2013);
                $orden = 'id_jurisdiccion';

                $respuesta = $modelFicha->calcularIndicador($dimension, $filtro, $orden, true);
                if(isset($respuesta['error'])) throw new Exception($respuesta['msjerror']);
            } else {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = 'No se encuentra el indicador especificado';
            }
        } catch (Exception $e) {
            $respuesta['error'] = true;
            $respuesta['msjerror'] = $e->getMessage();
        }

		echo json_encode($respuesta);
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