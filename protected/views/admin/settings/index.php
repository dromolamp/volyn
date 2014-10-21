<?php $this->title = Yii::t('core/admin','General site settings');?>
<div class="form">
    <?php echo CHtml::beginForm(); ?>
        <?php foreach ($paramsDesc as $desc) { ?>
            <div class="row">
                <?php echo CHtml::label($desc->desc, $desc->key); ?>
                <?php echo CHtml::textField($desc->key, (isset($params[$desc->key]) ? $params[$desc->key] : '' ))?>
            </div>
        <?php } ?>
    <?php
        $this->widget('bootstrap.widgets.TbButton',array(
            'label' => Yii::t('core/admin','Save'),
            'buttonType' => 'submit',
            'type' => 'primary',
            'htmlOptions'=>array(
                'name'=>'save'
            )
        )); ?>
    <?php echo CHtml::endForm(); ?>
</div>