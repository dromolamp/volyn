<h2>Продукція тм Волинь</h2>
<?php
$i=0;
foreach($production as $model){
    $i++;
?>
    <?php if($i%2==1){?><div class="row"><?php }?>
        <div class="grid_4 m_22">
            <div class="event_box">
                <a href="<?php echo $this->createUrl('/production/'.$model->seo_link);?>"><img src="/upload/production/<?php echo $model->image;?>" alt="" class="event_img" style="width:101px"></a>
                <div class="extra_wrap">

                    <h5><a href="<?php echo $this->createUrl('/production/'.$model->seo_link);?>"><?php echo $model->title;?></a></h5>

                </div>
            </div>
        </div>
    <?php if($i%2==0){?></div><?php }?>
<?php }
if ($i%2==1){?> </div> <?php }?>
