<?php
/* @var $this SocialNetworkLinkController */
/* @var $model SocialNetworkLink */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#social-network-link-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<?php $this->title = Yii::t('4c0eed12/admin', 'Ссылки на соц. сети'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
'id'=>'social-network-link-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
		'link',
		'css_class',
        array(
            'name'=>'status',
            'value'=>'$data->textStatus'
        ),
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}{delete}'
),
),
)); ?>
