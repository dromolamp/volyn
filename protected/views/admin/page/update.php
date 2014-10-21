<?php
/* @var $this PageController */
/* @var $model Page */

?>

<?php $this->title = 'Обновить страницу '.$model->title; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>