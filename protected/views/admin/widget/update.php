<?php $this->title = Yii::t('core/admin','Update Widget').' '.$model->title; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'listPosition'=>$listPosition)); ?>