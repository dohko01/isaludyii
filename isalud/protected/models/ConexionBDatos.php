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
}
