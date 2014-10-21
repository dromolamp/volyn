<?php $this->title = Yii::t('core/admin','Create user widget');?>

<?php echo $this->renderPartial('_userForm',array('model'=>$model,'listPosition'=>$listPosition)); ?>