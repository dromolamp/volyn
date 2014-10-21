<?php $this->title = Yii::t('core/admin','Install Widget'); ?>

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
    'dataProvider'=>$dataProvided,
    'columns'=>array(
        array(
            'name' => Yii::t('core/admin','Title'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data["title"])'

        ),
        array(
            'name' => Yii::t('core/admin','Description'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data["description"])'

        ),
        array(
            'name' => Yii::t('core/admin','Version'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data["version"])'

        ),
        array(
            'name' => Yii::t('core/admin', 'Author name'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data["author"]["name"])'

        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'install'=>array(
                    'label'=>Yii::t('core/admin','Install'),
                    'visible'=>'isset($data["need_upgrade"]) ? false : true',
                    'url'=> 'Yii::app()->createUrl("/admin/widget/install", array("widget"=>$data["name"],"action"=>"install"))',
                ),
                'upgrade'=>array(
                    'label'=>Yii::t('core/admin','Upgrade'),
                    'visible'=>'isset($data["need_upgrade"]) ? true : false',
                    'url'=> 'Yii::app()->createUrl("/admin/widget/install", array("widget"=>$data["name"],"action"=>"upgrade"))',
                ),
            ),
            'template'=>'{install}{upgrade}',
        ),
    ),
)); ?>