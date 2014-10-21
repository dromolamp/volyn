<?php


Yii::import('application.modules.agrocorm.models.*');

class headerContactWidget extends CmsWidget
{
    public function init()
    {
        $this->render('_view',array(
            'company'=>Company::model()->find(),
        ));
    }
} 