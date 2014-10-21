<?php


Yii::import('application.modules.academpl.models.*');

class copyrightWidget extends CmsWidget
{
    public function init()
    {
        $this->render('_view',array(
            'copyright_list'=> Page::model()->findByPk((int)$this->widget->options['page']),
        ));
    }
} 