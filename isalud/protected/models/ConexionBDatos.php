<?php

/**
 * This is the model class for table "tbl_conexion_bdatos".
 *
 * The followings are the available columns in table 'tbl_conexion_bdatos':
 * @property integer $id
 * @property integer $id_motor_bdatos
 * @property string $nombre
 * @property integer $puerto
 * @property string $instancia
 * @property string $direccion
 * @property string $usuario
 * @property string $pass
 * @property string $base_datos
 * @property string $comentarios
 *
 * The followings are the available model relations:
 * @property TblcMotorBdatos $idMotorBdatos
 * @property TblFuenteDatos[] $tblFuenteDatoses
 */
class ConexionBDatos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_conexion_bdatos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_motor_bdatos, nombre, usuario, pass, base_datos', 'required'),
			array('id_motor_bdatos, puerto', 'numerical', 'integerOnly'=>true),
			array('nombre, instancia, direccion, pass, base_datos', 'length', 'max'=>45),
			array('usuario', 'length', 'max'=>20),
			array('comentarios', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_motor_bdatos, nombre, puerto, instancia, direccion, usuario, pass, base_datos, comentarios', 'safe', 'on'=>'search'),
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
			'MotorBDatos' => array(self::BELONGS_TO, 'MotorBDatos', 'id_motor_bdatos'),
			'FuenteDatos' => array(self::HAS_MANY, 'FuenteDatos', 'id_conexion_bdatos'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_motor_bdatos' => 'Motor de base de datos',
			'nombre' => 'Nombre de la conexión',
			'puerto' => 'Puerto',
			'instancia' => 'Instancia',
			'direccion' => 'IP o URL',
			'usuario' => 'Usuario',
			'pass' => 'Contraseña',
			'base_datos' => 'Nombre de la base datos',
			'comentarios' => 'Comentarios',
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
		$criteria->compare('id_motor_bdatos',$this->id_motor_bdatos);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('puerto',$this->puerto);
		$criteria->compare('instancia',$this->instancia,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('base_datos',$this->base_datos,true);
		$criteria->compare('comentarios',$this->comentarios,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConexionBDatos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Devuelve un objeto de tipo CDbConnection.
     * En caso de error, lanza una excepción.
     */
    public function getConexion($datoConnec)
    {
        $datosConexion = null;

        // Si no es un array, quiere decir que estamos recibiendo el id de una conexion existente en la base de datos
        // de lo contrario recibe los datos en forma de array de una nueva conexion, es decir, los datos del formulario
        if(!is_array($datoConnec)) {
            $datosConexion = $this->findByPk($datoConnec);

            if($datosConexion)
                $datosConexion = $datosConexion->getAttributes(false);
            else
                throw new Exception('Especifique una conexión a base de datos válida');
                //return array('error'=>true, 'msjerror'=>'No existe el registro de la conexión a base de datos especificada');
        }
        else
            $datosConexion = $datoConnec;

        // Validar los datos propocionados
        if(!$datosConexion['direccion'])
            throw new Exception('Proporcione la IP o URL para la conexión');
        if(!$datosConexion['usuario'])
            throw new Exception('Proporcione el dato del nombre de usuario');
        if(!$datosConexion['pass'])
            throw new Exception('Proporcione la contraseña del usuario');
        if(!$datosConexion['base_datos'])
            throw new Exception('Proporcione el nombre de la base de datos');

        $dsn = '';
        $motorBDatos = MotorBDatos::model()->findByPk($datosConexion['id_motor_bdatos']);

        if(is_null($motorBDatos))
            throw new Exception('Especifique un motor de base de datos válido para la conexión');

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
	 * Devuelve un array con los resultados de la consulta.
     * En caso de existir un error, lanza una excepción.
	 */
    public function getQueryResult($objConnec, $sql, $limit=null)
    {
        $noPermitidos = '/\bUPDATE\b|\bDELETE\b|\bINSERT\b|\bCREATE\b|\bDROP\b|USUARIO|USER/i';
        $respuesta = null;//array('error'=>false, 'msjerror'=>'');

        if (preg_match($noPermitidos, $sql) == FALSE) {
            if($limit) {
                if($objConnec->getDriverName() == 'mssql' || $objConnec->getDriverName() == 'sqlsrv')
                     $sql = str_ireplace('SELECT', 'SELECT TOP '.$limit, $sql); // SQL Server no soporta limit
                else
                     $sql = $sql.' LIMIT '.$limit;
            }

            $command = $objConnec->createCommand($sql);
            $dataReader = $command->query();
            $resultSet = $dataReader->readAll();

            if(count($resultSet) > 0) {
                // Revisar si la codificación del caracter es utf-8, si no los es hay que convertirlo
                $funcConvertUFT8 = function(&$elemento, &$clave) {
                    $elemento = mb_check_encoding($elemento, 'UTF-8') ? $elemento : utf8_encode(trim($elemento));
                };
                // Codificar todos los caracteres a utf-8 de lo contrario marca error al convertir a json
                array_walk_recursive($resultSet, $funcConvertUFT8);
                $respuesta = $resultSet;
            }
        } else {
            throw new Exception('Por seguridad, las siguientes sentencias no son permitidas UPDATE, DELETE, INSERT, CREATE y DROP, tampoco acceso a datos de USUARIO');
        }

        return $respuesta;
     }
}
