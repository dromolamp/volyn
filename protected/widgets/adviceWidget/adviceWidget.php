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

class adviceWidget extends CmsWidget
{
    public function init()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('status', News::STATUS_IS_ACTIVE);
        $criteria->compare('type', News::TYPE_ADVICE);
        $criteria->order = "date_public DESC";
        $criteria->limit = 3;

        $this->render('_view',array(
            'news_list'=>News::model()->findAll($criteria),
        ));
    }
}