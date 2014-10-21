<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 27.08.13
 * Time: 17:24
 */

class DefaultController extends CmsController
{
    public function actionUnsubscribe($hash)
    {
        $email = base64_decode($hash);
        $user = User::model()->findByAttributes(array(
            'email'=>$email
        ));
        if ($user === null)
            throw new CHttpException(404,'The requested page does not exist.');
        if ($user->profile->status_subscribe == Profile::STATUS_UNSUBSCRIBE)
            $this->render('unsubscribed', array(
                'message'=>'Вы раньше уже отписались от получения всех рассылок.'
            ));
        elseif ($user->profile->status_subscribe == Profile::STATUS_SUBSCRIBE) {
            $user->profile->status_subscribe = Profile::STATUS_UNSUBSCRIBE;
            $user->profile->save(false);
            $this->render('unsubscribed', array(
                'message'=>'Ваш email адрес был отписан от получения всех рассылок.'
            ));
        }
    }
} 