<div id="content">
    <div class="container">
        <div class="row">
            <div class="grid_8">
                <h4><?php echo $model->title;?></h4>
                <img src="/upload/article/<?php echo $model->image?>" style="float:right; margin: 5px;" />
                <h6 class="m_19"><?php echo DLocale::dateFormatter('d MMMM yyyy',$model->date_public);?></h6>
                <?php echo $model->text;?>
                <h4>Інші статті</h4>
                <div class="row">
                    <div class="grid_4 m_22">
                        <div class="event_box">
                            <a href="<?php echo $this->createUrl('/article/'.$articles[0]->seo_link);?>">
                            <?php echo CHtml::image($articles[0]->getImage(101,101),"image", array('class'=>'event_img')); ?>
                            </a>
                            <div class="extra_wrap">
                                <h6 class="m_0"><?php echo DLocale::dateFormatter('d MMMM yyyy',$articles[0]->date_public);?></h6>
                                <h5><a href="<?php echo $this->createUrl('/article/'.$articles[0]->seo_link);?>"><?php echo $articles[0]->title;?></a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="grid_4 m_22">
                        <div class="event_box">
                            <a href="<?php echo $this->createUrl('/article/'.$articles[1]->seo_link);?>">
                            <?php echo CHtml::image($articles[1]->getImage(101,101),"image", array('class'=>'event_img')); ?>
                            </a>
                            <div class="extra_wrap">
                                <h6 class="m_0"><?php echo DLocale::dateFormatter('d MMMM yyyy',$articles[1]->date_public);?></h6>
                                <h5><a href="<?php echo $this->createUrl('/article/'.$articles[1]->seo_link);?>"><?php echo $articles[1]->title;?></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid_4">
                <?php $this->position('searchANewDilers');?>
                <hr class="m_53">
                <?php $this->position('randProduction');?>
            </div>
        </div>
    </div>
</div>