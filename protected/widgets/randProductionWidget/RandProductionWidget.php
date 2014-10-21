<?php


Yii::import('application.modules.volyn.models.*');

class RandProductionWidget extends CmsWidget
{
    public function init()
    {
        $this->render('view',array(
            'models'=>Production::model()->findAll(array(
                    'limit'=>'2',
                    'condition' =>'status = '.Production::STATUS_PUBLIC,
                    'order'=>'RAND()',
                )),
        ));
    }
}