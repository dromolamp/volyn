<div class="row">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model, 'title'.$suffix,array('size'=>60,'maxlength'=>128)); ?>
    <?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'value'); ?>
    <?php $this->widget('application.extensions.yii-ckeditor.CKEditorWidget', array(
        'model' => $model,
        'attribute' => 'value'.$suffix,
        'htmlOptions'=>array('value'=>$model->{'value'.$suffix})
    )); ?>
    <?php echo $form->error($model,'value'); ?>
</div>