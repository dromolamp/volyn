<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property integer $id
 * @property string $city
 * @property string $birthday
 * @property integer $sex
 * @property string $photo
 * @property integer $is_get_news
 * @property integer $user_id
 */
class Profile extends CActiveRecord
{
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    public $day;
    public $month;
    public $year;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return '{{profile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('sex, is_get_news, user_id', 'numerical', 'integerOnly'=>true),
			array('city, day, month, year', 'length', 'max'=>255),
			array('photo', 'length', 'max'=>100),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, city, birthday, sex, photo, is_get_news, user_id', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'city' => 'City',
			'birthday' => 'Birthday',
			'sex' => 'Sex',
			'photo' => 'Photo',
			'is_get_news' => 'Is Get News',
			'user_id' => 'User',
		);
	}

    public function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->day && $this->month && $this->year) {
                $this->birthday = Yii::app()->dateFormatter->format('yyyy-MM-dd', $this->year.'-'.($this->month < 10 ? '0'.$this->month : $this->month).'-'.($this->day < 10 ? '0'.$this->day : $this->day));
            } else
                $this->birthday = null;
            return true;
        } else
            return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($this->birthday) {
            $this->day = (integer) Yii::app()->dateFormatter->format('dd', $this->birthday);
            $this->month = (integer) Yii::app()->dateFormatter->format('MM', $this->birthday);
            $this->year = (integer) Yii::app()->dateFormatter->format('yyyy', $this->birthday);
        }

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
		$criteria->compare('city',$this->city,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('is_get_news',$this->is_get_news);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function resizeImage($width,$height,$scr,$dest)
    {
        $image = Yii::app()->image->load($scr);
        if($image->width > $width || $image->height > $height)
        {
            if (($image->width/$width) < ($image->height/$height))
                $image->resize($width, null, Image::AUTO);
            else
                $image->resize(null, $height, Image::AUTO);
        }
        $image->crop($width, $height, 'center', 'center');
        $image->save($dest);
    }

    public function getImage($width,$height)
    {
        if (empty($this->photo))
            $this->photo = 'no_avatar.png';
        $dir = Yii::getPathOfAlias('webroot.upload.profile').DIRECTORY_SEPARATOR;
        $name = $width.'_'.$height.'_'.$this->photo;
        if (!file_exists($dir.$name)) {
            self::resizeImage($width, $height, $dir.$this->photo, $dir.$name);
        }
        return Yii::app()->baseUrl.'/upload/profile/'.$name;
    }

    public function getDayBirth($component = 'dd')
    {
        if (!empty($this->birthday))
            return (integer) Yii::app()->dateFormatter->format($component, $this->birthday);
    }

    public static function getDaysList()
    {
        $data = array();
        for ($i = 1; $i<=31; $i++) {
            $data[$i] = $i;
        }
        return $data;
    }

    public static function getMonthsList()
    {
        $data = array();
        for ($i = 1; $i <= 12; $i++) {
            $date_str = '2012-'.($i<10 ? '0'.$i : $i).'-01 00:00:00';
            $time = strtotime($date_str);
            $data[$i] = Yii::app()->getLocale(Yii::app()->language)->dateFormatter->format('LLLL', $time);
        }
        return $data;
    }

    public static function getYearList()
    {
        $data = array();
        $currentYear = (integer) Yii::app()->dateFormatter->format('yyyy', time());
        for ($i = ($currentYear-90); $i<$currentYear-5; $i++)
            $data[$i] = $i;
        return $data;
    }
}