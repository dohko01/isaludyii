<?php

/**
 * This is the model class for table "tbl_ficha_tecnica".
 *
 * The followings are the available columns in table 'tbl_ficha_tecnica':
 * @property integer $id
 * @property integer $id_cat_tipo_indicador
 * @property integer $id_cat_clasificacion
 * @property integer $id_escala_evaluacion
 * @property integer $id_cat_periodicidad
 * @property integer $id_ficha_tecnica_padre
 * @property integer $id_cat_direccion
 * @property integer $id_cat_subdireccion
 * @property integer $id_cat_coordinacion
 * @property integer $id_cat_programa_accion
 * @property integer $id_cat_nivel
 * @property string $nombre
 * @property string $codigo
 * @property string $formula
 * @property boolean $es_acumulable
 * @property double $ponderacion
 * @property string $unidad_medida
 * @property string $meta
 * @property string $definicion
 * @property string $fundamento
 * @property string $utilidad
 *
 * The followings are the available model relations:
 * @property TblcTipoIndicador $idCatTipoIndicador
 * @property TblcClasificacion $idCatClasificacion
 * @property TblEscalaEvaluacion $idEscalaEvaluacion
 * @property TblcPeriodicidad $idCatPeriodicidad
 * @property FichaTecnica $idFichaTecnicaPadre
 * @property FichaTecnica[] $tblFichaTecnicas
 * @property TblcDireccion $idCatDireccion
 * @property TblcSubdireccion $idCatSubdireccion
 * @property TblcCoordinacion $idCatCoordinacion
 * @property TblcProgramaAccion $idCatProgramaAccion
 * @property TblcNivel $idCatNivel
 */
