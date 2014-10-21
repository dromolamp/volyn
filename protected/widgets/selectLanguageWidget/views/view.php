<div class="multi-lang_widget">
    <ul>
    <li><a href="#">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/<?php echo Yii::app()->language; ?>.jpg" alt=""/>
    </a></li>
    <?php
    foreach ($links as $link){
        echo $link;
    }
    ?>
        </ul>
</div>
