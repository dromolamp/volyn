<?php
/* @var $this MenuController */
/* @var $model Menu */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#menu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->title = Yii::t('core/admin','Manage Menu'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'post-cat-grid',
    'dataProvider'=>$model->adminSearchMenu(),
    'filter'=>$model,
    'columns'=>array(
        'title',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}&nbsp;{delete}',
        ),
    ),
)); ?>

