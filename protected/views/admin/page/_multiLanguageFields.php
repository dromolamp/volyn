<div class="row">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title'.$suffix,array('size'=>60,'maxlength'=>128, 'value'=>$model->title)); ?>
    <?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'content'); ?>
    <?php $this->widget('application.extensions.yii-ckeditor.CKEditorWidget', array(
        'model' => $model,
        'attribute' => 'content'.$suffix,
        'config'=>array(
            'contentsCss'=>Yii::app()->theme->baseUrl.'/stylesheets/agro.css'
        )
    )); ?>
    <?php echo $form->error($model,'content'); ?>
</div>