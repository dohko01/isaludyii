<?php

class FuenteDatosController extends Controller
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
	public $title_sin = 'Fuente de datos';

	/**
	 * Titulo plural para breadcrumb y encabezado
	 *     
	 * @var string 
	 */
	public $title_plu = 'Fuentes de datos';

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
				'actions'=>array('index','view','create','update','admin','delete','validararchivo'),
				'expression'=>'$user->id == 1 && $user->tipoUsuario == 1',
			),
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
        
		$model=new FuenteDatos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FuenteDatos']))
		{
			$model->attributes=$_POST['FuenteDatos'];
			$model->archivo = CUploadedFile::getInstance($model, 'archivo');

			if($model->save()) {
                if(!empty($model->archivo)) {
                    $model->archivo->saveAs(Yii::getPathOfAlias('application').'/data/uploads/'.$model->archivo);

                    if($model->archivo->hasError)
                        Yii::app()->user->setFlash('errorUploadFile', $model->archivo->error);
                }

                Yii::app()->user->setFlash('errorUploadFile', 'Error enviado por set flash');
				$this->redirect(array('view','id'=>$model->id));
            }
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
		$this->pageTitle = $this->title_sin.' - Actualizar';
        
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FuenteDatos']))
		{
			$model->attributes=$_POST['FuenteDatos'];
            $model->archivo = CUploadedFile::getInstance($model, 'archivo');
            
			if($model->save()) {
                if(!empty($model->archivo)) {
                    $model->archivo->saveAs(Yii::getPathOfAlias('application').'/data/uploads/'.$model->archivo);

                    if($model->archivo->hasError)
                        Yii::app()->user->setFlash('errorUploadFile', $model->archivo->error);
                }
				$this->redirect(array('view','id'=>$model->id));
            }
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
        
		$dataProvider=new CActiveDataProvider('FuenteDatos');
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
        
		$model=new FuenteDatos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FuenteDatos']))
			$model->attributes=$_GET['FuenteDatos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FuenteDatos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FuenteDatos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FuenteDatos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='fuente-datos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /**
	 * Valida si existe un archivo con el mismo nombre del que se esta cargando al sistema
	 */
	public function actionValidarArchivo()
	{
        $directorio = opendir(Yii::getPathOfAlias('application').'/data/uploads/');
        $archivoSubir = explode(DIRECTORY_SEPARATOR, $_POST['archivo']);
        // El ultimo segmento del arreglo contiene el nombre del archivo
        $archivoSubir = $archivoSubir[count($archivoSubir)-1];
        $respuesta = array('error'=>false);

        while (($archivo = readdir($directorio)) !== false)
        {
            // Comparación de string segura a nivel binario e insensible a mayúsculas y minúsculas
            if(strcasecmp($archivoSubir, $archivo) == 0) {
                $respuesta['error'] = true;
                $respuesta['archivo'] = $archivoSubir;
                $respuesta['archivo'] = $archivo;
                break;
            }
        }

        closedir($directorio);

        echo json_encode($respuesta);
	}
}
