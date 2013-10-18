<?php

class EscalaEvaluacionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Titulo singular para breadcrumb y encabezado
	 *
	 * @var string
	 */
	public $title_sin = 'Escala de evaluación';

	/**
	 * Titulo plural para breadcrumb y encabezado
	 *     
	 * @var string 
	 */
	public $title_plu = 'Escalas de evaluación';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				//'users'=>array('*'),
				'expression'=>'$user->id == 1 && $user->tipoUsuario == 1',
			),/*
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				//'users'=>array('@'),
				'expression'=>'$user->id == 1 && $user->tipoUsuario == 1',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'users'=>array('admin'),
				'expression'=>'$user->id == 1 && $user->tipoUsuario == 1',
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->pageTitle = $this->title_sin.' - Ver';
        
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = $this->title_sin.' - Crear';
        
		$model=new EscalaEvaluacion;
        $criteriosEvaluacion = CHtml::listData(CriterioEvaluacion::model()->findAll(), 'id', 'nombre');
        $msjError = '';
        $transaction = null;
        $reglasEvaluacion = null;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EscalaEvaluacion']))
		{
            try {
                $transaction = Yii::app()->db->beginTransaction();
                $model->attributes=$_POST['EscalaEvaluacion'];

                if($model->save()) {
                    $reglasEvaluacion = $_POST['EscalaEvaluacion']['reglas'];

                    if(!empty($reglasEvaluacion)) {
                        foreach($reglasEvaluacion as $id => $regEval) {
                            $criEscEva = new CriterioEscalaEvaluacion;

                            $criEscEva->id_cat_criterio_evaluacion = $regEval['criterio'];
                            $criEscEva->id_escala_evaluacion = $model->id;
                            $criEscEva->limite_inf = $regEval['limInf'];
                            $criEscEva->limite_sup = $regEval['limSup'];

                            $criEscEva->save();
                        }
                    } else {
                        throw new Exception('Debe especificar por lo menos una regla de evaluación');
                    }
                }
                $transaction->commit();
            } catch (Exception $e) {
                $msjError = 'Error al guardar los datos datos. '.$e->getMessage();
            }

            $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
            'criteriosEvaluacion'=>$criteriosEvaluacion,
            'msjError'=>$msjError,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->pageTitle = $this->title_sin.' - Actualizar';
        
		$model=$this->loadModel($id);
        $msjError = '';
        $reglasEliminar = null;
        $transaction = null;
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EscalaEvaluacion']))
		{
            try {
                $transaction = Yii::app()->db->beginTransaction();
                $model->attributes=$_POST['EscalaEvaluacion'];

                if($model->save()) {
                    if(!empty($_POST['ReglasEliminar'])) {
                        $reglasEliminar = explode(',', $_POST['ReglasEliminar']);
                        $reglasEliminar = array_filter($reglasEliminar);

                        foreach ($reglasEliminar as $eliminar) {
                            $objEliminar = CriterioEscalaEvaluacion::model()->findByAttributes(array('id_escala_evaluacion'=>$model->id, 'id_cat_criterio_evaluacion'=>$eliminar));

                            $objEliminar->delete();
                        }
                    }

                    $reglasEvaluacion = $_POST['EscalaEvaluacion']['reglas'];

                    if(!empty($reglasEvaluacion)) {
                        foreach($reglasEvaluacion as $id => $regEval) {
                            $criEscEva = CriterioEscalaEvaluacion::model()->findByAttributes(array('id_escala_evaluacion'=>$model->id, 'id_cat_criterio_evaluacion'=>$id));

                            if($criEscEva) {
                                $criEscEva->id_cat_criterio_evaluacion = $regEval['criterio'];
                                $criEscEva->id_escala_evaluacion = $model->id;
                                $criEscEva->limite_inf = $regEval['limInf'];
                                $criEscEva->limite_sup = $regEval['limSup'];

                                $criEscEva->save();
                            } else {
                                $criEscEva = new CriterioEscalaEvaluacion;

                                $criEscEva->id_cat_criterio_evaluacion = $regEval['criterio'];
                                $criEscEva->id_escala_evaluacion = $model->id;
                                $criEscEva->limite_inf = $regEval['limInf'];
                                $criEscEva->limite_sup = $regEval['limSup'];

                                $criEscEva->save();
                            }
                        }
                    } else {
                        throw new Exception('Debe especificar por lo menos una regla de evaluación');
                    }
                }
                $transaction->commit();
            } catch (Exception $e) {
                $msjError = 'Error al guardar los datos datos. '.$e->getMessage();
            }

            //$this->redirect(array('view','id'=>$model->id));
		}

        $criteriosEvaluacion = CHtml::listData(CriterioEvaluacion::model()->findAll(array('order'=>'id')), 'id', 'nombre');
        
		$this->render('update',array(
			'model'=>$model,
            'criteriosEvaluacion'=>$criteriosEvaluacion,
            'msjError'=>$msjError,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->pageTitle = $this->title_sin.' - Eliminar';
        
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = $this->title_sin.' - Inicio';
        
		$dataProvider=new CActiveDataProvider('EscalaEvaluacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->pageTitle = $this->title_sin.' - Administración';
        
		$model=new EscalaEvaluacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EscalaEvaluacion']))
			$model->attributes=$_GET['EscalaEvaluacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EscalaEvaluacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EscalaEvaluacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EscalaEvaluacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='escala-evaluacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
