<?php
/* @var $this DefaultController */
/* @var $model Mail */
?>

<?php $this->title = Yii::t('blog/admin', 'Создать письмо'); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>