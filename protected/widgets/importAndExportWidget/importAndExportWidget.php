<?php
/**
 * Created by PhpStorm.
 * User: mukolla
 * Date: 18.06.14
 * Time: 12:36
 */

Yii::import('application.modules.agrocorm.models.*');

class importAndExportWidget extends CmsWidget{
    public function init()
    {
        $this->render('_view');
    }
} 