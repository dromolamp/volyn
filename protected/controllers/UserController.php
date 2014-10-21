<?php
/**
 * Created by JetBrains PhpStorm.
 * User: weblogic
 * Date: 2/12/13
 * Time: 5:36 PM
 * To change this template use File | Settings | File Templates.
 */

class UserController extends CmsController {
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('paymentFailed', 'paymentSuccess', 'secretPaymentUserUrlAmivi', 'login', 'registration', 'getRegistrationForm', 'resetPassword', 'fullRegistration'),
                'users'=>array('*'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('logout', 'payment'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!empty(Yii::app()->request->urlReferrer) && Yii::app()->request->urlReferrer != $this->createAbsoluteUrl("/user/login")) {
            Yii::app()->user->setReturnUrl(Yii::app()->request->urlReferrer);
        }
        $service = Yii::app()->request->getQuery('service');
        if (isset($service)) {
            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('registration');

            if ($authIdentity->authenticate()) {
                $identity = new EAuthUserIdentity($authIdentity);

                // successful authentication
                if ($identity->authenticate()) {
                    Yii::app()->user->login($identity);

                    // special redirect with closing popup window
                    $authIdentity->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    if ($identity->errorCode == EAuthUserIdentity::ERROR_NOT_AUTHENTICATED)
                        $authIdentity->redirect($this->createAbsoluteUrl('registration'));
                    else
                        $authIdentity->cancel();
                }
            }

            // Something went wrong, redirect to login page
            $this->redirect(array('login'));
        }

        $model=new LoginForm();

        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->request->urlReferrer);
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

    public function actionRegistration($id = null)
    {
        $user = null;
        if(!empty($id))
        {
            $user = User::model()->findByPk($id);
            $user->scenario = 'registration_step_two';
        }
        else
            $user = new User('registration_step_one');

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($user);
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            if ($id !== null)
                $user->status = User::STATUS_ACTIVE;
            $user->role = 'user';
            if ($user->save(false)) {
                $user->refresh();
                if ($user->profile === null) {
                    $profile = new Profile();
                    $profile->user_id = $user->id;
                    $profile->save(false);
                    echo $user->id;
                } else {
                    $userIdentity = new UserIdentity($user->email, $user->password);
                    $userIdentity->auth();
                    if ($userIdentity->errorCode == UserIdentity::ERROR_NONE) {
                        Yii::app()->user->login($userIdentity);
                    }
                }
            }
        }
    }

    public function actionFullRegistration()
    {

    }

    public function actionGetRegistrationForm($id)
    {
        $user = User::model()->findByPk($id);
        if ($user === null)
            throw new CHttpException(404);
        $user->password = '';
        $user->repeat_password = '';
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        echo $this->renderPartial('_reg_form', array('user'=>$user), true, true);
        Yii::app()->end();
    }

    public function actionResetPassword()
    {
        $model = new RestorePassword();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['RestorePassword'])) {
            $model->attributes = $_POST['RestorePassword'];
            if ($model->validate() && $model->restore())
                echo Yii::t('avimi', 'Your mail has been sent a new password');
            else
                echo Yii::t('avimi', 'Password recovery error occurred');
        }
        Yii::app()->end();
    }

    public function actionPayment()
    {
        $sum = Yii::app()->request->getParam('sum_payment');
        if ($sum !== null) {
            $login = 'Amivi';
            $pass = '13atdhfkz1988';
            $inv_id = Yii::app()->user->id;
            $inv_desc = Yii::t('avimi', 'Addition personal account');
            $out_summ = $sum;
            $crc  = md5("$login:$out_summ:$inv_id:$pass");
            $url = "https://auth.robokassa.ru/Merchant/Index.aspx?MrchLogin=$login&".
                "OutSum=$out_summ&InvId=$inv_id&Desc=$inv_desc&SignatureValue=$crc";
            $this->redirect($url);
        } else
            throw new CHttpException(403, Yii::t('avimi', 'Depositing prohibited without specifying amounts'));
    }

    public function actionSecretPaymentUserUrlAmivi()
    {
        $sum = Yii::app()->request->getParam('OutSum');
        $user_id = Yii::app()->request->getParam('InvId');
        $hash = Yii::app()->request->getParam('SignatureValue');
        if ($sum !== null && $user_id !== null && $hash !== null) {
            $pass = '10zydfhz1989';
            $hash = strtoupper($hash);
            $paymentHash = strtoupper(md5("$sum:$user_id:$pass"));
            if ($hash == $paymentHash) {
                $user = User::model()->findByPk($user_id);
                if ($user !== null) {
                    $user->balance += $sum;
                    $user->save(false);
                }
            }
        }
    }

    public function actionPaymentSuccess()
    {
        $this->layout = '//layouts/column1';
        $language = Yii::app()->request->getParam('Culture');
        if ($language !== null && strpos($language, 'ru') !== false)
            Yii::app()->setLanguage('ru');
        $this->render('payment', array(
            'msg'=>Yii::t('avimi', 'Addition personal account was successful')
        ));

    }

    public function actionPaymentFailed()
    {
        $language = Yii::app()->request->getParam('Culture');
        if ($language !== null && strpos($language, 'ru') !== false)
            Yii::app()->setLanguage('ru');
        $this->layout = '//layouts/column1';
        $this->render('payment', array(
            'msg'=>Yii::t('avimi', 'During refill the error occurred')
        ));
    }
}