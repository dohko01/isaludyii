<?php

/**
 * This is the model class for table "tblc_jurisdiccion".
 *
 * The followings are the available columns in table 'tblc_jurisdiccion':
 * @property integer $id_estado
 * @property integer $id_jurisdiccion
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property TblcMunicipio[] $tblcMunicipios
 * @property TblcMunicipio[] $tblcMunicipios1
 * @property TblcEstado $idEstado
 * @property TblUsuario[] $tblUsuarios
 * @property TblUsuario[] $tblUsuarios1
 */
class Jurisdiccion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblc_jurisdiccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_estado, nombre', 'required'),
			array('id_estado', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_estado, id_jurisdiccion, nombre', 'safe', 'on'=>'search'),
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
			'tblcMunicipios' => array(self::HAS_MANY, 'TblcMunicipio', 'id_estado'),
			'tblcMunicipios1' => array(self::HAS_MANY, 'TblcMunicipio', 'id_jurisdiccion'),
			'idEstado' => array(self::BELONGS_TO, 'TblcEstado', 'id_estado'),
			'tblUsuarios' => array(self::HAS_MANY, 'TblUsuario', 'id_cat_estado'),
			'tblUsuarios1' => array(self::HAS_MANY, 'TblUsuario', 'id_cat_jurisdiccion'),
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
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jurisdiccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
     * Obtiene el Numero y Nombre concatenados
     * 
     * @return String
     */
    function getNumNombre()
    {
        return $this->id_jurisdiccion.'. '.$this->nombre;
    }
}
