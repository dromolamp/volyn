<?php

class ProductionController extends CmsController
{

    public $layout = '//layouts/column2';

    public function actionIndex()
    {
        $production = Production::model()->findAll(array(
            'condition'=>'status = '.Production::STATUS_PUBLIC,
        ));


        $this->render('index',array(
            'production'=>$production,
        ));
    }

    public function actionView($seo_link)
    {
        $model = Production::model()->find(array(
            'condition'=>'seo_link = \''.$seo_link.'\'',
        ));


        if ($model){
            $production = Production::model()->findAll(array(
                'condition'=>'NOT id ='.$model->id,
                'limit'=>'2',
                'order'=>'RAND ()',
            ));
            $this->render('view', array(
                'model'=>$model,
                'production'=>$production,
            ));
        }
        else {
            throw new CHttpException(404,'The requested page does not exist.');
        }
    }
}