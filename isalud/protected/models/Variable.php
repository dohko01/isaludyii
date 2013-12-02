<?php

/**
 * This is the model class for table "tbl_variable".
 *
 * The followings are the available columns in table 'tbl_variable':
 * @property integer $id
 * @property integer $id_fuente_datos
 * @property integer $id_campo
 * @property string $nombre
 * @property string $ini_formula
 * @property string $comentario
 *
 * The followings are the available model relations:
 * @property TblFuenteDatos $idFuenteDatos
 * @property TblCampo $idCampo
 */
class Variable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_variable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_fuente_datos, id_campo, nombre, ini_formula', 'required'),
			array('id_fuente_datos, id_campo', 'numerical', 'integerOnly'=>true),
			array('nombre, ini_formula', 'length', 'max'=>45),
            array('ini_formula', 'match', 'pattern'=>'/^([a-zA-Z0-9_-])+$/', 'message'=>'Sólo puede escribir caracteres alfanuméricos, guión bajo(_) y guión medio (-)'),
			array('comentario', 'safe'),
            array('nombre', 'ValidateNombre'),
            array('ini_formula', 'ValidateIniFormula'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_fuente_datos, id_campo, nombre, ini_formula, comentario', 'safe', 'on'=>'search'),
		);
	}
    
    public function ValidateNombre($attribute,$params)
    {
        $objVariable = $this->findByAttributes(array('nombre'=>$this->nombre));
        
        if(!empty($objVariable))
            $this->addError('nombre','Ya existe una variable con el mismo nombre, elija otro nombre para la nueva variable.');
    }
    
    public function ValidateIniFormula($attribute,$params)
    {
        $objVariable = $this->findByAttributes(array('ini_formula'=>$this->ini_formula));
        
        if(!empty($objVariable))
            $this->addError('ini_formula','Ya existe una variable con el mismo nombre para formula, elija otro nombre para formula para la nueva variable.');
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'FuenteDatos' => array(self::BELONGS_TO, 'FuenteDatos', 'id_fuente_datos'),
			'Campo' => array(self::BELONGS_TO, 'Campo', 'id_campo'),
            'FichasTecnicas' => array(self::MANY_MANY, 'FichaTecnica', 'tbl_ficha_tecnica_variable(id_ficha_tecnica, id_variable)'),
            'FichaTecnicasVariable' => array(self::HAS_MANY, 'FichaTecnicaVariable', 'id_variable'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_fuente_datos' => 'Fuente de datos',
			'id_campo' => 'Campo',
			'nombre' => 'Nombre',
			'ini_formula' => 'Nombre para formula',
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
		$criteria->compare('id_fuente_datos',$this->id_fuente_datos);
		$criteria->compare('id_campo',$this->id_campo);
		$criteria->compare('LOWER(nombre)',strtolower($this->nombre),true);
		$criteria->compare('LOWER(ini_formula)',strtolower($this->ini_formula),true);
		$criteria->compare('LOWER(comentario)',strtolower($this->comentario),true);
        $criteria->order = 'nombre ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Variable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
	 * Devuelve la concatenacion del nombre mas la inicial para formula
     * Se utiliza en el CHtml::listData
	 */
	public function getFullName()
	{
		return $this->nombre.' ['.$this->ini_formula.']';
	}
}
