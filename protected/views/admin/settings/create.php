<?php
/* @var $this SettingsController */
/* @var $model Params */
?>
<?php $this->title = Yii::t('core/user', 'Create Param'); ?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note"><?php echo Yii::t('core/admin','Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('core/admin','are required.'); ?></p>

    <?php
    if ($form->errorSummary($model))
        Yii::app()->user->setFlash('error', $form->errorSummary($model));
    $this->widget('bootstrap.widgets.TbAlert', array(
        'closeText'=>false,
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model,'key'); ?>
        <?php echo $form->textField($model,'key',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'key'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'desc'); ?>
        <?php echo $form->textField($model,'desc',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'desc'); ?>
    </div>

    <?php
    $this->widget('bootstrap.widgets.TbButton',
        array(
            'label' => $model->isNewRecord ? Yii::t('core/admin', 'Create') : Yii::t('core/admin', 'Save'),
            'buttonType' => 'submit',
            'type' => 'primary',
        )
    );
    ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->
