<?php

class AboutController extends CmsController
{
    public $layout = '//layouts/column2';

    public function actionTrade()
    {
        $this->render('trade');
    }

    public function actionPatent()
    {
        $this->render('patent');
    }

    public function actionIndex()
    {
        $this->render('index');
    }
}