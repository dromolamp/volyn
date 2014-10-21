<?php
/**
 * Created by PhpStorm.
 * User: mukolla
 * Date: 10.04.14
 * Time: 16:35
 */
?>

<?php


Yii::import('application.modules.agrocorm.models.*');

class partnerWidget extends CmsWidget
{
    public function init()
    {
        $this->render('_view',array(
            'partner_list'=>Partner::model()->findAllByAttributes(array('status'=>Partner::STATUS_IS_ACTIVE)),
        ));
    }
}