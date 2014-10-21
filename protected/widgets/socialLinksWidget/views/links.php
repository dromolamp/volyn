<?php
/**
 * Created by PhpStorm.
 * User: peter
 * E-mail: petro.stasuk.990@gmail.com
 * Date: 31.01.14
 * Time: 15:09
 */
?>

<div class="circle-link">
    <?php foreach ($links as $link) { ?>
    <a href="<?php echo $link->link; ?>" class="<?php echo $link->css_class; ?>"><?php echo $link->name; ?></a>
    <?php } ?>
</div>