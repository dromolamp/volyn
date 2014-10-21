<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $pub_date
 * @property integer $author_id
 * @property integer $layouts
 * @property integer $is_main
 *
 * The followings are the available model relations:
 * @property User $author
 */
class Page extends CActiveRecord
{
    const STATUS_IS_MAIN=1;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
		return '{{page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, pub_date, author_id', 'required'),
			array('author_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
            array('content', 'safe'),
            array('layouts', 'safe'),
            array('is_main', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
			array('id, title, content, pub_date, author_id', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => Yii::t('core/admin', 'Title'),
			'content' => Yii::t('core/admin', 'Contents'),
			'pub_date' => Yii::t('core/admin', 'Pub Date'),
			'author_id' => Yii::t('core/admin', 'Author'),
			'layouts' => Yii::t('core/admin', 'Layouts'),
			'is_main' => Yii::t('core/admin', 'Is Main Page'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('pub_date',$this->pub_date,true);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('layouts',$this->layouts,true);
        $criteria->compare('is_main',$this->is_main,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$this->ml->modifySearchCriteria($criteria),
        ));
	}

    public function behaviors()
    {
        return array(
            'ml' => array(
                'class' => 'application.components.MultilingualBehavior',
                'localizedAttributes' => array(
                    'title', 'content'
                ),
                'langClassName' => 'PageLang',
                'langTableName' => 'page_lang',
                'langField' => 'lang_id',
                'localizedPrefix' => 'l_',
                'languages' => Language::getListLanguages(),
                'defaultLanguage' => Language::getDefaultLanguage()->name,
                'langForeignKey' => 'page_id',
                'dynamicLangClass' => true,
            ),
            'RouteBehavior'=>array(
                'class'=>'application.components.cms.CmsRouteBehavior',
                'route'=>'/page/view',
                'options'=>array(
                    'can_have_child'=>1,
                    'is_clone'=>0,
                    'can_delete'=>1,
                    'create_child_item_link'=>array(
                        'route'=>'/admin/page/create',
                        'param'=>'id',
                        'paramName'=>'page_id'
                    ),
                    'names'=>array(
                        '/page/view'=>'Просмотр статьи'
                    ),
                ),
            ),
        );
    }

    public function defaultScope()
    {
        return $this->ml->localizedCriteria();
    }
}