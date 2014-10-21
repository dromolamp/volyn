<?php
/**
 * Created by PhpStorm.
 * User: mukolla
 * Date: 10.04.14
 * Time: 16:38
 */
?>

<ul class="rslides" id="slider1">
    <?php foreach($slider_list as $slider) { ?>
        <li>
            <img src="<?php echo $slider->imagePatch; ?>" alt="<?php echo $slider->title; ?>">
        </li>
    <?php }?>
</ul>