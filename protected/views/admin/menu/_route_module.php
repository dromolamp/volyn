<?php Yii::app()->clientscript->scriptMap['jquery.js'] = false; ?>
<div class="row">
    <?php echo CHtml::dropDownList(
        'module',
        '',
        CHtml::listData(Module::model()->findAll(), 'name', 'title'),
        array(
            'id'=>'select_module',
            'empty'=>'Select module'
        )
    ); ?>
    <?php echo CHtml::activeDropDownList($model, 'url', Module::getRoutes(), array(
        'class'=>'moduleRoutes',
        'empty'=>'Выбрать'
    )); ?>
</div>