<!--======================== content ===========================-->
<div id="content">
    <div class="container">
        <div class="row">
            <div class="grid_8">
                <h2>Цікаве про папір</h2>
                <?php foreach($articles as $model){?>
                    <div class="wrapper">
                        <div class="event_box m_34">
                            <?php echo CHtml::image($model->getImage(200,150),"image", array('class'=>'event_img full_width')); ?>
                            <!--<img src="images/page4_img5.jpg" alt="" class="event_img full_width">-->
                            <div class="extra_wrap">
                                <h6 class="m_0"><?php echo DLocale::dateFormatter('d MMMM yyyy',$model->date_public);?></h6>
                                <h5><a href="<?php echo $this->createUrl('/article/'.$model->seo_link);?>"><?php echo $model->title;?></a></h5>
                                <?php echo $model->teaser;?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <div class="grid_4 m_31">
                <?php $this->position('searchANewDilers');?>
                <hr class="m_53">
                <?php $this->position('randProduction');?>
            </div>
        </div>

    </div>
</div>