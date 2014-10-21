<?php
$this->breadcrumbs=array(
	'Seotexts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Seotext', 'url'=>array('index')),
	array('label'=>'Create Seotext', 'url'=>array('create')),
	array('label'=>'Update Seotext', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Seotext', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Seotext', 'url'=>array('admin')),
);
?>

<h1>View Seotext #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'content',
		'link',
		'page_title',
		'meta_desc',
		'meta_keys',
		'status',
	),
)); ?>
