<?php

class TableroController extends Controller
{
	public function actionIndex()
	{
        $config = CJavaScript::encode(Yii::app()->params['prefixTblIndicador']);
        $baseUrl = CJavaScript::encode(Yii::app()->baseUrl);
        $graficos =  CJavaScript::encode(CHtml::listData(TipoGrafico::model()->findAll(), 'codigo', 'nombre'));
        
        Yii::app()->clientScript->registerScript('appConfig', 'var prefixTblIndicador = '.$config.
                                                            '; var baseUrl = '.$baseUrl.
                                                            '; var graficos = '.$graficos, CClientScript::POS_HEAD);
    
		$this->render('index', array(
            'indicadores' => CHtml::listData(FichaTecnica::model()->findAll(array('order'=>'nombre ASC')), 'id', 'nombre'),
            'tableros' => CHtml::listData(Tablero::model()->findAll(array('order'=>'nombre ASC')), 'id', 'nombre'),
            'datosPost'=>$_POST,
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
                    if($respuesta['error']) throw new Exception($respuesta['msjerror']);
                    
                    // Si no esta definido el tipo de grafio, se establecera como line
                    if( empty($respuesta['tipo_grafico']) && Yii::app()->request->getPost('tipo_grafico')==null )
                        $respuesta['tipo_grafico'] = 'line';
                    else if (Yii::app()->request->getPost('tipo_grafico')!=null)
                        $respuesta['tipo_grafico'] = Yii::app()->request->getPost('tipo_grafico');
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
    
    public function actionGerencial()
	{
        $baseUrl = CJavaScript::encode(Yii::app()->baseUrl);
        
        $sabin_sns['indicador'] = 0;
        $sr_sns['indicador'] = 0;
        $td_sns['indicador'] = 0;
        
        $vac_cob_m1 = 0; // 1
        $vac_cen_m1 = 0; // 21
        
        $vac_cob_1 = 0; // 2
        $vac_cen_1 = 0; // 22
        
        $vac_cob_1_4 = 0; // 17
        $vac_cen_1_4 = 0; // 23
        
        $meses = array("Enero"=>1,"Febrero"=>2,"Marzo"=>3,"Abril"=>4,"Mayo"=>5,"Junio"=>6,"Julio"=>7,"Agosto"=>8,"Septiembre"=>9,"Octubre"=>10,"Noviembre"=>11,"Diciembre"=>12);
        
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(18);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) 
                $sabin_sns = $indicador->calcularIndicador('id_estado', array('id_estado'=>7, 'anio'=>2013), null, false);
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(19);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) 
                $sr_sns = $indicador->calcularIndicador('id_estado', array('id_estado'=>7, 'anio'=>2013), null, false);
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(20);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) 
                $td_sns = $indicador->calcularIndicador('id_estado', array('id_estado'=>7, 'anio'=>2013), null, false);
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(1);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) {
                $vac_cob_m1 = $indicador->calcularIndicador('mes', array('id_estado'=>7, 'anio'=>2013), null, false);
                $tmpDatos = array();
                
                foreach ($vac_cob_m1 as $temp) {
                    $tmpDatos[$meses[$temp["mes"]]] = floatval($temp["indicador"]);
                }
                $tmpDatos = array_filter($tmpDatos);
                ksort($tmpDatos);
                unset($tmpDatos[12]);
                $vac_cob_m1 = $tmpDatos;
            }
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(21);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) {
                $vac_cen_m1 = $indicador->calcularIndicador('mes', array('id_estado'=>7, 'anio'=>2013), null, false);
                $tmpDatos = array();
                
                foreach ($vac_cen_m1 as $temp) {
                    $tmpDatos[$meses[$temp["mes"]]] = floatval($temp["indicador"]);
                }
                $tmpDatos = array_filter($tmpDatos);
                ksort($tmpDatos);
                unset($tmpDatos[12]);
                $vac_cen_m1 = $tmpDatos;
            }
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(2);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) {
                $vac_cob_1 = $indicador->calcularIndicador('mes', array('id_estado'=>7, 'anio'=>2013), null, false);
                $tmpDatos = array();
                
                foreach ($vac_cob_1 as $temp) {
                    $tmpDatos[$meses[$temp["mes"]]] = floatval($temp["indicador"]);
                }
                $tmpDatos = array_filter($tmpDatos);
                ksort($tmpDatos);
                unset($tmpDatos[12]);
                $vac_cob_1 = $tmpDatos;
            }
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(22);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) {
                $vac_cen_1 = $indicador->calcularIndicador('mes', array('id_estado'=>7, 'anio'=>2013), null, false);
                $tmpDatos = array();
                
                foreach ($vac_cen_1 as $temp) {
                    $tmpDatos[$meses[$temp["mes"]]] = floatval($temp["indicador"]);
                }
                $tmpDatos = array_filter($tmpDatos);
                ksort($tmpDatos);
                unset($tmpDatos[12]);
                $vac_cen_1 = $tmpDatos;
            }
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(17);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) {
                $vac_cob_1_4 = $indicador->calcularIndicador('mes', array('id_estado'=>7, 'anio'=>2013), null, false);
                $tmpDatos = array();
                
                foreach ($vac_cob_1_4 as $temp) {
                    $tmpDatos[$meses[$temp["mes"]]] = floatval($temp["indicador"]);
                }
                $tmpDatos = array_filter($tmpDatos);
                ksort($tmpDatos);
                unset($tmpDatos[12]);
                $vac_cob_1_4 = $tmpDatos;
            }
        }
        /*****************************************************************************/
        $indicador = FichaTecnica::model()->findByPk(23);
        if($indicador) {
            $respuesta = $indicador->crearIndicador();
            
            if(!$respuesta['error']) {
                $vac_cen_1_4 = $indicador->calcularIndicador('mes', array('id_estado'=>7, 'anio'=>2013), null, false);
                $tmpDatos = array();
                
                foreach ($vac_cen_1_4 as $temp) {
                    $tmpDatos[$meses[$temp["mes"]]] = floatval($temp["indicador"]);
                }
                $tmpDatos = array_filter($tmpDatos);
                ksort($tmpDatos);
                unset($tmpDatos[12]);
                $vac_cen_1_4 = $tmpDatos;
            }
        }
        
        /*****************************************************************************/
        
        Yii::app()->clientScript->registerScript('appConfig', 'var baseUrl = '.$baseUrl.';'.
                                                              'var sabin_sns = '.CJavaScript::encode($sabin_sns[0]['indicador']).';'.
                                                              'var sr_sns = '.CJavaScript::encode($sr_sns[0]['indicador']).';'.
                                                              'var td_sns = '.CJavaScript::encode($td_sns[0]['indicador']).';'.
                                                              'var vac_cob_m1 = '.CJavaScript::encode($vac_cob_m1).';'.
                                                              'var vac_cen_m1 = '.CJavaScript::encode($vac_cen_m1).';'.
                                                              'var vac_cob_1 = '.CJavaScript::encode($vac_cob_1).';'.
                                                              'var vac_cen_1 = '.CJavaScript::encode($vac_cen_1).';'.
                                                              'var vac_cob_1_4 = '.CJavaScript::encode($vac_cob_1_4).';'.
                                                              'var vac_cen_1_4 = '.CJavaScript::encode($vac_cen_1_4).';', 
                                    CClientScript::POS_HEAD);
        
		$this->render('gerencial', array());
	}
    
    public function actionPrincipal()
	{
        $baseUrl = CJavaScript::encode(Yii::app()->baseUrl);
        Yii::app()->clientScript->registerScript('appConfig', 'var baseUrl = '.$baseUrl, CClientScript::POS_HEAD);
        
		$this->render('principal');
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