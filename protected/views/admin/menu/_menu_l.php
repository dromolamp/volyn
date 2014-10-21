<div class="row">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title'.$suffix,array('size'=>60,'maxlength'=>125)); ?>
    <?php echo $form->error($model,'title'.$suffix); ?>
</div>