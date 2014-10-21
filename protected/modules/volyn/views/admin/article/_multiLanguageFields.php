<div class="row">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title'.$suffix,array('class'=>'span6')); ?>
    <?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'teaser'); ?>
    <?php $this->widget('application.extensions.yii-ckeditor.CKEditorWidget', array(
        'model' => $model,
        'attribute' => 'teaser'.$suffix,
    )); ?>
    <?php echo $form->error($model,'teaser'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'text'); ?>
    <?php $this->widget('application.extensions.yii-ckeditor.CKEditorWidget', array(
        'model' => $model,
        'attribute' => 'text'.$suffix,
    )); ?>
    <?php echo $form->error($model,'text'); ?>
</div>