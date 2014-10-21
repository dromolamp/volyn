<style type="text/css">
    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0 }
    #map-canvas { height: 100% }
</style>

<?php
    $baseUrl = Yii::app()->theme->baseUrl;

    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyD4se0s89Wtmraw6KP6jv6q-OSLb1Mmv3g&sensor=true');

    Yii::app()->clientScript->registerScriptFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('application.widgets.contactWidget.js').'/map2.js'
        )
    );

    Yii::app()->clientScript->registerScriptFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('application.widgets.contactWidget.js').'/contact.js'
        ),
        CClientScript::POS_END
    );
?>


<div class="tabs-map">
    <ul class="nav nav-tabs" id="myTab">

        <?php foreach($contact_list as $key => $contact) {?>
            <li <?php if($key==0){echo 'class="active"';} ?> >
                <a href="#tab<?php echo $key+1 ?>" >
                    <i class="<?php echo $contact->icon;?>"></i>
                    <span><?php echo $contact->title; ?></span>
                    <i class="va-helper"></i>
                </a>
            </li>
        <?php }?>

    </ul>
    <div class="tab-content">
        <?php foreach($contact_list as $key => $contact) {?>
            <div class="tab-pane <?php if($key==0){echo 'active';} ?>" id="tab<?php echo $key+1 ?>">
                <div class="tab-info va-middle">
                    <div class="dib">
                        <?php echo $contact->address; ?>
                    </div>
                </div>
                <div class="tab-call va-middle">
                    <div class="dib">
                        <div><?php echo Yii::t('core/site', 'tel'); ?>: <?php echo $contact->code; ?><?php echo $contact->phone; ?></div>
                        <div><?php echo Yii::t('core/site', 'fax'); ?>: <?php echo $contact->code; ?><?php echo $contact->fax; ?></div>
                        <div><?php echo Yii::t('core/site', 'email'); ?>:     <a href="#"><?php echo $contact->email; ?></a></div>
                    </div>
                </div>
                <div id="map<?php echo $key+1 ?>" style="height: 300px; width: 100%;"></div>
                <script>
                    var option = {
                        selector: 'map'+'<?php echo $key+1 ?>',
                        latitude: '<?php echo $contact->latitude; ?>',
                        longitude: '<?php echo $contact->longitude; ?>'
                    };
                    google.maps.event.addDomListener(window, 'load', initialize(option));
                </script>
            </div>
        <?php }?>
        <?php if((Yii::app()->controller->id == 'contact' &&  Yii::app()->controller->action->id == 'index')) {?>
            <div class="form-contact">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'feedback-form',
                    'enableAjaxValidation'=>true,
                    'enableClientValidation'=>false,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        'validateOnChange'=>true
                    ),
                    'action' => array('/academpl/feedback/create'),
                )); ?>

                <?php echo $form->errorSummary($model); ?>
                <div class="form-head"><?php echo Yii::t('core/site', 'we write') ?></div>
                <div class="form-body">
                    <label class="span-5 pull-left" for="Feedback_name"><?php echo Yii::t('core/site', 'Name') ?>
                        <?php echo $form->textField($model,'name'); ?>
                        <?php echo $form->error($model,'name', array('class'=>'error') ); ?>
                    </label>

                    <label class="span-5 pull-right" for="Feedback_email"><?php echo Yii::t('core/site', 'Email') ?>
                        <?php echo $form->textField($model,'email'); ?>
                        <?php echo $form->error($model,'email', array('class'=>'error') ); ?>
                    </label>


                    <label class="span-10" for="Feedback_message"><?php echo Yii::t('core/site', 'Message') ?>
                        <?php echo $form->textArea($model,'message'); ?>
                        <?php echo $form->error($model,'message', array('class'=>'error') ); ?>
                    </label>

                </div>
                <div class="form-footer">
                    <input class="submit" type="submit" value="<?php echo Yii::t('core/site', 'Send') ?>">
                </div>
                <?php $this->endWidget(); ?>
            </div>
        <?php }?>
    </div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade hide modal-2" id="myModal4" role="dialog" tabindex="-1">
    <div class="modal-body"><img alt="" src="/themes/academ/icons/modal-ok.jpg" />
        <h5><?php echo Yii::t('core/site', 'Hi!'); ?></h5>

        <p><?php echo Yii::t('core/site', 'Your request has been sent to the Polish academic centers! Expect a contact with a specialist center.'); ?></p>
    </div>
    <button class="close" data-dismiss="modal" type="button"></button></div>
