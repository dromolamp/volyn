<?php
/* @var $this SettingController */
/* @var $model Setting */

?>

<?php $this->title = Yii::t('core/admin', 'Manage Settings'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
'id'=>'setting-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'key',
		array(
            'name'=>'title',
            'type'=>'html'
        ),
		array(
            'name'=>'value',
            'type'=>'html',
        ),
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}'
),
),
)); ?>
