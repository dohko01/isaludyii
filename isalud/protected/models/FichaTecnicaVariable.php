<?php

/**
 * This is the model class for table "tbl_ficha_tecnica_variable".
 *
 * The followings are the available columns in table 'tbl_ficha_tecnica_variable':
 * @property integer $id_ficha_tecnica
 * @property integer $id_variable
 */
class FichaTecnicaVariable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_ficha_tecnica_variable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ficha_tecnica, id_variable', 'required'),
			array('id_ficha_tecnica, id_variable', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ficha_tecnica, id_variable', 'safe', 'on'=>'search'),
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
            'FichaTecnica' => array(self::BELONGS_TO, 'FichaTecnica', 'id_ficha_tecnica'),
            'Variable' => array(self::BELONGS_TO, 'Variable', 'id_variable'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ficha_tecnica' => 'Id Ficha Tecnica',
			'id_variable' => 'Id Variable',
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

		$criteria->compare('id_ficha_tecnica',$this->id_ficha_tecnica);
		$criteria->compare('id_variable',$this->id_variable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FichaTecnicaVariable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
