<?php

/**
 * This is the model class for table "tblc_municipio".
 *
 * The followings are the available columns in table 'tblc_municipio':
 * @property integer $id_estado
 * @property integer $id_jurisdiccion
 * @property integer $id_municipio
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property TblcJurisdiccion $idEstado
 * @property TblcJurisdiccion $idJurisdiccion
 * @property TblcClues[] $tblcClues
 * @property TblcClues[] $tblcClues1
 * @property TblcClues[] $tblcClues2
 */
class Municipio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblc_municipio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_estado, id_jurisdiccion', 'required'),
			array('id_estado, id_jurisdiccion', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_estado, id_jurisdiccion, id_municipio, nombre', 'safe', 'on'=>'search'),
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
			'idEstado' => array(self::BELONGS_TO, 'TblcJurisdiccion', 'id_estado'),
			'idJurisdiccion' => array(self::BELONGS_TO, 'TblcJurisdiccion', 'id_jurisdiccion'),
			'tblcClues' => array(self::HAS_MANY, 'TblcClues', 'id_estado'),
			'tblcClues1' => array(self::HAS_MANY, 'TblcClues', 'id_jurisdiccion'),
			'tblcClues2' => array(self::HAS_MANY, 'TblcClues', 'id_municipio'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_estado' => 'Id Estado',
			'id_jurisdiccion' => 'Id Jurisdiccion',
			'id_municipio' => 'Id Municipio',
			'nombre' => 'Nombre',
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

		$criteria->compare('id_estado',$this->id_estado);
		$criteria->compare('id_jurisdiccion',$this->id_jurisdiccion);
		$criteria->compare('id_municipio',$this->id_municipio);
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Municipio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
