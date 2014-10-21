<?php

/**
 * This is the model class for table "{{production}}".
 *
 * The followings are the available columns in table '{{production}}':
 * @property integer $id
 * @property string $date_create
 * @property string $date_update
 * @property string $seo_link
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $date_public
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property ProductionLang[] $productionLangs
 */
class Production extends CActiveRecord
{
    const STATUS_PUBLIC=1;
    const STATUS_DRAFT=2;
    const STATUS_DELETED=3;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Production the static model class
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
		return '{{production}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_create, date_update, seo_link, title, text, date_public', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date_create, date_update, seo_link, title, text, image, date_public, status', 'safe', 'on'=>'search'),
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
			'productionLangs' => array(self::HAS_MANY, 'ProductionLang', 'production_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core/admin', 'ID'),
			'date_create' => Yii::t('core/admin', 'Date Create'),
			'date_update' => Yii::t('core/admin', 'Date Update'),
			'seo_link' => Yii::t('core/admin', 'Seo Link'),
			'title' => Yii::t('core/admin', 'Title'),
			'text' => Yii::t('core/admin', 'Text'),
			'image' => Yii::t('core/admin', 'Image'),
			'date_public' => Yii::t('core/admin', 'Date Public'),
			'status' => Yii::t('core/admin', 'Status'),
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
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('seo_link',$this->seo_link,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('date_public',$this->date_public,true);
		$criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array(
            'criteria'=>$this->ml->modifySearchCriteria($criteria),
        ));
    }

    protected function beforeValidate()
    {
        if(parent::beforeValidate())
        {
            $this->seo_link = UrlTranslit::translit($this->title);
            $i=0;
            while (self::model()->exists("seo_link = '".$this->seo_link."'".($this->isNewRecord ? "" :
                    " AND t.id !=".$this->id))) {
                $i++;
                $this->seo_link = $this->seo_link.$i;
            }

            if($this->isNewRecord)
            {
                $this->date_update = Yii::app()->getLocale(Yii::app()->language == 'ua' ? 'uk' :
                    Yii::app()->language)->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
                $this->date_public = Yii::app()->getLocale(Yii::app()->language == 'ua' ? 'uk' :
                    Yii::app()->language)->dateFormatter->format('yyyy-MM-dd HH:mm:ss',  $this->date_public );
                $this->date_create = $this->date_update;
            }
            else
            {
                $this->date_public = Yii::app()->getLocale(Yii::app()->language == 'ua' ? 'uk' :
                    Yii::app()->language)->dateFormatter->format('yyyy-MM-dd HH:mm:ss',  $this->date_public );
                $this->date_update = Yii::app()->getLocale(Yii::app()->language == 'ua' ? 'uk' :
                    Yii::app()->language)->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
            }

            return true;
        }
        else
            return false;
    }

    public function defaultScope()
    {
        return $this->ml->localizedCriteria();
    }
    public static function statusList()
    {
        return array(
            self::STATUS_PUBLIC => 'Публиковать',
            self::STATUS_DRAFT => 'Черновик',
            self::STATUS_DELETED => 'Удаленный',
        );
    }

    public function getImage($width,$height)
    {
        if (empty($this->image))
            return false;
        $dir = Yii::getPathOfAlias('webroot.upload.'.mb_strtolower(__CLASS__)).DIRECTORY_SEPARATOR;
        $name = $width.'_'.$height.'_'.$this->image;
        if (!file_exists($dir.$name)) {
            self::resizeImage($width, $height, $dir.$this->image, $dir.$name);
        }
        return Yii::app()->baseUrl.'/upload/'.mb_strtolower(__CLASS__).'/'.$name;
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


    public function behaviors(){
        return array(
            // наше поведение для работы с файлом
            'uploadableFile'=>array(
                'class'=>'application.modules.volyn.components.UploadableFileBehavior',
                'savePathAlias' => 'webroot.upload.'.mb_strtolower(__CLASS__),
                'attributeName' => 'image',
                'folder' =>  mb_strtolower(__CLASS__),
            ),
            'ml' => array(
                'class' => 'application.components.MultilingualBehavior',
                'localizedAttributes' => array(
                    'text','title'
                ),
                'langClassName' => 'ProductionLang',
                'langTableName' => 'production_lang',
                'langField' => 'lang_id',
                'localizedPrefix' => 'l_',
                'languages' => Language::getListLanguages(),
                'defaultLanguage' => Language::getDefaultLanguage()->name,
                'langForeignKey' => 'production_id',
                'dynamicLangClass' => true,
            ),
        );
    }
}