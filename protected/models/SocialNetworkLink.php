<?php

/**
 * This is the model class for table "{{social_network_link}}".
 *
 * The followings are the available columns in table '{{social_network_link}}':
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $css_class
 * @property integer $status
 */
class SocialNetworkLink extends CActiveRecord
{
    const STATUS_PUBLISH = 1;
    const STATUS_NO_PUBLISH = 0;

    public static $statusList = array(
        self::STATUS_NO_PUBLISH=>'Не опубликовано',
        self::STATUS_PUBLISH=>'Опубликовано',
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SocialNetworkLink the static model class
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
		return '{{social_network_link}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link, css_class', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('link', 'length', 'max'=>255),
			array('css_class', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, link, css_class, status', 'safe', 'on'=>'search'),
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
			'name' => 'Название',
			'link' => 'Ссылка',
			'css_class' => 'Css класс',
			'status' => 'Статус',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('css_class',$this->css_class,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTextStatus()
    {
        return self::$statusList[$this->status];
    }
}