<?php
/* @var $this ProductionController */
/* @var $model Production */
?>

<?php $this->title = Yii::t('volyn/admin', 'Manage Productions'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
'id'=>'production-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
    array(
        'name' => 'image',
        'value' => '$data->image ? CHtml::link(CHtml::image($data->getImage(200,150)), Yii::app()->controller->createUrl("update", array("id" => $data->id))) : ""',
        'type' => 'html',
    ),
    /*'date_create',
    'date_update',*/
    /*'seo_link',*/
    'title',
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}{delete}'
),
),
)); ?>
