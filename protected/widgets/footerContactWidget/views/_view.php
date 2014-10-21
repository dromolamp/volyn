<div class="col-xs-3">
    <div class="contact-info">
        <div class="icons-adres big"></div>
        <span class="text"><?php echo $company->manager->address; ?></span>
    </div>
    <div class="contact-info">
        <div class="icons-contact big"></div>
            <span class="text">
                <?php echo $company->manager->phone;?> <br/>
<!--                --><?php //foreach($company->manager->managerPhones as $phone) {?>
<!--                    --><?php //echo $phone->phone; ?><!-- <br/>-->
<!--                --><?php //}?>
            </span>
    </div>
    <a class="map-link" href="#">
        <span class="icons-map-link"></span>
        <span class="description"><?php echo Yii::t('core/site', 'Подивитись на карті'); ?></span>
    </a>
</div>