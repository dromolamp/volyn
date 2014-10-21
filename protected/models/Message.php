<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property integer $id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $message
 * @property string $date_create
 * @property integer $status_from
 * @property integer $status_to
 * @property integer $lesson_language_id
 */
class Message extends CActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_READ = 1;
    const STATUS_IGNORE = 2;
    const STATUS_DELETE = 10;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return '{{message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_user_id, to_user_id, message', 'required'),
			array('from_user_id, to_user_id, status_from, status_to, lesson_language_id', 'numerical', 'integerOnly'=>true),
			array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, from_user_id, to_user_id, message, date_create, status_from, status_to', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'from_user_id' => 'Отправитель',
			'to_user_id' => 'Получатель',
			'message' => 'Сообщение',
			'date_create' => 'Дата отправки',
			'status_from' => 'Status From',
			'status_to' => 'Status To',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('status_from',$this->status_from);
		$criteria->compare('status_to',$this->status_to);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}