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
				'actions'=>array('index','view','create','update','admin','delete','validararchivo','configurarcampo', 'cargardatos', 'obtenercampos', 'verdatos', 'recargardatos'),
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

        $msjError = '';
		$model = new FuenteDatos;
        $archivo = null;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FuenteDatos']))
		{
            $transaction = null;
            try {
                $model->attributes=$_POST['FuenteDatos'];
                $model->archivo = CUploadedFile::getInstance($model, 'archivo');

                $transaction = Yii::app()->db->beginTransaction();

                if($model->save()) {
                    // Subir el archivo al servidor
                    if(!empty($model->archivo)) {
                        $archivo = YiiBase::getPathOfAlias(Yii::app()->params['pathUploads']).DIRECTORY_SEPARATOR.$model->archivo;
                        $model->archivo->saveAs($archivo);

                        if($model->archivo->hasError)
                            Yii::app()->user->setFlash('errorUploadFile', 'Error al subir el archivo: '.$model->archivo->error);
                    }

                    // Cargar todos los campos
                    // Desde una base de datos
                    if(!empty($model->id_conexion_bdatos)) {
                        $DBConec = ConexionBDatos::model()->getConexion($model->id_conexion_bdatos);

                        // Leemos solo un registro de la consulta ya que lo que necesitamos son el nombre de las columnas
                        $rsDatos = ConexionBDatos::model()->getQueryResult($DBConec, $model->sentencia_sql, 1);
                        
                        if(empty($rsDatos))
                            throw new Exception('No se pudieron obtener los campos desde la consulta.');

                        // Campos enviados desde la sentencia SQL
                        $nombresCampo = array_keys($rsDatos[0]);
                        
                        foreach ($nombresCampo as $strCampo) {
                            $objCampo = new Campo;
                            $objCampo->id_fuente_datos = $model->id;
                            $objCampo->nombre = $model->limpiarCadena($strCampo);

                            $objCampo->save();
                        }

                    } // Desde un archivo
                    else if(!empty($archivo)) {
                        // Fuente: https://github.com/marcovtwout/yii-phpexcel
                        Yii::import('ext.phpexcel.XPHPExcel');
                        XPHPExcel::init();

                        $inputFileType = PHPExcel_IOFactory::identify($archivo);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objReader->setReadDataOnly(true);
                        $objPHPExcel = $objReader->load($archivo);
                        // La primera fila del archivo contiene el nombre de los campos
                        $datos = $objPHPExcel->getActiveSheet()->rangeToArray(
                                    'A1:'.$objPHPExcel->getActiveSheet()->getHighestColumn().'1', // Solo lee la primera fila
                                    null,true,true,true
                                );

                        if(empty($datos))
                            throw new Exception('No se pudieron obtener los campos desde el archivo.');

                        foreach ($datos[1] as $strCampo) {
                            $objCampo = new Campo;
                            $objCampo->id_fuente_datos = $model->id;
                            $objCampo->nombre = $model->limpiarCadena($strCampo);

                            $objCampo->save();
                        }
                    } else {
                        throw new Exception('Debe especificar un origen de datos, puede ser una base de datos o un archivo');
                    }

                    $transaction->commit();

                    $this->redirect(array('view','id'=>$model->id));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                $msjError = 'Error al crear la fuente de datos. '.$e->getMessage();
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'msjError' => $msjError,
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

        $msjError = '';
		$model = $this->loadModel($id);
        $archivo = null;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FuenteDatos']))
		{
            $transaction = null;
            try {
                $model->attributes=$_POST['FuenteDatos'];
                // Si no hay valor para el archivo actual
                // quiere decir que esta subiendo un nuevo archivo
                if(empty($_POST['archivoActual']))
                    $model->archivo = CUploadedFile::getInstance($model, 'archivo');
                else
                    $model->archivo = $_POST['archivoActual'];

                $transaction = Yii::app()->db->beginTransaction();

                if($model->save()) {
                    // Subir el archivo al servidor
                    if(empty($_POST['archivoActual']) && !empty($model->archivo)) {
                        $archivo = YiiBase::getPathOfAlias(Yii::app()->params['pathUploads']).DIRECTORY_SEPARATOR.$model->archivo;
                        $model->archivo->saveAs($archivo);

                        if($model->archivo->hasError)
                            Yii::app()->user->setFlash('errorUploadFile', 'Error al subir el archivo: '.$model->archivo->error);
                    }

                    // Cargar todos los campos
                    // Desde una base de datos
                    if(!empty($model->id_conexion_bdatos)) {
                        $DBConec = ConexionBDatos::model()->getConexion($model->id_conexion_bdatos);

                        // Leemos solo un registro de la consulta ya que lo que necesitamos son el nombre de las columnas
                        $rsDatos = ConexionBDatos::model()->getQueryResult($DBConec, $model->sentencia_sql, 1);

                        if(empty($rsDatos))
                            throw new Exception('No se pudieron obtener los campos desde la consulta.');

                        // Campos enviados desde la sentencia SQL
                        $nombresCampo = array_keys($rsDatos[0]);

                        // no se aceptaran espacios ni caracteres especiales en el nombre de los campos
                        foreach($nombresCampo as $key => $value) {
                            $nombresCampo[$key] = $model->limpiarCadena($value);
                        }

                        // Campos que actualmente estan en la base de datos
                        $camposExistentes = CHtml::listData($model->Campos, 'id', 'nombre');
                        $camposEliminar = array();

                        foreach ($camposExistentes as $existente) {
                            // Si el campo que esta guardado en la base de datos
                            // no se encuentra en la lista de los nuevos campos enviados
                            if(!in_array($existente, $nombresCampo)) {
                                // quiere decir que lo tenemos que eliminar
                                $camposEliminar[] = $existente;
                            }
                        }

                        if(!empty($camposEliminar)) {
                            foreach ($camposEliminar as $eliminar) {
                                $objCampo = Campo::model()->findByAttributes(array('id_fuente_datos'=>$model->id, 'nombre'=>$eliminar));

                                $objCampo->delete();
                            }
                        }

                        // Obtenemos los campos que no estan guardados en la base de datos
                        $camposNuevos = array_diff($nombresCampo, $camposExistentes);

                        if(!empty($camposNuevos)) {
                            foreach ($camposNuevos as $strCampo) {
                                $objCampo = new Campo;
                                $objCampo->id_fuente_datos = $model->id;
                                $objCampo->nombre = $model->limpiarCadena($strCampo);

                                $objCampo->save();
                            }
                        }
                    } // Desde un archivo
                    else if(empty($_POST['archivoActual']) && !empty($archivo)) {
                        // Fuente: https://github.com/marcovtwout/yii-phpexcel
                        Yii::import('ext.phpexcel.XPHPExcel');
                        XPHPExcel::init();

                        $inputFileType = PHPExcel_IOFactory::identify($archivo);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objReader->setReadDataOnly(true);
                        $objPHPExcel = $objReader->load($archivo);
                        // La primera fila del archivo contiene el nombre de los campos
                        $datos = $objPHPExcel->getActiveSheet()->rangeToArray(
                                    'A1:'.$objPHPExcel->getActiveSheet()->getHighestColumn().'1', // Solo lee la primera fila
                                    null,true,true,true
                                );

                        if(empty($datos))
                            throw new Exception('No se pudieron obtener los campos desde el archivo.');

                        // Campos obtenidos desde el archivo
                        $nombresCampo = $datos[1];

                        // no se aceptaran espacios ni caracteres especiales en el nombre de los campos
                        foreach($nombresCampo as $key => $value) {
                            $nombresCampo[$key] = $model->limpiarCadena($value);
                        }

                        // Campos que actualmente estan en la base de datos
                        $camposExistentes = CHtml::listData($model->Campos, 'id', 'nombre');
                        $camposEliminar = array();

                        foreach ($camposExistentes as $existente) {
                            // Si el campo que esta guardado en la base de datos
                            // no se encuentra en la lista de los nuevos campos enviados
                            if(!in_array($existente, $nombresCampo)) {
                                // quiere decir que lo tenemos que eliminar
                                $camposEliminar[] = $existente;
                            }
                        }

                        if(!empty($camposEliminar)) {
                            foreach ($camposEliminar as $eliminar) {
                                $objCampo = Campo::model()->findByAttributes(array('id_fuente_datos'=>$model->id, 'nombre'=>$eliminar));

                                $objCampo->delete();
                            }
                        }

                        // Obtenemos los campos que no estan guardados en la base de datos
                        $camposNuevos = array_diff($nombresCampo, $camposExistentes);

                        if(!empty($camposNuevos)) {
                            foreach ($camposNuevos as $strCampo) {
                                $objCampo = new Campo;
                                $objCampo->id_fuente_datos = $model->id;
                                $objCampo->nombre = $model->limpiarCadena($strCampo);

                                $objCampo->save();
                            }
                        }
                    }

                    $transaction->commit();

                    $this->redirect(array('view','id'=>$model->id));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                $msjError = 'Error al actualizar la fuente de datos. '.$e->getMessage();
            }
		}

		$this->render('update',array(
			'model'=>$model,
            'msjError' => $msjError,
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
        
		$dataProvider=new CActiveDataProvider('FuenteDatos', array('criteria'=>array('order'=>'nombre ASC')) );
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
			throw new CHttpException(404,'La pagina solicitado no existe.');
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
        $directorio = opendir(YiiBase::getPathOfAlias(Yii::app()->params['pathUploads']).DIRECTORY_SEPARATOR);
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
                break;
            }
        }

        closedir($directorio);

        echo json_encode($respuesta);
	}

    /**
	 * Configura los campos de la fuente de datos
	 */
	public function actionConfigurarCampo($id)
	{
        $this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Configurar Campos';

        // Configuracion de campos enviada desde la vista por el metodo POST
        $configCampos = Yii::app()->request->getPost('Campo');
        $msgResult = '';
        $msjError = '';
        
        try {
            if(!empty($configCampos)) {
                // La configuracion de campos es un array asociativo
                // con el id del campo como llave de cada arreglo de configuracion
                foreach ($configCampos as $idCampo => $confCampo) {
                    $campo = Campo::model()->findByPk($idCampo);

                    $campo->id_tipo_campo = $confCampo['tipo'];
                    $campo->id_significado_campo = $confCampo['significado'];

                    $campo->save();
                }
                $msgResult = 'Campos configurados correctamente';
            }
        } catch(Exception $e) {
            $msgResult = 'ERROR: No se guardo las configuraciones para los campos, revise el mensaje de error.';
            $msjError = $e->getMessage();
        }

        $model = $this->loadModel($id);
        $campos = $model->Campos;

        $tipoCampo = CHtml::listData(TipoCampo::model()->findAll(), 'id', 'descripcion');
        $significadoCampo = CHtml::listData(SignificadoCampo::model()->findAll(), 'id', 'descripcion');

		$this->render('campos',array(
			'model'=>$model,
            'campos'=>$campos,
            'tipoCampo'=>$tipoCampo,
            'significadoCampo'=>$significadoCampo,
            'msgResult'=>$msgResult,
            'msjError'=>$msjError,
		));
	}

    /**
	 * Carga datos desde la fuente de datos
	 */
	public function actionCargarDatos($recargar=false)
	{
        $cadenaInsert = '';
        $respuesta = array('error'=>false, 'msjerror'=>'');

		if(isset($_POST['id_FuenteDatos']))
		{
            $model = $this->loadModel($_POST['id_FuenteDatos']);
            $respuesta = $model->cargarDatos($recargar);
		}

        if($recargar)
            return $respuesta;
        else
            echo json_encode($respuesta);
	}

    /**
	 * Devuelve un json con los campos de la fuente de datos
     * 
     * $soloCampCal Especifica si se devuelve solo los campos para calculos
	 */
	public function actionObtenerCampos($id, $soloCampCal=true)
	{
        if($id==0)
            return false;

        if(Yii::app()->request->isAjaxRequest) {
            $respuesta = array();

            try {
                $model = $this->loadModel($id);
                
                if($soloCampCal)
                    $respuesta = CHtml::listData($model->getOnlyCalculo(), 'id', 'nombre');
                else
                    $respuesta = CHtml::listData($model->Campos, 'id', 'nombre');
            } catch(Exception $e) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $e->getMessage();
            }

            echo json_encode($respuesta);
        }
        else
            return false;
	}

    /**
	 * Muestra los datos cargados desde el origen de datos
	 */
	public function actionVerDatos($id)
	{
		$this->pageTitle = Yii::app()->name.' - '.$this->title_sin.' - Ver';

        $fuenteDatos = $this->loadModel($id);
        $countDatos = $fuenteDatos->getCountDatos();
        $sqlAllDatos = $fuenteDatos->getSQLDatos();
        
		$this->render('viewDatos',array(
			'model'=>$fuenteDatos,
            'countDatos' => $countDatos,
            'sqlAllDatos' => $sqlAllDatos,
		));
	}

    /**
	 * Elimina todos los datos y los vuelve a cargar desde el origen de datos
	 */
	public function actionRecargarDatos()
	{
        $respuesta = array('error'=>false, 'msjerror'=>'');

        if(isset($_POST['id_FuenteDatos']) && Yii::app()->request->isAjaxRequest)
		{
            $fuenteDatos = $this->loadModel($_POST['id_FuenteDatos']);

            try {
                $respuesta = $fuenteDatos->cargarDatos(true);

                if($respuesta['error'])
                    throw new Exception($respuesta['msjerror']);

                $variables = $fuenteDatos->Variables;

                // Reconstruir todos los indicadores que estan asociado con la fuente de datos
                // La relacion se establece a traves de la variable
                if(count($variables)) {
                    foreach ($variables as $variable) {
                        if(count($variable->FichasTecnicas)) {
                            foreach ($variable->FichasTecnicas as $indicador) {
                                $indicador->crearIndicador(true);
                            }
                        }
                    }
                }
            } catch(Exception $e) {
                $respuesta['error'] = true;
                $respuesta['msjerror'] = $e->getMessage();
            }
        }

        echo json_encode($respuesta);
	}

}
