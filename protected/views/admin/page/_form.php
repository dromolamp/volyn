<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php $this->widget('application.components.MultiLanguageWidget', array(
        'model'=>$model,
        'viewItem'=>'_multiLanguageFields',
        'form'=>$form
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'author_id'); ?>
        <?php echo $form->dropDownList($model,'author_id', CHtml::listData(User::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model,'author_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pub_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model'=>$model,
            'attribute'=>'pub_date',
            'options'=>array(
                'dateFormat'=>'dd.mm.yy',
            ),
        )); ?>
        <?php echo $form->error($model,'pub_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'is_main'); ?>
        <?php echo $form->checkBox($model, 'is_main', array('value'=> 1));?>
        <?php echo $form->error($model,'is_main'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'layouts'); ?>
        <?php echo $form->textField($model, 'layouts'); ?>
        <?php echo $form->error($model,'layouts'); ?>
    </div>

    <div class="row buttons">
        <?php
        $label = $model->isNewRecord ? "Create" : "Save";
        $this->widget('bootstrap.widgets.TbButton',array(
            'label' => Yii::t('core/admin', $label),
            'buttonType' => 'submit',
            'type' => 'primary',
        )); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->