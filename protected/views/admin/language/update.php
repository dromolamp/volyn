<?php
/* @var $this LanguageController */
/* @var $model Language */
?>

<?php $this->title = Yii::t('core/admin','Update Language').' - '.$model->title; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>