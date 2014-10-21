<?php
/* @var $this DefaultController */
/* @var $model Mail */
?>
<?php $this->title = Yii::t('blog/admin', 'Обновить письмо').' '.$model->id; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>