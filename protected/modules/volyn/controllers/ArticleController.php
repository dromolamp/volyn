<?php

class ArticleController extends CmsController
{

    public $layout = '//layouts/main';

    public function actionIndex()
    {
        $articles = Article::model()->findAll(array(
            'condition'=>'status = '.Article::STATUS_PUBLIC,
            'order'=>'date_public DESC',
        ));
        $this->render('index', array(
            'articles'=>$articles,
        ));
    }

    public function actionView($seo_link)
    {
        $model = Article::model()->find(array(
            'condition'=>'seo_link = \''.$seo_link.'\'',
        ));
        if ($model){
            $articles = Article::model()->findAll(array(
                'condition'=>'NOT id ='.$model->id,
                'limit'=>'2',
                'order'=>'RAND ()',
            ));
            $this->render('view', array(
                'model'=>$model,
                'articles'=>$articles,
            ));
        }
        else {
            throw new CHttpException(404,'The requested page does not exist.');
        }
    }
}