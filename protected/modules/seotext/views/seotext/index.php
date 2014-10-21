<?php
$this->breadcrumbs=array(
	'Seotexts',
);

$this->menu=array(
	array('label'=>'Create Seotext', 'url'=>array('create')),
	array('label'=>'Manage Seotext', 'url'=>array('admin')),
);
?>

<h1>Seotexts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
