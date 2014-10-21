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

class newsWidget extends CmsWidget
{
    public function init()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('type', News::TYPE_NEWS);
        $criteria->compare('status', News::STATUS_IS_ACTIVE);
        $criteria->order = "date_public DESC";
        $criteria->limit = Yii::app()->params['news']['widget_count'];

        $this->render('_view',array(
            'news_list'=>News::model()->findAll($criteria),
        ));
    }
}