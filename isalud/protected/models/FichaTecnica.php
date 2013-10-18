<?php

/**
 * This is the model class for table "tbl_ficha_tecnica".
 *
 * The followings are the available columns in table 'tbl_ficha_tecnica':
 * @property integer $id
 * @property integer $id_cat_tipo_indicador
 * @property integer $id_cat_clasificacion
 * @property integer $id_escala_evaluacion
 * @property integer $id_cat_periodicidad
 * @property integer $id_ficha_tecnica_padre
 * @property integer $id_cat_direccion
 * @property integer $id_cat_subdireccion
 * @property integer $id_cat_coordinacion
 * @property integer $id_cat_programa_accion
 * @property integer $id_cat_nivel
 * @property string $nombre
 * @property string $codigo
 * @property string $formula
 * @property double $ponderacion
 * @property string $unidad_medida
 * @property string $meta
 * @property string $definicion
 * @property string $fundamento
 * @property string $utilidad
 *
 * The followings are the available model relations:
 * @property TblcTipoIndicador $idCatTipoIndicador
 * @property TblcClasificacion $idCatClasificacion
 * @property TblEscalaEvaluacion $idEscalaEvaluacion
 * @property TblcPeriodicidad $idCatPeriodicidad
 * @property FichaTecnica $idFichaTecnicaPadre
 * @property FichaTecnica[] $tblFichaTecnicas
 * @property TblcDireccion $idCatDireccion
 * @property TblcSubdireccion $idCatSubdireccion
 * @property TblcCoordinacion $idCatCoordinacion
 * @property TblcProgramaAccion $idCatProgramaAccion
 * @property TblcNivel $idCatNivel
 */
class FichaTecnica extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_ficha_tecnica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat_tipo_indicador, id_cat_clasificacion, id_escala_evaluacion, id_cat_periodicidad, id_cat_direccion, id_cat_nivel, nombre, unidad_medida', 'required'),
			array('id_cat_tipo_indicador, id_cat_clasificacion, id_escala_evaluacion, id_cat_periodicidad, id_ficha_tecnica_padre, id_cat_direccion, id_cat_subdireccion, id_cat_coordinacion, id_cat_programa_accion, id_cat_nivel', 'numerical', 'integerOnly'=>true),
			array('ponderacion', 'numerical'),
			array('nombre, formula', 'length', 'max'=>200),
			array('codigo', 'length', 'max'=>15),
			array('unidad_medida, meta', 'length', 'max'=>20),
			array('definicion, fundamento, utilidad', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cat_tipo_indicador, id_cat_clasificacion, id_escala_evaluacion, id_cat_periodicidad, id_ficha_tecnica_padre, id_cat_direccion, id_cat_subdireccion, id_cat_coordinacion, id_cat_programa_accion, id_cat_nivel, nombre, codigo, formula, ponderacion, unidad_medida, meta, definicion, fundamento, utilidad', 'safe', 'on'=>'search'),
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
			'TipoIndicador' => array(self::BELONGS_TO, 'TipoIndicador', 'id_cat_tipo_indicador'),
			'Clasificacion' => array(self::BELONGS_TO, 'Clasificacion', 'id_cat_clasificacion'),
			'EscalaEvaluacion' => array(self::BELONGS_TO, 'EscalaEvaluacion', 'id_escala_evaluacion'),
			'Periodicidad' => array(self::BELONGS_TO, 'Periodicidad', 'id_cat_periodicidad'),
			'FichaTecnicaPadre' => array(self::BELONGS_TO, 'FichaTecnica', 'id_ficha_tecnica_padre'),
			'FichasTecnicas' => array(self::HAS_MANY, 'FichaTecnica', 'id_ficha_tecnica_padre'),
			'Direccion' => array(self::BELONGS_TO, 'Direccion', 'id_cat_direccion'),
			'Subdireccion' => array(self::BELONGS_TO, 'Subdireccion', 'id_cat_subdireccion'),
			'Coordinacion' => array(self::BELONGS_TO, 'Coordinacion', 'id_cat_coordinacion'),
			'ProgramaAccion' => array(self::BELONGS_TO, 'ProgramaAccion', 'id_cat_programa_accion'),
			'Nivel' => array(self::BELONGS_TO, 'Nivel', 'id_cat_nivel'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_cat_tipo_indicador' => 'Tipo de indicador',
			'id_cat_clasificacion' => 'Clasificación',
			'id_escala_evaluacion' => 'Escala de evaluación',
			'id_cat_periodicidad' => 'Periodicidad de evaluación',
			'id_ficha_tecnica_padre' => 'Indicador al que pertenece',
			'id_cat_direccion' => 'Dirección',
			'id_cat_subdireccion' => 'Subdirección',
			'id_cat_coordinacion' => 'Coordinación',
			'id_cat_programa_accion' => 'Programa de acción',
			'id_cat_nivel' => 'Nivel del indicador',
			'nombre' => 'Nombre',
			'codigo' => 'Código',
			'formula' => 'Formula',
			'ponderacion' => 'Ponderación',
			'unidad_medida' => 'Unidad de medida',
			'meta' => 'Meta institucional',
			'definicion' => 'Definición',
			'fundamento' => 'Fundamento técnico científico',
			'utilidad' => 'Utilidad',
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
		$criteria->compare('id_cat_tipo_indicador',$this->id_cat_tipo_indicador);
		$criteria->compare('id_cat_clasificacion',$this->id_cat_clasificacion);
		$criteria->compare('id_escala_evaluacion',$this->id_escala_evaluacion);
		$criteria->compare('id_cat_periodicidad',$this->id_cat_periodicidad);
		$criteria->compare('id_ficha_tecnica_padre',$this->id_ficha_tecnica_padre);
		$criteria->compare('id_cat_direccion',$this->id_cat_direccion);
		$criteria->compare('id_cat_subdireccion',$this->id_cat_subdireccion);
		$criteria->compare('id_cat_coordinacion',$this->id_cat_coordinacion);
		$criteria->compare('id_cat_programa_accion',$this->id_cat_programa_accion);
		$criteria->compare('id_cat_nivel',$this->id_cat_nivel);
		$criteria->compare('LOWER(nombre)',strtolower($this->nombre),true);
		$criteria->compare('LOWER(codigo)',strtolower($this->codigo),true);
		$criteria->compare('LOWER(formula)',strtolower($this->formula),true);
		$criteria->compare('ponderacion',$this->ponderacion);
		$criteria->compare('LOWER(unidad_medida)',strtolower($this->unidad_medida),true);
		$criteria->compare('LOWER(meta)',strtolower($this->meta),true);
		$criteria->compare('LOWER(definicion)',strtolower($this->definicion),true);
		$criteria->compare('LOWER(fundamento)',strtolower($this->fundamento),true);
		$criteria->compare('LOWER(utilidad)',strtolower($this->utilidad),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FichaTecnica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
