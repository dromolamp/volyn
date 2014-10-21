<h2><?php echo $model->title;?></h2>
<div class="wrapper">
    <div class="event_box m_34">
        <a href="/upload/production/<?php echo $model->image;?>" rel="gallery">
            <img src="/upload/production/<?php echo $model->image;?>" alt="" class="event_img full_width" width="270" rel="gallery">
        </a>
        <div class="extra_wrap">
            <?php echo $model->text;?>
        </div>
    </div>
</div>
<h2>Інші товари</h2>
<div class="row">
    <?php foreach ($production as $product){?>
    <div class="grid_4 m_22">
        <div class="event_box">
            <a href="<?php echo $this->createUrl('/production/'.$product->seo_link);?>"><img src="/upload/production/<?php echo $product->image;?>" alt="" class="event_img" style="width:101px"></a>
            <div class="extra_wrap">

                <h5><a href="<?php echo $this->createUrl('/production/'.$product->seo_link);?>"><?php echo $product->title;?></a></h5>

            </div>
        </div>
    </div>
    <?php }?>
</div>

<?php
$this->widget('application.modules.volyn.extensions.fancybox.EFancyBox', array(
        'target'=>'a[rel=gallery]',
        'config'=>array(),
    )
);
?>