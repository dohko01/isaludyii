<?php

/**
 * This is the model class for table "tblc_clues".
 *
 * The followings are the available columns in table 'tblc_clues':
 * @property integer $id_estado
 * @property integer $id_jurisdiccion
 * @property integer $id_institucion
 * @property integer $id_municipio
 * @property string $clues
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property TblcMunicipio $idEstado
 * @property TblcMunicipio $idJurisdiccion
 * @property TblcMunicipio $idMunicipio
 * @property TblcInstitucion $idInstitucion
 */
class Clues extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblc_clues';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_jurisdiccion, id_municipio, clues, nombre', 'required'),
			array('id_jurisdiccion, id_institucion, id_municipio', 'numerical', 'integerOnly'=>true),
			array('clues', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_estado, id_jurisdiccion, id_institucion, id_municipio, clues, nombre', 'safe', 'on'=>'search'),
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
			'idEstado' => array(self::BELONGS_TO, 'TblcMunicipio', 'id_estado'),
			'idJurisdiccion' => array(self::BELONGS_TO, 'TblcMunicipio', 'id_jurisdiccion'),
			'idMunicipio' => array(self::BELONGS_TO, 'TblcMunicipio', 'id_municipio'),
			'idInstitucion' => array(self::BELONGS_TO, 'TblcInstitucion', 'id_institucion'),
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
			'id_institucion' => 'Id Institucion',
			'id_municipio' => 'Id Municipio',
			'clues' => 'Clues',
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
		$criteria->compare('id_institucion',$this->id_institucion);
		$criteria->compare('id_municipio',$this->id_municipio);
		$criteria->compare('clues',$this->clues,true);
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
