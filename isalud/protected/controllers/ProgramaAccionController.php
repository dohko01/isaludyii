<?php

class ProgramaAccionController extends Controller
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
	public $title_sin = 'ProgramaAccion';

	/**
	 * Titulo plural para breadcrumb y encabezado
	 *     
	 * @var string 
	 */
	public $title_plu = 'ProgramaAccion';

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
				'actions'=>array('index','view','create','update','admin','delete','getProgramaAccion'),
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
		$this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Ver';
        
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
		$this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Crear';
        
		$model=new ProgramaAccion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProgramaAccion']))
		{
			$model->attributes=$_POST['ProgramaAccion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Actualizar';
        
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProgramaAccion']))
		{
			$model->attributes=$_POST['ProgramaAccion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Eliminar';
        
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
		$this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Inicio';
        
		$dataProvider=new CActiveDataProvider('ProgramaAccion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Administración';
        
		$model=new ProgramaAccion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProgramaAccion']))
			$model->attributes=$_GET['ProgramaAccion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProgramaAccion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProgramaAccion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La pagina solicitada no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProgramaAccion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='programa-accion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionGetProgramaAccion()
	{
		$datosPost = array();
		foreach($_POST as $key => $value)
		{
			$datosPost[] = $value;
		}
		
		$data = ProgramaAccion::model()->findAll('"id_cat_coordinacion"=:id_coordinacion',
												array(':id_coordinacion'=>(int)$datosPost[1]['id_cat_coordinacion'])
												);
		$data = CHtml::listData($data,'id','nombre');
		
		echo CHtml::tag('option', array('value'=>'empty'),CHtml::encode('Seleccionar'),true);
		foreach($data as $value => $name)
		{
			echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		}
	}
}
