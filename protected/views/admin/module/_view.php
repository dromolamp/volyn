<div class="view">
    <?php echo CHtml::image($data->imageUrl) ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php
    if ($data->admin_controller!==null)
        echo CHtml::link(CHtml::encode($data->title), array('/'.strtolower($data->name).$data->admin_controller));
    else
        echo CHtml::encode($data->title);
    ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('version')); ?>:</b>
	<?php echo CHtml::encode($data->version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>: </b>
         <?php echo CHtml::link(
            CHtml::encode($data->author_name),
            $data->author_url,
            array('target'=>'_blank')).', '.
            CHtml::encode($data->author_email); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo ($data->status == Module::STATUS_DISABLE ? Yii::t('core/admin','Disabled') : Yii::t('core/admin','Enabled')); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('options')); ?>:</b>
    <?php echo CHtml::link(Yii::t('core/admin','Change'), array('update','id'=>$data->id)); ?>
    <br />

    <?php echo CHtml::link(Yii::t('core/admin','Remove'), array('uninstall','id'=>$data->id)); ?>
    <br />

</div>