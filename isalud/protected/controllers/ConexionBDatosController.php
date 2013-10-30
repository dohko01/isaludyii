<?php

class ConexionBDatosController extends Controller
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
	public $title_sin = 'Conexión a base de datos';

	/**
	 * Titulo plural para breadcrumb y encabezado
	 *     
	 * @var string 
	 */
	public $title_plu = 'Conexiones a base de datos';

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
				'actions'=>array('index','view','create','update','admin','delete', 'probarconexion', 'probarsql'),
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
        
		$model=new ConexionBDatos;
        $motoresBDatos = new MotorBDatos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ConexionBDatos']))
		{
			$model->attributes=$_POST['ConexionBDatos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
            'motoresBDatos'=>$motoresBDatos
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

		if(isset($_POST['ConexionBDatos']))
		{
			$model->attributes=$_POST['ConexionBDatos'];
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
        
		$dataProvider=new CActiveDataProvider('ConexionBDatos');
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
        
		$model=new ConexionBDatos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ConexionBDatos']))
			$model->attributes=$_GET['ConexionBDatos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ConexionBDatos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ConexionBDatos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ConexionBDatos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='conexion-bdatos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /**
	 * Prueba una conexion a base de datos.
     * Devueleve un json con dos elementos error y msjerror
	 */
	public function actionProbarConexion()
	{
        if(Yii::app()->request->isAjaxRequest) {
            $respuesta = array('error'=>false, 'msjerror'=>'');

            try {
                $conexion = ConexionBDatos::model()->getConexion($_POST['ConexionBDatos']);
                $conexion->setActive(true);

                if($conexion->getActive()) { // Si se establecio la conexion
                    $conexion->setActive(false); // Cierrar la conexion
                } else { // De lo contrario, notificar el error
                    $respuesta['error'] = true;
                    $respuesta['msjerror'] = 'No se realizó la conexión con la base de datos, revise los datos proporcionados';
                }
            } catch (Exception $exc) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $exc->getMessage();
            }

            echo json_encode($respuesta);
        }
	}

    /**
	 * Prueba una sentencia sql
     * Devuelve un array con tres elementos
     * error, msjerror y resultado.
     * En caso de existir un error, error se establece con true y msjerror contiene el mensaje de error
	 */
	public function actionProbarSQL()
	{
        if(Yii::app()->request->isAjaxRequest) {
            $respuesta = array('error'=>false, 'msjerror'=>'');

            try {
                if(empty($_POST['FuenteDatos']['sentencia_sql']))
                    throw new Exception ('Debe especificar una sentencia SQL');
                
                $conexion = ConexionBDatos::model()->getConexion($_POST['FuenteDatos']['id_conexion_bdatos']);
                $conexion->setActive(true);

                if($conexion->getActive()) { // Si se establecio la conexion
                    $respuesta = ConexionBDatos::model()->getQueryResult($conexion, $_POST['FuenteDatos']['sentencia_sql'], '15');
                } else { // De lo contrario, notificar el error
                    $respuesta['error'] = true;
                    $respuesta['msjerror'] = 'No se realizó la conexión con la base de datos, revise los datos proporcionados';
                }
            } catch (Exception $exc) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $exc->getMessage();
            }

            echo json_encode($respuesta);
        }
	}
}