class FichaTecnica extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_ficha_tecnica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_tipo_indicador, id_cat_clasificacion, id_escala_evaluacion, id_cat_periodicidad, id_cat_direccion, id_cat_nivel, nombre, unidad_medida', 'required'),
			array('id_cat_tipo_indicador, id_cat_clasificacion, id_escala_evaluacion, id_cat_periodicidad, id_ficha_tecnica_padre, id_cat_direccion, id_cat_subdireccion, id_cat_coordinacion, id_cat_programa_accion, id_cat_nivel, es_acumulable', 'numerical', 'integerOnly'=>true),
			array('ponderacion', 'numerical'),
			array('nombre, formula', 'length', 'max'=>200),
			array('codigo', 'length', 'max'=>15),
			array('unidad_medida, meta', 'length', 'max'=>20),
			array('definicion, fundamento, utilidad', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cat_tipo_indicador, id_cat_clasificacion, id_escala_evaluacion, id_cat_periodicidad, id_ficha_tecnica_padre, id_cat_direccion, id_cat_subdireccion, id_cat_coordinacion, id_cat_programa_accion, id_cat_nivel, nombre, codigo, formula, ponderacion, unidad_medida, meta, definicion, fundamento, utilidad', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'TipoIndicador' => array(self::BELONGS_TO, 'TipoIndicador', 'id_cat_tipo_indicador'),
			'Clasificacion' => array(self::BELONGS_TO, 'Clasificacion', 'id_cat_clasificacion'),
			'EscalaEvaluacion' => array(self::BELONGS_TO, 'EscalaEvaluacion', 'id_escala_evaluacion'),
			'Periodicidad' => array(self::BELONGS_TO, 'Periodicidad', 'id_cat_periodicidad'),
			'FichaTecnicaPadre' => array(self::BELONGS_TO, 'FichaTecnica', 'id_ficha_tecnica_padre'),
			'FichasTecnicas' => array(self::HAS_MANY, 'FichaTecnica', 'id_ficha_tecnica_padre'),
			'Direccion' => array(self::BELONGS_TO, 'Direccion', 'id_cat_direccion'),
			'Subdireccion' => array(self::BELONGS_TO, 'Subdireccion', 'id_cat_subdireccion'),
			'Coordinacion' => array(self::BELONGS_TO, 'Coordinacion', 'id_cat_coordinacion'),
			'ProgramaAccion' => array(self::BELONGS_TO, 'ProgramaAccion', 'id_cat_programa_accion'),
			'Nivel' => array(self::BELONGS_TO, 'Nivel', 'id_cat_nivel'),
            'Variables' => array(self::MANY_MANY, 'Variable', 'tbl_ficha_tecnica_variable(id_ficha_tecnica, id_variable)'),
            'FichaTecnicaVariables' => array(self::HAS_MANY, 'FichaTecnicaVariable', 'id_ficha_tecnica'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_cat_tipo_indicador' => 'Tipo de indicador',
			'id_cat_clasificacion' => 'Clasificación',
			'id_escala_evaluacion' => 'Escala de evaluación',
			'id_cat_periodicidad' => 'Periodicidad de evaluación',
			'id_ficha_tecnica_padre' => 'Indicador al que pertenece',
			'id_cat_direccion' => 'Dirección',
			'id_cat_subdireccion' => 'Subdirección',
			'id_cat_coordinacion' => 'Coordinación',
			'id_cat_programa_accion' => 'Programa de acción',
			'id_cat_nivel' => 'Nivel del indicador',
			'nombre' => 'Nombre',
			'codigo' => 'Código',
			'formula' => 'Formula',
            'es_acumulable' => '¿Es acumulable?',
			'ponderacion' => 'Ponderación (%)',
			'unidad_medida' => 'Unidad de medida',
			'meta' => 'Meta institucional',
			'definicion' => 'Definición',
			'fundamento' => 'Fundamento técnico científico',
			'utilidad' => 'Utilidad',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_cat_tipo_indicador',$this->id_cat_tipo_indicador);
		$criteria->compare('id_cat_clasificacion',$this->id_cat_clasificacion);
		$criteria->compare('id_escala_evaluacion',$this->id_escala_evaluacion);
		$criteria->compare('id_cat_periodicidad',$this->id_cat_periodicidad);
		$criteria->compare('id_ficha_tecnica_padre',$this->id_ficha_tecnica_padre);
		$criteria->compare('id_cat_direccion',$this->id_cat_direccion);
		$criteria->compare('id_cat_subdireccion',$this->id_cat_subdireccion);
		$criteria->compare('id_cat_coordinacion',$this->id_cat_coordinacion);
		$criteria->compare('id_cat_programa_accion',$this->id_cat_programa_accion);
		$criteria->compare('id_cat_nivel',$this->id_cat_nivel);
		$criteria->compare('LOWER(nombre)',strtolower($this->nombre),true);
		$criteria->compare('LOWER(codigo)',strtolower($this->codigo),true);
		$criteria->compare('LOWER(formula)',strtolower($this->formula),true);
		$criteria->compare('ponderacion',$this->ponderacion);
		$criteria->compare('LOWER(unidad_medida)',strtolower($this->unidad_medida),true);
		$criteria->compare('LOWER(meta)',strtolower($this->meta),true);
		$criteria->compare('LOWER(definicion)',strtolower($this->definicion),true);
		$criteria->compare('LOWER(fundamento)',strtolower($this->fundamento),true);
		$criteria->compare('LOWER(utilidad)',strtolower($this->utilidad),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FichaTecnica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
	 * Crear la tabla para el indicador
	 */
    public function crearIndicador()
    {
        $respuesta = array('error'=>false, 'msjerror'=>'');
        $nombreTablaIndicador = Yii::app()->params['prefixTblIndicador'].$this->id;
        $existeTabla = true;
        $sql = ''; // Contendra varias sentencias sql que se ejecutaran al final de la funcion
        $select = ''; // Contendra la seleccion de los datos del HSTORE
        $createVariable = ''; // Contendra la sentencia para crear las tablas temporales de las variables
        $joinVariables = ''; // Guarda la sentencia sql que une todas las tablas temparales que contienen las variables
        $arregloCampos = array(); // Contendra un arreglo bidimensional de los campos con el nombre de la variable de la formula como indice
        $arregloFuentesDatos = array(); // Contendra los IDs de las fuentes de datos de las diferentes variables

        $strVariables = '';
        $strCamposComunes = '';

        try {
            Yii::app()->db->createCommand('SELECT COUNT(*) FROM '.$nombreTablaIndicador)->query();
        } catch (Exception $e) {
            $existeTabla = false;
        }

        // Si la tabla existe ya no la creamos
        if($existeTabla) {
            $respuesta['msjerror'] = 'La tabla del indicador ya existe';
            return $respuesta;
        }
        
        $transaction = Yii::app()->db->beginTransaction();
        
        try {
            $variables = $this->Variables;
            // Se obtienen todas las variable que forman el indicador
            foreach ($variables as $variable) {
                $fuenteDatos = $variable->FuenteDatos;
                array_push($arregloFuentesDatos, $fuenteDatos->id);

                // Dado a que una fuente de datos puede tener muchas variables
                // se obtienen solo los campos que no son variables
                $campos = $fuenteDatos->getOnlyCampos();

                // El nombre de la tabla temporal que se creara sera determinado por el nombre de la variable para formula
                $tblFuenteVariable = strtolower($variable->ini_formula);
                $sql .= 'CREATE TEMP TABLE IF NOT EXISTS '.$tblFuenteVariable .' ( ';
                $select = 'SELECT ';

                // Para cada variable se obtiene sus campos
                foreach ($campos as $campo) {
                    $sql .= $campo->SignificadoCampo->codigo.' '.$campo->TipoCampo->codigo.', ';
                    $select .= ' CAST(datos->\''.$campo->nombre.'\' AS '.$campo->TipoCampo->codigo.') AS '.$campo->SignificadoCampo->codigo.', ';

                    $arregloCampos[$variable->ini_formula][$campo->SignificadoCampo->codigo] = $campo->TipoCampo->codigo;
                }

                // Al final se obtiene el campo al que corresponde la variable
                $campoVariable = $variable->Campo;
                
                $sql .= $variable->ini_formula.' '.$campoVariable->TipoCampo->codigo.', ';
                $select .= ' CAST(datos->\''.$campoVariable->nombre.'\' AS '.$campoVariable->TipoCampo->codigo.') AS '.$variable->ini_formula.', ';

                // Eliminamos la ultima coma y se agrega el cierre de la sentencia
                $select = trim($select, ', ').' FROM tbl_datos_origen WHERE 
                            id_fuente_datos = '.$fuenteDatos->id.' AND '.
                            'CAST(datos->\''.$campoVariable->nombre.'\' AS INTEGER) > 0; '.PHP_EOL;

                // Eliminamos la ultima coma y se agrega el cierre de la sentencia
                $sql = trim($sql, ', ') . '); '.PHP_EOL;

                $sql .= 'INSERT INTO '.$tblFuenteVariable.' '.$select;
            }

            $arregloFuentesDatos = array_unique($arregloFuentesDatos);

            // Si todas las variables son de la misma fuente de datos
            if(count($arregloFuentesDatos) == 1) {
                // Se toma la fuente de datos y apartir de ella se crea la tabla del indicador
            } else {
                // Devuelve los campos comunes de todas las fuentes de datos donde se encuentran las variables
                // Los campos deben ser igual tanto en significado como en tipo
                // El arreglo devuelto es asociativo de la forma significadoCampo => tipoCampo
                $camposComunes = $this->array_intersect_assoc_multi($arregloCampos);
                $strCamposComunes = implode(', ', array_keys($camposComunes));

                $arrayVariables = array_keys($arregloCampos);
                $strVariables = implode(', ', $arrayVariables);

                // Recorre nuevamente las variables para crear las tablas de las variables
                // a partir de los campos comunes
                foreach ($variables as $variable) {
                    $tblVariable = Yii::app()->params['prefixTblVariable'].strtolower($variable->ini_formula);

                    $createVariable = ' SELECT '.$strCamposComunes.', SUM('.$variable->ini_formula.') AS '.$variable->ini_formula.'
                                        INTO TEMP '.$tblVariable.'
                                        FROM '.$variable->ini_formula.'
                                        GROUP BY '.$strCamposComunes.'; '.PHP_EOL;
                    
                    $sql .= $createVariable;
                }

                $primeraVariable = array_shift($arrayVariables);
                $joinVariables = 'SELECT '.$strCamposComunes.', '.$strVariables. ' INTO '.
                                    $nombreTablaIndicador. ' FROM '.Yii::app()->params['prefixTblVariable'].$primeraVariable;
                $whereJoin = 'WHERE '.$primeraVariable.' > 0';

                foreach ($arrayVariables as $var) {
                    $joinVariables .= ' FULL OUTER JOIN '.Yii::app()->params['prefixTblVariable'].$var.
                                        ' USING ('.$strCamposComunes.') ';
                    $whereJoin .= ' AND '.$var.' > 0';
                }

                $joinVariables = $joinVariables.$whereJoin.'; ';

                $sql .= $joinVariables;
            }
            
            //echo $sql;
            //die();
            $this->executeMultipleSql($sql);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            $respuesta['error']=true;
            $respuesta['msjerror']='Error la tabla del indicador. '.$e->getMessage();
        }

        return $respuesta;
    }

    /**
	 * Crear la tabla para el indicador
	 */
    public function calcularIndicador($dimension, $filtros, $orden)
    {
        $respuesta = array('error'=>false, 'msjerror'=>'');
        $nombreTablaIndicador = Yii::app()->params['prefixTblIndicador'].$this->id;
        $operacionIndicador = 'ROUND(('.$this->formula.'), 1) AS indicador';

        $columnas = $this->getColumsIndicador();

        if(!in_array($dimension, $columnas)) {
            $respuesta['error']=true;
            $respuesta['msjerror']='La dimensión '.$dimension.' no es válida';

            return $respuesta;
        }

        $camposFiltro = array_keys($filtros);

        foreach ($camposFiltro as $campFil) {
            if(!in_array($campFil, $columnas)) {
                $respuesta['error']=true;
                $respuesta['msjerror']='El filtro '.$campFil.' no es válido';

                return $respuesta;
            }
        }

        //$strColumnas = implode(', ', $columnas);
        $strColumnas = implode(', ', $camposFiltro).', '.$dimension;
        $groupBy = ' GROUP BY '.$strColumnas;
        $orderBy = ' ORDER BY '.$orden;
        $where = ' WHERE 1=1 ';

        foreach ($camposFiltro as $campFil) {
            $where .= ' AND '.$campFil.' = \''.$filtros[$campFil].'\'';
        }

        $variables = $this->Variables;
        
        foreach ($variables as $variable) {
            $strColumnas .= ', SUM('.$variable->ini_formula.') AS '.$variable->ini_formula;
            $operacionIndicador = str_replace('['.$variable->ini_formula.']',
                                       'SUM('.$variable->ini_formula.')',
                                        $operacionIndicador
                                    );
        }

        echo 'SELECT '.$strColumnas.', '.$operacionIndicador.' FROM '.$nombreTablaIndicador.$where.$groupBy.$orderBy;
        
        die();
    }

    /**
     * Calcula la interseccion de los arreglos internos de una arreglo bidimensional
     */
    public function array_intersect_assoc_multi($arreglo)
    {
        if(!is_array($arreglo))
            return $arreglo;
        
        // Si el arreglo contiene mas de un conjunto de valores
        if(count($arreglo)>1) {
            $interseccion = null;
            $primero = array_shift($arreglo);

            foreach ($arreglo as $actual) {
                $interseccion = array_intersect_assoc($primero, $actual);

                $primero = $actual;
            }

            return $interseccion;
        } else {
            return $arreglo;
        }
        
    }

    /**
     * Ejecuta multiples consultas dentro de una cadena separa por punto y coma (;)
     * 
     * Fuente: http://www.yiiframework.com/forum/index.php/topic/39970-transaction-and-multiple-queries-in-one-string-with-pdo-mysql-solved/
     */
    public function executeMultipleSql($multiQuery)
    {
        // split multi-query-string by "semicolon and newline with or not comment"
        $arrQuery = mb_split(';\s*?(-- )?.*?\n',$multiQuery);

        $conn = Yii::app()->db;
        /*$transaction = $conn->beginTransaction();
        try
        {*/
            foreach($arrQuery as $query) {
                if (strlen(trim($query)) > 0) {
                    $conn->createCommand($query)->execute();
                }
            }
            /*$transaction->commit();
        }
        catch (Exception $e)
        {
            $transaction->rollback();
            throw $e;
        }*/
        return true;
    }

    /**
     * Obtiene la lista de columnas, que no son variables, de la tabla del indicador
     */
    public function getColumsIndicador()
    {
        $query = 'SELECT * FROM '.Yii::app()->params['prefixTblIndicador'].$this->id.' LIMIT 1';
        $result = Yii::app()->db->createCommand($query)->queryRow();
        $colums = array_keys($result);
        $variables = $this->Variables;
        // Elimina de la lista de columnas, aquellas que son variables
        foreach ($variables as $variable) {
            unset($colums[ array_search($variable->ini_formula, $colums) ]);
        }

        return $colums;
    }

    /**
     * Obtiene la dimension lugar mayor
     */
    public function getMaxDimLugar()
    {
        $colums = $this->getColumsIndicador();
        $dims = Yii::app()->params['orderedColumLugar'];

        foreach($dims as $d) {
            if(in_array($d, $colums))
                return $d;
        }
    }

    /**
     * Obtiene la dimension lugar menor
     */
    public function getMinDimLugar()
    {
        $colums = $this->getColumsIndicador();
        $dims = array_reverse(Yii::app()->params['orderedColumLugar'], true);

        foreach($dims as $d) {
            if(in_array($d, $colums))
                return $d;
        }
    }

    /**
     * Obtiene la siguiente dimension lugar de un dimension dada
     */
    public function getNextDimLugar($dimActual)
    {
        $colums = $this->getColumsIndicador();
        $dims = Yii::app()->params['orderedColumLugar'];

        $index = array_search($dimActual, $colums);

        if(isset($colums[$index+1]))
            return $colums[$index+1];
        else
            return null;
    }

    /**
     * Obtiene la dimension tiempo mayor
     */
    public function getMaxDimTiempo() 
    {
        $colums = $this->getColumsIndicador();
        $dims = Yii::app()->params['orderedColumTiempo'];

        foreach($dims as $d) {
            if(in_array($d, $colums))
                return $d;
        }
    }

    /**
     * Obtiene la dimension tiempo menor
     */
    public function getMinDimTiempo()
    {
        $colums = $this->getColumsIndicador();
        $dims = array_reverse(Yii::app()->params['orderedColumTiempo'], true);

        foreach($dims as $d) {
            if(in_array($d, $colums))
                return $d;
        }
    }

    /**
     * Obtiene la siguiente dimension tiempo de un dimension dada
     */
    public function getNextDimTiempo($dimActual)
    {
        $colums = $this->getColumsIndicador();
        $dims = Yii::app()->params['orderedColumTiempo'];

        $index = array_search($dimActual, $colums);

        if(isset($colums[$index+1]))
            return $colums[$index+1];
        else
            return null;
    }
}
