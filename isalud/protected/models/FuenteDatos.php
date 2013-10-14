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
 * @property string $descripcion
 * @property string $sentencia_sql
 * @property string $archivo
 * @property string $ultima_lectura
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
			array('id_conexion_bdatos, id_cat_periodicidad', 'numerical', 'integerOnly'=>true),
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
			'descripcion' => 'Descripción',
			'sentencia_sql' => 'Sentencia SQL',
			'archivo' => 'Archivo',
			'ultima_lectura' => 'Última Lectura',
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
		$criteria->compare('ultima_lectura',$this->ultima_lectura,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
}
