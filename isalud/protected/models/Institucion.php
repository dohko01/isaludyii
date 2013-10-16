<?php

/**
 * This is the model class for table "tblc_institucion".
 *
 * The followings are the available columns in table 'tblc_institucion':
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion_corta
 * @property string $descripcion_clues
 *
 * The followings are the available model relations:
 * @property TblcClues[] $tblcClues
 * @property TblcDireccion[] $tblcDireccions
 * @property TblUsuario[] $tblUsuarios
 */
class Institucion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblc_institucion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('nombre', 'length', 'max'=>80),
			array('descripcion_corta', 'length', 'max'=>15),
			array('descripcion_clues', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, descripcion_corta, descripcion_clues', 'safe', 'on'=>'search'),
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
			'tblcClues' => array(self::HAS_MANY, 'TblcClues', 'id_cat_institucion'),
			'tblcDireccions' => array(self::HAS_MANY, 'TblcDireccion', 'id_cat_institucion'),
			'tblUsuarios' => array(self::HAS_MANY, 'TblUsuario', 'id_cat_institucion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'descripcion_corta' => 'Descripcion Corta',
			'descripcion_clues' => 'Descripcion Clues',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion_corta',$this->descripcion_corta,true);
		$criteria->compare('descripcion_clues',$this->descripcion_clues,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Institucion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
