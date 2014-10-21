<?php $this->title = Yii::t('core/admin','Modules');
$this->widget('zii.widgets.CListView', array(
    'summaryText'=>'',
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'htmlOptions'=>array(
        'class'=>''
    )
)); ?>
