<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 06.11.13
 * Time: 14:17
 */

class DMultilangHelper
{
    public static function enabled()
    {
        return count(Language::getListLanguages()) > 1;
    }

    public static function suffixList()
    {
        $list = array();
        $enabled = self::enabled();

        $criteria=new CDbCriteria;
        //$criteria->condition = "name <> :col_val AND name <> :col_val2";
        //$criteria->params = array(':col_val' => 'ru', ':col_val2' => 'en');

        /*$criteria->condition = "name <> :col_val";
        $criteria->params = array(':col_val' => 'ru');*/

        $criteria->order = 'status DESC';

        $models = CHtml::listData(Language::model()->findAll($criteria), 'name', 'title');

        foreach ($models as $lang => $name)
        {
            if ($lang === Language::getDefaultLanguage()->name) {
                $suffix = '';
                $list[$suffix] = $enabled ? $name : '';
            } else {
                $suffix = '_' . $lang;
                $list[$suffix] = $name;
            }
        }

        return $list;
    }

    public static function processLangInUrl($url)
    {
        if (self::enabled())
        {
            $domains = explode('/', ltrim($url, '/'));

            if(Language::getDefaultLanguage()->name == $domains[0])
            {
                Yii::app()->user->setState('user_language', $domains[0]);

                Yii::app()->user->setState('user_set_default_language', true);
                $url = str_replace('/en', '/', $url);
                $domains = explode('/', ltrim($url, '/'));
            }

            $isLangExists = in_array($domains[0], array_keys(Language::getListLanguages()));
            if($isLangExists)
            {
                Yii::app()->user->setState('user_language', $domains[0]);

                if(Language::getDefaultLanguage()->name != $domains[0])
                    Yii::app()->user->setState('user_set_default_language', false);
            }

            $isDefaultLang = $domains[0] == Language::getDefaultLanguage()->name;

            if ($isLangExists && !$isDefaultLang)
            {
                $lang = array_shift($domains);
                Yii::app()->setLanguage($lang);
            }

            $url = '/' . implode('/', $domains);
        }

        return $url;
    }

    public static function addLangToUrl($url)
    {
        if (self::enabled())
        {
            $domains = explode('/', ltrim($url, '/'));
            $isHasLang = in_array($domains[0], array_keys(Language::getListLanguages()));
            $isDefaultLang = Yii::app()->getLanguage() == Language::getDefaultLanguage()->name;

            if ($isHasLang && $isDefaultLang)
                array_shift($domains);

            if (!$isHasLang && !$isDefaultLang)
                array_unshift($domains, Yii::app()->getLanguage());

            $url = '/' . implode('/', $domains);
        }

        return $url;
    }
} 