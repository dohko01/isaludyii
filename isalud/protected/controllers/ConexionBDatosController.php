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

    /*
     * Devuelve un objeto de tipo CDbConnection
     */
    public function getConexion($datoConnec) {
        $datosConexion = null;

        // Si no es un array, quiere decir que estamos recibiendo el id de una conexion existente en la base de datos
        // de lo contrario recibe los datos en forma de array de una nueva conexion, es decir, los datos del formulario
        if(!is_array($datoConnec)) {
            $datosConexion = ConexionBDatos::model()->findByPk($datoConnec);

            if($datosConexion)
                $datosConexion = $datosConexion->getAttributes(false);
            else
                return array('error'=>true, 'msjerror'=>'No existe el registro de la conexión a base de datos especificada');
        }
        else
            $datosConexion = $datoConnec;

        // Validar los datos propocionados
        if(!$datosConexion['direccion'])
            return array('error'=>true, 'msjerror'=>'Proporcione la IP o URL para la conexión');
        if(!$datosConexion['usuario'])
            return array('error'=>true, 'msjerror'=>'Proporcione el dato del nombre de usuario');
        if(!$datosConexion['pass'])
            return array('error'=>true, 'msjerror'=>'Proporcione la contraseña del usuario');
        if(!$datosConexion['base_datos'])
            return array('error'=>true, 'msjerror'=>'Proporcione el nombre de la base de datos');

        $dsn = '';
        $motorBDatos = MotorBDatos::model()->findByPk($datosConexion['id_motor_bdatos']);

        if(is_null($motorBDatos))
            return array('error'=>true, 'msjerror'=>'Especifique un motor de base de datos válido para la conexión');

        switch ($motorBDatos->driver) {
            case 'sqlite':
                $dsn = $motorBDatos->driver.':'.$datosConexion['direccion'];
                break;
            case 'mysql':
                if(empty($datosConexion['puerto']))
                    $datosConexion['puerto'] = 3306;

                $dsn = $motorBDatos->driver.':'.
                                    'host='.$datosConexion['direccion'].';'.
                                    'port='.$datosConexion['puerto'].';'.
                                    'dbname='.$datosConexion['base_datos'];
                break;
            case 'pgsql':
                if(empty($datosConexion['puerto']))
                    $datosConexion['puerto'] = 5432;

                $dsn = $motorBDatos->driver.':'.
                                    'host='.$datosConexion['direccion'].';'.
                                    'port='.$datosConexion['puerto'].';'.
                                    'dbname='.$datosConexion['base_datos'];
                break;
            case 'mssql':
                if(empty($datosConexion['puerto']))
                    $datosConexion['puerto'] = 1433;

                if(!empty($datosConexion['instancia']))
                    $datosConexion['direccion'] .= $datosConexion['direccion'].'\\'.$datosConexion['instancia'];

                $dsn = $motorBDatos->driver.':'.
                                    'host='.$datosConexion['direccion'].';'.
                                    'dbname='.$datosConexion['base_datos'];
                break;
            case 'sqlsrv': // Alternativa de conexion para SQL Server en php >= 5.3, http://mx1.php.net/manual/en/ref.pdo-sqlsrv.connection.php
                if(empty($datosConexion['puerto']))
                    $datosConexion['puerto'] = 1433;

                if(!empty($datosConexion['instancia']))
                    $datosConexion['direccion'] .= $datosConexion['direccion'].'\\'.$datosConexion['instancia'];

                $dsn = $motorBDatos->driver.':'.
                                    'Server='.$datosConexion['direccion'].';'.
                                    'Database='.$datosConexion['base_datos'];
                break;
            case 'oci':
                if(empty($datosConexion['puerto']))
                    $datosConexion['puerto'] = 1521;

                $dsn = $motorBDatos->driver.':'.
                                    'dbname='.$datosConexion['direccion'].':'.
                                    $datosConexion['puerto'].'/'.
                                    $datosConexion['base_datos'];
                break;
        }

        $conexion = new CDbConnection($dsn,$datosConexion['usuario'],$datosConexion['pass']);


        return $conexion;
    }

    /**
	 * Prueba una conexion a base de datos.
     * Si la prueba es exitosa devuelve true, de lo contrario devuelve false
     * junto con el mensaje de error
	 */
	public function actionProbarConexion()
	{
        if(Yii::app()->request->isAjaxRequest) {
            $respuesta = array('error'=>false, 'msjerror'=>'');

            try {
                $conexion = $this->getConexion($_POST['ConexionBDatos']);

                // Si me devuelve un arreglo, quiere decir que se lanzó un error
                if(is_array($conexion)) {
                    $respuesta = $conexion;
                } else {
                    $conexion->setActive(true);

                    if($conexion->getActive()) { // Si se establecio la conexion
                        $conexion->setActive(false); // Cierrar la conexion
                    } else { // De lo contrario, notificar el error
                        $respuesta['error'] = true;
                        $respuesta['msjerror'] = 'No se realizó la conexión con la base de datos, revise los datos proporcionados';
                    }
                }
            } catch (Exception $exc) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $exc->getMessage();
            }

            echo json_encode($respuesta);
        }
	}

    /**
	 * Prueba una conexion a base de datos.
     * Si la prueba es exitosa devuelve true, de lo contrario devuelve false
     * junto con el mensaje de error
	 */
	public function actionProbarSQL()
	{
        if(Yii::app()->request->isAjaxRequest) {
            $respuesta = array('error'=>false, 'msjerror'=>'');

            try {
                if(empty($_POST['sql']))
                    throw new Exception ('Debe especificar una sentencia SQL');
                
                $conexion = $this->getConexion($_POST['conexion']);

                // Si me devuelve un arreglo, quiere decir que se lanzó un error
                if(is_array($conexion)) {
                    $respuesta = $conexion;
                } else {
                    $conexion->setActive(true);

                    if($conexion->getActive()) { // Si se establecio la conexion
                        $noPermitidos = '/\bUPDATE\b|\bDELETE\b|\bINSERT\b|\bCREATE\b|\bDROP\b/i';
                        $sql = $_POST['sql'];

                        if (preg_match($noPermitidos, $sql) == FALSE) {
                            // limitar la consulta a los 15 primeros registros
                            if($conexion->getDriverName() == 'mssql' || $conexion->getDriverName() == 'sqlsrv')
                                 $sql = str_ireplace('SELECT', 'SELECT TOP 15 ', $sql); // SQL Server no soporta limit
                            else
                                 $sql = $sql.' LIMIT 15';

                            $command = $conexion->createCommand($sql);
                            $dataReader = $command->query();
                            $resultSet = $dataReader->readAll();

                            if(count($resultSet) > 0) {
                                // Revisar si la codificación del caracter es utf-8, si no los es hay que convertirlo
                                $funcConvertUFT8 = function(&$elemento, &$clave) {
                                    $elemento = mb_check_encoding($elemento, 'UTF-8') ? $elemento : utf8_encode(trim($elemento));
                                };
                                // Codificar todos los caracteres a utf-8 de lo contrario marca error al convertir a json
                                array_walk_recursive($resultSet, $funcConvertUFT8);
                                $respuesta['resultado'] = $resultSet;
                            }

                        } else {
                            $respuesta['error'] = true;
                            $respuesta['msjerror'] = 'Sentencias no permitidas UPDATE, DELETE, INSERT, CREATE y DROP';
                        }
                    } else { // De lo contrario, notificar el error
                        $respuesta['error'] = true;
                        $respuesta['msjerror'] = 'No se realizó la conexión con la base de datos, revise los datos proporcionados';
                    }
                }
            } catch (Exception $exc) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $exc->getMessage();
            }

            echo json_encode($respuesta);
        }
	}
}
