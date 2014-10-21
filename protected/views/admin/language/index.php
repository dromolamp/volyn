<?php
/* @var $this LanguageController */
/* @var $model Language */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#language-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->title = Yii::t('core/admin','Manage Languages'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'post-cat-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name',
        'title',
        array(
            'name'=>'status',
            'value'=>'$data->statusText',
            'filter'=>array(
                Language::STATUS_NO_PUBLISHED=>Yii::t('core/admin','Disable'),
                Language::STATUS_PUBLISHED=>Yii::t('core/admin','Enable'),
                Language::STATUS_SYSTEM=>Yii::t('core/admin','System language'),
            )
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
            'buttons'=>array(
                'update'=>array(
                    'visible'=>'($data->status == Language::STATUS_SYSTEM ? false : true)',
                ),
                'delete'=>array(
                    'visible'=>'($data->status == Language::STATUS_SYSTEM ? false : true)',
                ),
            ),
        ),
    ),
)); ?>

