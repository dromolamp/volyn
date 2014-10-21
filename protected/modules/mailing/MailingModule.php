<?php

class MailingModule extends CmsModule
{
    public $host;
    public $port;
    public $login;
    public $password;

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'mailing.models.*',
            'mailing.components.*',
            'mailing.helpers.*',
            'mailing.extensions.swiftMailer.*',
            'application.modules.coupon.models.*',
            'application.modules.profile.models.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            $mailer =  array(
                'class' => 'application.modules.mailing.extensions.swiftMailer.SwiftMailer',
            );
            Yii::app()->setComponent('swiftMailer', $mailer);
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }


}
