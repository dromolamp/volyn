<?php
/* @var $this UserController */
?>

<?php $this->title = Yii::t('core/user', 'Manage users roles'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'roles-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'header'=>Yii::t('core/admin', 'Description'),
            'name'=>'description'
        ),
        array(
            'header'=>Yii::t('core/admin', 'Name'),
            'name'=>'name'
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateRole", array("name"=>$data->name))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("deleteRole", array("name"=>$data->name))',
        ),
    ),
)); ?>
