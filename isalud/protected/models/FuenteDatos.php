<?php

/**
 * This is the model class for table "tbl_fuente_datos".
 *
 * The followings are the available columns in table 'tbl_fuente_datos':
 * @property integer $id
 * @property integer $id_conexion_bdatos
 * @property integer $id_cat_periodicidad
 * @property string $nombre
 * @property string $responsable
 * @property integer $tolerancia_actualizacion
 * @property string $descripcion
 * @property string $sentencia_sql
 * @property string $archivo
 * @property string $ultima_lectura
 * @property booblean $es_actualizacion_incremental
 *
 * The followings are the available model relations:
 * @property TblDatosOrigen[] $tblDatosOrigens
 * @property TblConexionBdatos $idConexionBdatos
 * @property TblcPeriodicidad $idCatPeriodicidad
 * @property TblCampo[] $tblCampos
 * @property TblVariable[] $tblVariables
 */
class FuenteDatos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_fuente_datos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_periodicidad, nombre, responsable', 'required'),
			array('id_conexion_bdatos, id_cat_periodicidad, es_actualizacion_incremental, tolerancia_actualizacion', 'numerical', 'integerOnly'=>true),
			array('nombre, responsable', 'length', 'max'=>45),
			array('descripcion, sentencia_sql, ultima_lectura, archivo', 'safe'),
            array('archivo', 'file', 'types'=>'xls, xlsx, csv, txt', 'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_conexion_bdatos, id_cat_periodicidad, nombre, responsable, descripcion, sentencia_sql, archivo, ultima_lectura', 'safe', 'on'=>'search'),
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
			'DatosOrigen' => array(self::HAS_MANY, 'DatosOrigen', 'id_fuente_datos'),
			'ConexionBDatos' => array(self::BELONGS_TO, 'ConexionBDatos', 'id_conexion_bdatos'),
			'Periodicidad' => array(self::BELONGS_TO, 'Periodicidad', 'id_cat_periodicidad'),
			'Campos' => array(self::HAS_MANY, 'Campo', 'id_fuente_datos'),
			'Variables' => array(self::HAS_MANY, 'Variable', 'id_fuente_datos'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_conexion_bdatos' => 'Conexión a base de datos',
			'id_cat_periodicidad' => 'Periodicidad de actualización',
			'nombre' => 'Nombre',
			'responsable' => 'Responsable',
            'tolerancia_actualizacion' => '¿Días de tolerancia para actualizacion?',
			'descripcion' => 'Descripción',
			'sentencia_sql' => 'Sentencia SQL',
			'archivo' => 'Archivo',
			'ultima_lectura' => 'Última Lectura',
            'es_actualizacion_incremental' => '¿Es actualización incremental?',
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
		$criteria->compare('id_conexion_bdatos',$this->id_conexion_bdatos);
		$criteria->compare('id_cat_periodicidad',$this->id_cat_periodicidad);
		$criteria->compare('LOWER(nombre)',strtolower($this->nombre),true);
		$criteria->compare('LOWER(responsable)',strtolower($this->responsable),true);
        
        if($this->ultima_lectura) {
            $fecha = new DateTime($this->ultima_lectura);
            $strFecha = $fecha->format('Y-m-d h:m:s');
            $criteria->addCondition('ultima_lectura >= \''.$strFecha.'\'');
        }
        
        $criteria->order = 'nombre ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>20)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FuenteDatos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
	 * Limpia la cadena de cualquier caracter no alfanumerico,
     * elimina los acentos y espacios
	 */
    public function limpiarCadena($cadena)
    {
        $strLimpia = preg_replace('/\s+/', ' ', trim($cadena));
        // Eliminar todos los acentos y espacios
        $strLimpia = strtolower(str_replace(
                            array('á', 'é', 'í', 'ó', 'ú', 'ñ',  'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', ' '),
                            array('a', 'e', 'i', 'o', 'u', 'ni', 'A', 'E', 'I', 'O', 'U', 'NI', '_'),
                            $strLimpia));
        
        $strLimpia = preg_replace('/\W+/', '', $strLimpia);
     
        return $strLimpia;
    }

    /**
	 * Carga datos desde la fuente de datos
	 */
	public function cargarDatos($recargar=false)
	{
        $cadenaInsert = '';
        $respuesta = array('error'=>false, 'msjerror'=>'');
        $arrayCampos = array();

        $transaction = null;
        try {
            $transaction = Yii::app()->db->beginTransaction();
            
            // validar que todos los campos este configurados correctamente
            $campos = $this->Campos;

            foreach ($campos as $campo) {
                if(!$campo->SignificadoCampo) {
                    throw new Exception('Los campos no estan configurados correctamente. El campo '.
                                             $campo->nombre.' no tiene asignado un significado.');
                }

                if(!$campo->TipoCampo) {
                    throw new Exception('Los campos no estan configurados correctamente. El campo '.
                                             $campo->nombre.' no tiene asignado un tipo de dato.');
                }
                
                $arrayCampos[$campo->SignificadoCampo->codigo] = $campo->nombre;
            }
            
            // Si la opcion es recargar
            // o la actualizacion no es incremental
            // Debemos eliminar los datos actuales de la fuente de datos
            if($recargar || !$this->es_actualizacion_incremental) {
                $delete = 'DELETE FROM tbl_datos_origen WHERE id_fuente_datos='.$this->id;
                $command = Yii::app()->db->createCommand($delete);
                $command->execute();
            }

            // Cargar todos los campos
            // ****************************
            //   Desde una base de datos
            // ****************************
            if($this->id_conexion_bdatos) {
                $DBConec = ConexionBDatos::model()->getConexion($this->id_conexion_bdatos);
                
                $sql = '';
                if($this->es_actualizacion_incremental) {
                    $where = 'WHERE 1=1 ';
                    $ordenTiempo = Yii::app()->params['orderedColumTiempo'];
                    
                    $maxCampoSuperior = '';
                    $maxValorSuperior = null;
                    $sqlCampoSuperior = '';
                    
                    $maxCampoInferior = '';
                    $maxValorInferior = null;
                    $sqlCampoInferior = '';

                    foreach ($ordenTiempo as $tiempo) {
                        if(empty($maxCampoSuperior)) {
                            if(array_key_exists($tiempo, $arrayCampos)) {
                                $maxCampoSuperior = $tiempo;
                                $sqlCampoSuperior = $arrayCampos[$tiempo];
                            }
                        }

                        if(array_key_exists($tiempo, $arrayCampos)) {
                            $maxCampoInferior = $tiempo;
                            $sqlCampoInferior = $arrayCampos[$tiempo];
                        }
                    }

                    $sqlAux = 'SELECT 
                                MAX(CAST(datos->\''.$maxCampoSuperior.'\' AS INTEGER)) AS val_superior,
                                MAX(CAST(datos->\''.$maxCampoInferior.'\' AS INTEGER)) AS val_inferior
                            FROM tbl_datos_origen WHERE id_fuente_datos = '.$this->id;

                    $result = Yii::app()->db->createCommand($sqlAux)->queryRow();

                    if( !empty($result) ) {
                        $maxValorSuperior = $result['val_superior'];
                        $maxValorInferior = $result['val_inferior'];

                        if($maxCampoSuperior == 'anio' && $maxCampoInferior == 'mes' && $maxValorInferior == 12) {
                            $maxValorInferior = 0;
                        } else if($maxCampoSuperior == 'anio' && $maxCampoInferior == 'semana' && $maxValorInferior == 52) {
                            $maxValorInferior = 0;
                        } else if($maxCampoSuperior == 'anio' && $maxCampoInferior == 'quincena' && $maxValorInferior == 26) {
                            $maxValorInferior = 0;
                        } else if($maxCampoSuperior == 'anio' && $maxCampoInferior == 'bimestre' && $maxValorInferior == 6) {
                            $maxValorInferior = 0;
                        } else if($maxCampoSuperior == 'anio' && $maxCampoInferior == 'trimestre' && $maxValorInferior == 4) {
                            $maxValorInferior = 0;
                        } else if($maxCampoSuperior == 'anio' && $maxCampoInferior == 'cuatrimestre' && $maxValorInferior == 3) {
                            $maxValorInferior = 0;
                        } else if($maxCampoSuperior == 'anio' && $maxCampoInferior == 'semestre' && $maxValorInferior == 2) {
                            $maxValorInferior = 0;
                        }

                        if($maxCampoSuperior == $maxCampoInferior) {
                            $maxCampoInferior = null;
                            $maxValorInferior = null;
                        }
                    }
                    
                    if(!empty($maxValorSuperior))
                        $where .= ' AND '.$sqlCampoSuperior.'>'.$maxValorSuperior;

                    if(!empty($maxValorInferior)) {
                        $where .= ' OR ('.$sqlCampoSuperior.'='.$maxValorSuperior.' AND '
                                .$sqlCampoInferior.'>'.$maxValorInferior.')';
                    }
                    
                    $sql = 'SELECT * FROM (' . $this->sentencia_sql . ') AS sqlOriginal '.$where;
                } else {
                    $sql = $this->sentencia_sql;
                }
                
                $rsDatos = ConexionBDatos::model()->getQueryResult($DBConec, $sql);

               /* if(empty($rsDatos))
                    throw new Exception('No se pudieron obtener los datos desde la consulta.');*/

                if(!empty($rsDatos)) {
                    foreach ($rsDatos as $fila) {
                        $cadenaInsert .= '('.$this->id.',\'';
                        foreach ($fila as $campo => $valor) {
                            // no se aceptaran espacios ni caracteres especiales en el nombre de los campos
                            $campo = $this->limpiarCadena($campo);

                            // Revisar si la codificación del caracter es utf-8, si no los es hay que convertirlo
                            $valor = mb_check_encoding($valor, 'UTF-8') ? $valor : utf8_encode(trim($valor));
                            $cadenaInsert .= $campo.'=>"'.$valor.'",';
                        }
                        // Eliminar la ultima coma (,)
                        $cadenaInsert = substr($cadenaInsert, 0, -1);
                        $cadenaInsert .= '\'),';
                    }

                    // Eliminar la ultima coma (,)
                    $cadenaInsert = substr($cadenaInsert, 0, -1);

                    $sqlInsert = 'INSERT INTO tbl_datos_origen(id_fuente_datos, datos) VALUES '.$cadenaInsert;
                    $command = Yii::app()->db->createCommand($sqlInsert);
                    $command->execute();
                }
            }
            // ***********************
            //     Desde un archivo
            // ***********************
            else if($this->archivo) {
                // Fuente: https://github.com/marcovtwout/yii-phpexcel
                Yii::import('ext.phpexcel.XPHPExcel');
                XPHPExcel::init();

                $archivo = YiiBase::getPathOfAlias(Yii::app()->params['pathUploads']).DIRECTORY_SEPARATOR.$this->archivo;

                $inputFileType = PHPExcel_IOFactory::identify($archivo);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($archivo);

                // La primera fila del archivo contiene el nombre de los campos
                $datos = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                if(empty($datos))
                    throw new Exception('No se pudieron obtener los datos desde el archivo.');
                
                $nombreCampo = array_shift($datos);
                $nombreCampo = array_filter($nombreCampo);
                //$noColumnas = count($nombreCampo);
                
                // no se aceptaran espacios ni caracteres especiales en el nombre de los campos
                foreach($nombreCampo as $key => $value) {
                    $nombreCampo[$key] = $this->limpiarCadena($value);
                }

                foreach ($datos as $fila) {
                    $cadenaInsert .= '('.$this->id.',\'';
                    foreach ($fila as $campo => $valor) {
                        if(!empty($campo) && !empty($valor)) {
                            // Revisar si la codificación del caracter es utf-8, si no los es hay que convertirlo
                            $valor = mb_check_encoding($valor, 'UTF-8') ? $valor : utf8_encode(trim($valor));
                            $cadenaInsert .= $nombreCampo[$campo].'=>"'.$valor.'",';
                        }
                    }
                    // Eliminar la ultima coma (,)
                    $cadenaInsert = substr($cadenaInsert, 0, -1);
                    $cadenaInsert .= '\'),';
                }

                // Eliminar la ultima coma (,)
                $cadenaInsert = substr($cadenaInsert, 0, -1);

                $sqlInsert = 'INSERT INTO tbl_datos_origen(id_fuente_datos, datos) VALUES '.$cadenaInsert;
                $command = Yii::app()->db->createCommand($sqlInsert);
                $command->execute();
            }

            Yii::app()->db->createCommand('UPDATE tbl_fuente_datos SET ultima_lectura=\''.date('Y-m-d H:m:s').'\' WHERE id='.$this->id)->execute();

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            $respuesta['error']=true;
            $respuesta['msjerror']=$e->getMessage();
        }
		
        return $respuesta;
	}

    /**
	 * Devuelve todos los campos que no sean variables
	 */
	public function getOnlyCampos()
	{
        $campos = $this->Campos;

        foreach ($campos as $index => $campo) {
            if($campo->Variable) { // Si el campo es una variable
                unset($campos[$index]); // Lo eliminamos del arreglo
            }
        }

        return $campos;
	}
    
    /**
	 * Devuelve todos los campos que tengan como significado "Campo para formula"
	 */
	public function getOnlyCalculo()
	{
        $campos = $this->Campos;

        foreach ($campos as $index => $campo) {
            if($campo->id_significado_campo != 1 || $campo->Variable) { // Si el campo no es un "Campo para formula"
                unset($campos[$index]); // Lo eliminamos del arreglo
            }
        }

        return $campos;
	}

    /**
	 * Obtiene el numero total de registros de la fuente de datos
	 */
	public function getCountDatos()
	{
        $sqlCountDatos = 'SELECT COUNT(id) as totalDatos FROM tbl_datos_origen WHERE id_fuente_datos='.$this->id;
		//die($sqlCountDatos);
        $countDatos = Yii::app()->db->createCommand($sqlCountDatos)->queryScalar();

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
        $sqlAllDatos = 'SELECT ROW_NUMBER() OVER () AS id, ';
        $campos = $this->Campos;

        // Construye el sql a partir de todos los campos
        foreach ($campos as $campo) {
            $sqlAllDatos .= ' CAST(datos->\''.$campo->nombre.'\' AS '.$campo->TipoCampo->codigo.') AS '.$campo->nombre.', ';
        }

        // Eliminamos la ultima coma
        $sqlAllDatos = trim($sqlAllDatos, ', ');

        $sqlAllDatos .= ' FROM tbl_datos_origen WHERE id_fuente_datos='.$this->id;
		//die($sqlAllDatos);
        return $sqlAllDatos;
	}
}
