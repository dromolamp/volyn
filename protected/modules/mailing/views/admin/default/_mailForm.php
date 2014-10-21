<?php
/* @var $this DefaultController */
/* @var $model Mail */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'mail-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model, "email_id"); ?>
        <?php echo $form->dropDownList($model, "email_id", CHtml::listData(Mail::model()->findAll(), "id", "name"), array(
            "empty"=>"Выберите сообщение"
        ));?>
        <?php echo $form->error($model,'email_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, "user_group"); ?>
        <?php echo $form->dropDownList($model, "user_group", CHtml::listData(Yii::app()->authManager->roles, 'name', 'description'), array(
            "empty"=>"Выберите группу пользователей"
        ));?>
        <?php echo $form->error($model,'user_group'); ?>
    </div>

    <div class="row">
        <?php echo $form->checkBoxList(
            $model,
            "cat_ids",
            CHtml::listData(CouponCategory::model()->findAll(), 'id', 'title'),
            array(
                'template'=>'{label}{input}',
                'checkAll'=>'Выбрать все категории'
            )
        );?>
    </div>

    <div class="row buttons">
        <?php
        $this->widget('bootstrap.widgets.TbButton',array(
            'label' => 'Отправить',
            'buttonType' => 'submit',
            'type' => 'primary',
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->