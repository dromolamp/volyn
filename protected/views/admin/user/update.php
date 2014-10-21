<?php
/* @var $this UserController */
/* @var $model User */
?>
<?php $this->title = Yii::t('core/user', 'Update User') . ' ' . $model->id; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>