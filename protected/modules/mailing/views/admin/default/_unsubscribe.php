<div>
    Для того, что бы отписаться от рассылки, перейдите по следующей ссылке: <a href="<?php echo Yii::app()->request->hostInfo.Yii::app()->getController()->createUrl('/mailing/default/unsubscribe', array('hash'=>base64_encode($model->email)))?>" target="_blank">Отписаться</a>
</div>