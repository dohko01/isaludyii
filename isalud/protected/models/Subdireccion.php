<?php

/**
 * This is the model class for table "tblc_subdireccion".
 *
 * The followings are the available columns in table 'tblc_subdireccion':
 * @property integer $id
 * @property integer $id_cat_direccion
 * @property string $nombre
 * @property string $responsable
 * @property string $comentario
 *
 * The followings are the available model relations:
 * @property TblFichaTecnica[] $tblFichaTecnicas
 * @property TblcDireccion $idCatDireccion
 * @property TblcCoordinacion[] $tblcCoordinacions
 * @property TblUsuario[] $tblUsuarios
 */
class Subdireccion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	public $direccion_search;
	
	public function tableName()
	{
		return 'tblc_subdireccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_direccion, nombre, responsable', 'required'),
			array('id_cat_direccion', 'numerical', 'integerOnly'=>true),
			array('nombre, responsable', 'length', 'max'=>45),
			array('comentario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cat_direccion, direccion_search, nombre, responsable, comentario', 'safe', 'on'=>'search'),
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
			'tblFichaTecnicas' => array(self::HAS_MANY, 'FichaTecnica', 'id_cat_subdireccion'),
			'idCatDireccion' => array(self::BELONGS_TO, 'Direccion', 'id_cat_direccion'),
			'tblcCoordinacions' => array(self::HAS_MANY, 'Coordinacion', 'id_cat_subdireccion'),
			'tblUsuarios' => array(self::HAS_MANY, 'Usuario', 'id_cat_subdireccion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_cat_direccion' => 'Id Cat Direccion',
			'nombre' => 'Nombre',
			'responsable' => 'Responsable',
			'comentario' => 'Comentario',
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
		$criteria->compare('id_cat_direccion',$this->id_cat_direccion);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('comentario',$this->comentario,true);
		// Se crea el apuntador al campo que se va a buscar de la tabla a la que pertenece la llave foranea
		$criteria->with=array('idCatDireccion');
		$criteria->compare('"idCatDireccion"."nombre"',$this->direccion_search, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subdireccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
