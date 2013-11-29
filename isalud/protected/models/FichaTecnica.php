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
 * @property boolean $es_publico
 * @property double $ponderacion
 * @property string $unidad_medida
 * @property string $meta
 * @property string $definicion
 * @property string $fundamento
 * @property string $utilidad
 *
 * The followings are the available model relations:
 * @property TipoIndicador $TipoIndicador
 * @property Clasificacion $Clasificacion
 * @property EscalaEvaluacion $EscalaEvaluacion
 * @property Periodicidad Periodicidad
 * @property FichaTecnica $FichaTecnicaPadre
 * @property FichaTecnica[] $FichaTecnicasHijas
 * @property Direccion $Direccion
 * @property Subdireccion $Subdireccion
 * @property Coordinacion $Coordinacion
 * @property ProgramaAccion $ProgramaAccion
 * @property Nivel $Nivel
 * @property TipoGrafico $TipoGrafico
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
			array('id_cat_tipo_indicador, id_cat_clasificacion, id_escala_evaluacion, id_cat_periodicidad, id_ficha_tecnica_padre, id_cat_direccion, id_cat_subdireccion, id_cat_coordinacion, id_cat_programa_accion, id_cat_nivel, es_acumulable, es_publico, id_cat_tipo_grafico', 'numerical', 'integerOnly'=>true),
			array('ponderacion', 'numerical'),
			array('nombre, formula', 'length', 'max'=>200),
			array('codigo', 'length', 'max'=>40),
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
			'FichasTecnicasHijas' => array(self::HAS_MANY, 'FichaTecnica', 'id_ficha_tecnica_padre'),
			'Direccion' => array(self::BELONGS_TO, 'Direccion', 'id_cat_direccion'),
			'Subdireccion' => array(self::BELONGS_TO, 'Subdireccion', 'id_cat_subdireccion'),
			'Coordinacion' => array(self::BELONGS_TO, 'Coordinacion', 'id_cat_coordinacion'),
			'ProgramaAccion' => array(self::BELONGS_TO, 'ProgramaAccion', 'id_cat_programa_accion'),
			'Nivel' => array(self::BELONGS_TO, 'Nivel', 'id_cat_nivel'),
            'Variables' => array(self::MANY_MANY, 'Variable', 'tbl_ficha_tecnica_variable(id_ficha_tecnica, id_variable)'),
            'FichaTecnicaVariables' => array(self::HAS_MANY, 'FichaTecnicaVariable', 'id_ficha_tecnica'),
            'TipoGrafico' => array(self::BELONGS_TO, 'TipoGrafico', 'id_cat_tipo_grafico'),
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
            'id_cat_tipo_grafico' => 'Tipo de grafico',
			'nombre' => 'Nombre',
			'codigo' => 'Código',
			'formula' => 'Formula',
            'es_acumulable' => '¿Es acumulable?',
            'es_publico' => '¿La informacion se puede difundir a la población en general?',
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
        $criteria->compare('id_cat_tipo_grafico',$this->id_cat_tipo_grafico);
		$criteria->compare('LOWER(nombre)',strtolower($this->nombre),true);
		$criteria->compare('LOWER(codigo)',strtolower($this->codigo),true);
		$criteria->compare('LOWER(formula)',strtolower($this->formula),true);
		$criteria->compare('ponderacion',$this->ponderacion);
		$criteria->compare('LOWER(unidad_medida)',strtolower($this->unidad_medida),true);
		$criteria->compare('LOWER(meta)',strtolower($this->meta),true);
		$criteria->compare('LOWER(definicion)',strtolower($this->definicion),true);
		$criteria->compare('LOWER(fundamento)',strtolower($this->fundamento),true);
		$criteria->compare('LOWER(utilidad)',strtolower($this->utilidad),true);
        $criteria->order = 'nombre ASC';

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
	 * Crear el codigo para el indicador
	 */
    public function crearCodigo()
    {
        // Eliminar todos los acentos
        $nombre = strtolower(str_replace(
                            array('á', 'é', 'í', 'ó', 'ú', 'ñ',  'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'),
                            array('a', 'e', 'i', 'o', 'u', 'ni', 'A', 'E', 'I', 'O', 'U', 'NI'),
                            $this->nombre));
        // Dividir el nombre en todas sus palabras
        $nombre = explode(' ', $nombre);
        // Eliminar cualquier elemento vacio del arreglo
        $nombre = array_filter($nombre);
        $codigo = '';

        // El codigo se formara por las tres primeras letras de cada
        // palabra del nombre concatenados con un guion bajo (_)
        foreach ($nombre as $palabra) {
            // Eliminar cualquier caracter no alfanumerico
            $palabra = preg_replace('/\W+/', '', $palabra);
            $codigo .= substr(trim($palabra), 0, 3).'_';
        }

        // La longitud maxima del codigo sera 40 caracteres
        $this->codigo = substr(substr($codigo, 0, -1), 0, 40);
    }

    /**
	 * Crea la formula para los indicadores que estan formados por indicadores
     * Se utiliza en las vistas
	 */
    public function creaFormulaIndicador()
    {
        // Es un indicador compuesto, su formula se forma a partir de
        // la suma del producto de cada indicador por su % ponderacion
        $varIndicadores = $this->FichasTecnicasHijas;
        $formula = array();

        foreach ($varIndicadores as $varInd) {
            $formula[] = '( '.$varInd->nombre.' * '.$varInd->ponderacion.'% )';
        }

        $operacionIndicador = implode(' + ', $formula);

        return $operacionIndicador;
    }

    /**
	 * Crear la tabla para el indicador
	 */
    public function crearIndicador($reconstruirTabla = false)
    {
        $respuesta = array('error'=>false, 'msjerror'=>'');
        $nombreTablaIndicador = Yii::app()->params['prefixTblIndicador'].$this->id;
        $existeTabla = true;
        $sql = ''; // Contendra varias sentencias sql que se ejecutaran al final de la funcion
        $select = ''; // Contendra la seleccion de los datos del HSTORE
        $createVariable = ''; // Contendra la sentencia para crear las tablas temporales de las variables
        $joinVariables = ''; // Guarda la sentencia sql que une todas las tablas temparales que contienen las variables
        $arregloCampos = array(); // Contendra un arreglo bidimensional de los campos de cada fuente de datos con el nombre de la variable de la formula como indice
        $arregloFuentesDatos = array(); // Contendra los IDs de las fuentes de datos de las diferentes variables
        $tblFuenteVariable = '';  // Guarda el nombre de la tabla que se crea a partir de la variable
        $dropTabla = '';

        $strVariables = '';
        $strCamposComunes = '';
        
        if(empty($this->formula) && empty($this->FichasTecnicasHijas)) {
            $respuesta['error']=true;
            $respuesta['msjerror']='Verifique la formula del indicador.';
            
            return $respuesta;
        }

        // Validar si las fuentes de datos estan mas actualizadas
        // que la informacion de la tabla del indicador
        // si es asi, es necesario reconstruir la tabla del indicador
        if(!$reconstruirTabla) {
            // Si no tiene formula, es un indicador compuesto
            if(empty($this->formula)) {
                // Si la tabla padre no tiene fecha de creacion
                // no es necesario hacer el drop
                if($this->fecha_tbl_indicador != '') {
                    $tmpIndsHijos = $this->FichasTecnicasHijas;

                    $fechaPadre = new DateTime($this->fecha_tbl_indicador);
                    $fechaHijo = '';
                    
                    // se recorren todos sus indicadores hijos
                    foreach ($tmpIndsHijos as $indicadorHijo) {
                        if($indicadorHijo->fecha_tbl_indicador != '') {
                            $fechaHijo = new DateTime($indicadorHijo->fecha_tbl_indicador);

                            if($fechaHijo > $fechaPadre) {
                                $reconstruirTabla = true;
                                break;
                            }

                            $tmpVariables = $indicadorHijo->Variables;

                            foreach ($tmpVariables as $variable) {
                                $fuenteDatos = $variable->FuenteDatos;

                                if($fuenteDatos->ultima_lectura == '') {
                                    $respuesta['error']=true;
                                    $respuesta['msjerror']='La fuente de datos '.$fuenteDatos->nombre.' no contiene datos, primero cargue datos y despues consulte el indicador';
                                    return $respuesta;
                                }

                                $fechaFuentaDatos = new DateTime($fuenteDatos->ultima_lectura);
                                $fechaTablaIndicador = new DateTime($indicadorHijo->fecha_tbl_indicador);

                                if($fechaFuentaDatos > $fechaTablaIndicador) {
                                    $reconstruirTabla = true;
                                    break;
                                }   
                            }

                            if($reconstruirTabla)
                                break;
                        }
                    }
                }
            } else {
                $tmpVariables = $this->Variables;
                // Se obtienen todas las variable que forman el indicador
                foreach ($tmpVariables as $variable) {
                    // para cada variable se obtiene su fuente de datos
                    $fuenteDatos = $variable->FuenteDatos;

                    // Si no existe la fecha de ultima lectura de la fuente de datos
                    // significa que no se han cargado datos
                    if($fuenteDatos->ultima_lectura == '') {
                        $respuesta['error']=true;
                        $respuesta['msjerror']='La fuente de datos '.$fuenteDatos->nombre.' no contiene datos, primero cargue datos y despues consulte el indicador';
                        return $respuesta;
                    }

                    $fechaFuentaDatos = new DateTime($fuenteDatos->ultima_lectura);

                    // Si no se tiene fecha de construccion del indicador
                    // significa que todavia no se ha construido la tabla del indicador
                    // por lo tanto no es necesario eliminar una tabla inexistente
                    if($this->fecha_tbl_indicador == '') {
                        $fechaTablaIndicador = new DateTime($this->fecha_tbl_indicador);

                        // Si la fecha de ultima lectura de la fuente de datos
                        // es mas reciente que la fecha de construccion del indicador
                        // significa que la informacion de la tabla del indicador debe ser actualizada
                        // por lo que es necesario regenerar la tabla indicador
                        if($fechaFuentaDatos > $fechaTablaIndicador) {
                            $reconstruirTabla = true;
                            break;
                        }
                    }
                }
            }
        }

        try {
            if($reconstruirTabla) {
                $dropTabla = 'DROP TABLE IF EXISTS '.$nombreTablaIndicador.'; '.PHP_EOL.PHP_EOL;
                //Yii::app()->db->createCommand('DROP TABLE IF EXISTS '.$nombreTablaIndicador)->execute();
                $existeTabla = false;
            } else {
                Yii::app()->db->createCommand('SELECT COUNT(*) FROM '.$nombreTablaIndicador)->query();
            }
        } catch (Exception $e) {
            $existeTabla = false;
        }

        // Si la tabla existe ya no la creamos
        if($existeTabla) {
            $respuesta['msjerror'] = 'La tabla del indicador '.$this->nombre.' ya existe';
            return $respuesta;
        }

        // Si la ficha tecnica esta compuesta por otras fichas tecnicas
        // No tendra formula ni variables asociadas
        // la formula se formara por la suma del producto de cada indicador
        // por su ponderacion
        if(empty($this->formula)) {
            $indicadoresHijos = $this->FichasTecnicasHijas;
            $arregloCamposIndicadores = array(); // Guarda un arreglo bidimensional de los campos de cada indicador con el id de la ficha tecnica como indice
            $arregloTblVarsIndicadores = array(); // Guarda un arreglo con los nombres de las tablas temporales de cada indicador hijo
            $arregloCamposVarsInds = array(); // Guarda un arreglo con los nombres de los codigos de cada indicador hijo
            $sqlIndicadoresHijos = ''; // Guarda todas las consultas para formar el indicador padre
            $createTblVarIndicador = ''; // Guarda la sentencia para crear la tabla temporal de cada indicador

            try {
                // Asegurarse que todos los indicadores esten construidos
                foreach ($indicadoresHijos as $indicadorHijo) {
                    // esto agrega soporte para tener varios niveles de
                    // dependencias entre indicadoes
                    $respuesta = $indicadorHijo->crearIndicador($reconstruirTabla);

                    if($respuesta['error']) throw new Exception($respuesta['msjerror']);

                    $arregloCamposIndicadores[$indicadorHijo->id] = $indicadorHijo->getColumsIndicador();
                }
               
                // Obtener los campos comunes de todos los indicadores relacionados con el indicador padre
                $camposComunesIndicadores = $this->array_intersect_assoc_multi($arregloCamposIndicadores, false);
                $camposComunesIndicadores = implode(', ', $camposComunesIndicadores);

                // Recorrer todos los indicadores que forman el indicador actual
                foreach ($indicadoresHijos as $indicadorHijo) {
                    $tblInidicador = Yii::app()->params['prefixTblIndicador'].$indicadorHijo->id;
                    $tblVarIndicador = Yii::app()->params['prefixTblVariable'].$tblInidicador;

                    array_push($arregloTblVarsIndicadores, $tblVarIndicador);

                    // Si el indicador no tiene codigo, asignarle uno
                    if(empty($indicadorHijo->codigo))
                        $indicadorHijo->crearCodigo();

                    $operacionIndicador = '';

                    array_push($arregloCamposVarsInds, $indicadorHijo->codigo);

                    // Construir la formula del indicador hijo
                    // Si no tiene formula
                    if(empty($indicadorHijo->formula)) {
                        // Es un indicador compuesto, su formula se forma a partir de
                        // la suma del producto de cada indicador por su % ponderacion
                        $varIndicadores = $indicadorHijo->FichasTecnicasHijas;
                        $formula = array();

                        foreach ($varIndicadores as $varInd) {
                            if(empty($varInd->codigo))
                                $varInd->crearCodigo();

                            $formula[] = ' (SUM('.$varInd->codigo.') * '.$varInd->ponderacion.' / 100) ';
                        }

                        // El codigo del indicador sirve para asignarle el nombre a la
                        // columna que contiene el calculo del indicador
                        $operacionIndicador = 'ROUND(('.implode(' + ', $formula).'), 1) AS '.$indicadorHijo->codigo;
                    } else {
                        // El codigo del indicador sirve para asignarle el nombre a la
                        // columna que contiene el calculo del indicador
                        $operacionIndicador = 'ROUND(('.$indicadorHijo->formula.'), 1) AS '.$indicadorHijo->codigo;

                        // Es un indicador formado por variables
                        foreach ($indicadorHijo->Variables as $variable) {
                            // Remplazar cada variable por la funcion SUM que es interpretada por el DBMS
                            $operacionIndicador = str_replace('['.$variable->ini_formula.']',
                                                       'SUM('.$variable->ini_formula.')',
                                                        $operacionIndicador
                                                    );
                        }
                    }

                    // Crear la tabla temporal que guarda el calculo del indicador
                    $createTblVarIndicador = ' SELECT '.$camposComunesIndicadores.', '.$operacionIndicador.'
                                        INTO TEMP '.$tblVarIndicador.'
                                        FROM '.$tblInidicador.'
                                        GROUP BY '.$camposComunesIndicadores.'; '.PHP_EOL.PHP_EOL;

                    $sqlIndicadoresHijos .= $createTblVarIndicador;
                }

                $strCamposVarsInds = implode(', ', $arregloCamposVarsInds);
                $varInd = array_shift($arregloTblVarsIndicadores);
                $CampVarInd = array_shift($arregloCamposVarsInds);

                // Construir la tabla del indicador padre
                // a partir de todos indicadores hijos
                $joinVariablesIndicadores = 'SELECT '.$camposComunesIndicadores.', '.$strCamposVarsInds. ' INTO '.
                                    $nombreTablaIndicador. ' FROM '.$varInd;
                $whereJoinVarsInds = 'WHERE '.$CampVarInd.' > 0';

                foreach ($arregloTblVarsIndicadores as $varInd) {
                    $CampVarInd = array_shift($arregloCamposVarsInds);
                    $joinVariablesIndicadores .= ' FULL OUTER JOIN '.$varInd.'
                                         USING ('.$camposComunesIndicadores.') ';
                    $whereJoinVarsInds .= ' AND '.$CampVarInd.' > 0';
                }

                $joinVariablesIndicadores = $joinVariablesIndicadores.$whereJoinVarsInds.'; ';

                $sqlIndicadoresHijos .= $joinVariablesIndicadores;
                $sqlIndicadoresHijos = $dropTabla.$sqlIndicadoresHijos;

                //echo '<br><br>'.$this->id.' - '.$this->nombre.'<br><br>';
                //echo nl2br($sqlIndicadoresHijos);
                //die();
                $transaction = Yii::app()->db->beginTransaction();
                
                $this->executeMultipleSql($sqlIndicadoresHijos);

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollback();
                $respuesta['error']=true;
                $respuesta['msjerror']='Error la tabla del indicador. '.$e->getMessage();
            }
        } else {
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
                                'CAST(datos->\''.$campoVariable->nombre.'\' AS INTEGER) > 0; '.PHP_EOL.PHP_EOL;

                    // Eliminamos la ultima coma y se agrega el cierre de la sentencia
                    $sql = trim($sql, ', ') . '); '.PHP_EOL.PHP_EOL;

                    $sql .= 'INSERT INTO '.$tblFuenteVariable.' '.$select;
                }

                $arregloFuentesDatos = array_unique($arregloFuentesDatos);

                // Si todas las variables son de la misma fuente de datos
                // y la formula contiene solo una variable
                if(count($arregloFuentesDatos) == 1 && count($variables) == 1) {
                    // Se toma la fuente de datos y apartir de ella se crea la tabla del indicador
                    $createIndicador = ' SELECT * INTO '.$nombreTablaIndicador.
                                        ' FROM '.$tblFuenteVariable.' WHERE '.$tblFuenteVariable.' > 0; ';
                    $sql .= $createIndicador;
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
                                            GROUP BY '.$strCamposComunes.'; '.PHP_EOL.PHP_EOL;

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

                $sql = $dropTabla.$sql;
                //echo nl2br($sql);
                //die();
                $this->executeMultipleSql($sql);

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollback();
                $respuesta['error']=true;
                $respuesta['msjerror']='Error la tabla del indicador. '.$e->getMessage();
            }
        }

        // Si no hay error, significa que se construyo la tabla exitosamente
        if(!$respuesta['error']) {
            // el campo fecha_tbl_indicador almacena la fecha de la
            // construccion de la tabla del indicador
            Yii::app()->db->createCommand('UPDATE tbl_ficha_tecnica SET fecha_tbl_indicador=\''.date('Y-m-d H:m:s').'\' WHERE id='.$this->id)->execute();
        }

        return $respuesta;
    }

    /**
	 * Crear la tabla para el indicador
	 */
    public function calcularIndicador($dimension, $filtros, $orden = null, $metadatos = true)
    {
        $respuesta = array('error'=>false, 'msjerror'=>'');
        $nombreTablaIndicador = Yii::app()->params['prefixTblIndicador'].$this->id;
        $strColumnas = '';
        $orderBy = '';
        $operacionIndicador = '';
        $resultado = null;
        $fuentes = array(); // Guarda la lista de todas las fuentes de datos
        $campoEtiqueta = ''; // Guarda la la etiqueta del campo dimension que se esta mostrando
        $etiquetasIndicadores = array(); // En el caso de ser un indicador compuesto, las etiquetas son los nombres de los indicadores hijos
        $columnasIndicadores = array(); // En el caso de ser un indicador compuesto, respaldar el nombre de las columnas que guardan el resultado de los indicadores hijos
        $subtitulo = '';
        $significados = CHtml::listData(SignificadoCampo::model()->findAll(), 'codigo', 'descripcion');
        $idIndicadores = array(); //En el caso de ser un indicador compuesto, almacena todos los ids de los indicadores hijos

        $columnas = $this->getColumsIndicador();

        // Validar que la dimension sea una columna del indicador
        // Una dimensión es un campo/columna de la tabla indicador
        if(!in_array($dimension, $columnas)) {
            $respuesta['error']=true;
            $respuesta['msjerror']='La dimensión '.$dimension.' no es válida';

            return $respuesta;
        }

        $camposFiltro = array_keys($filtros);

        // Validar que todos los filtros sean un campo del indicador
        foreach ($camposFiltro as $keyFil => $campFil) {
            if(!in_array($campFil, $columnas)) {
                $respuesta['error']=true;
                $respuesta['msjerror']='El filtro '.$campFil.' no es válido';

                return $respuesta;
            }
        }
        
        // Si no tiene formula
        if(empty($this->formula)) {
            // Es un indicador compuesto, su formula se forma a partir de 
            // la suma del producto de cada indicador por su % ponderacion
            $varIndicadores = $this->FichasTecnicasHijas;
            $formula = array();
            
            // Recorrer todos los indicadores hijos
            foreach ($varIndicadores as $varInd) {
                if(empty($varInd->codigo))
                    $varInd->crearCodigo();

                // Multiplicar cada indicador por su ponderacion
                $formula[] = ' (SUM('.$varInd->codigo.') * '.$varInd->ponderacion.' / 100) ';
                // El codigo del indicador es el nombre de la columna en la tabla indicador padre
                $strColumnas .= ', SUM('.$varInd->codigo.') AS '.$varInd->codigo;
                
                // Agregar el indicador como fuente de datos
                $fuentes[$varInd->id] = $varInd->nombre;
                // Agregar el nombre del indicador a la etiqueta
                $etiquetasIndicadores[] = $varInd->nombre;
                // Guardar el nombre de la columna que contiene el valor del indicador
                $columnasIndicadores[] = $varInd->codigo;
                //Guarda el id de los indicadores que lo componen
                $idIndicadores[] = $varInd->id;
            }
            
            //REVISAR. Eliminar la primera coma
            $strColumnas = ltrim($strColumnas, ', ');

            // La columna indicador es fija y contiene el resultado de la formula
            $operacionIndicador = 'ROUND(('.implode(' + ', $formula).'), 1) AS indicador';
        } else {
            // La columna indicador contiene el valor a mostrar en la grafica
            $operacionIndicador = 'ROUND(('.$this->formula.'), 1) AS indicador';
        }
        $campoSubtitulo = '';
        // El orden por default sera el resultado del indicador
        if($orden == null) {
            $orden = 'indicador';
        }
        
        // Solo se considera la dimensión para aquellos indicadores que no son compuestos
        $innerJoin = '';
        if(!empty($this->formula)) {
            // Respalda la dimension antes de ser modificada
            $resultado['dimension'] = $dimension;

            // Revisar si la dimensión hace referencia a un catalogo
            $objDimension = SignificadoCampo::model()->findByAttributes(array('codigo'=>$dimension));

            // Si la dimension es un catalogo
            if($objDimension->catalogo) {
                // La columna nombre es fija en todos los catalogos y contiene la descripcion del id al que hace referencia
                $strColumnas = 'nombre AS '.$objDimension->catalogo;
                // Todos los catalogos tienen como prefijo tblc_
                $innerJoin = ' INNER JOIN tblc_'.$objDimension->catalogo.' USING('.$objDimension->llave_primaria.') ';

                // Si la forma de ordenar es la misma que la dimension,
                // entonces ordenamos por la descripcion del catalogo
                // en este caso siempre sera la columna nombre
                if($orden == $dimension)
                    $orden = 'nombre';

                // Agregamos a la dimension el campo nombre, ya que es requerido en el group by
                $dimension .= ', nombre';
                $campoEtiqueta = $objDimension->catalogo;
                $campoSubtitulo = $objDimension->descripcion;
            } else {
                $strColumnas = $dimension;
                $campoEtiqueta = $dimension;
                $campoSubtitulo = ucfirst($dimension);
            }
        } else {
            //$strColumnas = $dimension;
            //$campoEtiqueta = $dimension;
            //$campoSubtitulo = ucfirst($dimension);
        }
        
        // Agregar los filtros al subtitulo
        foreach($filtros as $campFil => $valFil) {
            // Revisar si cada filtro hace referencia a un catalogo
            $objDimension = SignificadoCampo::model()->findByAttributes(array('codigo'=>$campFil));
            
            // Si la dimension es un catalogo
            if($objDimension->catalogo) {
                // Obtener los campos de la llave primaria del catalogo
                $llavePrimaria = explode(',', $objDimension->llave_primaria);
                // Construir el sql para obtener la descripcion del ID del catalogo
                $sqlCatalogo = 'SELECT nombre FROM tblc_'.$objDimension->catalogo.' WHERE 1=1 ';
                
                // Todos los campos de la llave primaria deben estar en el campo filtro
                foreach ($llavePrimaria as $pk) {
                    $sqlCatalogo .= ' AND '.$pk.'='.$filtros[$pk];
                }
                
                // Obtener la descripcion del filtro dentro de la tabla catalogo
                $descripcion = Yii::app()->db->createCommand($sqlCatalogo)->queryRow();
                
                $subtitulo .= $significados[$campFil].': '.$descripcion['nombre'].', ';
            } else {
                $subtitulo .= $significados[$campFil].': '.$valFil.', ';
            }
        }
        
        // Agregamos la descripcion de la dimension que se esta mostrando al subtitulo
        $subtitulo = 'Por '.$campoSubtitulo.', para '.trim($subtitulo,', ');
        
        $groupBy = ' GROUP BY '.implode(', ', $camposFiltro);
        
        // Solo se considera la dimensión para aquellos indicadores que no son compuestos
        if(!empty($this->formula)) {
            $groupBy .= ', '.$dimension;
        }
        
        $where = ' WHERE 1=1 ';
        $orderBy = ' ORDER BY '.$orden;

        // Agregar todos los filtros la consulta
        foreach ($camposFiltro as $campFil) {
            $where .= ' AND '.$campFil.' = \''.$filtros[$campFil].'\'';
        }

        $variables = $this->Variables;
        
        // Reemplazamos las variables por su respectiva operacion en formato SQL
        // Solo aplica para indicadores que tenga una formula
        foreach ($variables as $variable) {
            // Operacion para el calculo de la columna
            $strColumnas .= ', SUM('.$variable->ini_formula.') AS '.$variable->ini_formula;
            // Operacion para el calculo del indicador
            $operacionIndicador = str_replace('['.$variable->ini_formula.']',
                                       'SUM('.$variable->ini_formula.')',
                                        $operacionIndicador
                                    );
            
            // Guardar la fuente de datos de cada variable
            $fuente = $variable->FuenteDatos;
            $fuentes[$fuente->id]= $fuente->nombre;
        }

        $sql = 'SELECT '.$strColumnas.', '.$operacionIndicador.' FROM '.$nombreTablaIndicador.
                $innerJoin.$where.$groupBy.$orderBy;

        if($metadatos) {
            $resultado['datos'] = Yii::app()->db->createCommand($sql)->query()->readAll();
            $resultado['titulo'] = $this->nombre;
            $resultado['subtitulo'] = $subtitulo;
            $resultado['fuentes'] = implode(', ', $fuentes);
            $resultado['meta'] = $this->meta;
            $resultado['filtro'] = $filtros;
            $fecha = new DateTime($this->fecha_tbl_indicador);
            $resultado['fecha'] = $fecha->format('d-m-Y');
            $resultado['valores'] = array();
            $resultado['etiquetas'] = array();
            $resultado['escalaEvaluacion'] = array();
            $resultado['etiquetaY'] = $this->unidad_medida;
            $resultado['etiquetaX'] = $campoSubtitulo;
            $resultado['nivel'] = array("id" => $this->Nivel->id, "nombre" => $this->Nivel->nombre);
            $resultado['tipo_grafico'] = $this->TipoGrafico ? $this->TipoGrafico->codigo : '';
            $resultado['sql'] = $sql;
            
            // Enviar los valores y las etiquetas en un arreglo separado,
            // es necesario para la construccion de la grafica
            
            // Para los indicadores compuestos, las etiquetas son los nombres de los indicadores hijos
            if(empty($this->formula)) {
                $resultado['etiquetas'] = $etiquetasIndicadores;
                $resultado['idIndicadores'] = $idIndicadores;
                
                foreach($columnasIndicadores as $columna) {
                    array_push($resultado['valores'], floatval($resultado['datos'][0][$columna]));
                }
            } else {
                foreach($resultado['datos'] as $fila) {
                    // La columna indicador es fija y contiene el valor del indicador
                    array_push($resultado['valores'], floatval($fila['indicador']));
                    // El campo etiqueta depende de la dimension a mostrar
                    array_push($resultado['etiquetas'], $fila[$campoEtiqueta]);
                    
                }
            }
            
            $escalaEvaluacion = $this->EscalaEvaluacion;
            // Obtener todas las escalas de evaluacion
            foreach ($escalaEvaluacion->CriteriosEscalaEvaluacion as $regla) {
                $reglaEvaluacion['nombre'] = $regla->CriterioEvaluacion->nombre;
                $reglaEvaluacion['color'] = $regla->CriterioEvaluacion->color;
                $reglaEvaluacion['limite_inf'] = $regla->limite_inf;
                $reglaEvaluacion['limite_sup'] = $regla->limite_sup;
                
                array_push($resultado['escalaEvaluacion'], $reglaEvaluacion);
            }
        } else {
            $resultado = Yii::app()->db->createCommand($sql)->query()->readAll();
        }
         
        return $resultado;
    }

    /**
     * Calcula la interseccion de los arreglos internos de una arreglo bidimensional
     */
    public function array_intersect_assoc_multi($arreglo,$assoc=true)
    {
        if(!is_array($arreglo))
            return $arreglo;
        
        // Si el arreglo contiene mas de un conjunto de valores
        if(count($arreglo)>1) {
            $interseccion = array_shift($arreglo);

            foreach ($arreglo as $actual) {
                if($assoc)
                    $interseccion = array_intersect_assoc($interseccion, $actual);
                else
                    $interseccion = array_intersect($interseccion, $actual);
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
            if(in_array($variable->ini_formula, $colums))
                unset($colums[ array_search($variable->ini_formula, $colums) ]);
        }

        return $colums;
    }

    /**
     * Obtiene la lista de variables de la tabla del indicador
     */
    public function getVariablesIndicador()
    {
        $variables = array();
        $objsVariables = $this->Variables;

        // Elimina de la lista de columnas, aquellas que son variables
        foreach ($objsVariables as $variable) {
            $variables[] = $variable->ini_formula;
        }

        return $variables;
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
     * Obtiene la anterior dimension lugar de un dimension dada
     */
    public function getPrevDimLugar($dimActual)
    {
        $colums = $this->getColumsIndicador();
        $dims = Yii::app()->params['orderedColumLugar'];

        $index = array_search($dimActual, $colums);

        if(isset($colums[$index-1]))
            return $colums[$index-1];
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

    /**
     * Obtiene la anterior dimension tiempo de un dimension dada
     */
    public function getPrevDimTiempo($dimActual)
    {
        $colums = $this->getColumsIndicador();
        $dims = Yii::app()->params['orderedColumTiempo'];

        $index = array_search($dimActual, $colums);

        if(isset($colums[$index-1]))
            return $colums[$index-1];
        else
            return null;
    }

    /**
	 * Obtiene el numero total de registros de la fuente de datos
	 */
	public function getCountDatos()
	{
        $sqlCountDatos = 'SELECT COUNT(*) as totalDatos FROM ind_'.$this->id;
        try {
            $countDatos = Yii::app()->db->createCommand($sqlCountDatos)->queryScalar();
        } catch (Exception $e) {
            $countDatos = 0;
        }

		return $countDatos;
	}

    /**
	 * Obtiene el sql para mostrar todos los datos de una fuente de datos
     * Se utiliza para el CSqlDataProvider
	 */
	public function getSQLDatos()
	{
        $sqlAllDatos = 'SELECT ROW_NUMBER() OVER () AS id, * FROM ind_'.$this->id;

        return $sqlAllDatos;
	}
}
