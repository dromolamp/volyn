<?php

class SelectLanguageWidget extends CmsWidget
{
    public function init()
    {
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $links = array();
        foreach (DMultilangHelper::suffixList() as $suffix => $name){

            if(trim($suffix, '_') == Yii::app()->language)
                continue;
            if(trim($suffix, '_') == Yii::app()->language)
                continue;

            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : Language::getDefaultLanguage()->name.'/') . $currentUrl;
            $links[] = CHtml::tag('li', array(), CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.'/images/'.($suffix ? trim($suffix, '_') : Language::getDefaultLanguage()->name).'.jpg'), $url) );
        }
        if (Yii::app()->language=='en') unset($links[0]);

        $this->render('view', array('links'=>$links));
    }
} 