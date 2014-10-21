<?php
/* @var $this ProductionController */
/* @var $model Production */
?>
<?php $this->title = Yii::t('core/admin', 'Update Production').' '.$model->id; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>