<?php
/* @var $this MenuController */
/* @var $model Menu */
?>

<?php $this->title = Yii::t('core/admin','Update menu item'); ?>

<?php echo $this->renderPartial('_form_item', array('model'=>$model)); ?>