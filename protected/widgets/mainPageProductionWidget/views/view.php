<h4>Популярні товари</h4>
<div class="row">
    <?php foreach ($production as $product){?>
        <div class="grid_4 m_22">
            <div class="event_box">
                <a href="<?php echo Yii::app()->controller->createUrl('/production/'.$product->seo_link);?>"><img src="/upload/production/<?php echo $product->image;?>" alt="" class="event_img" style="width:101px"></a>
                <div class="extra_wrap">

                    <h5><a href="<?php echo Yii::app()->controller->createUrl('/production/'.$product->seo_link);?>"><?php echo $product->title;?></a></h5>

                </div>
            </div>
        </div>
    <?php }?>
</div>