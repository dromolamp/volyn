<?php
class FeedbackForm extends CFormModel
{
    public $email;
    public $name;
    public $title;
    public $message;


    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('email, name, title, message', 'required'),
            array('email', 'email'),
            array('title, name', 'length', 'max'=>255),

        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email'	=> Yii::t('avimi', 'Email'),
            'name'	=> Yii::t('avimi', 'Name'),
            'title'	=> Yii::t('avimi', 'Subject'),
            'message' => Yii::t('avimi', 'Message'),

        );
    }

}
