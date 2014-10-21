<?php
/* @var $this SocialNetworkLinkController */
/* @var $model SocialNetworkLink */
?>
<?php $this->title = Yii::t('blog/admin', 'Редактировать ссылку').' '.$model->id; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>