<?php

class PageController extends CmsController
{
    public $layout = '//layouts/page';

    public function actionView($id)
    {
        $model = Page::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('Academ PL', 'Page not found'));
        }

        /* Load more layouts from static page */
        if($model->layouts != "")
        {
            $this->layout = '//layouts/' . $model->layouts;
        }

        $this->breadcrumbs = array(
            $model->title
        );
        $this->render('view', array('model'=>$model));
    }

    public function actionMain()
    {
        $this->layout = '/layouts/index';

        //$models = LessonLanguage::model()->findAllByAttributes(array('status'=>LessonLanguage::STATUS_ACTIVE));

        $mainPage = Page::model()->findByAttributes(array('is_main'=>Page::STATUS_IS_MAIN));

        $this->render('view', array(
            'model'=>$mainPage
        ));

    }
}