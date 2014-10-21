<?php

class SiteController extends CmsController
{
	public function actionIndex()
	{
        /*if(Yii::app()->language == 'ru'){
            Yii::app()->setLanguage('ua');
            $this->redirect(array('/site/index'));
        }*/

        if(Yii::app()->user->hasState('user_language') && Yii::app()->language != Yii::app()->user->getState('user_language'))
        {
            Yii::app()->setLanguage(Yii::app()->user->getState('user_language'));
            Yii::app()->user->setState('enter_site_language', true);
            $this->redirect(array('/site/index'));
        }

        if (!Yii::app()->user->hasState('enter_site_language')) {
            Yii::app()->setLanguage('ua');
            Yii::app()->user->setState('user_language', Yii::app()->language);
            Yii::app()->user->setState('enter_site_language', true);
            $this->redirect(array('/site/index'));
        }

        if (isset(Yii::app()->params['forward']) && Yii::app()->params['forward'] !== 'index')
            $this->forward(Yii::app()->params['forward']);
        else

        //$this->layout = '/layouts/main';

            $this->redirect('/volyn/default/index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
        $this->layout = '//layouts/column1';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else {
                if (Yii::app()->user->isAdmin)
                    $this->layout = '//admin/layouts/main';
                $this->render('error', $error);
            }
		}
	}
}