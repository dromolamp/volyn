<?php
/**
 * Created by PhpStorm.
 * User: peter
 * E-mail: petro.stasuk.990@gmail.com
 * Date: 27.01.14
 * Time: 12:29
 */

class RestorePassword extends CFormModel
{
    public $email;

    public function rules()
    {
        return array(
            array('email', 'required'),
            array('email', 'email'),
            array('email', 'checkEmail'),
        );
    }

    public function checkEmail()
    {
        if (!User::model()->exists('email=:email', array(':email'=>$this->email)))
            $this->addError('email', Yii::t('avimi', 'E-mail was not found'));
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe'=>Yii::t('avimi','Email'),

        );
    }

    public function restore()
    {
        $user = User::model()->findByAttributes(array('email'=>$this->email));
        if ($user === null)
            return false;
        $pass = User::generateRandomString(5);
        $user->password = $pass;
        $user->save(false);
        Yii::import('application.modules.mailing.helpers.*');
        $message = 'Email: '.$this->email.'. '.Yii::t('avimi', 'New password: ').$pass;
        SendMail::send($this->email, 'Reset password - '.Yii::app()->name, $message);
        return true;
    }
} 