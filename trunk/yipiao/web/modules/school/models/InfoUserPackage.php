<?php

/**
 * This is the model class for table "info_user_package".
 *
 * The followings are the available columns in table 'info_user_package':
 * @property integer $UID
 * @property integer $PackageID
 * @property string $Validity
 * @property integer $State
 * @property string $CreateTime
 */
class InfoUserPackage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return InfoUserPackage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'info_user_package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UID, Validity, CreateTime', 'required'),
			array('UID, PackageID, State', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UID, PackageID, Validity, State, CreateTime', 'safe', 'on'=>'search'),
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
			'UID' => 'Uid',
			'PackageID' => 'Package',
			'Validity' => 'Validity',
			'State' => 'State',
			'CreateTime' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('UID',$this->UID);

		$criteria->compare('PackageID',$this->PackageID);

		$criteria->compare('Validity',$this->Validity,true);

		$criteria->compare('State',$this->State);

		$criteria->compare('CreateTime',$this->CreateTime,true);

		return new CActiveDataProvider('InfoUserPackage', array(
			'criteria'=>$criteria,
		));
	}
}