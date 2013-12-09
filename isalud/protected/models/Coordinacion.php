<?php

/**
 * This is the model class for table "tblc_coordinacion".
 *
 * The followings are the available columns in table 'tblc_coordinacion':
 * @property integer $id
 * @property integer $id_cat_subdireccion
 * @property string $nombre
 * @property string $responsable
 * @property string $comentario
 *
 * The followings are the available model relations:
 * @property TblcProgramaAccion[] $tblcProgramaAccions
 * @property TblFichaTecnica[] $tblFichaTecnicas
 * @property TblcSubdireccion $idCatSubdireccion
 * @property TblUsuario[] $tblUsuarios
 */
class Coordinacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 
	public $subdireccion_search; //se define la variable para realizar la busqueda en admin por las relaciones que tiene.
	
	public function tableName()
	{
		return 'tblc_coordinacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_subdireccion, nombre, responsable', 'required'),
			array('id_cat_subdireccion', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>80),
			array('responsable', 'length', 'max'=>45),
			array('comentario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cat_subdireccion, subdireccion_search, nombre, responsable, comentario', 'safe', 'on'=>'search'),
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
			'tblcProgramaAccions' => array(self::HAS_MANY, 'ProgramaAccion', 'id_cat_coordinacion'),
			'tblFichaTecnicas' => array(self::HAS_MANY, 'FichaTecnica', 'id_cat_coordinacion'),
			'idCatSubdireccion' => array(self::BELONGS_TO, 'Subdireccion', 'id_cat_subdireccion'),
			'tblUsuarios' => array(self::HAS_MANY, 'Usuario', 'id_cat_coordinacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_cat_subdireccion' => 'Id Cat Subdireccion',
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
		$criteria->compare('id_cat_subdireccion',$this->id_cat_subdireccion);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('comentario',$this->comentario,true);
		// Se crea el apuntador al campo que se va a buscar de la tabla a la que pertenece la llave foranea
		$criteria->with=array('idCatSubdireccion');
		$criteria->compare('"idCatSubdireccion"."nombre"',$this->subdireccion_search, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Coordinacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
