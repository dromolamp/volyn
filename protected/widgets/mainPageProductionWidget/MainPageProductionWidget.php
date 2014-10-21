<?php


Yii::import('application.modules.volyn.models.*');

class MainPageProductionWidget extends CmsWidget
{
    public function init()
    {
        $production = Production::model()->findAll(array(
            'limit'=>'2',
            'order'=>'RAND()',
        ));
        $this->render('view',array(
            'production'=> $production,
        ));
    }
}