<h4>Останні статті</h4>
<div class="row">
    <div class="grid_4 m_22">
        <div class="event_box">
            <a href="<?php echo Yii::app()->controller->createUrl('/article/'.$articles[0]->seo_link);?>">
                <?php echo CHtml::image($articles[0]->getImage(101,101),"image", array('class'=>'event_img')); ?>
            </a>
            <div class="extra_wrap">
                <h6 class="m_0"><?php echo DLocale::dateFormatter('d MMMM yyyy',$articles[0]->date_public);?></h6>
                <h5><a href="<?php echo Yii::app()->controller->createUrl('/article/'.$articles[0]->seo_link);?>"><?php echo $articles[0]->title;?></a></h5>
            </div>
        </div>
    </div>
    <div class="grid_4 m_22">
        <div class="event_box">
            <a href="<?php echo Yii::app()->controller->createUrl('/article/'.$articles[1]->seo_link);?>">
                <?php echo CHtml::image($articles[1]->getImage(101,101),"image", array('class'=>'event_img')); ?>
            </a>
            <div class="extra_wrap">
                <h6 class="m_0"><?php echo DLocale::dateFormatter('d MMMM yyyy',$articles[1]->date_public);?></h6>
                <h5><a href="<?php echo Yii::app()->controller->createUrl('/article/'.$articles[1]->seo_link);?>"><?php echo $articles[1]->title;?></a></h5>
            </div>
        </div>
    </div>
</div>