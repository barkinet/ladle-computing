<?php

/**
 * This is the model class for table "info_teachrelation".
 *
 * The followings are the available columns in table 'info_teachrelation':
 * @property integer $TeachID
 * @property integer $UID
 * @property integer $GradeID
 * @property integer $ClassID
 * @property integer $SubjectID
 * @property integer $CreatorID
 * @property string $CreateTime
 * @property integer $State
 */
class InfoTeachrelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return InfoTeachrelation the static model class
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
		return 'info_teachrelation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UID, GradeID, ClassID, SubjectID, CreatorID, CreateTime', 'required'),
			array('UID, GradeID, ClassID, SubjectID, CreatorID, State', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TeachID, UID, GradeID, ClassID, SubjectID, CreatorID, CreateTime, State', 'safe', 'on'=>'search'),
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
			'TeachID' => 'Teach',
			'UID' => 'Uid',
			'GradeID' => 'Grade',
			'ClassID' => 'Class',
			'SubjectID' => 'Subject',
			'CreatorID' => 'Creator',
			'CreateTime' => 'Create Time',
			'State' => 'State',
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

		$criteria->compare('TeachID',$this->TeachID);

		$criteria->compare('UID',$this->UID);

		$criteria->compare('GradeID',$this->GradeID);

		$criteria->compare('ClassID',$this->ClassID);

		$criteria->compare('SubjectID',$this->SubjectID);

		$criteria->compare('CreatorID',$this->CreatorID);

		$criteria->compare('CreateTime',$this->CreateTime,true);

		$criteria->compare('State',$this->State);

		return new CActiveDataProvider('InfoTeachrelation', array(
			'criteria'=>$criteria,
		));
	}
}