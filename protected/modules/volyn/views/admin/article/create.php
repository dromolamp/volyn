<?php
/* @var $this ArticleController */
/* @var $model Article */
?>

<?php $this->title = Yii::t('core/admin', 'Create Article'); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>