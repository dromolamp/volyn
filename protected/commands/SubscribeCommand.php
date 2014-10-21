<?php
/**
 * Created by PhpStorm.
 * User: peter
 * E-mail: petro.stasuk.990@gmail.com
 * Date: 31.01.14
 * Time: 10:22
 */


class SubscribeCommand extends CConsoleCommand
{
    public function run($argc)
    {
        Yii::import('application.modules.mailing.helpers.*');
        Yii::import('application.modules.blog.models.*');
        $criteria = new CDbCriteria();
        $criteria->order = 'id ASC';
        $criteria->limit = 2;
        $stack = SubscribeSendStack::model()->findAll($criteria);

        if(!empty($stack))
        {
            foreach($stack as $row)
            {
                if ($row->subscribe !== null && $row->post !== null) {
                    Yii::app()->language = $row->subscribe->language;

                    $message = Setting::getSettingValue('blog_subscribe_email_text', $row->subscribe->language).CHtml::link($row->post->title, Yii::app()->createAbsoluteUrl('/blog/default/view', array('seo_link'=>$row->post->seo_link)) )."";

                    SendMail::send($row->subscribe->email, strip_tags(Setting::getSettingValue('blog_subscribe_email_title', $row->subscribe->language)." "), $message);
                }

            }
            SubscribeSendStack::model()->deleteAll($criteria);
            Yii::app()->language = 'ru';
        }
    }
} 