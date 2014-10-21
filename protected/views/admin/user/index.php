<?php
/* @var $this UserController */
/* @var $model User */


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->title = Yii::t('core/user', 'Manage Users'); ?>

<?php echo CHtml::link(Yii::t('core/admin', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'post-cat-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'username',
        'email',
        'name',
        array(
            'name'=>'role',
            'value'=>'Yii::app()->authManager->getAuthItem($data->role)->description',
            'filter'=>CHtml::activeDropDownList($model,'role',
                CHtml::listData(Yii::app()->authManager->roles, 'name', 'description'),
                array('empty'=>'------')
            ),
        ),
        array(
            'name'=>'status',
            'value'=>'$data->statusName',
            'filter'=>CHtml::activeDropDownList($model,'status', array(
                User::STATUS_ACTIVE => Yii::t('core/admin', 'Active'),
                User::STATUS_NOACTIVE => Yii::t('core/admin','No active'),

            ), array('empty'=>'------')),
        ),
        array(
            'name'=>'filter_online',
            'value'=>'$data->isOnline ? "Онлайн" : "Оффлайн"',
            'filter'=>array(User::STATUS_ONLINE=>'Онлайн', User::STATUS_OFFLINE=>'Оффлайн')
        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}&nbsp;&nbsp;{delete}',

            'deleteConfirmation'=>"js:'Запись '+$(this).closest('tr').find('td').eq(2).text()+' будет удалена! Продолжить?'",

            /*'buttons'     => array(
                'delete' => array(
                    //'icon'  => 'trash',
                    //'label' => 'Remove from project',
                    //'url'   => 'Yii::app()->controller->createUrl("removeCandidate", array("id" => $data->id, "project_id" => $data->project_id))',
                    'click' => 'js:function(e) {
                                    //e.preventDefault();
                                    var location = $(this).attr("href");
                                    var confirm_item = $(this).closest("tr").find("td").eq(2).text();
                                    bootbox.confirm("<div class=\"confirm-text\"><p>Вы действительно желаете удалить запись "+confirm_item+" ?</p></div>", "Нет", "Да", function(confirm) {
                                        //if (confirm) { deleteCandidate(location); }
                                        return true;
                                    });
                                    return false;
                                }',
                ),
            )*/

        ),
    ),
)); ?>
