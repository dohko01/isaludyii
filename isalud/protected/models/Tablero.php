<?php

/**
 * This is the model class for table "tbl_tablero".
 *
 * The followings are the available columns in table 'tbl_tablero':
 * @property integer $id
 * @property string $nombre
 * @property boolean $es_publico
 * @property boolean $fecha_creacion
 * @property boolean $id_usuario
 *
 * The followings are the available model relations:
 * @property TblFichaTecnica[] $tblFichaTecnicas
 */
class Tablero extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_tablero';
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
			array('nombre', 'length', 'max'=>50),
			array('es_publico', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, es_publico, fecha_creacion, id_usuario', 'safe', 'on'=>'search'),
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
			'FichasTecnicas' => array(self::MANY_MANY, 'FichaTecnica', 'tbl_tablero_indicador(id_tablero, id_ficha_tecnica)'),
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
			'es_publico' => '¿Es publicable?',
            'fecha_creacion' => 'Fecha de creación',
            'id_usuario' => 'Autor',
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
		$criteria->compare('es_publico',$this->es_publico);
        $criteria->compare('fecha_creacion',$this->fecha_creacion);
        $criteria->compare('id_usuario',$this->id_usuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tablero the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
