<?php

class SeotextModule extends CmsModule
{
    private $_seoModel=null;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'seotext.models.*',
			'seotext.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

    public function getSeoModel()
    {
        if ($this->_seoModel===null)
        {
            if (isset($_GET['view']) && $_GET['view'])
                $link = $_GET['view'];
            else
                $link = Yii::app()->request->getOriginalUrl();
            $seoModel = Seotext::model()->findByAttributes(array("link"=>$link));
            $this->_seoModel = $seoModel;
        }
        return $this->_seoModel;
    }

    public function seoPageTitle()
    {
        if ($this->seoModel !== null && $this->seoModel->status==1)
        {
            Yii::app()->clientScript->registerMetaTag($this->seoModel->meta_keys, 'keywords');
            Yii::app()->clientScript->registerMetaTag($this->seoModel->meta_desc, 'description');
            if ($this->seoModel->page_title)
                return $this->seoModel->page_title;
        }
        return false;
    }
}
