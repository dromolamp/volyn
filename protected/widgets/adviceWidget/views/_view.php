<div class="caption">
    <span class="text"><?php echo Yii::t('core/site', 'Expert Advice'); ?></span>
    <span class="va-helper"></span>
</div>
<div class="states">
    <?php foreach($news_list as $news) { ?>
        <div class="news">
            <span class="data"><?php echo DLocale::dateFormatter('d MMMM yyyy',$news->date_public);?></span>
            <a href="<?php echo Yii::app()->createUrl('/advice/'.$news->seo_link); ?>" class="description"><?php echo $news->name; ?></a>
        </div>
    <?php } ?>
    <div class="all-link">
        <a href="<?php echo Yii::app()->createUrl('/advice'); ?>">
            <span class="icons-link"></span>
            <span class="text"><?php echo Yii::t('core/site', 'Більше статей'); ?></span>
        </a>
    </div>
</div>