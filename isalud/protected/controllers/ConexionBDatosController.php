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
				'actions'=>array('index','view','create','update','admin','delete', 'probar'),
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
     * Si la prueba es exitosa devuelve true, de lo contrario devuelve false
     * junto con el mensaje de error
	 */
	public function actionProbar()
	{
        if(Yii::app()->request->isAjaxRequest) {
            $respuesta = array('error'=>false, 'msjerror'=>'');

            $motorBDatos = MotorBDatos::model()->findByPk($_POST['ConexionBDatos']['id_motor_bdatos']);

            $motorBDatos->driver;

            try {
                $dsn = '';

                switch ($motorBDatos->driver) {
                    case 'sqlite':
                        $dsn = $motorBDatos->driver.':'.$_POST['ConexionBDatos']['direccion'];
                        break;
                    case 'mysql':
                        if(empty($_POST['ConexionBDatos']['puerto']))
                            $_POST['ConexionBDatos']['puerto'] = 3306;
                        
                        $dsn = $motorBDatos->driver.':'.
                                            'host='.$_POST['ConexionBDatos']['direccion'].';'.
                                            'port='.$_POST['ConexionBDatos']['puerto'].';'.
                                            'dbname='.$_POST['ConexionBDatos']['base_datos'];
                        break;
                    case 'pgsql':
                        if(empty($_POST['ConexionBDatos']['puerto']))
                            $_POST['ConexionBDatos']['puerto'] = 5432;

                        $dsn = $motorBDatos->driver.':'.
                                            'host='.$_POST['ConexionBDatos']['direccion'].';'.
                                            'port='.$_POST['ConexionBDatos']['puerto'].';'.
                                            'dbname='.$_POST['ConexionBDatos']['base_datos'];
                        break;
                    case 'mssql':
                        if(empty($_POST['ConexionBDatos']['puerto']))
                            $_POST['ConexionBDatos']['puerto'] = 1433;

                        if(!empty($_POST['ConexionBDatos']['instancia']))
                            $_POST['ConexionBDatos']['direccion'] .= $_POST['ConexionBDatos']['direccion'].'\\'.$_POST['ConexionBDatos']['instancia'];
                        
                        $dsn = $motorBDatos->driver.':'.
                                            'host='.$_POST['ConexionBDatos']['direccion'].';'.
                                            'dbname='.$_POST['ConexionBDatos']['base_datos'];
                        break;
                    case 'sqlsrv': // Alternativa de conexion para SQL Server en php >= 5.3, http://mx1.php.net/manual/en/ref.pdo-sqlsrv.connection.php
                        if(empty($_POST['ConexionBDatos']['puerto']))
                            $_POST['ConexionBDatos']['puerto'] = 1433;

                        if(!empty($_POST['ConexionBDatos']['instancia']))
                            $_POST['ConexionBDatos']['direccion'] .= $_POST['ConexionBDatos']['direccion'].'\\'.$_POST['ConexionBDatos']['instancia'];

                        $dsn = $motorBDatos->driver.':'.
                                            'Server='.$_POST['ConexionBDatos']['direccion'].';'.
                                            'Database='.$_POST['ConexionBDatos']['base_datos'];
                        break;
                    case 'oci':
                        if(empty($_POST['ConexionBDatos']['puerto']))
                            $_POST['ConexionBDatos']['puerto'] = 1521;

                        $dsn = $motorBDatos->driver.':'.
                                            'dbname='.$_POST['ConexionBDatos']['direccion'].':'.
                                            $_POST['ConexionBDatos']['puerto'].'/'.
                                            $_POST['ConexionBDatos']['base_datos'];
                        break;
                }

                $conexion = new CDbConnection($dsn,$_POST['ConexionBDatos']['usuario'],$_POST['ConexionBDatos']['pass']);

                $conexion->setActive(true);

                if($conexion->active) // Si se establecio la conexion
                    $conexion->active=false; // Cierra la conexion
            } catch (Exception $exc) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $exc->getMessage();
            }

            echo json_encode($respuesta);
        }
	}
}
