<h4>Популярні товари<h4>
<?php foreach($models as $model){?>

        <div class="event_box">
            <a href="<?php echo Yii::app()->controller->createUrl('/production/'.$model->seo_link);?>"><img src="/upload/production/<?php echo $model->image;?>" alt="" class="event_img" style="width:101px"></a>
            <div class="extra_wrap">

                <h5><a href="<?php echo Yii::app()->controller->createUrl('/production/'.$model->seo_link);?>"><?php echo $model->title;?></a></h5>

            </div>
        </div>
    <div style="clear:both"></div>
<?php }?>
