<?php $this->title = Yii::t('core/admin','Widgets'); ?>
<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')): ?>

<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('error'); ?>
</div>

<?php endif; ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'post-cat-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'name',
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'title',
            'editable' => array(
                'url' => $this->createUrl('updateField'),
                'inputclass' => 'span3'
            )
        ),
        'author_name',
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'status',
            'filter'=> false,
            'value' => '$data->statusName',
            'sortable'=>false,
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('updateField'),
                'source'  => $this->createUrl('statusList'),
                'onInit' => 'js: function(e, editable) {
                    var colors = {0: "gray", 1: "green"};
                    $(this).css("color", colors[editable.value]);
                }',
                'options' => array(
                    'display' => 'js: function(value, sourceData) {
                          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
                              colors = {0: "gray", 1: "green"};
                          $(this).text(selected[0].text).css("color", colors[value]);
                      }'
                ),
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'position',
            'filter'=> false,
            'value' => '$data->position',
            'sortable'=>false,
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('updateField'),
                'source'  => $this->createUrl('positionList'),
            )
        ),
//        'position',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}&nbsp;{delete}{copy}',
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'Yii::app()->createUrl("/admin/widget/uninstall", array("id"=>$data->id))',
                ),
                'copy'=>array(
                    'label'=>'Copy',
                    'url'=>'Yii::app()->createUrl("/admin/widget/copy", array("id"=>$data->id))',
                    'visible'=>'$data->parent_id == null ? true : false',
                ),
            ),
        ),
    ),
)); ?>