<?php
/**
 * Created by PhpStorm.
 * User: mukolla
 * Date: 10.04.14
 * Time: 16:35
 */
?>

<?php


Yii::import('application.modules.euroregionbug.models.*');

class sliderWidget extends CmsWidget
{
    public function init()
    {
        $this->render('_view',array(
            'slider_list'=>Slider::model()->findAllByAttributes(array('status'=>Slider::STATUS_IS_ACTIVE)),
        ));
    }
}