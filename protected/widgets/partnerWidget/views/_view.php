<div class="brands">
    <h3>
        <?php echo Yii::t('core/site', 'НАШІ ПАРТНЕРИ'); ?>
    </h3>

    <?php foreach($partner_list as $partner) {?>
        <a href="<?php echo $partner->link;  ?>" target="_blank">
            <img src="<?php echo $partner->imagePatch; ?>" alt="<?php echo $partner->alt; ?>"/>
        </a>
    <?php }?>
</div>