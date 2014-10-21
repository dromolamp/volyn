<?php
/* @var $this SettingController */
/* @var $model Setting */
?>
<?php $this->title = Yii::t('blog/admin', 'Update Setting').' '.$model->id; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>