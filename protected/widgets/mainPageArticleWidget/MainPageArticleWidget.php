<?php


Yii::import('application.modules.volyn.models.*');

class MainPageArticleWidget extends CmsWidget
{
    public function init()
    {
        $articles = Article::model()->findAll(array(
            'limit'=>'2',
            'order'=>'date_public DESC',
        ));
        $this->render('view',array(
            'articles'=> $articles,
        ));
    }
}