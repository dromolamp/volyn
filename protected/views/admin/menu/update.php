<?php
/* @var $this MenuController */
/* @var $model Menu */
?>

<?php $this->title = Yii::t('core/admin','Update Menu').' - '.$model->title; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>