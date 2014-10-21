<?php
/* @var $this SettingsController */
?>
<?php $this->title = Yii::t('core/admin', 'Manage Params Descriptions'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'desc-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'key',
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'desc',
            'editable' => array(
                'url' => $this->createUrl('updateField'),
                'inputclass' => 'span3'
            )
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}'
        ),
    ),
)); ?>
