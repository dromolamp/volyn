<div class="multi-lang">
    <a href="#">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/<?php echo Yii::app()->language; ?>.jpg" alt=""/>
    </a>
    <?php
        echo CHtml::tag('ul', array() , implode("\n", $links));
    ?>
</div>


