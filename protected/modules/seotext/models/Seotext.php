<?php

/**
 * This is the model class for table "{{seotext}}".
 *
 * The followings are the available columns in table '{{seotext}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $link
 * @property string $page_title
 * @property string $meta_desc
 * @property string $meta_keys
 * @property integer $status
 * @property string $icon
 * @property string $icon_alt
 */
class Seotext extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Seotext the static model class
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
		return '{{seotext}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_title, meta_desc, meta_keys, link', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('link, page_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, link, page_title, meta_desc, meta_keys, status', 'safe', 'on'=>'search'),
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
			'link' => 'Линк',
			'page_title' => 'Title страницы',
			'meta_desc' => 'Description страницы',
			'meta_keys' => 'Keywords страницы',
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
		$criteria->compare('link',$this->link,true);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('meta_keys',$this->meta_keys,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}