<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CmsController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
    public $title;

    public function getMenuTitle()
    {
        return Yii::t('core/admin', 'Main menu');
    }

    public function getMenu()
    {
        return array();
    }

    public function getSubMenuTitle()
    {
        return Yii::t('core/admin', 'Submenu');
    }

    public function getSubMenu()
    {
        return array();
    }
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function accessSpecs()
    {
        return array();
    }

    public function position($name)
    {
        $this->widget('application.components.cms.CmsPositionWidget', array('position'=>$name));
    }

    protected $_header_bg = null;
    protected $_lesson_language = null;

    public function getHeaderBg()
    {
        if ($this->_header_bg !== null)
            return $this->_header_bg;
        elseif ($this->_lesson_language !== null) {
            $criteria = new CDbCriteria();
            $criteria->compare('lesson_language_id', $this->_lesson_language->id);
            $criteria->order = 'RAND()';
            $headerImage = HeaderImage::model()->find($criteria);
            if ($headerImage !== null) {
                return $headerImage->getImage(1200, 319);
            } else
                return Yii::app()->theme->baseUrl.'/img/bg1.png';
        } else
            return Yii::app()->theme->baseUrl.'/img/bg1.png';
    }

    protected $_lessonLanguage = null;

    public function getLessonLanguage()
    {
        return $this->_lessonLanguage;
    }
    public function setLessonLanguage($modelLessonLanguage)
    {
        $this->_lessonLanguage = $modelLessonLanguage;
    }

    protected $_lesson = null;

    public function getLesson()
    {
        return $this->_lesson;
    }
    public function setLesson($modelLesson)
    {
        $this->_lesson = $modelLesson;
    }

    protected function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!Yii::app()->user->isGuest) {
                User::model()->updateByPk(Yii::app()->user->id, array(
                    'last_activity'=>Yii::app()->getLocale(Yii::app()->language == 'ua' ? 'uk' : Yii::app()->language)->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time())
                ));
            }
            return true;
        } else
            return false;
    }

    protected $_model=null;

    public function getSeoTitle()
    {
        if ($this->_model !== null) {
            $metaData = MetaData::model()->findByAttributes(array(
                'model'=>get_class($this->_model),
                'model_id'=>$this->_model->id
            ));
            if ($metaData !== null) {
                Yii::app()->clientScript->registerMetaTag($metaData->meta_keywords, 'keywords');
                Yii::app()->clientScript->registerMetaTag($metaData->meta_description, 'description');
                return $metaData->meta_title;
            }
        }

        if (($title = Yii::app()->getModule('seotext')->seoPageTitle()) !== false) {
            return $title;
        }

        if (isset(Yii::app()->params['title_'.Yii::app()->language]))
            return Yii::app()->params['title_'.Yii::app()->language];
        else
            return Yii::app()->params['title_ru'];

    }
}