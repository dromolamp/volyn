<?php
/* @var $this DefaultController */
/* @var $model Mail */


?>



<?php $this->title = Yii::t('mailing/admin', 'Управление рассылками'); ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true,
    'fade'=>true,
    'closeText'=>'&times;',
    'alerts'=>array(
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
    ))); ?>

<?php $this->widget('bootstrap.widgets.TbButton',array(
    'label' => '+ Добавить письмо',
    'type' => 'success',
    'buttonType' => 'link',
    'url' => array('admin/default/create')
)); ?>&nbsp;&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton',array(
    'label' => '+ Отправить рассылку',
    'type' => 'success',
    'buttonType' => 'link',
    'url' => array('admin/default/sendMail')
)); ?>
<br/>
<br/>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'type'=>'striped bordered condensed',
'id'=>'mail-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
		'pub_date',
array(
'htmlOptions' => array('nowrap'=>'nowrap'),
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}{delete}'
),
),
)); ?>
