<?php

class PivotTableController extends Controller
{
	public function actionIndex()
	{
        $this->pageTitle = Yii::app()->name.' - Tabla dinámica';
        $error = false;
        $nombreIndicador = '';
        $jsCalculaIndicador = '';
        $jsPivotTable = '';
        $jsonDatos = '';
        
        if(Yii::app()->request->getPost('indicador')) {
            $modelFicha = FichaTecnica::model()->findByPk( Yii::app()->request->getPost('indicador') );
            
            if(!$modelFicha)
                $error = 'No se encuentra el indicador especificado';
            else {
                $nombreIndicador = $modelFicha->nombre;
                try {
                    $respuesta = $modelFicha->crearIndicador();
                    if($respuesta['error']) throw new Exception($respuesta['msjerror']);

                    $rows = $modelFicha->getMaxDimLugar();
                    $significado = SignificadoCampo::model()->find(array('condition'=>'codigo = \''.$rows.'\''));
                    if(!$significado) throw new Exception('No se puede obtener la dimensión lugar: '.$rows);
                    $rows = $significado->descripcion;
                    
                    $cols = $modelFicha->getMaxDimTiempo();
                    $significado = SignificadoCampo::model()->find(array('condition'=>'codigo = \''.$cols.'\''));
                    if(!$significado) throw new Exception('No se puede obtener la dimensión tiempo: '.$cols);
                    $cols = $significado->descripcion;
                    
                    $jsonDatos = $modelFicha->obtenerJSONDatos();
                    if(isset($jsonDatos['error'])) throw new Exception($jsonDatos['error']);
                    
                    $variables = $modelFicha->getVariablesIndicador();
            
                    $jsCalculaIndicador = '
                        var calculaIndicador = function(){
                            return function(){
                                return {';
                    
                    foreach ($variables as $var) {
                        $jsCalculaIndicador .= '
                                    sum_'.strtolower($var).': 0,';
                    }
                    
                    $jsCalculaIndicador .= '
                                    push: function(record) {';
                    
                    
                    foreach ($variables as $var) {
                        $jsCalculaIndicador .= '
                                    if ( !isNaN(parseFloat(record.'.strtolower($var).')) ) {
                                            this.sum_'.strtolower($var).' += parseFloat(record.'.strtolower($var).');
                                        }';
                    }
                    // Ejemplo: [esq_comp_menor_1] / [pob_inf_menor_uno] * 100
                    $formula = $modelFicha->formula ? $modelFicha->formula : str_replace('%', '/100', $modelFicha->creaFormulaIndicador());
                    $formula = str_replace('[', 'this.sum_', $formula);
                    $formula = str_replace(']', '', $formula);
                    
                    $jsCalculaIndicador .= '
                                    },
                                    value: function() {
                                        if ( !isNaN('.$formula.') )
                                            return Math.round( ('.$formula.') * 100) / 100 ;

                                        return 0;
                                    },
                                    format: function(x) { return x ; },
                                    label: "'.$nombreIndicador.'"
                                };
                            };
                        };';

                    $formula = $modelFicha->formula ? $modelFicha->formula : str_replace('%', '/100', $modelFicha->creaFormulaIndicador());
                    $formula = str_replace('[', 'record["', $formula);
                    $formula = str_replace(']', '"]', $formula);
                    
                    $jsPivotTable = '
                        $("#divPivotTable").pivotUI('.$jsonDatos.', {
                            renderers: $.extend(
                                $.pivotUtilities.renderers,
                                $.pivotUtilities.gchart_renderers
                            ),
                            aggregators: { "'.$nombreIndicador.'": calculaIndicador },
                            hiddenAttributes: ["'.implode('", "', $variables).'", "Indicador"],
                            derivedAttributes: {
                                "Indicador": function(record){
                                    return '.$formula.';
                                }
                            },
                            cols: ["'.$cols.'"], 
                            rows: ["'.$rows.'"],
                            rendererName: "Bar Char"
                        });';
                    
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        }
                
		$this->render('index', array(
            'indicadores' => CHtml::listData(FichaTecnica::model()->findAll(array('order'=>'nombre ASC')), 'id', 'nombre'),
            'jsCalculaIndicador' => $jsCalculaIndicador,
            'jsPivotTable' => $jsPivotTable,
            'nombreIndicador' => $nombreIndicador,
            'error' => $error,
        ));
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