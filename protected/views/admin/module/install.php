<?php $this->title = Yii::t('core/admin','Install module'); ?>

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


<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'type' => 'primary',
    'toggle' => 'radio',
    'buttons' => array(
        array(
            'label'=>'Сервер',
            'active'=>true,
            'htmlOptions'=>array(
                'onclick'=>'js: $("#install_achive").hide(); $("#install_server").show();'
            )
        ),
        array(
            'label'=>'Архив',
            'htmlOptions'=>array(
                'onclick'=>'js: $("#install_server").hide(); $("#install_achive").show();'
            )
        ),
    ),
)); ?>


<div class="form" id="install_achive" style="display: none;">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'install-module-form',
        'action'=>array('/admin/module/installArchive'),
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($installModel,'name'); ?>
        <?php echo $form->textField($installModel,'name'); ?>
        <?php echo $form->error($installModel,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($installModel,'file'); ?>
        <?php echo $form->fileField($installModel,'file'); ?>
        <?php echo $form->error($installModel,'file'); ?>
    </div>

    <?php
    $this->widget('bootstrap.widgets.TbButton',array(
        'label' => Yii::t('core/admin', 'Install'),
        'buttonType' => 'submit',
        'type' => 'primary',
    )); ?>

    <?php $this->endWidget(); ?>
</div>
<div id="install_server">
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
            'value' => 'CHtml::encode($data["desc"])'

        ),
        array(
            'name' => Yii::t('core/admin','Version'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data["version"])'

        ),
        array(
            'name' => Yii::t('core/admin', 'Author name'),
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data["author"]), $data["web_site"], array("target"=>"_blank"))'

        ),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'install'=>array(
                    'label'=>Yii::t('core/admin','Install'),
                    'visible'=>'isset($data["need_upgrade"]) ? false : true',
                    'url'=> 'Yii::app()->createUrl("/admin/module/install", array("module"=>$data["name"],"action"=>"install"))',
                ),
                'upgrade'=>array(
                    'label'=>Yii::t('core/admin','Upgrade'),
                    'visible'=>'isset($data["need_upgrade"]) ? true : false',
                    'url'=> 'Yii::app()->createUrl("/admin/module/install", array("module"=>$data["name"],"action"=>"upgrade"))',
                ),
            ),
            'template'=>'{install}{upgrade}',
        ),
    ),
)); ?>
</div>