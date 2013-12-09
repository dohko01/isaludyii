<?php

/**
 * This is the model class for table "tblc_programa_accion".
 *
 * The followings are the available columns in table 'tblc_programa_accion':
 * @property integer $id
 * @property integer $id_cat_coordinacion
 * @property string $nombre
 * @property string $responsable
 * @property string $comentario
 *
 * The followings are the available model relations:
 * @property TblcCoordinacion $idCatCoordinacion
 * @property TblFichaTecnica[] $tblFichaTecnicas
 */
class ProgramaAccion extends CActiveRecord
{
	public $coordinacion_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblc_programa_accion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_coordinacion, nombre, responsable', 'required'),
			array('id_cat_coordinacion', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>80),
			array('responsable', 'length', 'max'=>45),
			array('comentario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cat_coordinacion, coordinacion_search nombre, responsable, comentario', 'safe', 'on'=>'search'),
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
			'idCatCoordinacion' => array(self::BELONGS_TO, 'Coordinacion', 'id_cat_coordinacion'),
			'tblFichaTecnicas' => array(self::HAS_MANY, 'FichaTecnica', 'id_cat_programa_accion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_cat_coordinacion' => 'Id Cat Coordinacion',
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
		$criteria->compare('id_cat_coordinacion',$this->id_cat_coordinacion);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('comentario',$this->comentario,true);
		// Se crea el apuntador al campo que se va a buscar de la tabla a la que pertenece la llave foranea
		$criteria->with=array('idCatCoordinacion');
		$criteria->compare('"idCatCoordinacion"."nombre"',$this->coordinacion_search, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProgramaAccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
