<?php

/**
 * This is the model class for table "tblc_modulo".
 *
 * The followings are the available columns in table 'tblc_modulo':
 * @property integer $id
 * @property integer $id_cat_tipo_usuario
 * @property string $nombre
 * @property string $url
 * @property boolean $activo
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property TblcTipoUsuario $idCatTipoUsuario
 * @property Modulo $parent
 * @property Modulo[] $tblcModulos
 */
class Modulo extends CActiveRecord
{
    //se define la variable para realizar la busqueda en admin por las relaciones que tiene.
    public $modulo_search;
    public $tipousuario_search;
    public $activo_search;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblc_modulo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_tipo_usuario, nombre', 'required'),
			array('id_cat_tipo_usuario, parent_id', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>50),
			array('url', 'length', 'max'=>45),
			array('activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, modulo_search, activo_search, tipousuario_search, id_cat_tipo_usuario, nombre, url, activo, parent_id', 'safe', 'on'=>'search'),
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
			'idCatTipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'id_cat_tipo_usuario'),
			'parent' => array(self::BELONGS_TO, 'Modulo', 'parent_id'),
			'tblcModulos' => array(self::HAS_MANY, 'Modulo', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_cat_tipo_usuario' => 'Tipo de usuario',
			'nombre' => 'Nombre',
			'url' => 'URL',
			'activo' => 'Activo',
			'parent_id' => 'Padre',
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
		//$criteria->compare('id_cat_tipo_usuario',$this->id_cat_tipo_usuario);
		$criteria->compare('"t"."nombre"',$this->nombre,true);
		$criteria->compare('"t"."url"',$this->url,true);
		$criteria->compare('"t"."activo"',$this->activo_search);
		//$criteria->compare('parent_id',$this->parent_id);
        
        $criteria->with=array('idCatTipoUsuario','parent');
        $criteria->compare('"idCatTipoUsuario"."nombre"',$this->tipousuario_search, true);
        $criteria->compare('"parent"."nombre"',$this->modulo_search, true);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['filasPorPagina'],
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Modulo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
