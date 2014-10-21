<?php $this->title = Yii::t('core/admin','Update user widget').' '.$model->name; ?>

<?php echo $this->renderPartial('_userForm',array('model'=>$model,'listPosition'=>$listPosition)); ?>
