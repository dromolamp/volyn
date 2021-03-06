<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $username=strtolower($this->username);
        $user=User::model()->find('LOWER(email)=?',array($username));
        if($user===null || $user->status == User::STATUS_NOACTIVE)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$user->id;
            $this->username=$user->username;
            $this->errorCode=self::ERROR_NONE;

            $this->setState('role', $user->role);
            if (isset(Yii::app()->authManager->getAuthItem($user->role)->data['is_admin']))
                $this->setState('is_admin', Yii::app()->authManager->getAuthItem($user->role)->data['is_admin']);
        }
        return $this->errorCode==self::ERROR_NONE;
    }

    public function auth()
    {
        $username=strtolower($this->username);
        $user=User::model()->find('LOWER(email)=?',array($username));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($user->password != $this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$user->id;
            $this->username=$user->username;
            $this->errorCode=self::ERROR_NONE;

            $this->setState('role', $user->role);
            if (isset(Yii::app()->authManager->getAuthItem($user->role)->data['is_admin']))
                $this->setState('is_admin', Yii::app()->authManager->getAuthItem($user->role)->data['is_admin']);
        }
        return $this->errorCode==self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }
}