<?php

/**
 * SendForm class.
 * SendForm is the data structure for keeping
 * user login form data.
 */
class SendForm extends CFormModel
{
    public $email_id;
    public $user_group;
    public $cat_ids;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('email_id, user_group, cat_ids', 'required'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email_id'=>Yii::t('core/user','Message'),
            'user_group' => Yii::t('core/user','User group'),

        );
    }

    public function send()
    {
        $mail = Mail::model()->findByPk($this->email_id);
        if ($mail === null) {
            $this->addError('email_id', 'Указаная рассылка не доступна!');
            return false;
        }
        $catArray = array();
        foreach ($this->cat_ids as $id)
            $catArray[] = $id;
        $usersIds = Yii::app()->db->createCommand()
            ->select('user_id')
            ->from('{{profile_subscribe_cat}}')
            ->where('cat_id IN ('.implode(', ',$catArray).')')
            ->group('user_id')
            ->queryColumn();
        $criteria = new CDbCriteria();
        $criteria->with = array('profile');
        $criteria->compare('t.id', $usersIds);
        $criteria->compare('role', $this->user_group);
        $criteria->compare('profile.status_subscribe', Profile::STATUS_SUBSCRIBE);
        $criteria->group = 't.id';
        $criteria->together = true;
        $users = User::model()->findAll($criteria);
        $usersEmailList = array();
        $current_time = time();
        $df = Yii::app()->dateFormatter;
        foreach ($users as $user)
            if (!empty($user->email)) {
                $lastTime = new DateTime($df->format('yyyy-MM-dd HH:mm:ss', $user->profile->last_date_send_mail));
                $difference = 0;
                switch ($user->profile->period_send_mail) {
                    case Profile::PERIOD_SEND_MAIL_ANY_DAY:
                        $difference = 60*60*24;
                        break;
                    case Profile::PERIOD_SEND_MAIL_3_DAY:
                        $difference = 60*60*24*3;
                        break;
                    case Profile::PERIOD_SEND_MAIL_WEEK:
                        $difference = 60*60*24*7;
                        break;
                }
                if ($current_time - $lastTime->getTimestamp() >= $difference || empty($user->profile->last_date_send_mail)) {
                    SendMail::send($user->email, $mail->name, $mail->text.Yii::app()->getController()->renderPartial('_unsubscribe', array('model'=>$user), true));
                    $user->profile->last_date_send_mail = $df->format('yyyy-MM-dd HH:mm:ss', time());
                    $user->profile->save(false);
                }
            }
        return true;
    }
}
