<?php

/**
 * This is the model class for table "tbl_criterio_escala_evaluacion".
 *
 * The followings are the available columns in table 'tbl_criterio_escala_evaluacion':
 * @property integer $id_cat_criterio_evaluacion
 * @property integer $id_escala_evaluacion
 * @property double $limite_inf
 * @property double $limite_sup
 */
class CriterioEscalaEvaluacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_criterio_escala_evaluacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_criterio_evaluacion, id_escala_evaluacion', 'required'),
			array('id_cat_criterio_evaluacion, id_escala_evaluacion', 'numerical', 'integerOnly'=>true),
			array('limite_inf, limite_sup', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cat_criterio_evaluacion, id_escala_evaluacion, limite_inf, limite_sup', 'safe', 'on'=>'search'),
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
            'EscalaEvaluacion' => array(self::BELONGS_TO, 'EscalaEvaluacion', 'id_escala_evaluacion'),
            'CriterioEvaluacion' => array(self::BELONGS_TO, 'CriterioEvaluacion', 'id_cat_criterio_evaluacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cat_criterio_evaluacion' => 'Id Cat Criterio Evaluacion',
			'id_escala_evaluacion' => 'Id Escala Evaluacion',
			'limite_inf' => 'Limite Inf',
			'limite_sup' => 'Limite Sup',
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

		$criteria->compare('id_cat_criterio_evaluacion',$this->id_cat_criterio_evaluacion);
		$criteria->compare('id_escala_evaluacion',$this->id_escala_evaluacion);
		$criteria->compare('limite_inf',$this->limite_inf);
		$criteria->compare('limite_sup',$this->limite_sup);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CriterioEscalaEvaluacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
