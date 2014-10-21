<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 19.11.13
 * Time: 14:51
 */

class MlHelper {
    public static function languagesList()
    {
        $data = Yii::app()->cache->get('lang_list');
        if ($data === false) {
            $languages = Yii::app()->db->createCommand()
                ->select('name, title')
                ->from('{{language}}')
                ->order('status DESC')
                ->queryAll();
            $data = array();
            foreach ($languages as $lng)
                $data[$lng['name']] = $lng['title'];
            Yii::app()->cache->set('lang_list', $data);
        }
        return $data;
    }

    public static function defaultLanguage()
    {
        $lng = Yii::app()->cache->get('lang_default');
        if ($lng === false) {
            $lng = Yii::app()->db->createCommand()
                ->select('name')
                ->from('{{language}}')
                ->where('status='.Language::STATUS_SYSTEM)
                ->queryRow();
            Yii::app()->cache->set('lang_default', $lng);
        }
        return $lng['name'];
    }
} 