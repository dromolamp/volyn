<?php
/* @var $this DefaultController */
/* @var $model Mail */
?>

<?php $this->title = Yii::t('blog/admin', 'Отправить письмо'); ?>

<?php echo $this->renderPartial('_mailForm', array(
    'model'=>$model
)); ?>