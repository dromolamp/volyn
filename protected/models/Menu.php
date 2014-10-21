<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property integer $route_id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property integer $status
 * @property integer $parent_id
 * @property integer $type
 * @property string $url
 * @property string $css_class
 * @property string $template
 */
class Menu extends CActiveRecord
{

    const STATUS_NO_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    const TYPE_ROUTE = 0;
    const TYPE_LINK = 1;
    const TYPE_ROUTE_MODULE = 2;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return '{{menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('route_id, status, parent_id, type', 'numerical', 'integerOnly'=>true),
			array('title, image, css_class', 'length', 'max'=>128),
            array('template', 'safe'),
			array('url', 'length', 'max'=>255),
            array('type', 'checkValue', 'on'=>'childItem'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, image, route_id, status', 'safe', 'on'=>'search'),
		);
	}

    public function checkValue($attributes, $params)
    {
        if ($this->type == self::TYPE_ROUTE && empty($this->route_id))
            $this->addError('route_id', 'Выберите роут из структуры сайта');
        if (($this->type == self::TYPE_LINK || $this->type == self::TYPE_ROUTE_MODULE) && empty($this->url))
            $this->addError('url', 'Укажыте url для пункта меню.');
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'route'=>array(self::BELONGS_TO, 'Route', 'route_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'image' => 'Image',
			'route_id' => 'Route',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'status' => 'Status',
			'css_class' => 'Css class',
			'template' => 'Template',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
    public function adminSearchMenu()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('title',$this->title,true);
        $criteria->compare('status',$this->status);
        $criteria->addCondition('parent_id IS NULL');

        return new CActiveDataProvider($this, array(
            'criteria'=>$this->ml->modifySearchCriteria($criteria),
        ));
    }

    public function getTitleList()
    {
        return str_repeat('- ',$this->level-1).$this->title;
    }

    public function getUrl()
    {
        switch ($this->type) {
            case self::TYPE_ROUTE:
                return '/'.$this->route->full_url;
                break;
            case self::TYPE_LINK:
                return $this->url;
                break;
            case self::TYPE_ROUTE_MODULE:
                return $this->url;
                break;
        }

    }

    public function behaviors()
    {
        return array(
            'nestedSetBehavior'=>array(
                'class'=>'application.extensions.yiiext-nested-set-behavior.NestedSetBehavior',
                'leftAttribute'=>'lft',
                'rightAttribute'=>'rgt',
                'levelAttribute'=>'level',
                'rootAttribute'=>'root',
                'hasManyRoots'=>true

            ),
            'ml' => array(
                'class' => 'application.components.MultilingualBehavior',
                'localizedAttributes' => array(
                    'title',
                ),
                'langClassName' => 'MenuLang',
                'langTableName' => 'menu_lang',
                'langField' => 'lang_id',
                'localizedPrefix' => 'l_',
                'languages' => Language::getListLanguages(),
                'defaultLanguage' => Language::getDefaultLanguage()->name,
                'langForeignKey' => 'menu_id',
                'dynamicLangClass' => true,
            ),
        );
    }

    public function defaultScope()
    {
        return $this->ml->localizedCriteria();
    }

    public static function getItems($menu_id, $active_class="")
    {
        $menu = self::model()->findByPk($menu_id);
        $menuItems = $menu->descendants()->findAll();
        $items = array();
        $new = array();
        foreach ($menuItems as $menuItem){
            $new[$menuItem->parent_id][] = $menuItem;
        }
        $items = self::RecursiveTree2($new, $menu_id, $active_class);
        return $items;
    }

    public static function RecursiveTree2(&$rs,$parent, $active_class)
    {
        $out=array();
        if (!isset($rs[$parent]))
        {
            return $out;
        }
        foreach ($rs[$parent] as $row)
        {
            $css_class = "";
            if( Yii::app()->request->url == $row->getUrl() )
            {
                $css_class = $active_class;
            }

            $children=self::RecursiveTree2($rs,$row->id,$active_class);
            $node = array(
                'label'         => $row->title,
                'url'           => Yii::app()->createUrl($row->getUrl()),
                'submenuOptions'=> array(),
                'itemOptions'=>array('class'=>implode(' ',array($row->css_class, $css_class))),
            );

            if(strlen($row->template) >1)
            {
                if(strpos($row->template,'{link}')!== false)
                {
                    $row->template = str_replace('{link}',Yii::app()->createUrl($row->getUrl()), $row->template);
                }

                if(strpos($row->template,'{title}')!== false)
                {
                    $row->template = str_replace('{title}',$row->title, $row->template);
                }

                $node['template'] = $row->template;
            }


            if ($children)
                $node['items']=$children;
            $out[]=$node;
        }
        return $out;
    }
}