<?php

class ContactsController extends CmsController
{
    public $layout = '//layouts/main';

    public function actionIndex()
    {
        $this->render('index');
    }
}