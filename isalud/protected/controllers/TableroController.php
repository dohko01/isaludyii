<?php

class TableroController extends Controller
{
	public function actionIndex()
	{
        $config = CJavaScript::encode(Yii::app()->params['prefixTblIndicador']);
        $baseUrl = CJavaScript::encode(Yii::app()->baseUrl);
        
        Yii::app()->clientScript->registerScript('appConfig', 'var prefixTblIndicador = '.$config.'; var baseUrl = '.$baseUrl.'; ', CClientScript::POS_HEAD);
    
		$this->render('index', array(
            'indicadores' => CHtml::listData(FichaTecnica::model()->findAll(), 'id', 'nombre'),
            'tableros' => CHtml::listData(Tablero::model()->findAll(), 'id', 'nombre'),
        ));
	}
	
	public function actionSample()
	{
		$this->render('sample');
	}
    
    public function actionGetIndicador() {
        $respuesta = array('error'=>false, 'msjerror'=>'');
        $modelFicha = null;
        
        if(Yii::app()->request->isAjaxRequest && Yii::app()->request->getPost('id')) {
            try {
                $dimension = Yii::app()->request->getPost('dimension');//'id_jurisdiccion';
                $filtro = Yii::app()->request->getPost('filtro');//array('id_estado'=>7, 'anio'=>2013);
                $orden = Yii::app()->request->getPost('orden');//'id_jurisdiccion';
                
                if(empty($dimension)) throw new Exception('Debe especificar una dimensión para el indicador');
                
                if(empty($filtro)) throw new Exception('Debe especificar los parametros de filtrado para el indicador');
                
                $modelFicha = FichaTecnica::model()->findByPk(Yii::app()->request->getPost('id'));

                if($modelFicha) {
                    $respuesta = $modelFicha->crearIndicador();
                    if($respuesta['error']) throw new Exception($respuesta['msjerror']);

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
        
        if(Yii::app()->request->isAjaxRequest && Yii::app()->request->getPost('nombre')) {
            try {
                $transaction = Yii::app()->db->beginTransaction();
                
                $tablero = new Tablero;
                
                $tablero->nombre = Yii::app()->request->getPost('nombre');
                $tablero->es_publico = false;
                $tablero->fecha_creacion = date('Y-m-d H:m:s');
                $tablero->id_usuario = Yii::app()->user->id;
                
                if($tablero->save()) {
                    $datosIndicadores = Yii::app()->request->getPost('datos');
                    
                    foreach ($datosIndicadores as $indicador) {
                        $indicadorTablero = new TableroIndicador;
                    
                        $indicadorTablero->id_tablero = $tablero->id;
                        $indicadorTablero->id_ficha_tecnica = $indicador['id'];
                        $indicadorTablero->dimension = $indicador['dimension'];
                        $indicadorTablero->filtro = $indicador['filtro'];
                        $indicadorTablero->posicion = $indicador['posicion'];
                        $indicadorTablero->tipo_grafico = $indicador['tipo_grafico'];
                        $indicadorTablero->configuracion = $indicador['configuracion'];
                        
                        if(!$indicadorTablero->save()) {
                            throw new Exception(implode(' ',$indicadorTablero->getMsgErrors()));
                        }
                    }
                    $transaction->commit();
                } else {
                    throw new Exception(implode(' ',$tablero->getMsgErrors()));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $e->getMessage();
            }

            echo json_encode($respuesta);
        }
    }
    
    public function actionGetTablero() {
        $respuesta = array('error'=>false, 'msjerror'=>'', 'datos'=>array());
        
        if(Yii::app()->request->isAjaxRequest && Yii::app()->request->getPost('id')) {
            try {
                $tablero = Tablero::model()->findByPk(Yii::app()->request->getPost('id'));
                
                foreach ($tablero->indicadoresTablero as $indicador) {
                    $datosIndicador = array(
                        'id'=> $indicador->id_ficha_tecnica,
                        'dimension'=> $indicador->dimension,
                        'filtro'=> json_decode($indicador->filtro),
                        'posicion'=> $indicador->posicion,
                        'tipo_grafico'=> $indicador->tipo_grafico,
                        'configuracion'=> $indicador->configuracion 
                    );
                    
                    $respuesta['datos'][] = $datosIndicador;
                }
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