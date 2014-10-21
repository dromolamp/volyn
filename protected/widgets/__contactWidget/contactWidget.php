<?php


Yii::import('application.modules.academpl.models.*');

class contactWidget extends CmsWidget
{
    public function init()
    {
        $this->render('_view',array(
            'contact_list'=>Contact::model()->findAll(),
            'model' => new Feedback(),
        ));
    }
} 