<?php
/* @var $this SiteController */
/* @var $error array */
?>
<div style="padding: 35px; ">
    <h2 style="font-family: 'FuturaRoundBold';
font-size: 30px;
color: #0092c1;
padding: 0 0 25px;"><?php echo Yii::t('core/site', 'Error').' - '.$code; ?></h2>

    <div class="error">
    <?php echo CHtml::encode($message); ?>
    </div>
</div>