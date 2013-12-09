<?php

/**
 * This is the model class for table "tbl_usuario".
 *
 * The followings are the available columns in table 'tbl_usuario':
 * @property integer $id
 * @property integer $id_cat_estado
 * @property integer $id_cat_jurisdiccion
 * @property integer $id_cat_direccion
 * @property integer $id_cat_subdireccion
 * @property integer $id_cat_coordinacion
 * @property integer $id_cat_tipo_usuario
 * @property integer $id_cat_institucion
 * @property string $nombre
 * @property string $email
 * @property string $telefono
 * @property string $username
 * @property string $pass
 * @property boolean $activo
 *
 * The followings are the available model relations:
 * @property TblcJurisdiccion $idCatJurisdiccion
 * @property TblcJurisdiccion $idCatEstado
 * @property TblcDireccion $idCatDireccion
 * @property TblcSubdireccion $idCatSubdireccion
 * @property TblcCoordinacion $idCatCoordinacion
 * @property TblcTipoUsuario $idCatTipoUsuario
 * @property TblcInstitucion $idCatInstitucion
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_estado, id_cat_tipo_usuario, id_cat_institucion, nombre, username, pass', 'required'),
			array('id_cat_estado, id_cat_jurisdiccion, id_cat_direccion, id_cat_subdireccion, id_cat_coordinacion, id_cat_tipo_usuario, id_cat_institucion', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>100),
			array('email', 'length', 'max'=>50),
			array('telefono', 'length', 'max'=>30),
			array('username', 'length', 'max'=>15),
			array('pass', 'length', 'max'=>45),
			array('activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cat_estado, id_cat_jurisdiccion, id_cat_direccion, id_cat_subdireccion, id_cat_coordinacion, id_cat_tipo_usuario, id_cat_institucion, nombre, email, telefono, username, pass, activo', 'safe', 'on'=>'search'),
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
			'idCatJurisdiccion' => array(self::BELONGS_TO, 'Jurisdiccion', 'id_cat_jurisdiccion'),
			'idCatEstado' => array(self::BELONGS_TO, 'Estado', 'id_cat_estado'),
			'idCatDireccion' => array(self::BELONGS_TO, 'Direccion', 'id_cat_direccion'),
			'idCatSubdireccion' => array(self::BELONGS_TO, 'Subdireccion', 'id_cat_subdireccion'),
			'idCatCoordinacion' => array(self::BELONGS_TO, 'Coordinacion', 'id_cat_coordinacion'),
			'idCatTipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'id_cat_tipo_usuario'),
			'idCatInstitucion' => array(self::BELONGS_TO, 'Institucion', 'id_cat_institucion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_cat_estado' => 'Estado',
			'id_cat_jurisdiccion' => 'Jurisdicción',
			'id_cat_direccion' => 'Direccion',
			'id_cat_subdireccion' => 'Subdirección',
			'id_cat_coordinacion' => 'Coordinación',
			'id_cat_tipo_usuario' => 'Tipo Usuario',
			'id_cat_institucion' => 'Institución',
			'nombre' => 'Nombre',
			'email' => 'E-Mail',
			'telefono' => 'Teléfono',
			'username' => 'Usuario',
			'pass' => 'Contraseña',
			'activo' => 'Activo',
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
		$criteria->compare('id_cat_estado',$this->id_cat_estado);
		$criteria->compare('id_cat_jurisdiccion',$this->id_cat_jurisdiccion);
		$criteria->compare('id_cat_direccion',$this->id_cat_direccion);
		$criteria->compare('id_cat_subdireccion',$this->id_cat_subdireccion);
		$criteria->compare('id_cat_coordinacion',$this->id_cat_coordinacion);
		$criteria->compare('id_cat_tipo_usuario',$this->id_cat_tipo_usuario);
		$criteria->compare('id_cat_institucion',$this->id_cat_institucion);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('activo',$this->activo);
        $criteria->order = 'nombre ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
