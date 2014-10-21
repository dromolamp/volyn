<?php

class DefaultController extends CmsAdminController
{
    public function accessSpecs()
    {
        return array(
            'operations'=>array(
                'index'=>array(
                    'access'=>'isAdmin'
                ),
                'login'=>array(
                    'access'=>'allow'
                ),
                'logout'=>array(
                    'access'=>'@'
                ),
            ),
        );
    }

	public function actionIndex()
	{
        if(isset(Yii::app()->params['default_admin_controller']))
            $this->forward(Yii::app()->params['default_admin_controller']);
        else
            $this->forward('/admin/structure/index');
	}

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout = '//admin/layouts/login';
        $model=new LoginForm();

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            if($model->validate() && $model->login())
                $this->redirect(array('/admin/default/index'));
        }

        // display the login form
        $this->render('login', array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect.
     */
    public function actionLogout()
    {
        if (!empty(Yii::app()->request->urlReferrer) && Yii::app()->request->urlReferrer != $this->createAbsoluteUrl("/user/logout")) {
            Yii::app()->user->setReturnUrl(Yii::app()->request->urlReferrer);
        }
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->returnUrl);
    }
}