<h3><?php echo Yii::t('core/site', 'NEWS'); ?></h3>

<?php foreach($news_list as $news) { ?>
    <a href="<?php echo Yii::app()->createUrl('/news/'.$news->seo_link); ?>">
        <span class="preview">
            <img src="<?php echo $news->getImage(96,96); ?>" alt="<?php echo $news->name; ?>"/>
        </span>
        <span class="description">
            <span class="data"><?php echo DLocale::dateFormatter('d MMMM yyyy',$news->date_public);?></span>
            <span class="info"><?php echo $news->name; ?></span>
        </span>
    </a>
<?php } ?>


<div class="all-link">
    <a href="<?php echo Yii::app()->createUrl('/news'); ?>">
        <span class="icons-link"></span>
        <span class="text">
            <?php echo Yii::t('core/site','Всі новини'); ?>
        </span>
    </a>
</div>