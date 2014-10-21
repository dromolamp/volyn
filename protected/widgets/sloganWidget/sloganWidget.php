<?php

Yii::import('application.modules.agrocorm.models.*');

class sloganWidget extends CmsWidget
{
    public function init()
    {
        $this->render('_view',array(
            'company'=>Company::model()->find(),
        ));
    }
}