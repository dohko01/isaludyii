<?php

class TableroController extends Controller
{
	public function actionIndex()
	{
        $config = CJavaScript::encode(Yii::app()->params['prefixTblIndicador']);
        $baseUrl = CJavaScript::encode(Yii::app()->baseUrl);
        
        Yii::app()->clientScript->registerScript('appConfig', 'var prefixTblIndicador = '.$config.'; var baseUrl = '.$baseUrl.'; ', CClientScript::POS_HEAD);
    
		$this->render('index', array(
            'indicadores' => CHtml::listData(FichaTecnica::model()->findAll(), 'id', 'nombre')
        ));
	}
	
	public function actionSample()
	{
		$this->render('sample');
	}
    
    public function actionGetIndicador() {
        $respuesta = array('error'=>false, 'msjerror'=>'');
        $modelFicha = null;
        
        if(Yii::app()->request->isAjaxRequest && isset($_POST['id'])) {
            try {
                $modelFicha = FichaTecnica::model()->findByPk($_POST['id']);

                if($modelFicha) {
                    $respuesta = $modelFicha->crearIndicador();
                    if($respuesta['error']) throw new Exception($respuesta['msjerror']);

                    $dimension = 'id_jurisdiccion';
                    $filtro = array('id_estado'=>7, 'anio'=>2013);
                    $orden = 'id_jurisdiccion';

                    $respuesta = $modelFicha->calcularIndicador($dimension, $filtro, $orden);
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
    }
    
    public function actionGuardarTablero() {
        $respuesta = array('error'=>false, 'msjerror'=>'');
        
        if(Yii::app()->request->isAjaxRequest && isset($_POST['nombre'])) {
            try {
                //$respuesta = $_POST['datos'];
                
            } catch (Exception $e) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $e->getMessage();
            }

            echo json_encode($respuesta);
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