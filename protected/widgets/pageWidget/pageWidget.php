<?php


Yii::import('application.modules.euroregionbug.models.*');

class pageWidget extends CmsWidget
{
    public function init()
    {
        $this->render('view',array(
            'data'=> Page::model()->findByPk((int)$this->widget->options['page']),
        ));
    }
} 