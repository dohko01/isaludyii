<?php

/**
 * This is the model class for table "tbl_tablero_indicador".
 *
 * The followings are the available columns in table 'tbl_tablero_indicador':
 * @property integer $id_tablero
 * @property integer $id_ficha_tecnica
 * @property string $dimension
 * @property string $filtro
 * @property integer $posicion
 * @property string $tipo_grafico
 * @property string $configuracion
 */
class TableroIndicador extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_tablero_indicador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tablero, id_ficha_tecnica, dimension, filtro, posicion', 'required'),
			array('id_tablero, id_ficha_tecnica, posicion', 'numerical', 'integerOnly'=>true),
			array('dimension', 'length', 'max'=>45),
			array('filtro, configuracion', 'length', 'max'=>50),
			array('tipo_grafico', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tablero, id_ficha_tecnica, dimension, filtro, posicion, tipo_grafico, configuracion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tablero' => 'Id Tablero',
			'id_ficha_tecnica' => 'Id Ficha Tecnica',
			'dimension' => 'Dimension',
			'filtro' => 'Filtro',
			'posicion' => 'Posicion',
			'tipo_grafico' => 'Tipo Grafico',
			'configuracion' => 'Configuracion',
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

		$criteria->compare('id_tablero',$this->id_tablero);
		$criteria->compare('id_ficha_tecnica',$this->id_ficha_tecnica);
		$criteria->compare('dimension',$this->dimension,true);
		$criteria->compare('filtro',$this->filtro,true);
		$criteria->compare('posicion',$this->posicion);
		$criteria->compare('tipo_grafico',$this->tipo_grafico,true);
		$criteria->compare('configuracion',$this->configuracion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TableroIndicador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
