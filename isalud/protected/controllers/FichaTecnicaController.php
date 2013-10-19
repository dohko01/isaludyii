<?php

class FichaTecnicaController extends Controller
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
	public $title_sin = 'Ficha Técnica';

	/**
	 * Titulo plural para breadcrumb y encabezado
	 *     
	 * @var string 
	 */
	public $title_plu = 'Fichas Técnicas';

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
        
        $msjError = '';
		$model=new FichaTecnica;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FichaTecnica']))
		{
            $transaction = null;

            try {
                $model->attributes=$_POST['FichaTecnica'];
                $transaction = Yii::app()->db->beginTransaction();

                $this->validateVariables($model);

                if($model->save()) {
                    
                    $variables = $_POST['FichaTecnica']['Variables'];

                    if(!empty($variables)) {
                        foreach($variables as $var) {
                            $objVar = new FichaTecnicaVariable;

                            $objVar->id_ficha_tecnica = $model->id;
                            $objVar->id_variable = $var;

                            $objVar->save();
                        }
                    }
                    $transaction->commit();
                    $this->redirect(array('view','id'=>$model->id));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                $msjError = $e->getMessage();
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
		$this->pageTitle = $this->title_sin.' - Actualizar';
        
        $msjError = '';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FichaTecnica']))
		{
            $transaction = null;

            try {
                $model->attributes=$_POST['FichaTecnica'];
                $transaction = Yii::app()->db->beginTransaction();

                $this->validateVariables($model);
                
                if($model->save()) {
                    FichaTecnicaVariable::model()->deleteAllByAttributes(array('id_ficha_tecnica'=>$model->id));

                    $variables = $_POST['FichaTecnica']['Variables'];

                    if(!empty($variables)) {
                        foreach($variables as $var) {
                            $objVar = new FichaTecnicaVariable;

                            $objVar->id_ficha_tecnica = $model->id;
                            $objVar->id_variable = $var;

                            $objVar->save();
                        }
                    }

                    $transaction->commit();
                    $this->redirect(array('view','id'=>$model->id));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                $msjError = 'Error al crear la fuente de datos. '.$e->getMessage();
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
        
		$dataProvider=new CActiveDataProvider('FichaTecnica');
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
        
		$model=new FichaTecnica('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FichaTecnica']))
			$model->attributes=$_GET['FichaTecnica'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FichaTecnica the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FichaTecnica::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La pagina solicitada no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FichaTecnica $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ficha-tecnica-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /**
     * Validar que todas las variables de la formula esten seleccionadas
     */
    private function validateVariables($model)
    {
        // Variables contenidas en la formula
        $vars_formula = array();
        // Variables seleccionadas en la lista
        $vars_select = explode(',',$_POST['variablesSeleccionadas']);

        // Elimina dobles espacios
        $model->formula = preg_replace('/\s+/', ' ', $model->formula);

        //preg_match_all('/(\[[a-z0-9\_\-]+\])/', $model->formula, $vars_formula);
        preg_match_all('/\[[a-z0-9\_\-]{1,}\]/', $model->formula, $vars_formula);

        $trimVars = function(&$elemento, &$clave) {
            $elemento = trim($elemento);
        };
        // Eliminar espacios en blanco de las variables
        array_walk_recursive($vars_formula, $trimVars);
        array_walk_recursive($vars_select, $trimVars);

        // Revisar si existe alguna variable que esta en la formula y que no este seleccionada
        $difVars = array_diff($vars_formula[0], $vars_select);

        if(count($difVars)) {
            $model->addError('Variables', 'Debe seleccionar todas las variables a utilizar en la formula');
            $model->addError('formula', 'La formula contiene variables que no estan seleccionadas');
            throw new Exception();
        }
    }
}
