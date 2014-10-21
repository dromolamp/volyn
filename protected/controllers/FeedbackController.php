<?php
class FeedbackController extends CmsController {

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
                'actions'=>array('send'),
                'users'=>array('*'),
            ),

        );
    }

    public function actionSend()
    {
        $model = new FeedbackForm();

        if(isset($_POST['ajax']) && $_POST['ajax']== 'feedback-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['FeedbackForm']))
        {
            $model->attributes = $_POST['FeedbackForm'];
            if($model->validate())
            {
                Yii::import('application.modules.mailing.helpers.*');

                $message = "<p>Имя: ".$model->name."</p>";
                $message .= "<p>Email: ".$model->email."</p>";
                $message .= "<p>Тема: ".$model->title."</p>";
                $message .= "<p>Дата: ".Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time())."</p>";
                $message .= "<p>Сообщение: <br>".$model->message."</p>";
                SendMail::send( Yii::app()->params['adminEmail'], "Сообщение обратной связи - ".$model->title." -".Yii::app()->name, $message);

               echo CJSON::encode(array('status'=>'success', 'message'=>Yii::t('avimi', 'Message sent!')));
            }

        }

    }


}